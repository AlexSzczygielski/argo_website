<?php
$page_title = "Blog - SKR Argo AGH";
$page_description = "Ostanie wydarzenia";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <?php require 'layout/header.php' ?>
</head>

<body>

<?php require 'layout/navbar.php' ?>

<?php
$posts = [];
$totalPosts = 0;
$totalPages = 0;
$featuredPost = null;
try{
  require_once('db/db.php');
  /* Open connection and get total posts count */
  $pdo = get_pdo();
  $totalPosts = (int)$pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'published'")->fetchColumn();

  /* PAGE NUMBER */
  $pageNum = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;

  /* PAGINATION SETTINGS */
  $perPage = 6;
  $totalPages = ceil($totalPosts / $perPage);

  $offset = ($pageNum - 1) * $perPage; //number of posts offset

  /* CURRENT PAGE POSTS */
  $stmt = $pdo->prepare("SELECT * FROM posts WHERE status = 'published' ORDER BY date DESC LIMIT :limit OFFSET :offset");
  $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  /* FEATURED POST */
  $featuredPost = $pdo->query("SELECT * FROM posts WHERE status = 'published' ORDER BY date DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log("DB error on blog: " . $e->getMessage());
}
?>

<!-- Hero -->
<div id="blog" class="bg-light py-5">
<div class="dolacz-hero">
    <div class="dolacz-hero-inner">
        <p class="dolacz-hero-eyebrow">Studenckie Koło Regatowe AGH</p>
        <h1 class="dolacz-hero-title">Aktualności Klubowe</h1>
    </div>
</div>
<br>
<div id="blog-anchor" class="section-anchor"></div>


  <div class="container">

    <!-- FEATURED POST -->
     
    <?php if ($featuredPost): ?>
    <div class="row mb-5 d-none d-md-flex">
      <div class="col-md-8">
        <img src="<?= htmlspecialchars($featuredPost['cover_image']) ?>" class="img-fluid rounded mb-3" alt="" style="max-height: 850px; object-fit: cover; width: 100%;">
      </div>
      <div class="col-md-4 d-flex flex-column justify-content-center">
        <h3 class="fw-bold"><?= htmlspecialchars($featuredPost['title']) ?></h3>
        <p><?= htmlspecialchars($featuredPost['excerpt']) ?></p>
        <a href="blog_post.php?id=<?= urlencode($featuredPost['id']) ?>" class="btn btn-sm btn-outline-secondary mt-2">
          Czytaj więcej
        </a>
      </div>
    </div>
    <?php endif; ?>

    <!-- POSTS GRID (PAGINATED) -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

      <?php foreach ($posts as $post): ?>
        <div class="col">
          <div class="card h-100">
            <img src="<?= htmlspecialchars($post['cover_image']) ?>" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($post['excerpt']) ?></p>
              <a href="blog_post.php?id=<?= urlencode($post['id']) ?>" class="btn btn-sm btn-outline-secondary">
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