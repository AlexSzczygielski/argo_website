<?php
$page_title = "SKR Argo AGH";
$page_description = "Studenckie Koło Regatowe Argo AGH";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <?php require 'layout/header.php' ?>
  <title>SKR Argo AGH</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="SKR ARGO AGH">
</head>
<body>
  <?php require 'layout/navbar.php' ?>

  <!-- Get cards -->
      <?php
      // -- Setup --
      $carousel_posts_count = 6; //counter that limits the posts fetched after fixed
      $fixed_posts_ids = [4, 3]; // Fixed posts that always stay in the carousel
      // --- ---

      /* Open connection and get posts*/
      try{
        require_once('db/db.php');
        $pdo = get_pdo();

        // Fetch fixed posts
        $placeholders = implode(',', array_fill(0, count($fixed_posts_ids), '?'));
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id IN ($placeholders)");
        $stmt->execute($fixed_posts_ids);
        $fixed_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch latest posts excluding fixed
        $limit = $carousel_posts_count - count($fixed_posts_ids);
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id NOT IN ($placeholders) ORDER BY date DESC LIMIT $limit");
        $stmt->execute($fixed_posts_ids);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $carouselPosts = array_merge($posts, $fixed_posts);
      } catch (Exception $e){
        error_log("DB error on index: " . $e->getMessage());
        $carouselPosts = [];
      }
      
      ?>

  <!-- Jumbotron Welcome Page-->
  <div class="argo-jumbotron" id="home">
    <div class="container text-center">
      <h1 class="argo-title">Argo</h1>
      <p class="argo-subtitle">Studencki Klub Regatowy AGH</p>
      <p class="argo-tagline">Zwyciężać mogą ci, którzy wierzą, że mogą.</p>
      <p class="argo-author-credit">Wergiliusz</p>


      <?php if (!empty($carouselPosts)): ?>
        <a href="blog_post.php?id=<?= urlencode($carouselPosts[0]['id']) ?>" class="argo-latest-teaser">
          <span class="argo-teaser-label">Ostatnio:</span>
          <?= htmlspecialchars($carouselPosts[0]['title']) ?>
        </a>
      <?php endif; ?>


      <a href="dolacz.php" class="btn btn-outline-light btn-lg mt-3 btn-join">Zostań Argonautą</a>
      <a href="partnerzy_oferta.php" class="btn btn-outline-light btn-lg mt-3 btn-partner">Współpraca</a>
      <a href="#blog-anchor" class="btn btn-outline-light btn-lg mt-3 btn-events">Najnowsze wydarzenia ↓</a>
    </div>

    <!-- Social Icons below navbar -->
    <div class="social-icons">
      <a href="https://facebook.com/" target="_blank" class="btn btn-outline-light btn-lg mt-3" aria-label="Facebook">
        <i class="fab fa-facebook-f fs-4"></i>
      </a>
      <a href="https://instagram.com/" target="_blank" class="btn btn-outline-light btn-lg mt-3" aria-label="Instagram">
        <i class="fab fa-instagram fs-4"></i>
      </a>
    </div>
  </div>

  <!-- O Nas Section -->
  <div id="about-anchor" class="section-anchor"></div>
  <div id="about" class="container py-5">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
        <h2 class="display-4">O nas</h2>
        <p class="lead">Argo to studencki klub regatowy skupiający ludzi z pasją do szybkiego żeglarstwa, współpracujący z AZS AGH. Naszym celem jest promowanie żeglarstwa regatowego wśród studentów i miłośników sportów wodnych.</p>
        <p>Organizujemy szkolenia, treningi i bierzemy udział w regatach na różnych poziomach zaawansowania. Dołącz do nas, aby rozwijać swoje umiejętności i poznać najpiękniejszy z wymiarów żeglarstwa.</p>
        <a href="about.php" class="btn btn-primary btn-lg">Więcej informacji</a>
      </div>
      <div class="col-md-6 text-center">
        <img src="storage/images/argologo.svg" alt="Argo Logo" class="img-fluid rounded-circle">
      </div>
    </div>
  </div>

  <!-- Wspolpraca/partnerzy Section -->
  <div id="partners-anchor" class="section-anchor"></div>
  <div id="partners" class="container py-5">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
        <!-- Heading -->
        <h2 class="display-4">Zostań naszym partnerem</h2>
        <!-- Description -->
        <p class="lead">Argo to także wyjątkowa okazja dla podmiotów chcących promować swój wizerunek. W przeciwieństwie do innych kół studenckich oferujemy ekspozycję państwa organizacji podczas różnorodnych zawodów akademickich, 
          odbywających się na poziomie ogólnokrajowym. Świat żeglarstwa regatowego skupia wokół siebie wielu wpływowych ludzi i wiele ważnych organizacji, a to w połączeniu z naszym wyjątkowym motywem przewodnim, legitymacją AGH oraz częstymi sukcesami na podium, zapewni możliwość zaprezentowania Państwa wizerunku, unikatowym i niszowym klientom.</p>
        <p>Jeśli chcą Państwo wspierać młodych sportowców i zostać częścią naszej regatowej społeczności, dołączcie do nas i pomóżcie tworzyć niezapomniane regaty, treningi i wydarzenia.</p>
        <a href="partnerzy_oferta.php" class="btn btn-primary btn-lg">Więcej informacji</a>
      </div>
      <div class="col-md-6 text-center">
        <div class="logos">
          <!-- University 1 Logo -->
          <img src="storage/images/agh_logo.svg" alt="University 1 Logo" class="partner-logo">
          <!-- University 2 Logo -->
          <img src="storage/images/azs_logo.webp" alt="University 2 Logo" class="partner-logo">
        </div>
      </div>
    </div>
  </div>
  <!-- Wydarzenia Section -->
  <div id="blog-anchor" class="section-anchor"></div>
  <div id="blog" class="bg-light py-5">
    <div class="container">
      <div class="blog-section-heading">
        <div class="blog-heading-rule-wrap">
          <div class="blog-heading-rule"></div>
          <div class="blog-heading-center">
            <div class="blog-heading-center">
              <img src="storage/images/sail.png" alt="" aria-hidden="true" class="blog-heading-icon">
              <h2 class="blog-heading-title">Wydarzenia</h2>
            </div>
          </div>
          <div class="blog-heading-rule"></div>
        </div>
        <p class="blog-heading-subtitle">Aktualności z regatowego życia</p>
      </div>

      

      <!-- Carousel for Desktop (screens md and up) -->
      <div id="eventsCarouselDesktop" class="carousel slide carousel-dark d-none d-md-block" data-bs-ride="carousel">

        <div class="carousel-inner">

          <?php
          $chunks = array_chunk($carouselPosts, 3); // 3 cards per slide
          foreach ($chunks as $index => $chunk):
          ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
              <div class="row">
                <?php foreach ($chunk as $post): ?>
                  <div class="col-md-4">
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
            </div>
          <?php endforeach; ?>

        </div>

        <!-- Indicators -->
        <div class="carousel-indicators">
          <?php foreach ($chunks as $index => $_): ?>
            <button type="button"
                    data-bs-target="#eventsCarouselDesktop"
                    data-bs-slide-to="<?= $index ?>"
                    class="<?= $index === 0 ? 'active' : '' ?>">
            </button>
          <?php endforeach; ?>
        </div>

      </div>

      <!-- Carousel for Mobile (screens sm and down) -->
      <div id="eventsCarouselMobile" class="carousel slide carousel-dark d-block d-md-none" data-bs-ride="carousel">

        <div class="carousel-inner">

          <?php foreach ($carouselPosts as $index => $post): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
              <div class="card">
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

        <!-- Indicators -->
        <div class="carousel-indicators">
          <?php foreach ($carouselPosts as $index => $_): ?>
            <button type="button"
                    data-bs-target="#eventsCarouselMobile"
                    data-bs-slide-to="<?= $index ?>"
                    class="<?= $index === 0 ? 'active' : '' ?>">
            </button>
          <?php endforeach; ?>
        </div>

      </div>

      <!-- Read All button -->
      <div class="text-center">
        <br>
        <a href="blog.php" class="btn btn-sm btn-outline-secondary argo-blog-more-btn">Wyświetl wszystkie wpisy</a>
      </div>
    </div>
  </div>

  <?php require 'layout/footer.php' ?>
</body>

</html>