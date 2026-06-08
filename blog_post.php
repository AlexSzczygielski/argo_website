<?php
try{
    require_once('db/db.php');
    /* Fetch post */
    $post_id = $_GET['id'] ?? null;
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id AND status = 'published'");
    $stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch();
} catch (Exception $e) {
    error_log("DB error on blog: " . $e->getMessage());
    $post = [
        'title'       => 'Błąd połączenia',
        'excerpt'     => 'Nie można załadować wpisu. Spróbuj ponownie później.',
        'date'        => date('Y-m-d'),
        'author'      => null,
        'cover_image' => 'storage/images/argologo.png',
        'content'     => null,
        'id'          => null,
    ];
}


if (!$post) {
    $post = [
        'title'       => 'Nie znaleziono wpisu',
        'excerpt'     => 'Wpis o podanym adresie nie istnieje.',
        'date'        => date('Y-m-d'),
        'author'      => null,
        'cover_image' => 'storage/images/argologo.png',
        'content'     => null,
        'id'          => null,
    ];
}

// META DATA
$page_title = "SKR Argo AGH " . $post['title'];
$page_description = $post['excerpt'];
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";

//Fetching gallery images
$gallery = [];
try{
    require_once('db/db.php');
    /* Fetch post */
    $post_id = $_GET['id'] ?? null;
    $pdo = get_pdo();
    $gallery_stmt = $pdo->prepare("SELECT * FROM post_gallery WHERE post_id = :id ORDER BY sort_order");
    $gallery_stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
    $gallery_stmt->execute();
    $gallery = $gallery_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log("DB error on blog gallery: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <?php require_once('layout/header.php'); ?>
</head>

<body>

<?php require_once('layout/navbar.php'); ?>

<div class="page-container">
    <div class="content-wrap">
        <!-- POST CONTENT -->
         <?php require_once('layout/post_content.php'); ?>
    </div>
</div>

<?php require_once('layout/footer.php'); ?>
</body>
</html>