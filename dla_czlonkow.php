<?php
$page_title = "SKR Argo AGH";
$page_description = "Sekcja dla członków";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>

<html lang="pl">

<head>
    <title>SKR Argo AGH - Dla Członków</title>
    <?php require_once('layout/header.php'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Dla Członków">

```
<style>
    /* Fix long links overflowing */
    a {
        word-break: break-word;
        overflow-wrap: anywhere;
    }
</style>
```

</head>

<body>

```
<div class="page-container">
    <div class="content-wrap">
        <?php require_once('layout/navbar.php'); ?>

        <!-- Page content starts here -->
        <div class="container py-4 px-3 px-md-4">
            <h1 class="mt-4 mb-4">Dla Członków</h1>

            <div class="row align-items-start">

                <!-- Image (top on mobile, right on desktop) -->
                <div class="col-md-4 order-1 order-md-2 text-center">
                    <img src="storage/images/sail.png"
                         alt="Żagle"
                         class="img-fluid rounded mb-4"
                         style="max-height: 250px; object-fit: contain;">
                </div>

                <!-- Text content -->
                <div class="col-md-8 order-2 order-md-1">

                    <section class="mb-4">
                        <p class="lead">
                            Ta sekcja zawiera informacje oraz porady dla członków koła.
                        </p>
                    </section>

                    <section class="mb-4">
                        <h2>Porady</h2>
                        <ul class="list">
                            <li class="mb-2">
                                <a href="cms_poradnik.php"
                                   class="text-break">
                                    Blog oraz zarządzanie postami[CMS] - poradnik
                                </a>
                            </li>
                        </ul>
                        
                        <h4>Start w regatach</h4>

                        <ul class="list">
                            <li class="mb-2">
                                <a href="pakowanie_omegi_poradnik.php"
                                   class="text-break">
                                    Pakowanie Omegi - Poradnik
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="pakowanie_check_lista.php"
                                   class="text-break">
                                    Pakowanie Omegi - Check Lista przed zawodami
                                </a>
                            </li>
                        </ul>
                    </section>
                    
                    <br>

                    <section class="mb-4">
                        <h2>Deklaracje</h2>

                        <ul class="list">
                            <li class="mb-2">
                                <a href="deklaracja_czlonkostwa.php"
                                   class="text-break">
                                    Członkostwo
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="legitymacja_azs.php"
                                   class="text-break">
                                    Legitymacja AZS i Certyfikat Przynależności
                                </a>
                            </li>
                        </ul>
                    </section>

                </div>
            </div>
        </div>
        <!-- Page content ends here -->

    </div>

    <?php require_once('layout/footer.php'); ?>
</div>
```

</body>

</html>
