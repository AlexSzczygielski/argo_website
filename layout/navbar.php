<?php
//remove query string, to allow passing pages with query
$request_uri = strtok($_SERVER['REQUEST_URI'], '?'); // Remove query string

if (pathinfo($request_uri, PATHINFO_EXTENSION) != 'php') {
  $active_site = "index";
} else {
  $active_site = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
}
?>

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#home">Argo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#about-anchor">O nas</a></li>
        <li class="nav-item"><a class="nav-link" href="#blog-anchor">Wydarzenia</a></li>
        <li class="nav-item"><a class="nav-link" href="#services">Współpraca</a></li>
        <li class="nav-item"><a class="nav-link" href="#portfolio">Dołącz</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Kontakt</a></li>
      </ul>
    </div>
  </div>
</nav>

<script>
  $(document).ready(function () {
  var navbarHeight = $('.navbar').outerHeight(true); // Measure it once

  $(".navbar a").on('click', function (event) {
    if (this.hash !== "") {
      event.preventDefault();

      var hash = this.hash; // ✅ Define hash immediately

      console.log("Clicked link to:", hash);
      console.log("Target offset:", $(hash).offset().top);
      console.log("Navbar height:", navbarHeight);

      $('html, body').animate({
        scrollTop: $(hash).offset().top - navbarHeight
      }, 900, function () {
        window.location.hash = hash; // ✅ Now hash is defined
      });
    }
  });

  // Optional: Add class when scrolling past 50px
  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $('.navbar').addClass('scrolled');
    } else {
      $('.navbar').removeClass('scrolled');
    }
  });
});

</script>