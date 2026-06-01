<?php
$page_title = "Blog - SKR Argo AGH";
$page_description = "Wydarzenia";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="stylesheet" href="plugins/bootstrap/5.3.3/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <title>SKR Argo AGH - Blog</title>
</head>

<body>

<?php require_once('layout/navbar.php'); ?>

<div class="page-container">
    <div class="content-wrap">

        <?php
        require 'blog/posts_data.php';

        $page = $_GET['page'] ?? null;

        $post = null;

        foreach ($posts as $p) {
            if ($p['id'] === $page) {
                $post = $p;
                break;
            }
        }

        if (!$post) {
            echo "<div class='container p-4'>Post not found</div>";
            exit;
        }
        ?>

        <!-- POST CONTENT -->
        <div class="container p-4">

            <div class="row g-5">

                <!-- LEFT COLUMN -->
                <div class="col-md-7">

                    <h1 class="mt-4 mb-3">
                        <?= htmlspecialchars($post['title']) ?>
                    </h1>

                    <p class="text-muted mb-4" style="font-size: 0.9rem;">
                        <?= date("d.m.Y", strtotime($post['date'])) ?>
                    </p>

                    <p class="lead mb-4">
                        <?= htmlspecialchars($post['excerpt']) ?>
                    </p>

                    <!-- MOBILE IMAGE -->
                    <div class="d-block d-md-none mb-4 text-center">
                        <img
                            src="<?= htmlspecialchars($post['image']) ?>"
                            alt="<?= htmlspecialchars($post['title']) ?>"
                            class="img-fluid rounded shadow-sm"
                            style="cursor:pointer;"
                            data-bs-toggle="modal"
                            data-bs-target="#titleImageModal"
                        >
                    </div>

                    <article class="mb-4">
                        <?php require $post['content']; ?>
                    </article>

                </div>

                <!-- DESKTOP IMAGE -->
                <div class="col-md-5 text-center text-md-end d-none d-md-block">

                    <img
                        src="<?= htmlspecialchars($post['image']) ?>"
                        alt="<?= htmlspecialchars($post['title']) ?>"
                        class="img-fluid rounded shadow-sm"
                        style="cursor:pointer;"
                        data-bs-toggle="modal"
                        data-bs-target="#titleImageModal"
                    >

                </div>

            </div>

    </div>

    </div>
</div>

<!-- TITLE IMAGE MODAL -->
<div class="modal fade" id="titleImageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            
            <div class="modal-body text-center p-0">
                <img
                    src="<?= htmlspecialchars($post['image']) ?>"
                    class="img-fluid rounded shadow"
                    alt="<?= htmlspecialchars($post['title']) ?>"
                >
            </div>
        </div>
    </div>
</div>

<?php require_once('layout/footer.php'); ?>

</body>
</html>