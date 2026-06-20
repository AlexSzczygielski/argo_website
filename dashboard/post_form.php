<?php
//Session
require_once(__DIR__ . '/auth_check.php');

// Decide on correct operation mode
$post_id = $_GET['id'] ?? null;
$is_edit = $post_id !== null;

$page_title = "SKR Argo AGH - " . ($is_edit ? "Edycja Postu" : "Nowy Post");
$page_description = $is_edit ? "CMS - Edycja Postu" : "CMS - Nowy Post";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";

$post = null;
if($is_edit){
    // Handle post loading
    try{
        require_once(__DIR__ . '/../db/db.php');
        /* Fetch post */
        $post_id = $_GET['id'] ?? null;
        $pdo = get_pdo();
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
        $post = $stmt->fetch();
    } catch (Exception $e) {
        error_log("DB error: " . $e->getMessage());
        $post = [
            'title'       => 'Błąd połączenia',
            'excerpt'     => 'Nie można załadować wpisu. Spróbuj ponownie później.',
            'date'        => date('Y-m-d'),
            'author'      => 'Błąd połączenia',
            'cover_image' => 'storage/images/argologo.png',
            'content'     => 'Błąd połączenia',
            'results_url'          => 'Błąd połączenia',
            'photo_credits' => '0',
        ];
    }

    //Load gallery
    $gallery = [];
    if ($post) {
        try{
            require_once(__DIR__ . '/../db/db.php');
            $gallery_stmt = $pdo->prepare("SELECT * FROM post_gallery WHERE post_id = :id ORDER BY sort_order");
            $gallery_stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
            $gallery_stmt->execute();
            $gallery = $gallery_stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e){
            error_log("DB error: " . $e->getMessage());
        }
    }

// Not post handling
    if (!$post) {
        $post = [
            'title'       => 'Brak wpisu',
            'excerpt'     => 'Nie można załadować wpisu. Spróbuj ponownie później.',
            'date'        => date('Y-m-d'),
            'author'      => 'Brak wpisu',
            'cover_image' => 'storage/images/argologo.png',
            'content'     => 'Brak wpisu',
            'id'          => 'Brak wpisu',
            'results_url' => 'Brak wpisu',
            'photo_credits' => '0',
        ];
    }
}

// Members can't edit a post that's awaiting admin review or already
// published — both have consequences (silent re-submission / silent
// unpublishing) that the member might not intend. They must explicitly
// revert it first. Admins keep full edit access in every state.
$user_is_admin = !empty($_SESSION['admin']);
$post_status = $post['status'] ?? null;
$post_is_in_review_or_live = in_array($post_status, ['pending', 'published'], true);

$is_post_locked_for_member = $is_edit
    && $post
    && !$user_is_admin
    && $post_is_in_review_or_live;

