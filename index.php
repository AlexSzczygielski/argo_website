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

  <!-- Jumbotron Welcome Page-->
  <div class="argo-jumbotron" id="home">
    <div class="container text-center">
      <h1 class="argo-title">Argo</h1>
      <p class="argo-subtitle">Studencki Klub Regatowy AGH</p>
      <p class="argo-tagline">Inspired by Ancient Mariners. Driven to Win.</p>
      <a href="dolacz.php" class="btn btn-outline-light btn-lg mt-3">Zostań Argonautą</a><br>
      <a href="sponsorzy_oferta.php" class="btn btn-outline-light btn-lg mt-3">Współpraca</a>
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
        <p class="lead">Argo to studencki klub regatowy z pasją do szybkiego żeglarstwa, współpracujący z AZS AGH. Naszym celem jest promowanie żeglarstwa regatowego wśród studentów i miłośników sportów wodnych.</p>
        <p>Organizujemy szkolenia, treningi i bierzemy udział w regatach na różnych poziomach zaawansowania. Dołącz do nas, aby rozwijać swoje umiejętności i poznać najpiękniejszy z wymiarów żeglarstwa.</p>
        <a href="about.php" class="btn btn-primary btn-lg">Skontaktuj się z nami</a>
      </div>
      <div class="col-md-6 text-center">
        <img src="storage/images/argologo.png" alt="Argo Logo" class="img-fluid rounded-circle">
      </div>
    </div>
  </div>

  <!-- Wspolpraca/sponost Section -->
  <div id="sponsor-anchor" class="section-anchor"></div>
  <div id="sponsor" class="container py-5">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
        <!-- Heading -->
        <h2 class="display-4">Zostań naszym sponsorem</h2>
        <!-- Description -->
        <p class="lead">Argo to także wyjątkowa okazja dla podmiotów chcących promować swój wizerunek. W przeciwieństwie do innych kół studenckich oferujemy ekspozycję państwa organizacji na szerokiej arenie zawodów akademickich, na ogólnokrajowym poziomie. Świat żeglarstwa regatowego skupia wokół siebie wielu wpływowych ludzi i organizacji, a to w połączeniu z naszym unikatowym motywem przewodnim w stylu sztuki klasycznej, legitymacją AGH oraz częstymi wizytami na podium zapewni ekspozycję na trudno dostępnych w innych kanałach promocyjnych klientów.</p>
        <p>Jeśli chcesz wspierać młodych sportowców i być częścią naszej regatowej społeczności, dołącz do nas i pomóż tworzyć niezapomniane regaty, treningi i wydarzenia.</p>
        <a href="sponsorzy_oferta.php" class="btn btn-primary btn-lg">Więcej informacji</a>
      </div>
      <div class="col-md-6 text-center">
        <div class="logos">
          <!-- University 1 Logo -->
          <img src="storage/images/agh_logo.svg" alt="University 1 Logo" class="sponsor-logo">
          <!-- University 2 Logo -->
          <img src="storage/images/azs_logo.webp" alt="University 2 Logo" class="sponsor-logo">
        </div>
      </div>
    </div>
  </div>
  <!-- Wydarzenia Section -->
  <div id="blog-anchor" class="section-anchor"></div>
  <div id="blog" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center display-4">Wydarzenia</h2>

      <div id="eventsCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel">
        <!-- Carousel -->
        <div class="carousel-inner">

          <!-- Indicators -->
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div>

          <!-- Slide 1 -->
          <div class="carousel-item active">
            <div class="row">
              <!-- Card 1 -->
              <?php require 'blog/cards/amp2025_card.php' ?>
              <!-- Card 2 -->
              <?php require 'blog/cards/treningi_card.php' ?>
              <!-- Card 3 -->
              <?php require 'blog/cards/argo_history_card.php' ?>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item">
            <div class="row">
              <!-- Card 1 -->
              <?php require 'blog/cards/ostatnie_starty.php' ?>
              <!-- Card 2 -->
              <?php require 'blog/cards/dbamy_sprzet_card.php' ?>
              <!-- Card 3 -->
              <?php require 'blog/cards/pozostale_redirect_card.php' ?>
            </div>
          </div>
        </div>

        <!-- Controls for carousel -->
        <!--<button class="carousel-control-prev" type="button" data-bs-target="#eventsCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Poprzedni</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#eventsCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Następny</span>
        </button>-->
      </div>

      <!-- Read All button -->
      <div class="text-center">
        <a href="blog.php" class="btn btn-sm btn-outline-secondary argo-blog-more-btn">Wyświetl wszystkie wpisy</a>
      </div>
    </div>
  </div>

  <?php require 'layout/footer.php' ?>
</body>

</html>