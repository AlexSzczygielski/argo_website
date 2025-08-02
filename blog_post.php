<!DOCTYPE html>
<html lang="pl">

<head>
    <title>SKR Argo AGH - AMP 2025</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="SKR ARGO AGH">
</head>

<body>

    <div class="page-container">
        <div class="content-wrap">
            <?php require_once('layout/navbar.php'); ?>

            <!-- Page content starts here -->
            <?php
            $allowedPages = require 'layout/allowed_pages.php';

            if (isset($_GET['page']) && in_array($_GET['page'], $allowedPages, true)) {
                require "blog/posts/{$_GET['page']}.php";
            } else {
                echo "<h1>Page not found</h1>";
            }
            ?>
            <!-- Page content ends here -->

        </div>
        <?php require_once('layout/footer.php'); // Include the footer 
        ?>
    </div>

</body>

</html>