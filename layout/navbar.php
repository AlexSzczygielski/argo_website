<?php
//remove query string, to allow passing pages with query
$request_uri = strtok($_SERVER['REQUEST_URI'], '?'); // Remove query string

$base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
//Redirect to index if no php
if (pathinfo($request_uri, PATHINFO_EXTENSION) != 'php') {
  $active_site = "index";
} else {
  $active_site = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
}
?>

<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top <?php echo ($active_site === 'index') ? 'navbar-transparent' : ''; ?>">
  <div class="container-fluid">
    <!-- Logo/Text Logo -->
    <a class="navbar-brand" href="<?php echo ($active_site === 'index') ? '#home' : $base_url . '/#home'; ?>">Argo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!---->
    <div class="collapse navbar-collapse" id="myNavbar">
      <!--Navbar Content-->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="about.php">O nas</a></li>
        <li class="nav-item"><a class="nav-link" href="partnerzy_oferta.php">Współpraca</a></li>
        <li class="nav-item"><a class="nav-link" href="blog.php">Wydarzenia</a></li>
        <li class="nav-item"><a class="nav-link" href="dolacz.php">Dołącz</a></li>
        <li class="nav-item"><a class="nav-link" href="dla_czlonkow.php">Dla Członków</a></li>
        <li class="nav-item"><a class="nav-link" href="kontakt.php">Kontakt</a></li>
      </ul>
      <!---->
    </div>
  </div>
</nav>
<!---->

<?php if ($active_site === 'index'): ?>
  <script>
    $(document).ready(function() {
      // Store the navbar's height to offset scroll position accurately.
      var navbarHeight = $('.navbar').outerHeight(true);

      /**
       * Smooth scrolling for anchor links within the navbar.
       * When a nav link with a hash is clicked, this prevents the default jump,
       * and smoothly animates the scroll to the target element.
       */
      $(".navbar a").on('click', function(event) {
        if (this.hash !== "") {
          event.preventDefault();

          // Store the hash from the clicked link.
          var hash = this.hash;

          // Animate the scroll to the target element.
          // The scroll position is offset by the navbar's height to prevent the
          // target section from being hidden behind the fixed navbar.
          $('html, body').animate({
            scrollTop: $(hash).offset().top - navbarHeight
          }, 900, function() {
            // After the animation completes, update the URL hash.
            window.location.hash = hash;
          });
        }
      });

      /**
       * Allows for applying different styles to the navbar,
       * once the user has scrolled past a certain point.
       */
      $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
          $('.navbar').addClass('scrolled');
        } else {
          $('.navbar').removeClass('scrolled');
        }
      });

      //Toggle hamburger menu (narrow screens)
      $('.navbar-toggler').on('click', function() {
        $('#myNavbar').slideToggle(); // toggles the menu with a slide animation
      });
    });
  </script>
<?php endif; ?>