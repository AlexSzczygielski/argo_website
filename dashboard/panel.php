<?php
require_once(__DIR__ . '/auth_check.php');
$page_title = "SKR Argo AGH - Panel";
$page_description = "CMS Panel";
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
            <div class="container p-4">
                <h1 class="md-6">Content Management System</h1>
                <h3 class="md-6">Działania:</h3>
                <div class="mb-4"></div>
                <!-- Adding new posts / more actions -->
                <a href="/dashboard/add_post.php" class="btn btn-sm btn-outline-primary mb-4">+ Dodaj nowy post</a>

                <hr class="mb-4">
                
                <!-- Existing posts -->
                <h2 class="md-6">Edytuj istniejącą bazę postów:</h2>
                <div class="mb-4"></div>
                <?php
                $posts = [];
                $totalPosts = 0;
                $totalPages = 0;
                try {
                    require_once(__DIR__ . '/../db/db.php');
                    $pdo = get_pdo();
                    $totalPosts = (int)$pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();

                    $pageNum = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
                    $perPage = 6;
                    $totalPages = ceil($totalPosts / $perPage);
                    $offset = ($pageNum - 1) * $perPage;

                    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY date DESC LIMIT :limit OFFSET :offset");
                    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
                    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                    $stmt->execute();
                    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                    error_log("DB error on panel: " . $e->getMessage());
                }
                ?>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php foreach ($posts as $post): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="/<?= htmlspecialchars($post['cover_image']) ?>"
                                     class="card-img-top"
                                     style="height: 200px; object-fit: cover;"
                                     alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                                    <p class="card-text text-muted" style="font-size:0.85rem">
                                        <?= htmlspecialchars($post['date']) ?> &middot; <?= htmlspecialchars($post['author'] ?? 'ARGO') ?>
                                    </p>
                                    <p class="card-text"><?= htmlspecialchars($post['excerpt']) ?></p>
                                </div>
                                <div class="card-footer d-flex gap-2">
                                    <a href="/dashboard/edit_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary">Edytuj</a>
                                    <a href="/blog_post.php?id=<?= $post['id'] ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Podgląd</a>
                                    <a href="/dashboard/delete_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger">Usuń</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- PAGINATION -->
                <?php if ($totalPages > 1): ?>
                <div class="d-flex justify-content-center mt-5 flex-wrap gap-2">

                    <?php if ($pageNum > 1): ?>
                        <a class="btn btn-sm btn-outline-secondary" href="?p=<?= $pageNum - 1 ?>">Poprzednia</a>
                    <?php else: ?>
                        <span class="btn btn-sm btn-outline-secondary disabled">Poprzednia</span>
                    <?php endif; ?>

                    <?php
                    $range = 2;
                    $start = max(1, $pageNum - $range);
                    $end = min($totalPages, $pageNum + $range);
                    ?>

                    <?php if ($start > 1): ?>
                        <a class="btn btn-sm btn-outline-secondary" href="?p=1">1</a>
                        <?php if ($start > 2): ?>
                            <span class="btn btn-sm btn-light disabled">...</span>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php for ($i = $start; $i <= $end; $i++): ?>
                        <a class="btn btn-sm <?= ($i === $pageNum) ? 'btn-secondary active' : 'btn-outline-secondary' ?>"
                           href="?p=<?= $i ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($end < $totalPages): ?>
                        <?php if ($end < $totalPages - 1): ?>
                            <span class="btn btn-sm btn-light disabled">...</span>
                        <?php endif; ?>
                        <a class="btn btn-sm btn-outline-secondary" href="?p=<?= $totalPages ?>"><?= $totalPages ?></a>
                    <?php endif; ?>

                    <?php if ($pageNum < $totalPages): ?>
                        <a class="btn btn-sm btn-outline-secondary" href="?p=<?= $pageNum + 1 ?>">Następna</a>
                    <?php else: ?>
                        <span class="btn btn-sm btn-outline-secondary disabled">Następna</span>
                    <?php endif; ?>

                </div>
                <?php endif; ?>

            </div>
            <!-- Page content ends here -->
        </div>
        <?php require_once(__DIR__ . '/../layout/footer.php');?>
    </div>
</body>
</html>