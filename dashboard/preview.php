<?php 
/**
 * Post preview generator - used in post_form.php
 */
require_once(__DIR__ . '/auth_check.php');
$post = [
    'title'        => $_POST['title'] ?? '',
    'excerpt'      => $_POST['excerpt'] ?? '',
    'date'         => $_POST['date'] ?? date('Y-m-d'),
    'author'       => $_POST['author'] ?? '',
    'cover_image'  => $_POST['cover_image'] ?? '',
    'content'      => $_POST['content'] ?? '',
    'results_url'  => $_POST['results_url'] ?? null,
    'photo_credits'=> $_POST['photo_credits'] ?? 0,
    'id'           => null,
];
$gallery = [];
$page_title = "Podgląd - " . ($_POST['title'] ?? 'Nowy Post');
$page_description = '';
$page_image = '';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <?php require_once(__DIR__ . '/../layout/header.php'); ?>
</head>
<body>

<div class="page-container">
    <div class="content-wrap">
        <!-- POST CONTENT -->
         <?php require_once(__DIR__ . '/../layout/post_content.php'); ?>
    </div>
</div>
</body>
</html>