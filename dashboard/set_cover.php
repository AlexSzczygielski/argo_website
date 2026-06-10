<?php
/**
 * Responsible for setting cover images from post_form.php
 * Accessible by everyone
 */

//Session
require_once(__DIR__ . '/auth_check.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: panel.php');
    exit;
}

$post_id  = (int)($_POST['post_id']  ?? 0);
$image_path = $_POST['image_path'] ?? "";
if ($post_id <= 0) {
    header('Location: panel.php' . '?message=error');
    exit;
}

$redirect_base = '/dashboard/post_form.php?id=' . $post_id;
if ($image_path == "") {
    header('Location: ' . $redirect_base . '&message=error');
    exit;
}

// -- DB and file handling --

try{
    require_once(__DIR__ . '/../db/db.php');
    $pdo = get_pdo(); //get DB connection
    
    //prevent path traversal
    if (strpos($image_path, 'storage/images/') !== 0) {
        error_log("Unexpected cover path: " . $image_path);
        header('Location: ' . $redirect_base . '&message=error');
        exit;
    }

    //Update DB entry
    $stmt = $pdo->prepare('UPDATE posts SET cover_image = :cover_image WHERE id = :id');
    $stmt->bindValue(':id',$post_id, PDO::PARAM_INT);
    $stmt->bindValue(':cover_image',$image_path);
    $stmt->execute();
    header('Location: ' . $redirect_base . '&message=saved');
    exit;

} catch(Exception $e){
    error_log("DB error: " . $e->getMessage());
    header('Location: ' . $redirect_base . '&message=error');
}
?>