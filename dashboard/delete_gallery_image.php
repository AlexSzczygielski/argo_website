<?php
/**
 * Responsible for deleting images from posts_gallery
 * Photo can be deleted by the user owner and admin
 */

//Session
require_once(__DIR__ . '/auth_check.php');

$post_id  = (int)($_POST['post_id']  ?? $_GET['post_id']  ?? 0);
$image_id = (int)($_POST['image_id'] ?? $_GET['image_id'] ?? 0);
if ($post_id <= 0) {
    header('Location: panel.php' . '?message=error');
    exit;
}

$redirect_base = '/dashboard/post_form.php?id=' . $post_id;
if ($image_id <= 0) {
    header('Location: ' . $redirect_base . '&message=error');
    exit;
}

// -- DB and file handling --
try{
    require_once(__DIR__ . '/../db/db.php');
    $pdo = get_pdo(); //get DB connection

    // -- Fetch required image from DB
    $stmt = $pdo->prepare('SELECT post_gallery.*, posts.title FROM post_gallery JOIN posts ON posts.id = post_gallery.post_id WHERE post_gallery.id = :image_id AND (posts.author = :username OR :is_admin = 1)');
    $stmt->bindValue(':image_id',$image_id, PDO::PARAM_INT);
    $stmt->bindValue(':username',$_SESSION['user_name'], PDO::PARAM_STR);
    $stmt->bindValue(':is_admin',$_SESSION['admin'] ? 1 : 0, PDO::PARAM_INT);
    $stmt->execute();
    $image = $stmt->fetch();
    if (!$image) {
    header('Location: ' . $redirect_base . '&message=error');
    exit;
    }

} catch(Exception $e){
    error_log("DB error: " . $e->getMessage());
    header('Location: ' . $redirect_base . '&message=error');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['action'] === 'delete') {
            // -- DB and file handling --
            try{
                require_once(__DIR__ . '/../db/db.php');
                $pdo = get_pdo(); //get DB connection
                
                // -- Delete image from the disk
                //prevent path traversal
                $allowed_base   = realpath(__DIR__ . '/../storage/images/');
                $image_filepath = realpath(__DIR__ . '/../' . $image['directory'] . '/' . $image['filename']);

                if ($image_filepath === false || strpos($image_filepath, $allowed_base) !== 0) {
                    error_log("Path traversal attempt blocked: " . $image['directory'] . '/' . $image['filename']);
                    header('Location: ' . $redirect_base . '&message=error');
                    exit;
                }
                //Delete file
                if(file_exists($image_filepath)){
                    unlink($image_filepath);
                }

                //Delete DB entry
                $stmt = $pdo->prepare('DELETE FROM post_gallery WHERE id = :image_id');
                $stmt->bindValue(':image_id',$image_id, PDO::PARAM_INT);
                $stmt->execute();
                header('Location: ' . $redirect_base . '&message=saved');
                exit;

            } catch(Exception $e){
                error_log("DB error: " . $e->getMessage());
                header('Location: ' . $redirect_base . '&message=error');
            }
        }
}

$page_title = "SKR Argo AGH - Usuń zdjęcie";
$page_description = "Usuń zdjęcie";
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
                    <h4 class="mb-3">Usuwanie zdjęcia</h4>
                    <img src="/<?= htmlspecialchars($image['directory'] . '/' . $image['filename']) ?>"
                    class="img-fluid rounded mb-3"
                    style="max-height: 200px; object-fit: cover;">
                    <p>Czy na pewno chcesz usunąć zdjęcie: <strong><?= htmlspecialchars($image['filename']) ?></strong>?</p>
                    <form method="POST">
                        <input type="hidden" name="image_id" value="<?= $image_id ?>">
                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                        <div class="d-flex gap-2 mt-3">
                            <a href="<?= $redirect_base ?>" class="btn btn-outline-secondary">← Powrót</a>
                            <button type="submit" name="action" value="delete" class="btn btn-danger">Usuń</button>
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