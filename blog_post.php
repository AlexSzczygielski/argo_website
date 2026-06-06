<?php
try{
    require_once('db/db.php');
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

$page_title = "SKR Argo AGH " . $post['title'];
$page_description = $post['excerpt'];
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
                            src="<?= htmlspecialchars($post['cover_image']) ?>"
                            alt="<?= htmlspecialchars($post['title']) ?>"
                            class="img-fluid rounded shadow-sm"
                            style="cursor:pointer;"
                            data-bs-toggle="modal"
                            data-bs-target="#titleImageModal"
                        >
                    </div>

                    <article class="mb-4">
                        <?php $post['content']; ?>
                    </article>

                </div>

                <!-- DESKTOP IMAGE -->
                <div class="col-md-5 text-center text-md-end d-none d-md-block">

                    <img
                        src="<?= htmlspecialchars($post['cover_image']) ?>"
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
                    src="<?= htmlspecialchars($post['cover_image']) ?>"
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