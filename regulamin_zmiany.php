<?php
$page_title = "Projekt zmian Regulaminu - SKR Argo AGH";
$page_description = "Projekt zmian Regulaminu Uczelnianej Organizacji Studenckiej SKR Argo AGH – wersja v10";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <?php require_once('layout/header.php'); ?>
    <style>
        .change-banner {
            background: linear-gradient(135deg, #1a3a5c 0%, #0d2137 100%);
            color: #fff;
            border-radius: 12px;
            padding: 2rem 2.5rem;
            margin-bottom: 2.5rem;
        }
        .change-banner .badge-draft {
            display: inline-block;
            background: #e8a020;
            color: #fff;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .25em .7em;
            border-radius: 4px;
            margin-bottom: .75rem;
        }
        .change-banner h1 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: .4rem;
        }
        .change-banner p {
            opacity: .8;
            margin: 0;
            font-size: .95rem;
        }
        .legend {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .88rem;
            color: #444;
        }
        .legend-dot {
            width: 14px;
            height: 14px;
            border-radius: 3px;
            flex-shrink: 0;
        }
        .legend-dot.added   { background: #d4edda; border: 1.5px solid #28a745; }
        .legend-dot.removed { background: #f8d7da; border: 1.5px solid #dc3545; }
        .legend-dot.new-section { background: #cce5ff; border: 1.5px solid #0d6efd; }

        /* Change cards */
        .change-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        .change-card-header {
            padding: .75rem 1.25rem;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
            font-size: .9rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .change-card-header .section-ref {
            color: #6c757d;
            font-weight: 400;
            font-size: .82rem;
        }
        .change-card-body {
            padding: 1.25rem;
        }

        /* New section card */
        .change-card.new-section {
            border-color: #b8daff;
        }
        .change-card.new-section .change-card-header {
            background: #e7f1ff;
            border-bottom-color: #b8daff;
            color: #0d6efd;
        }

        /* Diff display */
        .diff-block {
            font-size: .93rem;
            line-height: 1.7;
        }
        .diff-del {
            background: #ffeef0;
            color: #b31d28;
            text-decoration: line-through;
            padding: .1em .25em;
            border-radius: 3px;
            font-weight: 500;
        }
        .diff-ins {
            background: #e6ffed;
            color: #22863a;
            padding: .1em .25em;
            border-radius: 3px;
            font-weight: 500;
        }

        /* New paragraph blocks inside new-section */
        .new-para {
            background: #f0f7ff;
            border-left: 3px solid #0d6efd;
            padding: .6rem 1rem;
            border-radius: 0 6px 6px 0;
            margin-bottom: .75rem;
            font-size: .93rem;
            line-height: 1.7;
        }
        .new-para:last-child { margin-bottom: 0; }
        .new-para ol {
            margin: .4rem 0 0 0;
            padding-left: 1.5rem;
        }
        .new-para ol li { margin-bottom: .3rem; }

        .para-num {
            font-weight: 700;
            color: #0d6efd;
            margin-right: .3rem;
        }

        /* Context text (unchanged surrounding text) */
        .ctx {
            color: #555;
        }
        .change-summary-box {
            background: #fffbf0;
            border: 1px solid #ffe082;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 2rem;
            font-size: .9rem;
        }
        .change-summary-box ul {
            margin: .4rem 0 0;
            padding-left: 1.2rem;
        }
        .change-summary-box li { margin-bottom: .2rem; }
    </style>
</head>

<body>
    <div class="page-container">
        <div class="content-wrap">
            <?php require_once('layout/navbar.php'); ?>

            <div class="container p-4">

                <!-- Banner -->
                <div class="change-banner mt-5">
                    <div class="badge-draft">Projekt zmian</div>
                    <h1>Zmiany w Regulaminie Organizacji</h1>
                    <p>Wersja v10 &mdash; do zatwierdzenia przez Walne Zebranie. Dokument przedstawia różnice względem obowiązującego Regulaminu z 31.12.2024&nbsp;r.</p>
                </div>

                <!-- Summary -->
                <div class="change-summary-box">
                    <strong>Podsumowanie zmian:</strong>
                    <ul>
                        <li><strong>§ 3 ust. 5</strong> &mdash; nowy obowiązek członka: dbanie o sprzęt i przestrzeganie zasad korzystania (§ 6)</li>
                        <li><strong>§ 3 ust. 7</strong> &mdash; nowa podstawa wykluczenia: naruszenie zasad korzystania ze sprzętu</li>
                        <li><strong>§ 5 ust. 8</strong> &mdash; zmiana „rok kalendarzowy" na „rok akademicki"</li>
                        <li><strong>§ 6 (nowy)</strong> &mdash; zasady wypożyczania sprzętu (próg wartości: 1000 zł), sankcje, odwołania</li>
                    </ul>
                </div>

                <!-- Legend -->
                <div class="legend">
                    <div class="legend-item"><div class="legend-dot added"></div> Dodany tekst</div>
                    <div class="legend-item"><div class="legend-dot removed"></div> Usunięty tekst</div>
                    <div class="legend-item"><div class="legend-dot new-section"></div> Nowy paragraf</div>
                </div>

                <!-- Change 1: §3 nowy obowiązek -->
                <div class="change-card">
                    <div class="change-card-header">
                        § 3 &mdash; Członkostwo
                        <span class="section-ref">Obowiązki osoby zrzeszonej (ust. 5)</span>
                    </div>
                    <div class="change-card-body">
                        <p class="text-muted small mb-2">Do listy obowiązków osoby zrzeszonej dodano nowy punkt:</p>
                        <div class="diff-block">
                            <span class="ctx">stosować się do postanowień organów Organizacji; </span>
                            przestrzegać postanowień niniejszego Regulaminu<span class="diff-del">.</span><span class="diff-ins">;</span>
                            <br>
                            <span class="diff-ins">dbać o sprzęt pozostający w dyspozycji Organizacji oraz przestrzegać zasad korzystania z niego, określonych w § 6.</span>
                        </div>
                    </div>
                </div>

                <!-- Change 2: §3 ust. 7 nowa podstawa wykluczenia -->
                <div class="change-card">
                    <div class="change-card-header">
                        § 3 &mdash; Członkostwo
                        <span class="section-ref">Podstawy wykluczenia (ust. 7)</span>
                    </div>
                    <div class="change-card-body">
                        <p class="text-muted small mb-2">Zmiana treści istniejącego punktu oraz dodanie nowej podstawy wykluczenia:</p>
                        <div class="diff-block">
                            <span class="ctx">nieprzestrzegania postanowień niniejszego Regulaminu</span>
                            <span class="diff-ins">, z zastrzeżeniem pkt 5</span>
                            <span class="ctx">;</span>
                            <br><br>
                            <span class="diff-ins">naruszenia zasad korzystania ze sprzętu Organizacji w przypadkach wskazanych w § 6 ust. 8 pkt 3.</span>
                        </div>
                    </div>
                </div>

                <!-- Change 3: §5 ust. 8 rok kalendarzowy → akademicki -->
                <div class="change-card">
                    <div class="change-card-header">
                        § 5 &mdash; Zarząd
                        <span class="section-ref">Sprawozdanie ustępującego Zarządu (ust. 8)</span>
                    </div>
                    <div class="change-card-body">
                        <div class="diff-block">
                            Ustępujący Zarząd jest obowiązany przedłożyć Walnemu Zebraniu osób zrzeszonych w Organizacji do zatwierdzenia sprawozdanie z działalności Organizacji w poprzednim roku <span class="diff-del">kalendarzowym</span><span class="diff-ins">akademickim</span>, w tym z wykorzystania otrzymanych środków.
                        </div>
                    </div>
                </div>

                <!-- Change 4: Nowy §6 -->
                <div class="change-card new-section">
                    <div class="change-card-header">
                        <i class="fas fa-plus-circle me-1"></i>
                        § 6 (nowy) &mdash; Korzystanie ze sprzętu Organizacji
                    </div>
                    <div class="change-card-body">
                        <p class="text-muted small mb-3">Dodany w całości nowy paragraf regulujący zasady wypożyczania i odpowiedzialności za sprzęt:</p>

                        <div class="new-para">
                            <span class="para-num">Ust. 1.</span>
                            Przez sprzęt Organizacji rozumie się sprzęt żeglarski o wartości <span class="diff-del">istotnej</span><span class="diff-ins">powyżej 1000 złotych</span>, w szczególności komplety żagli, pozostający w dyspozycji Organizacji.
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 2.</span>
                            Osoba zrzeszona może pobrać sprzęt Organizacji wyłącznie po uzyskaniu zgody Zarządu oraz po uprzednim wypełnieniu karty wypożyczenia i przekazaniu jej Zarządowi przed pobraniem sprzętu, w formie dokumentowej, w sposób umożliwiający identyfikację tej osoby. Wzór karty oraz sposób jej przekazywania (w tym formularz elektroniczny) określa Zarząd. Zarząd może odmówić zgody, w szczególności gdy sprzęt jest zarezerwowany w tym terminie, osoba zrzeszona nie ma doświadczenia lub umiejętności żeglarskich niezbędnych do prawidłowego użytkowania sprzętu albo nie może pobrać sprzętu na podstawie ust. 13.
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 3.</span>
                            Zabrania się pobierania, przewożenia i użytkowania sprzętu Organizacji bez zgody Zarządu oraz bez wypełnienia i przekazania Zarządowi karty wypożyczenia, o której mowa w ust. 2.
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 4.</span>
                            Kartę wypożyczenia wypełnia jedna osoba zrzeszona, wskazana jako odpowiedzialna za sprzęt w trakcie wyjazdu lub zawodów. Osoba ta odpowiada za sprzęt od chwili jego pobrania do chwili zwrotu i przesłania Zarządowi zdjęć, o których mowa w ust. 5.
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 5.</span>
                            Zwrot sprzętu następuje w terminie wskazanym w karcie wypożyczenia, nie później niż 7 dni od zakończenia zawodów lub wyjazdu. Po zwrocie sprzętu osoba odpowiedzialna za sprzęt przesyła Zarządowi zdjęcia sprzętu (całość oraz widoczne uszkodzenia, jeśli występują) i niezwłocznie zgłasza ewentualną utratę lub uszkodzenie.
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 6.</span>
                            Zarząd przechowuje karty wypożyczenia i prowadzi na ich podstawie ewidencję wydań i zwrotów sprzętu Organizacji.
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 7.</span>
                            Osoba, która użytkuje sprzęt Organizacji z naruszeniem ust. 2 lub 3, ponosi odpowiedzialność za jego utratę lub uszkodzenie jak osoba wypożyczająca, a ponadto jest zobowiązana niezwłocznie zwrócić sprzęt na wezwanie Zarządu.
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 8.</span>
                            W przypadku naruszenia ust. 2 lub 3 Zarząd, w drodze uchwały, może:
                            <ol type="1">
                                <li>udzielić osobie zrzeszonej upomnienia;</li>
                                <li>zakazać osobie zrzeszonej oraz osobom, które użytkowały sprzęt wspólnie z nią, korzystania ze sprzętu Organizacji na okres od 1 do 12 miesięcy;</li>
                                <li>wykluczyć osobę zrzeszoną z Organizacji, jeżeli naruszenie jest powtórne albo wiąże się z utratą sprzętu lub jego uszkodzeniem z winy osoby zrzeszonej, na zasadach określonych w § 3 ust. 7–12.</li>
                            </ol>
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 9.</span>
                            Wybierając rodzaj i wymiar środka, o którym mowa w ust. 8, Zarząd bierze pod uwagę w szczególności:
                            <ol type="1">
                                <li>wartość sprzętu oraz okoliczność jego utraty lub uszkodzenia;</li>
                                <li>czas i okoliczności nieuprawnionego użytkowania sprzętu;</li>
                                <li>to, czy osoba zrzeszona niezwłocznie ujawniła naruszenie, zwróciła sprzęt lub naprawiła szkodę;</li>
                                <li>to, czy w przeszłości naruszała zasady korzystania ze sprzętu Organizacji.</li>
                            </ol>
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 10.</span>
                            O rodzaju i wymiarze środka Zarząd informuje osobę zrzeszoną w formie dokumentowej wraz z uzasadnieniem.
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 11.</span>
                            Od uchwały w sprawie zakazu, o którym mowa w ust. 8 pkt 2, osobie, której ona dotyczy, przysługuje wniosek o ponowne rozpatrzenie sprawy przez Zarząd, złożony w formie dokumentowej w terminie 14 dni od otrzymania informacji, o której mowa w ust. 10. Zarząd rozpatruje wniosek w terminie 14 dni od jego otrzymania. <span class="diff-ins">Od negatywnego rozpatrzenia odwołania służy odwołanie do Walnego Zebrania, które rozpatruje je na najbliższym spotkaniu, bez konieczności zwoływania go w trybie nadzwyczajnym.</span>
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 12.</span>
                            Na wniosek osoby, wobec której zastosowano zakaz, Zarząd może go skrócić, jeżeli osoba ta zwróciła sprzęt i naprawiła szkodę.
                        </div>

                        <div class="new-para">
                            <span class="para-num">Ust. 13.</span>
                            Osoba zrzeszona, która nie zwróciła wcześniej pobranego sprzętu lub nie rozliczyła szkody w sprzęcie, nie może pobierać sprzętu Organizacji do czasu zwrotu lub rozliczenia.
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mt-4 flex-wrap">
                    <a href="/storage/docs/regulamin_projekt_zmian_v10.pdf" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-file-pdf me-1"></i> Pobierz projekt zmian (PDF, v10)
                    </a>
                    <a href="/regulamin.php" class="text-muted small">Pełny tekst obowiązującego regulaminu &rarr;</a>
                </div>

            </div>
        </div>
        <?php require_once('layout/footer.php'); ?>
    </div>
</body>
</html>
