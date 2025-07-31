<?php
if (pathinfo($request_uri, PATHINFO_EXTENSION) != 'php') {
    $active_site = "index";
} else {
    $active_site = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
}
?>

<div class="card mb-4 shadow-sm">
    <img src="storage/images/2024/Amp1.jpg" class="card-img-top" alt="Szkolenie">
    <div class="card-body">
        <h5 class="card-title">Treningi regatowe</h5>
        <p class="card-text">Organizujemy profesjonalne treningi regatowe w Krakowie. Zdobądź nowe umiejętności i poczuj się pewniej na wodzie.</p>
        <a href="#" class="btn btn-sm btn-outline-secondary">Czytaj więcej</a>
    </div>
</div>