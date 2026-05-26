<?php
$gallery = [
    "amp_2026_cover.webp",
    "IMG_9640.jpeg",
    "IMG_9750.JPG",
    "IMG_9751.JPG",
    "IMG_9752.JPG",
    "IMG_9753.JPG",
    "IMG_9754.JPG",
    "IMG_9755.JPG",
    "IMG_9756.JPG",
    "IMG_9757.JPG",
    "att.G5xWBDuB_vEV_TJqyz3n4Pgim3HJ3SBCdVWpl9LUhz4.JPG",
    "podium_1.JPG",
];
?>

<div class="blog-post-content">

    <p>
        Tegoroczne Akademickie Mistrzostwa Polski upłynęły pod znakiem wymagających, niemal bezwietrznych warunków. Słaby wiatr sprawiał, że każdy błąd kosztował podwójnie, a o końcowym wyniku decydowały precyzja, cierpliwość i pełne skupienie na trasie.
    </p>

    <p>
        Mimo trudnych warunków nasze załogi bardzo dobrze poradziły sobie w eliminacjach. Wszystkie trzy awansowały do złotej floty, co już samo w sobie było dużym sukcesem i potwierdzeniem wysokiego poziomu sportowego całej drużyny.
    </p>

    <p>
        Finały przyniosły kolejne powody do dumy. Załoga Leona wywalczyła 3. miejsce w klasyfikacji indywidualnej uczelni technicznych, pokazując świetne przygotowanie i konsekwencję w każdym wyścigu.
    </p>

    <p>
        Równie dobrze zaprezentowała się cała reprezentacja, zdobywając 2. miejsce w klasyfikacji drużynowej uczelni technicznych. To rezultat wspólnej pracy, zaangażowania i walki do ostatniego wyścigu.
    </p>

    <p>
        AMP-y były nie tylko sportową rywalizacją, ale także kolejnym cennym doświadczeniem zdobytym na wodzie. Wracamy z medalami, motywacją do dalszej pracy i apetytem na jeszcze więcej w kolejnych startach.
    </p>

    <div class="mt-5 text-muted" style="font-style: italic; font-size: 0.9rem;">
        AUTOR: <?= htmlspecialchars($post['author'] ?? 'ARGO') ?>
    </div>
<h4 class="mt-5">Wyniki</h4>
    <ul class="list-unstyled">
    <li><strong>6.</strong> Leon Gniadek, Jan Pacheco-Śledź, Tymoteusz Mika</li>
    <li><strong>28.</strong> Wiktor Leśkiewicz, Hubert Kraj, Kacper Ćwiokowski</li>
    <li><strong>34.</strong> Aleksander Szczygielski, Jan Gorgoń, Gabriela Cielecka</li>

    </ul>

    <strong>
        <a href="https://www.upwind24.pl/pl/regatta/akademickie-mistrzostwa-polski-w-zeglarstwie-2026-2026/results" target="_blank">
            Pełne wyniki na stronie Upwind
        </a>
    </strong>
</div>

<!-- GALERIA -->
<div class="post-gallery mt-5">
    <div class="row g-3">

        <?php foreach ($gallery as $index => $image): ?>
            <div class="col-6">
                <a
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#galleryModal<?= $index ?>"
                    class="gallery-item"
                >
                    <img
                        src="storage/images/2026/amp/<?= $image ?>"
                        alt="Studencki Klub Regatowy ARGO AGH Kraków - zdjęcie z regat"
                        class="img-fluid rounded shadow-sm gallery-image"
                        loading="lazy"
                    >
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<!-- MODALE -->
<?php foreach ($gallery as $index => $image): ?>
    <div class="modal fade" id="galleryModal<?= $index ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body text-center p-0">
                    <img
                        src="storage/images/2026/amp/<?= $image ?>"
                        class="img-fluid rounded shadow"
                        alt="Studencki Klub Regatowy ARGO AGH Kraków - zdjęcie z regat"
                    >
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="mt-5 text-muted" style="font-style: italic; font-size: 0.9rem;">
    Zdjęcia dzięki uprzejmości organizatora.
</div>