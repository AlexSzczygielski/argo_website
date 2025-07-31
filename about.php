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

  <div id="blog-anchor" class="section-anchor"></div>
  <div id="blog" class="bg-light py-5">
   

    
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