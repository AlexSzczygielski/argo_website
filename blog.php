<!DOCTYPE html>
<html lang="pl">

<head>
  <?php require 'layout/header.php' ?>
  <title>SKR Argo AGH - Blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="SKR ARGO AGH Wydarzenia">
</head>

<body>

<?php require 'layout/navbar.php' ?>

<?php
require 'blog/posts_data.php';

/* PAGE NUMBER */
$pageNum = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;

/* SORT POSTS (newest first) */
usort($posts, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

/* PAGINATION SETTINGS */
$perPage = 6;
$totalPosts = count($posts);
$totalPages = ceil($totalPosts / $perPage);

$offset = ($pageNum - 1) * $perPage;

/* CURRENT PAGE POSTS */
$visiblePosts = array_slice($posts, $offset, $perPage);

/* FEATURED POST */
$featuredPost = $posts[0] ?? null;
?>

<div id="blog-anchor" class="section-anchor"></div>

<div id="blog" class="bg-light py-5">
  <div class="container">

    <h2 class="text-center display-4 mb-5">Wydarzenia</h2>

    <!-- FEATURED POST -->
     
    <?php if ($featuredPost): ?>
    <div class="row mb-5 d-none d-md-flex">
      <div class="col-md-8">
        <img src="<?= htmlspecialchars($featuredPost['image']) ?>" class="img-fluid rounded mb-3" alt="" style="max-height: 850px; object-fit: cover; width: 100%;">
      </div>
      <div class="col-md-4 d-flex flex-column justify-content-center">
        <h3 class="fw-bold"><?= htmlspecialchars($featuredPost['title']) ?></h3>
        <p><?= htmlspecialchars($featuredPost['excerpt']) ?></p>
        <a href="blog_post.php?page=<?= urlencode($featuredPost['id']) ?>" class="btn btn-primary mt-2">
          Czytaj więcej
        </a>
      </div>
    </div>
    <?php endif; ?>

    <!-- POSTS GRID (PAGINATED) -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

      <?php foreach ($visiblePosts as $post): ?>
        <div class="col">
          <div class="card h-100">
            <img src="<?= htmlspecialchars($post['image']) ?>" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($post['excerpt']) ?></p>
              <a href="blog_post.php?page=<?= urlencode($post['id']) ?>" class="btn btn-sm btn-outline-secondary">
                Czytaj więcej
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <!-- PAGINATION -->
    <?php if ($totalPages > 1): ?>

    <div class="d-flex justify-content-center mt-5 flex-wrap gap-2">

      <!-- PREVIOUS -->
      <?php if ($pageNum > 1): ?>
        <a class="btn btn-sm btn-outline-secondary" href="?p=<?= $pageNum - 1 ?>">
          Poprzednia
        </a>
      <?php else: ?>
        <span class="btn btn-sm btn-outline-secondary disabled">
          Poprzednia
        </span>
      <?php endif; ?>


      <?php
      $range = 2;

      $start = max(1, $pageNum - $range);
      $end = min($totalPages, $pageNum + $range);
      ?>

      <!-- FIRST PAGE -->
      <?php if ($start > 1): ?>
        <a class="btn btn-sm btn-outline-secondary" href="?p=1">1</a>

        <?php if ($start > 2): ?>
          <span class="btn btn-sm btn-light disabled">...</span>
        <?php endif; ?>
      <?php endif; ?>


      <!-- PAGE RANGE -->
      <?php for ($i = $start; $i <= $end; $i++): ?>
        <a class="btn btn-sm 
          <?= ($i === $pageNum) ? 'btn-secondary active' : 'btn-outline-secondary' ?>"
          href="?p=<?= $i ?>">
          <?= $i ?>
        </a>
      <?php endfor; ?>


      <!-- LAST PAGE -->
      <?php if ($end < $totalPages): ?>

        <?php if ($end < $totalPages - 1): ?>
          <span class="btn btn-sm btn-light disabled">...</span>
        <?php endif; ?>

        <a class="btn btn-sm btn-outline-secondary" href="?p=<?= $totalPages ?>">
          <?= $totalPages ?>
        </a>

      <?php endif; ?>


      <!-- NEXT -->
      <?php if ($pageNum < $totalPages): ?>
        <a class="btn btn-sm btn-outline-secondary" href="?p=<?= $pageNum + 1 ?>">
          Następna
        </a>
      <?php else: ?>
        <span class="btn btn-sm btn-outline-secondary disabled">
          Następna
        </span>
      <?php endif; ?>

    </div>

    <?php endif; ?>

  </div>
</div>

<?php require 'layout/footer.php' ?>

</body>
</html>