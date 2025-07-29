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
      <a href="#about-anchor" class="btn btn-outline-light btn-lg mt-3">Zostań Argonautą</a><br>
      <a href="#about-anchor" class="btn btn-outline-light btn-lg mt-3">Współpraca</a>
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
        <a href="#contact" class="btn btn-primary btn-lg">Skontaktuj się z nami</a>
      </div>
      <div class="col-md-6 text-center">
        <img src="storage/images/argologo.png" alt="Argo Logo" class="img-fluid rounded-circle">
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
              <div class="col-6 col-md-4">
                <div class="card mb-4 shadow-sm">
                  <img src="storage/images/2025/AMP25.jpg" class="card-img-top" alt="Regaty">
                  <div class="card-body">
                    <h5 class="card-title">Akademickie Mistrzostwa Polski w Żeglarstwie 2025</h5>
                    <p class="card-text">Zobacz relację ze startu Argonautów w Akademickich Mistrzostwach Polski w Żeglarstwie.</p>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Czytaj więcej</a>
                  </div>
                </div>
              </div>
              <!-- Card 2 -->
              <div class="col-6 col-md-4">
                <div class="card mb-4 shadow-sm">
                  <img src="storage/images/2024/Amp1.jpg" class="card-img-top" alt="Szkolenie">
                  <div class="card-body">
                    <h5 class="card-title">Treningi regatowe</h5>
                    <p class="card-text">Organizujemy profesjonalne treningi regatowe w Krakowie. Zdobądź nowe umiejętności i poczuj się pewniej na wodzie.</p>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Czytaj więcej</a>
                  </div>
                </div>
              </div>
              <!-- Card 3 -->
              <div class="col-6 col-md-4">
                <div class="card mb-4 shadow-sm">
                  <img src="storage/images/argo_painting.jpg" class="card-img-top" alt="Rejs">
                  <div class="card-body">
                    <h5 class="card-title">Czym właściwie jest Argo?</h5>
                    <p class="card-text">Czyli dlaczego "nie należy zaniedbywać nauki o pięknie"?</p>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Czytaj więcej</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item">
            <div class="row">
              <!-- Card 1 -->
              <div class="col-6 col-md-4">
                <div class="card mb-4 shadow-sm">
                  <img src="storage/images/2024/Amp2.jpg" class="card-img-top" alt="Regaty">
                  <div class="card-body">
                    <h5 class="card-title">Nasze ostatnie starty</h5>
                    <p class="card-text">Zobacz relacje z regat, w których bierzemy udział.</p>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Czytaj więcej</a>
                  </div>
                </div>
              </div>
              <!-- Card 2 -->
              <div class="col-6 col-md-4">
                <div class="card mb-4 shadow-sm">
                  <img src="storage/images/2024/boat_sleep.webp" class="card-img-top" alt="Regaty">
                  <div class="card-body text-center">
                    <h5 class="card-title">Jak dbamy o sprzęt?</h5>
                    <p class="card-text">Uchylamy rąbka tajemnicy przygotowania najszybszych akademickich łódek.</p>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Czytaj więcej</a>
                  </div>
                </div>
              </div>
              <!-- Card 3 -->
              <div class="col-6 col-md-4">
                <div class="card mb-4 shadow-sm">
                  <img src="storage/images/2024/boat_storage.webp" class="card-img-top" alt="Regaty">
                  <div class="card-body text-center">
                    <h5 class="card-title">Pozostałe</h5>
                    <p class="card-text">Zobacz resztę wpisów</p>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Czytaj więcej</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#eventsCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Poprzedni</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#eventsCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Następny</span>
        </button>
      </div>
    </div>
  </div>

  <?php require 'layout/footer.php' ?>
</body>

</html>
