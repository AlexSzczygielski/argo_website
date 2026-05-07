<?php
$page_title = "Oferta sponsorska - SKR Argo AGH";
$page_description = "Argo to także wyjątkowa okazja dla podmiotów chcących promować swój wizerunek.";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <title>SKR Argo AGH - Współpraca</title>
    <?php require_once('layout/header.php'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="SKR ARGO AGH">
</head>

<body>

    <div class="page-container">
        <div class="content-wrap">
            <?php require_once('layout/navbar.php'); ?>

            <!-- Page content starts here -->
            <div class="container p-4">
                <h1 class="mt-5 mb-4">Współpraca</h1>

                <div class="row">
                    <!-- Left column: text -->
                    <div class="col-md-8">
                        <section class="mb-5">
                            <p class="lead">
                                Argo to także wyjątkowa okazja dla podmiotów chcących promować swój wizerunek. W przeciwieństwie do innych kół studenckich oferujemy ekspozycję państwa organizacji podczas różnorodnych zawodów akademickich,
                                odbywających się na poziomie ogólnokrajowym. Świat żeglarstwa regatowego skupia wokół siebie wielu wpływowych ludzi i wiele ważnych organizacji, a to w połączeniu z naszym wyjątkowym motywem przewodnim, legitymacją AGH oraz częstymi sukcesami na podium, zapewni możliwość zaprezentowania Państwa wizerunku, unikatowym i niszowym klientom.</p>
                        </section>

                        <section class="mb-5">
                            <h2>W tej sekcji pojawi się</h2>
                            <ul>
                                <li>Konspekt współpracy</li>
                                <li>Wizualizacja powierzchni reklamowej - łódka, żagle, itd.</li>
                                <li>Inforamcja o ekspozycji wizerunkowej partnera</li>
                                <li>Plan zagospodarowania pozyskanych środków</li>
                            </ul>
                        </section>

                        <!-- Formularz zgloszenowy -->
                        <a href="Kontakt.php" class="btn btn-primary">Skontaktuj się z nami</a>
                        </section>
                    </div>

                    <!-- Right column: images -->
                    <div class="col-md-4">
                        <img src="storage/images/2024/Amp2.jpg" alt="Zdjęcie klubu" class="img-fluid rounded mb-4">
                        <img src="storage/images/2024/boat_storage.webp" alt="Inne zdjęcie" class="img-fluid rounded mb-4">
                    </div>
                </div>
            </div>
            <!-- Page content ends here -->

        </div>
        <?php require_once('layout/footer.php'); // Include the footer 
        ?>
    </div>

</body>

</html>