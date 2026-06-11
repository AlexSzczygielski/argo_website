<?php
$page_title = "Panel klubowy — poradnik — SKR Argo AGH";
$page_description = "Jak korzystać z panelu CMS SKR Argo AGH — dodawanie postów, galeria, okładka.";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <?php require_once('layout/header.php'); ?>
    <style>
        .cms-step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background-color: #1e3f66;
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
            margin-right: 0.75rem;
        }
        .cms-step-heading {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }
        .cms-step-heading h3 {
            margin: 0;
        }
        .cms-screenshot {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            cursor: pointer;
            width: 100%;
            object-fit: cover;
        }
        .cms-screenshot-caption {
            font-size: 0.8rem;
            color: #6c757d;
            font-style: italic;
            margin-top: 0.4rem;
        }
        .role-card {
            border-left: 4px solid #1e3f66;
            background-color: #f8f9fa;
            border-radius: 0 8px 8px 0;
            padding: 1rem 1.25rem;
        }
        .role-card.admin {
            border-left-color: #198754;
        }
        .tip-box {
            background-color: #e8f0f7;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
        }
        .tip-box strong {
            color: #1e3f66;
        }
    </style>
</head>

<body>
<div class="page-container">
    <div class="content-wrap">
        <?php require_once('layout/navbar.php'); ?>

        <!-- Page content starts here -->
        <div class="container py-4 px-3 px-md-4">

            <h1 class="mt-4 mb-2">Panel klubowy — poradnik</h1>
            <p class="lead text-muted mb-4">
                Strona klubu posiada własny system zarządzania treścią, zbudowany specjalnie dla Argo.
                Poniżej znajdziesz wszystko, czego potrzebujesz żeby dodać relację z regat lub inny wpis na bloga.
            </p>

            <hr class="mb-5">

            <!-- ROLE SECTION -->
            <section class="mb-5">
                <h2 class="mb-4">Kto może co robić?</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="role-card h-100">
                            <h5 class="mb-2">👤 Klubowicz</h5>
                            <ul class="mb-0">
                                <li>Tworzy i edytuje własne wpisy</li>
                                <li>Dodaje zdjęcia do galerii</li>
                                <li>Ustawia okładkę posta</li>
                                <li>Wysyła wpis do zatwierdzenia</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="role-card admin h-100">
                            <h5 class="mb-2">🛡️ Administrator</h5>
                            <ul class="mb-0">
                                <li>Wszystko co klubowicz, plus:</li>
                                <li>Zatwierdza i publikuje wpisy</li>
                                <li>Usuwa dowolny wpis lub zdjęcie</li>
                                <li>Widzi wszystkie wpisy niezależnie od statusu</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tip-box mt-3">
                    <strong>Nie masz konta?</strong> Napisz do zarządu — konta zakładane są ręcznie przez administratora.
                    Jeśli chcesz żeby Twój wpis był opublikowany, po zapisaniu wyślij go do zatwierdzenia i poinformuj admina.
                </div>
            </section>

            <hr class="mb-5">

            <!-- STEP 1 — LOGIN -->
            <section class="mb-5">
                <div class="cms-step-heading">
                    <span class="cms-step-number">1</span>
                    <h3>Logowanie</h3>
                </div>
                <p>
                    Panel dostępny jest pod adresem
                    <a href="/dashboard/login.php"><strong>/dashboard/login.php</strong></a>.
                    Zaloguj się adresem e-mail i hasłem podanym przez administratora.
                </p>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLogin">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_login.jpeg"
                                 class="cms-screenshot"
                                 alt="Strona logowania do panelu">
                        </a>
                        <p class="cms-screenshot-caption">Strona logowania do panelu klubowego.</p>
                    </div>
                </div>
            </section>

            <!-- STEP 2 — PANEL -->
            <section class="mb-5">
                <div class="cms-step-heading">
                    <span class="cms-step-number">2</span>
                    <h3>Panel główny</h3>
                </div>
                <p>
                    Po zalogowaniu trafiasz do listy wszystkich wpisów. Każdy wpis pokazuje tytuł, autora, datę
                    oraz aktualny status. Możesz od razu edytować istniejące wpisy lub dodać nowy.
                </p>
                <div class="row mt-3 g-3">
                    <div class="col-md-8">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalPanel">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_panel.jpeg"
                                 class="cms-screenshot"
                                 alt="Lista wpisów w panelu">
                        </a>
                        <p class="cms-screenshot-caption">Lista wpisów — widoczne statusy, przyciski edycji i zarządzania.</p>
                    </div>
                </div>

                <h5 class="mt-4 mb-2">Filtrowanie wpisów</h5>
                <p>
                    Nad listą znajdziesz filtry według statusu: <strong>Wszystkie</strong>, <strong>Szkice</strong>,
                    <strong>Oczekujące</strong> i <strong>Opublikowane</strong>. Przydatne gdy wpisów jest dużo
                    i szukasz konkretnych — np. tych czekających na zatwierdzenie.
                </p>
                <div class="row mt-3">
                    <div class="col-md-8">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalFilter">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_panel_filter.jpeg"
                                 class="cms-screenshot"
                                 alt="Filtrowanie wpisów według statusu">
                        </a>
                        <p class="cms-screenshot-caption">Filtr "Oczekujące" — widok dla administratora przed zatwierdzeniem.</p>
                    </div>
                </div>
            </section>

            <!-- STEP 3 — NEW POST -->
            <section class="mb-5">
                <div class="cms-step-heading">
                    <span class="cms-step-number">3</span>
                    <h3>Tworzenie nowego wpisu</h3>
                </div>
                <p>
                    Kliknij <strong>„+ Dodaj nowy post"</strong>. Wypełnij formularz:
                </p>
                <ul>
                    <li><strong>Tytuł</strong> — pojawi się jako nagłówek wpisu i w listingu bloga</li>
                    <li><strong>Autor</strong> — domyślnie Twoje imię i nazwisko z konta</li>
                    <li><strong>Data</strong> — data widoczna przy wpisie</li>
                    <li><strong>Skrót</strong> — krótki opis wyświetlany na karcie bloga</li>
                    <li><strong>Upwind URL</strong> — opcjonalnie: link do wyników regat z upwind24.pl; jeśli podasz, wyniki załadują się automatycznie pod treścią</li>
                    <li><strong>Treść</strong> — edytor z formatowaniem (pogrubienie, listy, nagłówki)</li>
                </ul>
                <div class="row mt-3 g-3">
                    <div class="col-12">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalNowyPost">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_nowy_post.jpeg"
                                 class="cms-screenshot"
                                 alt="Formularz nowego wpisu">
                        </a>
                        <p class="cms-screenshot-caption">Formularz edycji wpisu z podglądem na żywo po prawej stronie.</p>
                    </div>
                </div>
                <div class="tip-box mt-3">
                    <strong>Podgląd na żywo:</strong> prawa strona ekranu pokazuje jak wpis będzie wyglądał po opublikowaniu —
                    aktualizuje się automatycznie podczas pisania.
                </div>
            </section>

            <!-- STEP 4 — GALLERY -->
            <section class="mb-5">
                <div class="cms-step-heading">
                    <span class="cms-step-number">4</span>
                    <h3>Dodawanie zdjęć</h3>
                </div>
                <p>
                    Zdjęcia możesz dodać dopiero po <strong>pierwszym zapisaniu wpisu</strong> — wtedy pojawi się sekcja galerii.
                    Kliknij <strong>„Zapisz szkic"</strong>, a formularz przełączy się w tryb edycji z aktywną galerią.
                </p>
                <p>
                    Możesz zaznaczyć kilka zdjęć naraz. Obsługiwane formaty: JPG, PNG, WebP, GIF.
                    Zdjęcia są automatycznie skalowane do maksymalnie 1920px i konwertowane do JPEG.
                </p>
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalGaleria">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_galeria.jpeg"
                                 class="cms-screenshot"
                                 alt="Sekcja galerii zdjęć">
                        </a>
                        <p class="cms-screenshot-caption">Galeria wpisu — przesłane zdjęcia z opcjami ustawienia okładki i usunięcia.</p>
                    </div>
                </div>
                <!-- PREVIEW GALLERY SCREENSHOT -->
                <h5 class="mt-4 mb-2">Podgląd galerii na żywo</h5>
                <p>Galeria zdjęć renderuje się w czasie rzeczywistym w podglądzie — bez zapisywania i odświeżania strony.</p>
                <div class="row mt-3">
                    <div class="col-8">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalPreviewGallery">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_preview_gallery.jpeg"
                                 class="cms-screenshot"
                                 alt="Podgląd galerii na żywo">
                        </a>
                        <p class="cms-screenshot-caption">Galeria zdjęć widoczna w podglądzie na żywo podczas edycji wpisu.</p>
                    </div>
                </div>
                <div class="tip-box mt-3">
                    <strong>Niezapisane zmiany:</strong> jeśli edytujesz treść wpisu i spróbujesz od razu przesłać zdjęcia,
                    system Cię zatrzyma i poprosi o wcześniejsze zapisanie — żeby nic nie przepadło.
                </div>
                <div class="mt-3">
                    <p class="mb-2">Po wybraniu zdjęć z dysku zatwierdź przesyłanie przyciskiem:</p>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="return false;">Dodaj zdjęcia (potwierdź)</button>
                    <p class="cms-screenshot-caption mt-2">Zdjęcia są przesyłane na serwer dopiero po kliknięciu tego przycisku — samo wybranie plików z dysku nic jeszcze nie robi.</p>
                </div>
            </section>

            <!-- STEP 5 — COVER -->
            <section class="mb-5">
                <div class="cms-step-heading">
                    <span class="cms-step-number">5</span>
                    <h3>Ustawianie okładki</h3>
                </div>
                <p>
                    Pod każdym zdjęciem w galerii znajdziesz przycisk <strong>„Ustaw okładkę"</strong>.
                    Kliknięcie go ustawia dane zdjęcie jako główne — pojawi się na karcie bloga i na górze wpisu.
                    Okładkę możesz zmienić w dowolnym momencie.
                </p>
                <div class="row mt-3">
                    <div class="col-md-7">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalOkladka">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_okladka.jpeg"
                                 class="cms-screenshot"
                                 alt="Ustawiona okładka wpisu">
                        </a>
                        <p class="cms-screenshot-caption">Podgląd ustawionej okładki w panelu edycji.</p>
                    </div>
                </div>
            </section>

            <!-- STEP 6 — STATUSES -->
            <section class="mb-5">
                <div class="cms-step-heading">
                    <span class="cms-step-number">6</span>
                    <h3>Statusy wpisu</h3>
                </div>
                <p>Każdy wpis przechodzi przez trzy statusy:</p>
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <div class="role-card h-100">
                            <span class="badge bg-secondary mb-2">Szkic</span>
                            <p class="mb-0 small">Widoczny tylko dla Ciebie w panelu. Możesz edytować bez ograniczeń.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="role-card h-100" style="border-left-color: #ffc107;">
                            <span class="badge bg-warning text-dark mb-2">Oczekuje</span>
                            <p class="mb-0 small">Wysłany do zatwierdzenia. Administrator widzi wpis i może go opublikować.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="role-card admin h-100">
                            <span class="badge bg-success mb-2">Opublikowany</span>
                            <p class="mb-0 small">Widoczny publicznie na stronie klubu w sekcji Blog.</p>
                        </div>
                    </div>
                </div>
                <p>
                    Kiedy wpis jest gotowy, kliknij <strong>„Wyślij do zatwierdzenia"</strong> i daj znać administratorowi —
                    dostanie go w kolejce oczekujących.
                </p>

                <div class="mt-3 mb-3 d-flex gap-2 flex-wrap">
                    <button type="button" class="btn btn-outline-secondary" onclick="return false;">Zapisz szkic</button>
                    <button type="button" class="btn btn-primary" onclick="return false;">Wyślij do zatwierdzenia</button>
                </div>
                <p class="cms-screenshot-caption mb-3">„Zapisz szkic" zachowuje wpis bez wysyłania do moderacji. „Wyślij do zatwierdzenia" zmienia status na Oczekuje — od tej chwili administrator widzi wpis w kolejce.</p>

                <h5 class="mt-4 mb-3">Zatwierdzanie (tylko administrator)</h5>
                <p>
                    Administrator widzi wpisy ze statusem „Oczekuje" w panelu i może je zatwierdzić jednym kliknięciem.
                    Po zatwierdzeniu wpis natychmiast pojawia się na blogu.
                </p>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalZatwierdz">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_zatwierdz.jpeg"
                                 class="cms-screenshot"
                                 alt="Strona zatwierdzania wpisu">
                        </a>
                        <p class="cms-screenshot-caption">Strona potwierdzenia publikacji — widok administratora.</p>
                    </div>
                </div>
                <!-- LIVE CARD RENDER -->
                <h5 class="mt-4 mb-2">Tak wyglądają wpisy w panelu:</h5>
                <div class="row g-4 mt-1 mb-3">

                    <!-- Published -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="/storage/images/argo_painting.jpg"
                                 class="card-img-top"
                                 style="height: 180px; object-fit: cover;"
                                 alt="Regaty o Złote Runo">
                            <div class="card-body">
                                <p class="card-text text-muted" style="font-size:0.85rem">
                                    10.06.2026 &middot; Stanisław Staszic
                                    <span class="badge bg-success">Opublikowany</span>
                                </p>
                                <h5 class="card-title">Regaty o Złote Runo - Ogólnopolski Puchar Żeglarski AGH</h5>
                                <p class="card-text">Załoga SKR ARGO AGH Kraków sięga po Złote Runo na Jeziorze Rożnowskim!</p>
                            </div>
                            <div class="card-footer d-flex gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary">Edytuj</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">Podgląd</a>
                                <a href="#" class="btn btn-sm btn-outline-danger">Usuń</a>
                            </div>
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="/storage/images/2024/Amp1.jpg"
                                 class="card-img-top"
                                 style="height: 180px; object-fit: cover;"
                                 alt="Akademickie Mistrzostwa Polski SKR ARGO AGH">
                            <div class="card-body">
                                <p class="card-text text-muted" style="font-size:0.85rem">
                                    08.06.2026 &middot; Mikołaj Kopernik
                                    <span class="badge bg-warning text-dark">Oczekuje</span>
                                </p>
                                <h5 class="card-title">Puchar Rektora AGH 2026</h5>
                                <p class="card-text">Relacja z regat rozegranych na Zalewie Kryspinów - czekamy na zatwierdzenie!</p>
                            </div>
                            <div class="card-footer d-flex gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary">Edytuj</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">Podgląd</a>
                                <a href="#" class="btn btn-sm btn-success">Zatwierdź</a>
                                <a href="#" class="btn btn-sm btn-outline-danger">Usuń</a>
                            </div>
                        </div>
                    </div>

                    <!-- Draft -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                 style="height: 180px; color: #adb5bd; font-size: 0.85rem;">
                                brak okładki
                            </div>
                            <div class="card-body">
                                <p class="card-text text-muted" style="font-size:0.85rem">
                                    05.06.2026 &middot; Jan Kochanowski
                                    <span class="badge bg-secondary">Szkic</span>
                                </p>
                                <h5 class="card-title">Kończymy Sezon</h5>
                                <p class="card-text">Wpis w trakcie pisania - jeszcze nie wysłany do zatwierdzenia.</p>
                            </div>
                            <div class="card-footer d-flex gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary">Edytuj</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">Podgląd</a>
                                <a href="#" class="btn btn-sm btn-success">Zatwierdź</a>
                                <a href="#" class="btn btn-sm btn-outline-danger">Usuń</a>
                            </div>
                        </div>
                    </div>

                </div>
                <p class="cms-screenshot-caption mb-3">Trzy wpisy w różnych statusach — opublikowany, oczekujący na zatwierdzenie i szkic. Administrator widzi przyciski „Zatwierdź" i „Usuń" przy każdym wpisie.</p>
            </section>

            <!-- STEP 7 — RESULT -->
            <section class="mb-5">
                <div class="cms-step-heading">
                    <span class="cms-step-number">7</span>
                    <h3>Efekt końcowy</h3>
                </div>
                <p>
                    Opublikowany wpis pojawia się w sekcji <a href="/blog.php"><strong>Blog</strong></a> —
                    z okładką, galerią ze zdjęciami do kliknięcia i opcjonalną tabelą wyników z Upwind24.
                    Na stronie głównej ostatnie wydarzenie aktualizuje się automatycznie.
                </p>

                <!-- MAIN PAGE UPDATE -->
                <h5 class="mt-4 mb-2">Automatyczna aktualizacja strony głównej</h5>
                <p>Po publikacji wpisu strona główna automatycznie pokazuje najnowsze wydarzenie — bez żadnej dodatkowej akcji.</p>
                <div class="row mt-3">
                    <div class="col-md-8">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLastEvent">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_updated_main_page.jpeg"
                                 class="cms-screenshot"
                                 alt="Aktualizacja strony głównej">
                        </a>
                        <p class="cms-screenshot-caption">Strona główna po publikacji — najnowszy wpis pojawia się automatycznie.</p>
                    </div>
                </div>

                <!-- BLOG RESULT -->
                <h5 class="mt-4 mb-2">Wpis na blogu</h5>
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalBlogResult">
                            <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_blog_result.jpeg"
                                 class="cms-screenshot"
                                 alt="Opublikowany wpis na blogu">
                        </a>
                        <p class="cms-screenshot-caption">Opublikowany wpis na blogu klubu z galerią zdjęć.</p>
                    </div>
                </div>
            </section>

            <!-- CLOSING NOTE -->
            <hr class="mb-4">
            <section class="mb-5">
                <p class="text-muted">
                    Coś nie działa? Napisz do <strong>zarządu</strong> lub bezpośrednio do osoby odpowiedzialnej za stronę.
                </p>
            </section>

        </div>
        <!-- Page content ends here -->
    </div>
    <?php require_once('layout/footer.php'); ?>
</div>

<!-- ===================== MODALS ===================== -->

<div class="modal fade" id="modalLogin" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_login.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPanel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_panel.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFilter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_panel_filter.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNowyPost" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_nowy_post.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalGaleria" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_galeria.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalOkladka" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_okladka.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalZatwierdz" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_zatwierdz.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBlogResult" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_blog_result.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLastEvent" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_updated_main_page.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPreviewGallery" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="storage/images/dla_czlonkow/cms_showcase/screenshot_preview_gallery.jpeg" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

</body>
</html>