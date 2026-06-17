<?php
/**
 * Approving posts directly from panel.php
 */
require_once(__DIR__ . '/auth_check.php');
$post_id = $_GET['id'] ?? null;
if($_SESSION['admin']){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        csrf_verify();
        if ($_POST['action'] === 'delete' && $_SESSION['admin']) {
            require_once(__DIR__ . '/../db/db.php');
            $pdo = get_pdo();
            $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
            $stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
            $stmt->execute();
        }
        require_once(__DIR__ . '/messages.php');
        header('Location: /dashboard/panel.php?message=' . MSG_DELETED);
        exit;
    }
}
$page_title = "SKR Argo AGH - Usuń post";
$page_description = "Usuń post";
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
                <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
                    <h4 class="mb-3">Usuwanie wpisu</h4>
                    <h5>Czy na pewno chcesz usunąć wpis o ID: <strong><?= $post_id ?></strong>?</h5>
                    <h6>Tej opcji nie można cofnąć!</h6>
                    <form method="POST">
                        <?= csrf_field() ?>
                        <div class="d-flex gap-2 mt-3">
                            <a href="/dashboard/panel.php" class="btn btn-outline-secondary">← Powrót</a>
                            <?php if ($_SESSION['admin']): ?>
                                <button type="submit" name="action" value="delete" class="btn btn-danger">Usuń</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Page content ends here -->
        </div>
        <?php require_once(__DIR__ . '/../layout/footer.php');?>
    </div>
</body>
</html>