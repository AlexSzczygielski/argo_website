<?php
$gallery = [
    "AMWIM_2025.jpg.webp",
    "na_wodzie.jpg",
    "podium_1.jpeg",
    "podium_2.jpg",
    "zaloga_1.jpg",
    "zaloga_2.jpg",
    "zaloga_3.jpg",
    "zaloga_5.jpg"
];
?>

<style>
  /* --- BLOG POST --- */

  .blog-post-content p {
    font-size: 1.05rem;
    line-height: 1.9;
    margin-bottom: 1.5rem;
    color: #212529;
  }

  .post-gallery .gallery-item {
    display: block;
    overflow: hidden;
    border-radius: 12px;
  }

  .post-gallery .gallery-image {
    transition: transform 0.3s ease;
  }

  .post-gallery .gallery-image:hover {
    transform: scale(1.03);
  }

  .modal-body img {
    max-height: 90vh;
    object-fit: contain;
  }
</style>

<div class="blog-post-content">

    <p>
        Miniony weekend był dla naszej załogi prawdziwym sprawdzianem żeglarskich umiejętności.
        Podczas Akademickich Mistrzostw Warszawy i Mazowsza rozegranych na Zalewie Zegrzyńskim
        reprezentacja ARGO AGH Kraków wywalczyła <strong>3. miejsce</strong>, pokazując charakter
        i skuteczność w bardzo wymagających taktycznie warunkach.
    </p>

    <p>
        Zmienny i niestabilny wiatr sprawiał, że kluczowe znaczenie miała taktyka,
        szybkie podejmowanie decyzji oraz dobra komunikacja na pokładzie.
        Każdy wyścig wymagał pełnego skupienia i umiejętności odnalezienia się
        w trudnej sytuacji na trasie.
    </p>

    <p>
        Mimo wymagających warunków nasza załoga utrzymywała równe tempo przez całe regaty,
        konsekwentnie walcząc o czołowe lokaty w kolejnych wyścigach.
        Ostatecznie pozwoliło to stanąć na podium i zakończyć rywalizację
        z bardzo dobrym wynikiem.
    </p>

    <p>
        Dziękujemy organizatorom za świetnie przygotowane zawody oraz wszystkim
        za wsparcie i doping.
    </p>

    <p>
        Teraz pałeczkę przejmuje kolejna załoga, która już za tydzień w Morągu zwoduje łódkę
        podczas regat Pucharu Polski. Trzymamy mocno kciuki za kolejne starty
        i życzymy powodzenia na wodzie!
    </p>

    <p class="fw-semibold mb-5">
        Do zobaczenia na regatach!
    </p>

    <h4>Wyniki (kategoria Open):</h4>
<ul class="list-unstyled">
    <li><strong>3.</strong> Aleksander Szczygielski, Jan Gorgoń, Gabriela Cielecka</li>
    <li>
        <strong>
            <a href="https://www.upwind24.pl/regatta/amwim-w-zeglarstwie-2026/results" target="_blank">
                Pełne wyniki na stronie Upwind
            </a>
        </strong>

</div>

<div class="mt-5 text-muted"
      style="font-style: italic; font-size: 0.9rem;">
    AUTOR: <?= htmlspecialchars($post['author'] ?? 'ARGO') ?>
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
                        src="storage/images/2026/amwim/<?= $image ?>"
                        alt="ARGO AGH Kraków - zdjęcie z regat"
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
                        src="storage/images/2026/amwim/<?= $image ?>"
                        class="img-fluid rounded shadow"
                        alt="ARGO AGH Kraków - zdjęcie z regat"
                    >

                </div>

            </div>

        </div>

    </div>

<?php endforeach; ?>