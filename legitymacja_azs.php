<?php
$page_title = "Legitymacja AZS - SKR Argo AGH";
$page_description = "Instrukcja zdobycia legitymacji AZS oraz certyfikatu przynależności akademickiej.";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>

<html lang="pl">

<head>
    <title>SKR Argo AGH - Legitymacja AZS</title>
    <?php require_once('layout/header.php'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Instrukcja zdobycia legitymacji AZS">

    <style>
        a {
            word-break: break-word;
            overflow-wrap: anywhere;
        }
    </style>
</head>

<body>

<div class="page-container">
    <div class="content-wrap">
        <?php require_once('layout/navbar.php'); ?>

        <!-- Page content starts here -->
        <div class="container py-4 px-3 px-md-4">

            <h1 class="mt-4 mb-4">Legitymacja AZS</h1>

            <div class="row align-items-start">

                <!-- Image -->
                <div class="col-md-4 order-1 order-md-2 text-center">
                    <img src="storage/images/argologo.svg"
                         alt="AZS Żeglarstwo"
                         class="img-fluid rounded mb-4"
                         style="max-height: 250px; object-fit: contain;">
                </div>

                <!-- Text -->
                <div class="col-md-8 order-2 order-md-1">

                    <section class="mb-5">
                        <p class="lead">
                            Poniżej znajdziecie instrukcję jak zdobyć legitymację AZS oraz certyfikat przynależności akademickiej potrzebny przed zawodami.
                        </p>
                    </section>

                    <section class="mb-5">
                        <h2>Krok 1 - Formularz Członkostwa w Argo</h2>

                        <p>
                            Najpierw należy zostać przyjętym do SKR Argo i wypełnić formularz:
                        </p>

                        <p>
                            <a href="deklaracja_czlonkostwa.php" target="_blank" class="text-break">
                                Deklaracja członkostwa
                            </a>
                        </p>
                    </section>

                    <section class="mb-5">
                        <h2>Krok 2 - Rejestracja w AZS</h2>

                        <p>
                            Następnie przechodzimy do formularza rejestracyjnego:
                        </p>

                        <p>
                            <a href="https://planeta.azs.pl/" target="_blank" class="text-break">
                                Planeta AZS
                            </a>
                        </p>

                        <p>
                            W formularzu uzupełniacie wszystkie pola oznaczone czerwoną gwiazdką.
                            Potrzebne będą podstawowe dane, numer telefonu, adres e-mail oraz zdjęcie w wersji cyfrowej.
                        </p>
                    </section>

                    <section class="mb-5">
                        <h2>Ważne informacje przy wypełnianiu formularza</h2>

                        <h4>Wariant ubezpieczenia NNW</h4>

                        <p>
                            Szczegóły dotyczące wariantów ubezpieczenia znajdziecie tutaj:
                        </p>

                        <p>
                            <a href="https://azs.pl/wariant-komfort" target="_blank" class="text-break">
                                https://azs.pl/wariant-komfort
                            </a>
                        </p>

                        <h4 class="mt-4">Rodzaj legitymacji</h4>

                        <p>
                            Warto od razu wybrać typ legitymacji <strong>AZS ISIC</strong>,
                            ponieważ potwierdza ona międzynarodowo status studenta.
                            Do tego potrzebne będzie zdjęcie Waszej legitymacji studenckiej.
                        </p>

                        <p>
                            Fizyczna legitymacja nie jest konieczna i kosztuje dodatkowo 35 zł.
                            Może się przydać za granicą przy zniżkach wymagających fizycznego ISIC,
                            ale w większości przypadków wystarcza wersja elektroniczna w aplikacji.
                        </p>

                        <h4 class="mt-4">Data przystąpienia do AZS</h4>

                        <p>
                            Można wpisać datę pierwszego treningu albo po prostu 1 października.
                        </p>

                        <h4 class="mt-4">Dane klubu</h4>

                        <ul>
                            <li class="mb-2">
                                <strong>Uczelnia:</strong> AGH
                            </li>

                            <li class="mb-2">
                                <strong>Klub:</strong> AZS AGH
                            </li>

                            <li class="mb-2">
                                <strong>Sekcja:</strong> Żeglarstwo
                            </li>
                        </ul>
                    </section>

                    <section class="mb-5">
                        <h2>Akceptacja członkostwa</h2>

                        <p>
                            Po zaakceptowaniu zgód i wysłaniu formularza należy poczekać na akceptację członkostwa przez biuro AZS AGH.
                            Zwykle trwa to kilka dni.
                        </p>

                        <p>
                            Po akceptacji otrzymacie wiadomość e-mail z informacją,
                            że można już opłacić składkę członkowską.
                        </p>

                        <div class="mt-4 mb-4 text-muted" style="font-style: italic; font-size: 0.95rem;">
                            Po opłaceniu składki oficjalnie dołączacie do AZS 🎉
                        </div>
                    </section>

                    <section class="mb-5">
                        <h2>Certyfikat przynależności akademickiej</h2>

                        <p>
                            Po opłaceniu składki w panelu członka Planeta AZS należy kliknąć:
                        </p>

                        <p>
                            <strong>„Certyfikat Przynależności Akademickiej”</strong>
                        </p>

                        <p>
                            System poprowadzi Was dalej przez generowanie dokumentu.
                        </p>

                        <p>
                            Wydrukowany certyfikat należy:
                        </p>

                        <ul>
                            <li class="mb-2">
                                podpisać własnoręcznie,
                            </li>

                            <li class="mb-2">
                                podbić pieczątką w dziekanacie podczas godzin pracy.
                            </li>
                        </ul>

                        <div class="mt-4 mb-4 text-muted" style="font-style: italic; font-size: 0.95rem;">
                            Certyfikat będzie potrzebny przed pierwszymi zawodami.
                        </div>
                    </section>

                </div>
            </div>
        </div>
        <!-- Page content ends here -->

    </div>

    <?php require_once('layout/footer.php'); ?>
</div>

</body>

</html>