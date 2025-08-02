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
          <h3 class="fw-bold">Akademickie Mistrzostwa Polski 2024</h3>
          <p>To jest krótki opis głównego wpisu blogowego. Można tutaj umieścić streszczenie najnowszego wydarzenia.</p>
          <a href="#" class="btn btn-primary mt-2">Czytaj więcej</a>
        </div>
      </div>

      <!-- Grid of blog cards -->
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <!-- Card 1 -->
        <?php require 'blog/cards/treningi_card.php' ?>

        <!-- Card 2 -->
        <?php require 'blog/cards/treningi_card.php' ?>

        <!-- Card 3 -->
        <?php require 'blog/cards/ostatnie_starty_card.php' ?>

        <!-- Add more cards to show at start below -->

      </div>
    </div>

    <!-- Pozostale (starsze) Wyswietl Wszystko -->
    <!-- Read All button -->
    <br><br><br>
    <div id="show_more" class="text-center">
      <div class="container">
        <div id="blog_more" class="bg-light py-5">
          <span id="show_more" class="btn btn-sm btn-outline-secondary argo-blog-more-btn">Wyświetl wszystkie wpisy</span>
          <div class="show_more_group_container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

              <!-- Card 4 -->
              <?php require 'blog/cards/ostatnie_starty_card.php' ?>

              <!-- Add older cards here -->
               
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <script>
    $('.argo-blog-more-btn').on('click', function(e) {
      console.log("here");
      $(this).hide();
      //$(this).parent().find('.show_more_button').hide();
      $(this).parent().find('.show_more_group_container').show();
    });
  </script>
  <?php require 'layout/footer.php' ?>
</body>

</html>