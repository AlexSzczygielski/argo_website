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
        error_log("DB error on blog: " . $e->getMessage());
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


                <div class="row g-4">
                    <!-- LEFT: Form -->
                    <div class="col-md-6">
                        <form method="POST">
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
                            <button type="submit" name="action" value="pending" class="btn btn-primary">Wyślij do zatwierdzenia</button>
                        </form>
                    </div>

                    <!-- RIGHT: Preview -->
                    <div class="col-md-6">
                        <h4 class="text-muted mb-3">Podgląd</h4>
                            <!-- JS updates this -->
                             <iframe id="preview-iframe" src="/dashboard/preview.php" style="width:100%; height:800px; border:1px solid #dee2e6; border-radius:8px;"></iframe>
                    </div>
                </div>
                
            </div>
            <!-- Page content ends here -->
        </div>
        <?php require_once(__DIR__ . '/../layout/footer.php');?>
    </div>
    
<!-- Load Quill text editor -->
<!-- Include stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    /**@abstract
     * Quill setup
     */
    const quill = new Quill('#quill-editor', {
        theme: 'snow'
    });

    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('content').value = quill.root.innerHTML;
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

    //Render
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
</script>
</body>
</html>