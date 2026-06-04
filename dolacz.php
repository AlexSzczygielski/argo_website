<?php
$page_title = "Dołącz do nas! - SKR Argo AGH";
$page_description = "Do naszej organizacji zapraszamy wszystkich aktywnych studentów AGH.";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <title>SKR Argo AGH - Dołącz do nas</title>
    <?php require_once('layout/header.php'); ?>
</head>

<body>

    <div class="page-container">
        <div class="content-wrap">
            <?php require_once('layout/navbar.php'); ?>

            <!-- Hero -->
            <div class="dolacz-hero">
                <div class="dolacz-hero-inner">
                    <p class="dolacz-hero-eyebrow">Studenckie Koło Regatowe AGH</p>
                    <h1 class="dolacz-hero-title">Dołącz do nas</h1>
                </div>
            </div>

            <!-- Lead intro -->
            <section class="dolacz-lead-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <p class="dolacz-lead-text">
                                Do naszej organizacji zapraszamy wszystkich aktywnych studentów/doktorantów AGH. Dla osób z doświadczeniem regatowym oferujemy ściganie się w jednej z najbardziej wymagającej stawek w Polsce.
                                Dla osób bez doświadczenia regatowego oferujemy możliwość poznania najpiękniejszej formy żeglarstwa, które może być sportowym wyzwaniem, zapraszając wszystkich chętnych na nasze treningi odbywające się bezpiecznie pod okiem doświadczonych zawodników i trenerów. Wspólnie będziemy rozwijać Twoje umiejętności żeglarskie i pasję do regat.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Requirements -->
            <section class="dolacz-req-section">
                <div class="container">
                    <div class="dolacz-section-header">
                        <h2 class="dolacz-section-title">Wymagania</h2>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <div class="col-sm-6 col-lg-3">
                            <div class="dolacz-req-card">
                                <div class="dolacz-req-icon"><i class="fa-solid fa-user-graduate"></i></div>
                                <p class="dolacz-req-text">Status aktywnego studenta AGH</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="dolacz-req-card">
                                <div class="dolacz-req-icon"><i class="fa-solid fa-trophy"></i></div>
                                <p class="dolacz-req-text">Doświadczenie regatowe (dla chętnych do udziału w zawodach)</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="dolacz-req-card">
                                <div class="dolacz-req-icon"><i class="fa-solid fa-wind"></i></div>
                                <p class="dolacz-req-text">Podstawowe doświadczenie żeglarskie (dla chętnych do udziału w treningach)</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="dolacz-req-card">
                                <div class="dolacz-req-icon"><i class="fa-solid fa-circle-check"></i></div>
                                <p class="dolacz-req-text">Nie wymagamy patentu sternika, liczy się tylko doświadczenie żeglarskie/regatowe</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- AKZ note -->
            <section class="dolacz-note-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="dolacz-note-card">
                                <div class="dolacz-note-icon"><i class="fa-solid fa-anchor"></i></div>
                                <div class="dolacz-note-body">
                                    <p class="dolacz-note-text">
                                        <strong>UWAGA:</strong> Osoby, które dopiero stawiają pierwsze kroki w świecie żeglarstwa, odsyłamy po zdobycie pierwszego doświadczenia do naszych przyjaciół z
                                        <a href="https://keja.agh.edu.pl/" target="_blank">Akademickiego Klubu Żeglarskiego AGH</a>,
                                        którzy organizują pierwsze spotkania z jachtami, rejsy turystyczne i szkolenia żeglarskie.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Images strip -->
            <div class="dolacz-images-strip">
                <div class="dolacz-strip-img" style="background-image: url('storage/images/2026/amwim/na_wodzie.jpg')"></div>
                <div class="dolacz-strip-img" style="background-image: url('storage/images/2024/Amp2.jpg')"></div>
                <div class="dolacz-strip-img" style="background-image: url('storage/images/2026/amp/podium_1.JPG')"></div>
            </div>

            <!-- CTA -->
            <section class="partnerzy-cta-final">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-6">
                            <h2 class="dolacz-cta-title">Spróbuj swoich sił!</h2>
                            <p class="dolacz-cta-text">
                                Masz dodatkowe pytania? Skontaktuj się z nami poprzez e-mail lub przyjdź na trening — chętnie udzielimy odpowiedzi i zachęcimy Cię do wstąpienia w nasze szeregi.
                            </p>
                            <a href="mailto:argo@agh.edu.pl" class="dolacz-btn-primary">Dołącz do nas!</a>
                            <br>
                            <a href="mailto:argo@agh.edu.pl" class="partnerzy-cta-email-link">argo@agh.edu.pl</a>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php require_once('layout/footer.php'); ?>
    </div>

</body>

</html>