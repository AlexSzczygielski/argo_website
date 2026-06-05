<?php
$page_title = "O Nas - SKR Argo AGH";
$page_description = "Argo to studencki klub regatowy z pasją do szybkiego żeglarstwa, współpracujący z AZS AGH.";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <title>SKR Argo AGH - O nas</title>
    <?php require_once('layout/header.php'); ?>
</head>
<body>

<div class="page-container">
    <div class="content-wrap">
        <?php require_once('layout/navbar.php'); ?>

        <!-- Page content starts here -->
         <!-- Hero section -->
        <div class="dolacz-hero about-hero">
            <div class="dolacz-hero-inner">
                <p class="dolacz-hero-eyebrow">Studenckie Koło Regatowe AGH</p>
                <h1 class="dolacz-hero-title">O nas</h1>
            </div>
        </div>

        <!-- Intro paragraph -->
        <section class="about-intro-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 pe-md-5">
                        <p class="about-intro-eyebrow">Kim jesteśmy</p>
                        <p class="about-intro-text">Argo to studencki klub regatowy z pasją do szybkiego żeglarstwa, współpracujący z AZS AGH. Regularnie startujemy w Ligach Akademickich, Akademickich Mistrzostwach Polski i Polskiej Lidze Klasy Omega. Poprzez stworzenie organizacji chcemy wyjść z naszą inicjatywą do społeczności akademickiej, aby wspólnie rozwijać żeglarstwo regatowe w Polsce.</p>
                    </div>
                    <div class="col-md-5">
                        <img class="img-fluid rounded" src="storage/images/argologo.png" alt="SKR ARGO AGH logo">
                    </div>
                </div>
            </div>
        </section>

        <!-- Info Cards - Goals -->
        <section class="about-goals-section">
            <div class="container">
                <div class="dolacz-section-header">
                    <h2 class="dolacz-section-title">Założenia naszej organizacji</h2>
                </div>
                <div class="row g-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="partnerzy-benefit-card">
                            <div class="dolacz-req-icon">
                                <i class="fa-solid fa-wind"></i>
                            </div>
                            <h3 class="partnerzy-benefit-heading">Popularyzacja</h3>
                            <p class="partnerzy-benefit-text">Popularyzacja żeglarstwa regatowego wśród wspólnoty akademickiej</p>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="partnerzy-benefit-card">
                            <div class="dolacz-req-icon">
                                <i class="fa-solid fa-sailboat"></i>
                            </div>
                            <h3 class="partnerzy-benefit-heading">Doskonalenie umiejętności</h3>
                            <p class="partnerzy-benefit-text">Doskonalenie umiejętności żeglarskich w zakresie rywalizacji sportowej</p>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="partnerzy-benefit-card">
                            <div class="dolacz-req-icon">
                                <i class="fa-solid fa-trophy"></i>
                            </div>
                            <h3 class="partnerzy-benefit-heading">Udział w zawodach</h3>
                            <p class="partnerzy-benefit-text">Organizacja wyjazdów i treningów regatowych na wodach śródlądowych oraz przybrzeżnych</p>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3">
                        <div class="partnerzy-benefit-card">
                            <div class="dolacz-req-icon">
                                <i class="fa-solid fa-anchor"></i>
                            </div>
                            <h3 class="partnerzy-benefit-heading">Organizacja regat</h3>
                            <p class="partnerzy-benefit-text">Organizacja zawodów – regat żeglarskich na arenie uczelnianej - wydziałowej, międzywydziałowej, a także ogólnopolskiej</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- CTA -->
         <section class="partnerzy-cta-final">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h2 class="dolacz-cta-title">Zapraszamy do kontaktu</h2>
                        <p class="dolacz-cta-text">Masz pytania lub chcesz nawiązać współpracę? Skontaktuj się z nami — chętnie odpowiemy na wszystkie pytania i pomożemy do nas dołączyć.</p>
                        <a href="dolacz.php" class="dolacz-btn-primary mb-3">Dołącz do nas!</a>
                        <br>
                        <a href="kontakt.php" class="dolacz-btn-primary ms-3">Skontaktuj się z nami</a>
                    </div>
                </div>
            </div>
         </section>
    </div>
    <!-- Page content ends here -->
    <?php require_once('layout/footer.php'); // Include the footer?>
</div>
</body>

</html>