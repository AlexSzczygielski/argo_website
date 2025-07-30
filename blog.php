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
  
  <div id="blog-anchor" class="section-anchor"></div>
  <div id="blog" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center display-4 mb-5">Wydarzenia</h2>

      <!-- Featured blog post -->
      <div class="row mb-5">
        <div class="col-md-8">
          <img src="storage/images/2025/AMP25.jpg" class="img-fluid rounded mb-3" alt="Featured">
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center">
          <h3 class="fw-bold">Tytuł głównego wpisu</h3>
          <p>To jest krótki opis głównego wpisu blogowego. Można tutaj umieścić streszczenie najnowszego wydarzenia.</p>
          <a href="#" class="btn btn-primary mt-2">Czytaj więcej</a>
        </div>
      </div>

      <!-- Grid of blog cards -->
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <!-- Card 1 -->
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="storage/images/2024/Amp1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Tytuł wpisu</h5>
              <p class="card-text">Krótki opis wydarzenia lub wpisu blogowego.</p>
              <a href="#" class="btn btn-outline-primary btn-sm">Czytaj dalej</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="storage/images/2024/Amp2.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Kolejny wpis</h5>
              <p class="card-text">Opis wpisu lub wydarzenia do pokazania w skrócie.</p>
              <a href="#" class="btn btn-outline-primary btn-sm">Czytaj dalej</a>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="storage/images/2024/boat_storage.webp" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Kolejny wpis</h5>
              <p class="card-text">Opis wpisu lub wydarzenia do pokazania w skrócie.</p>
              <a href="#" class="btn btn-outline-primary btn-sm">Czytaj dalej</a>
            </div>
          </div>
        </div>

        <!-- Add more cards -->
      </div>

    </div>
  </div>

  <?php require 'layout/footer.php' ?>
</body>

</html>