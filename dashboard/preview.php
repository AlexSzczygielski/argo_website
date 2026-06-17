<?php 
/**
 * Post preview generator - used in post_form.php
 */
require_once(__DIR__ . '/auth_check.php');
require_once(__DIR__ . '/sanitiser.php');
$post = [
    'title'        => $_POST['title'] ?? '',
    'excerpt'      => $_POST['excerpt'] ?? '',
    'date'         => $_POST['date'] ?? date('Y-m-d'),
    'author'       => $_POST['author'] ?? '',
    'cover_image'  => $_POST['cover_image'] ?? '',
    'content'      => sanitise_post_html($_POST['content'] ?? ''),
    'results_url'  => $_POST['results_url'] ?? null,
    'photo_credits'=> $_POST['photo_credits'] ?? 0,
    'id'           => null,
];

$gallery = json_decode($_POST['gallery'] ?? '[]', true); //true to return associative array

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