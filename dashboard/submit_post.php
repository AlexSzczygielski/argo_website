<?php
/**
 * Confirmation page for "Wyślij do zatwierdzenia" — sets a post's status
 * from draft to pending after the author confirms.
 * Reached only via the post_form.php submit-review button, which first
 * saves the post as draft so progress can't be lost here.
 */
require_once(__DIR__ . '/auth_check.php');
$post_id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
if ($post_id <= 0) {
    header('Location: /dashboard/panel.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    if ($_POST['action'] === 'submit') {
        try {
            require_once(__DIR__ . '/../db/db.php');
            $pdo = get_pdo();
            $stmt = $pdo->prepare("UPDATE posts SET status = 'pending' WHERE id = :id");
            $stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
            $stmt->execute();
            require_once(__DIR__ . '/activity_log.php');
            log_action('post.submit_for_review', $post_id);
        } catch (Exception $e) {
            error_log("submit_post error: " . $e->getMessage());
            header('Location: /dashboard/post_form.php?id=' . $post_id . '&message=error');
            exit;
        }
    }
    require_once(__DIR__ . '/messages.php');
    header('Location: /dashboard/panel.php?message=' . MSG_PENDING);
    exit;
}

// GET — render confirmation
try {
    require_once(__DIR__ . '/../db/db.php');
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT title FROM posts WHERE id = :id");
    $stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch();
} catch (Exception $e) {
    error_log("submit_post fetch error: " . $e->getMessage());
    $post = null;
}
if (!$post) {
    header('Location: /dashboard/panel.php');
    exit;
}

$page_title = "SKR Argo AGH - Wyślij do zatwierdzenia";
$page_description = "Wyślij post do zatwierdzenia";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
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
            <div class="container d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 450px);">
                <div class="card shadow p-4" style="max-width: 540px; width: 100%;">
                    <h4 class="mb-3">Wyślij post do zatwierdzenia</h4>
                    <p>
                        Post <strong><?= htmlspecialchars($post['title']) ?></strong> zostanie
                        wysłany do administratora w celu zatwierdzenia. Po akceptacji pojawi
                        się publicznie na stronie klubu. Do tego czasu pozostaje niewidoczny
                        dla odwiedzających.
                    </p>
                    <p class="text-muted small mb-0">
                        Twoje zmiany zostały już zapisane jako szkic — możesz bezpiecznie wrócić do edycji.
                    </p>
                    <form method="POST" id="submit-confirm-form">
                        <?= csrf_field() ?>
                        <div class="d-flex gap-2 mt-3">
                            <a href="/dashboard/post_form.php?id=<?= (int)$post_id ?>" class="btn btn-outline-secondary">← Powrót do edycji</a>
                            <button type="submit" name="action" value="submit" class="btn btn-primary">Wyślij do zatwierdzenia</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Page content ends here -->
        </div>
        <?php require_once(__DIR__ . '/../layout/footer.php');?>
    </div>
<script>
    // Prevent accidental double-click on confirmation
    (function() {
        let submitting = false;
        const form = document.getElementById('submit-confirm-form');
        form.addEventListener('submit', function(e) {
            if (submitting) { e.preventDefault(); return; }
            submitting = true;
            form.querySelectorAll('button[type="submit"]').forEach(b => b.classList.add('disabled'));
        });
    })();
</script>
</body>
</html>