/**
 * Handle form POST methods - updating SQL DB
 */
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    csrf_verify();
    require_once(__DIR__ . '/sanitiser.php');
    $clean_content = sanitise_post_html($_POST['content'] ?? '');

    // whitelist actions. "submit_review" saves as draft, then redirects to
    // submit_post.php for explicit confirmation before status becomes pending.
    $allowed_actions = ['draft', 'published', 'submit_review'];
    $action = in_array($_POST['action'] ?? '', $allowed_actions, true) ? $_POST['action'] : 'draft';
    $status = ($action === 'submit_review') ? 'draft' : $action;

    // published only allowed for admins additional check
    if ($status === 'published' && !$_SESSION['admin']) {
        $status = 'draft';
    }

    //Update DB
    try{
        //Determine correct sql query - INSERT/UPDATE
        require_once(__DIR__ . '/../db/db.php');
        require_once(__DIR__ . '/messages.php');
        if($is_edit){
            //Editing (UPDATE)
            $pdo = get_pdo();
            $stmt = $pdo->prepare("UPDATE posts SET
                        title = :title,
                        excerpt = :excerpt,
                        date = :date,
                        author = :author,
                        content = :content,
                        results_url = :results_url,
                        photo_credits = :photo_credits,
                        status = :status
                        WHERE id = :id"); 
            
            $stmt-> bindValue(':title', $_POST['title']);
            $stmt->bindValue(':excerpt', $_POST['excerpt'] ?? null);
            $stmt->bindValue(':date', $_POST['date']);
            $stmt->bindValue(':author', $_POST['author'] ?? null);
            $stmt->bindValue(':content', $clean_content);
            $stmt->bindValue(':results_url', $_POST['results_url'] ?? null);
            $stmt->bindValue(':photo_credits', isset($_POST['photo_credits']) ? 1 : 0, PDO::PARAM_INT);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
            $stmt->execute();
            require_once(__DIR__ . '/activity_log.php');
            log_action('post.update', (int)$post_id, ['status' => $status, 'action' => $action]);
            if ($action === 'submit_review') {
                header('Location: /dashboard/submit_post.php?id=' . $post_id);
                exit;
            }
            $msg = ($status === 'published') ? MSG_PUBLISHED : MSG_SAVED;
            header('Location: /dashboard/post_form.php?id=' . $post_id . '&message=' . $msg);
            exit;

        }else{
            //new post (INSERT)
            $pdo = get_pdo();
            $stmt = $pdo->prepare("INSERT INTO posts 
            (title, excerpt, date, author, content, results_url, photo_credits, status)
            VALUES (:title, :excerpt, :date, :author, :content, :results_url, :photo_credits, :status)"); 
            
            $stmt-> bindValue(':title', $_POST['title']);
            $stmt->bindValue(':excerpt', $_POST['excerpt'] ?? null);
            $stmt->bindValue(':date', $_POST['date']);
            $stmt->bindValue(':author', $_POST['author'] ?? null);
            $stmt->bindValue(':content', $clean_content);
            $stmt->bindValue(':results_url', $_POST['results_url'] ?? null);
            $stmt->bindValue(':photo_credits', isset($_POST['photo_credits']) ? 1 : 0, PDO::PARAM_INT);
            $stmt->bindValue(':status', $status);
            $stmt->execute();
            /**
             * Gallery can be uploaded only after post has an ID
             * After INSERT - redirect to the same page, so that photos can be added
             */
            $new_id = $pdo->lastInsertId();
            require_once(__DIR__ . '/activity_log.php');
            log_action('post.create', (int)$new_id, ['status' => $status, 'action' => $action]);
            if ($action === 'submit_review') {
                header('Location: /dashboard/submit_post.php?id=' . $new_id);
                exit;
            }
            $msg = ($status === 'published') ? MSG_PUBLISHED : MSG_SAVED;
            header('Location: /dashboard/post_form.php?id=' . $new_id . "&message=" . $msg);
            exit;
        }
    } catch(Exception $e){
        error_log("DB error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<?php require_once(__DIR__ . '/../layout/header.php');?>
</head>
<body>
    <div class="page-container">
        <div class="content-wrap">
            <?php require_once(__DIR__ . '/../layout/navbar.php'); ?>
            <!-- Page content starts here -->
            <div class="container-x-l p-4">
                <div class="mt-5 mb-4">
                    <h1 class="mb-2"><?= $is_edit ? "Edycja Postu" : "Nowy Post" ?></h1>
                    <a href="/dashboard/panel.php" class="btn btn-sm btn-outline-secondary">← Wróć do panelu</a>
                </div>

                <!--Show return message -->
                    <?php if (isset($_GET['message'])): ?>
                        <?php $messages = [
                                    'published' => ['text' => 'Post został opublikowany.',          'class' => 'success'],
                                    'deleted'   => ['text' => 'Post został usunięty.',              'class' => 'danger'],
                                    'saved'     => ['text' => 'Post został zapisany.',              'class' => 'success'],
                                    'error'     => ['text' => 'Błąd podczas przesyłania zdjęć.',   'class' => 'danger'],
                                    'partial'   => ['text' => 'Część zdjęć nie została przesłana.','class' => 'warning'],
                                    'no_file'   => ['text' => 'Nie wybrano żadnego pliku.',         'class' => 'warning'],
                                    'reverted'  => ['text' => 'Post cofnięty do szkicu — możesz go edytować.', 'class' => 'success'],
                                ];
                        ?>
                        <?php $msg = $messages[$_GET['message']] ?? null; ?>
                        <?php if ($msg): ?>
                            <div class="alert alert-<?= $msg['class'] ?> alert-dismissible fade show" role="alert">
                                <?= $msg['text'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['gallery_upload_errors'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Nie udało się przesłać niektórych zdjęć:</strong>
                            <ul class="mb-0 mt-2">
                                <?php foreach ($_SESSION['gallery_upload_errors'] as $err): ?>
                                    <li><code><?= htmlspecialchars($err['name']) ?></code> — <?= htmlspecialchars($err['reason']) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['gallery_upload_errors']); ?>
                    <?php endif; ?>


                <?php if ($is_post_locked_for_member): ?>
                    <!-- Read-only lockout for members on a pending or published post -->
                    <?php $is_published_lock = $post['status'] === 'published'; ?>
                    <div class="d-flex align-items-center justify-content-center" style="min-height: 400px;">
                        <div class="card shadow p-4" style="max-width: 540px; width: 100%;">
                            <?php if ($is_published_lock): ?>
                                <h4 class="mb-3">Post jest opublikowany na blogu</h4>
                                <p>
                                    Post <strong><?= htmlspecialchars($post['title']) ?></strong>
                                    jest publicznie widoczny na blogu. Aby wprowadzić zmiany,
                                    musisz najpierw wycofać go z bloga do szkicu.
                                </p>
                                <p class="text-muted small mb-0">
                                    Po wycofaniu post zniknie z bloga do czasu ponownego
                                    zatwierdzenia przez administratora.
                                </p>
                                <?php $revert_label = 'Wycofaj z bloga'; ?>
                            <?php else: ?>
                                <h4 class="mb-3">Post oczekuje na zatwierdzenie</h4>
                                <p>
                                    Post <strong><?= htmlspecialchars($post['title']) ?></strong>
                                    oczekuje na zatwierdzenie przez administratora i nie może być
                                    edytowany w trakcie weryfikacji.
                                </p>
                                <p class="text-muted small mb-0">
                                    Aby wprowadzić zmiany, cofnij post do szkicu — po zmianach
                                    wyślesz go ponownie do zatwierdzenia.
                                </p>
                                <?php $revert_label = 'Cofnij do szkicu'; ?>
                            <?php endif; ?>
                            <form method="POST" action="/dashboard/revert_post.php" id="revert-form">
                                <?= csrf_field() ?>
                                <input type="hidden" name="post_id" value="<?= (int)$post_id ?>">
                                <div class="d-flex gap-2 mt-3">
                                    <a href="/dashboard/panel.php" class="btn btn-outline-secondary">← Wróć do panelu</a>
                                    <button type="submit" class="btn btn-warning"><?= $revert_label ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        // Double-click guard for the revert button
                        (function() {
                            let submitting = false;
                            const f = document.getElementById('revert-form');
                            f.addEventListener('submit', function(e) {
                                if (submitting) { e.preventDefault(); return; }
                                submitting = true;
                                f.querySelectorAll('button[type="submit"]').forEach(b => b.classList.add('disabled'));
                            });
                        })();
                    </script>
                <?php else: ?>
                <div class="row g-4">
                    <!-- LEFT: Form -->
                    <div class="col-md-6">
                        <!-- Gallery -->
                         <?php if (!$is_edit && !$post): ?>
                            <div class="mb-3">
                                <label class="form-label">Aby dodać zdjęcia, <strong>najpierw zapisz post (szkic)</strong>.</label>
                            </div>
                        <?php endif; ?>
                        <?php if ($is_edit && $post): ?>
                        <div class="mt-4">
                            <!-- Cover IMG -->
                             <div class="mb-3">
                                <label class="form-label">Cover Image (zdjęcie tytułowe)</label>
                                <?php if (!empty($post['cover_image'])): ?>
                                    <div>
                                        <img src="/<?= htmlspecialchars($post['cover_image']) ?>"
                                            class="img-fluid rounded"
                                            style="max-height: 150px; object-fit: cover;">
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted small">Nie wybrano okładki — kliknij "Ustaw okładkę" przy zdjęciu z galerii.</p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Galeria</label>
                                <!-- Existing images -->
                                <div class="row g-2 mb-3">
                                    <?php foreach ($gallery as $image): ?>
                                        <div class="col-3">
                                            <img src="/<?= htmlspecialchars($image['directory'] . '/' . $image['filename']) ?>"
                                                class="img-fluid rounded"
                                                style="height: 100px; object-fit: cover; width: 100%;">
                                            <form method="POST" action="/dashboard/set_cover.php">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="post_id" value="<?= (int)$post_id ?>">
                                                <input type="hidden" name="image_path" value="<?= htmlspecialchars($image['directory'] . '/' . $image['filename']) ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-success mt-1 w-100">Ustaw okładkę</button>
                                            </form>
                                            <form method="POST" action="/dashboard/delete_gallery_image.php">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="image_id" value="<?= (int)$image['id'] ?>">
                                                <input type="hidden" name="post_id" value="<?= (int)$post_id ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger mt-1 w-100">Usuń</button>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Upload form -->
                                <form method="POST" id="photos-upload-form" enctype="multipart/form-data" action="/dashboard/upload_gallery.php?post_id=<?= $post_id ?>">
                                    <?= csrf_field() ?>
                                    <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp,image/gif" class="form-control mb-2">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Prześlij zdjęcia na serwer (potwierdź)</button>
                                </form>
                            </div>
                            <!-- existing images + upload form here -->
                        </div>
                        <?php endif; ?>

                        <form method="POST" id="post-upload-form">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label">Tytuł</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="<?= $post ? htmlspecialchars($post['title']) : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Autor</label>
                                <input type="text" id="author" name="author" class="form-control"
                                    value="<?= $post ? htmlspecialchars($post['author']) : htmlspecialchars($_SESSION['user_name']) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data</label>
                                <input type="date" id="date" name="date" class="form-control"
                                    value="<?= $post ? htmlspecialchars($post['date']) : date('Y-m-d') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Skrót</label>
                                <input type="text" id="excerpt" name="excerpt" class="form-control"
                                    value="<?= $post ? htmlspecialchars($post['excerpt']) : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upwind URL</label>
                                <input type="url" id="results_url" name="results_url" class="form-control"
                                    value="<?= $post ? htmlspecialchars($post['results_url']) : '' ?>"
                                    placeholder="https://www.upwind24.pl/regatta/...">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" id="photo_credits" name="photo_credits" value="1"
                                    class="form-check-input"
                                    <?= $post && $post['photo_credits'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="photo_credits"><strong>?</strong> Zdjęcia dzięki uprzejmości organizatora</label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Treść posta</label>
                                <div id="quill-editor" style="height: 300px;"><?= $post ? $post['content'] : '' ?></div>
                                <input type="hidden" id="content" name="content">
                            </div>

                            <button type="submit" name="action" value="draft" class="btn btn-outline-secondary">Zapisz szkic</button>
                            <button type="submit" name="action" value="submit_review" class="btn btn-primary">Wyślij do zatwierdzenia</button>
                            <?php if ($_SESSION['admin']): ?>
                                <button type="submit" name="action" value="published" class="btn btn-success">Opublikuj</button>
                            <?php endif; ?>
                        </form>
                    </div>

                    <!-- RIGHT: Preview -->
                    <div class="col-md-6">
                        <h4 class="text-muted mb-3">Podgląd</h4>
                            <!-- JS updates this -->
                             <iframe id="preview-iframe" src="/dashboard/preview.php" style="width:100%; height:800px; border:1px solid #dee2e6; border-radius:8px;"></iframe>
                    </div>
                </div>
                <?php endif; ?>

            </div>
            <!-- Page content ends here -->
        </div>
        <?php require_once(__DIR__ . '/../layout/footer.php');?>
    </div>

<?php if (!$is_post_locked_for_member): ?>
<!-- Load Quill text editor -->
<!-- Include stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    /** -- Quill text editor -- */
    /**@abstract
     * Quill setup
     */
    const quill = new Quill('#quill-editor', {
        theme: 'snow'
    });

    document.getElementById('post-upload-form').addEventListener('submit', function() {
        document.getElementById('content').value = quill.root.innerHTML;
        isDirty = false;
    });

    /**@abstract
     * Preview logic
     */
    function updatePreview() {
        const formData = new FormData();
        formData.append('title', document.getElementById('title').value);
        formData.append('author', document.getElementById('author').value);
        formData.append('date', document.getElementById('date').value);
        formData.append('excerpt', document.getElementById('excerpt').value);
        formData.append('content', quill.root.innerHTML);
        formData.append('results_url', document.getElementById('results_url').value);
        formData.append('photo_credits', document.getElementById('photo_credits').checked ? '1' : '0');
        formData.append('gallery', '<?= isset($gallery) ? json_encode($gallery) : json_encode([]) ?>');
        formData.append('cover_image', '<?= isset($post["cover_image"]) ? htmlspecialchars($post["cover_image"]) : "" ?>');

        fetch('/dashboard/preview.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(html => {
            const iframe = document.getElementById('preview-iframe');
            iframe.srcdoc = html;
        });
    }

    //Render edits
    let previewTimeout;
    function schedulePreview() {
        clearTimeout(previewTimeout);
        previewTimeout = setTimeout(updatePreview, 1000);
    }

    ['title', 'author', 'date', 'excerpt', 'results_url'].forEach(id => {
        document.getElementById(id).addEventListener('input', schedulePreview);
    });
    quill.on('text-change', schedulePreview);

    updatePreview();

    /** --- */
    /** -- Unsaved-changes protection -- */
    let isDirty = false;

    // Listen to any change on the post form
    ['title', 'author', 'date', 'excerpt', 'results_url'].forEach(id => {
        document.getElementById(id).addEventListener('input', () => {isDirty = true;});
    });
    document.getElementById('photo_credits').addEventListener('change', () => {isDirty = true;});
    quill.on('text-change', () => {isDirty = true;});

    // Clear flag when saving — runs before the form actually navigates.
    // Also guards against accidental double-click by blocking subsequent submits.
    let submitting = false;
    document.getElementById('post-upload-form').addEventListener('submit', function(e) {
        if (submitting) { e.preventDefault(); return; }
        submitting = true;
        document.getElementById('content').value = quill.root.innerHTML;
        isDirty = false;
        this.querySelectorAll('button[type="submit"]').forEach(b => b.classList.add('disabled'));
    });

    // Universal safety net — catches navbar links, "← Wróć do panelu",
    // gallery buttons (set cover / delete), browser back, tab close, reload.
    // Browsers ignore custom messages here and show their own generic prompt.
    window.addEventListener('beforeunload', function(e) {
        if (isDirty) {
            e.preventDefault();
            e.returnValue = ''; // required by some older browsers
        }
    });

    // Photos upload: keep the explicit alert — more helpful than the generic
    // browser prompt because it tells the user exactly what to do.
    // (Form only renders in edit mode, so guard against null on new-post page.)
    const photosForm = document.getElementById('photos-upload-form');
    if (photosForm) {
        photosForm.addEventListener('submit', function(e){
            if(isDirty){
                e.preventDefault();
                alert('Masz niezapisane zmiany! Najpierw zapisz post (szkic).');
            }
        });
    }
</script>
<?php endif; ?>
</body>
</html>