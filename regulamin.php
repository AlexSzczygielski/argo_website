<?php
$page_title = "Regulamin - SKR Argo AGH";
$page_description = "Regulamin Studenckiego Klubu Regatowego Argo AGH";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
$regulamin_pdf = "/storage/docs/regulamin_argo_17_10_2026.pdf";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <?php require_once('layout/header.php'); ?>
    <style>
        ol.pkt > li::marker {
            content: counter(list-item) ") ";
        }
    </style>
</head>

<body>

    <div class="page-container">
        <div class="content-wrap">
            <?php require_once('layout/navbar.php'); ?>

            <!-- Page content starts here -->
            <div class="container p-4">
                <h1 class="mt-5"><strong>Regulamin</strong></h1>
                <p class="text-muted">Studenckiego Klubu Regatowego Argo AGH</p>
                <p class="text-muted">Obowiązuje od 17.10.2026 r.</p>

                <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
                    <a href="<?php echo $regulamin_pdf; ?>" download="Regulamin_SKR_Argo_AGH.pdf" class="btn btn-primary btn-sm">
                        <i class="fas fa-download me-1"></i> Pobierz regulamin (PDF)
                    </a>
                    <a href="<?php echo $regulamin_pdf; ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-file-pdf me-1"></i> Otwórz PDF
                    </a>
                </div>

                <h3 class="mt-4">§ 1. Postanowienia ogólne</h3>
                <ol>
                    <li>Organizacja pod nazwą Studencki Klub Regatowy Argo AGH zwana dalej „Organizacją”, jest uczelnianą organizacją studencką, w rozumieniu art. 111 ustawy z dnia 20 lipca 2018 r. – Prawo o szkolnictwie wyższym i nauce.</li>
                    <li>Organizacja zrzesza wyłącznie studentów Akademii Górniczo-Hutniczej im. Stanisława Staszica w Krakowie, zwanej dalej „Uczelnią” lub AGH.</li>
                    <li>Siedzibą Organizacji jest Akademia Górniczo-Hutnicza w Krakowie.</li>
                    <li>Organizacja może używać skróconej nazwy w brzmieniu SKR Argo AGH.</li>
                    <li>Organizacja może posługiwać się logo AGH.</li>
                    <li>Organizacja zapewnia wszystkim osobom zrzeszonym, w tym osobom z niepełnosprawnościami i innym osobom ze szczególnymi potrzebami warunki do pełnego udziału w życiu Uczelni i społeczności akademickiej, w ramach swojej działalności, w tym w realizacji celów, o których mowa w § 2 ust. 2 – na zasadzie równości z innymi osobami, z uwzględnieniem sportowego charakteru Organizacji.</li>
                    <li>W ramach działań, o których mowa w ust. 6 powyżej, Organizacja zapewnia, w szczególności: przeprowadzanie wyborów do organów Organizacji w sposób dostępny, dostępność pomieszczeń oraz budynków, w których odbywają się działania Organizacji oraz dostępne formy komunikacji pomiędzy Organizacją a osobami zrzeszonymi.</li>
                    <li>W ramach działań, o których mowa w ust. 6 powyżej, Organizacja współpracuje z działającą w Uczelni jednostką odpowiedzialną za wsparcie oraz koordynację działań na rzecz osób ze szczególnymi potrzebami, w tym osób z niepełnosprawnościami – Działem Dostępności.</li>
                </ol>

                <h3 class="mt-4">§ 2. Cele i zadania Organizacji</h3>
                <ol>
                    <li>Podstawowym celem Organizacji jest popularyzacja żeglarstwa regatowego wśród wspólnoty akademickiej.</li>
                    <li>Celami Organizacji są w szczególności:
                        <ol class="pkt">
                            <li>Popularyzacja sportu, a w szczególności żeglarstwa regatowego wśród społeczności akademickiej;</li>
                            <li>Popularyzacja i doskonalenie umiejętności żeglarskich w zakresie rywalizacji sportowej.</li>
                        </ol>
                    </li>
                    <li>Cele, o których mowa w ust. 2 będą realizowane poprzez:
                        <ol class="pkt">
                            <li>organizację wyjazdów i treningów regatowych żeglarskich na polskich wodach śródlądowych oraz przybrzeżnych;</li>
                            <li>organizację wyjazdów i treningów regatowych żeglarskich na akwenach zagranicznych;</li>
                            <li>organizację zawodów – regat żeglarskich na arenie uczelnianej - wydziałowej, międzywydziałowej, a także ogólnopolskiej.</li>
                        </ol>
                    </li>
                    <li>Do realizacji celów, o których mowa w niniejszym paragrafie, Organizacja korzysta ze środków materialnych przekazanych przez Uczelnię oraz inne podmioty – za pośrednictwem Uczelni, a także z wpłat za wyjazdy dokonanych przez członków Organizacji.</li>
                </ol>

                <h3 class="mt-4">§ 3. Członkostwo</h3>
                <ol>
                    <li>Osobą zrzeszoną w Organizacji może zostać osoba studiująca w AGH, wykazująca zainteresowania w zakresie żeglarstwa, identyfikująca się z celami Organizacji i wyrażająca chęć ich realizacji.</li>
                    <li>Osobę studiującą deklarującą chęć członkostwa, w poczet osób zrzeszonych w Organizacji przyjmuje Zarząd na podstawie deklaracji złożonej przez osobę studiującą w formie dokumentowej. Warunkiem pozytywnego rozpatrzenia wniosku jest spełnianie warunków, o których mowa w ust. 1.</li>
                    <li>Wskazując w deklaracji członkowskiej swój adres e-mail osoba studiująca wyraża zgodę na otrzymywanie drogą elektroniczną wszelkich informacji przesyłanych przez Zarząd, dotyczących zarówno spraw indywidualnych, jak i innych informacji o charakterze organizacyjnym.</li>
                    <li>Osoba zrzeszona w Organizacji ma prawo:
                        <ol class="pkt">
                            <li>udziału we wszelkich formach działalności Organizacji;</li>
                            <li>zgłaszania wniosków i propozycji w czasie zebrań Organizacji;</li>
                            <li>dokonywania oceny działalności Zarządu Organizacji;</li>
                            <li>korzystania z czynnego i biernego prawa wyborczego.</li>
                        </ol>
                    </li>
                    <li>Osoba zrzeszona w Organizacji ma obowiązek:
                        <ol class="pkt">
                            <li>wykazywać się osiągnięciami sportowymi;</li>
                            <li>regularnie brać udział w zebraniach Organizacji;</li>
                            <li>aktywnie uczestniczyć w pracach Organizacji;</li>
                            <li>stosować się do postanowień organów Organizacji;</li>
                            <li>przestrzegać postanowień niniejszego Regulaminu;</li>
                            <li>dbać o sprzęt pozostający w dyspozycji Organizacji oraz przestrzegać zasad korzystania z niego, określonych w § 6.</li>
                        </ol>
                    </li>
                    <li>Członkostwo w Organizacji ustaje na skutek:
                        <ol class="pkt">
                            <li>dobrowolnej rezygnacji osoby zrzeszonej w Organizacji, przedłożonej Zarządowi Organizacji w formie dokumentowej;</li>
                            <li>utraty przez osobę zrzeszoną w Organizacji statusu studenta AGH;</li>
                            <li>wykluczenia osoby zrzeszonej w Organizacji w drodze uchwały Zarządu Organizacji, w przypadku zaistnienia okoliczności, o których mowa w ust. 7;</li>
                            <li>rozwiązania Organizacji.</li>
                        </ol>
                    </li>
                    <li>Zarząd Organizacji może wykluczyć osobę zrzeszoną w Organizacji z następujących powodów:
                        <ol class="pkt">
                            <li>świadomego działania na szkodę Organizacji;</li>
                            <li>nieprzestrzegania postanowień niniejszego Regulaminu, z zastrzeżeniem pkt 5;</li>
                            <li>rażącego niewywiązywania się z podjętych wobec Organizacji zobowiązań;</li>
                            <li>nieusprawiedliwionej nieobecności na 3 zebraniach Organizacji w ciągu roku akademickiego;</li>
                            <li>naruszenia zasad korzystania ze sprzętu Organizacji w przypadkach wskazanych w § 6 ust. 8 pkt 3.</li>
                        </ol>
                    </li>
                    <li>O podjęciu uchwały w sprawie wykluczenia Zarząd Organizacji informuje osobę wykluczoną w formie dokumentowej wraz z uzasadnieniem i pouczeniem o przysługującej jej drodze odwoławczej.</li>
                    <li>Od uchwały Zarządu w sprawie wykluczenia, wykluczonej osobie przysługuje prawo złożenia odwołania do Walnego Zebrania osób zrzeszonych w Organizacji. Odwołanie składa się za pośrednictwem Zarządu w terminie 14 dni od daty otrzymania przez wykluczoną osobę informacji o wykluczeniu przekazanej w formie dokumentowej.</li>
                    <li>Po otrzymaniu odwołania i jego rozpatrzeniu Zarząd, jeśli uzna, że odwołanie zasługuje w całości na uwzględnienie, może uchylić swoją uchwałę w sprawie wykluczenia i przywrócić osobę studiującą w prawach osoby zrzeszonej w Organizacji, o czym poinformuje osobę zainteresowaną w formie dokumentowej.</li>
                    <li>W razie wniesienia przez osobę wykluczoną odwołania i nieuwzględnieniu przez Zarząd tego odwołania w trybie określonym w ust. 10, Zarząd jest obowiązany zwołać Nadzwyczajne Walne Zebranie osób zrzeszonych w Organizacji najpóźniej w terminie 60 dni od daty otrzymania odwołania. Obowiązku tego Zarząd nie musi spełnić, jeżeli w terminie 60 dni od daty otrzymania odwołania ma się odbyć Zwyczajne Walne Zebranie osób zrzeszonych w Organizacji.</li>
                    <li>Walne Zebranie osób zrzeszonych w Organizacji po rozpatrzeniu odwołania może podtrzymać bądź uchylić uchwałę Zarządu w sprawie wykluczenia osoby zrzeszonej w Organizacji. Uchwała Walnego Zebrania osób zrzeszonych w Organizacji w sprawie uchylenia decyzji Zarządu jest podejmowana większością 3/5 głosów przy obecności co najmniej połowy osób zrzeszonych w Organizacji.</li>
                </ol>

                <h3 class="mt-4">§ 4. Walne Zebranie osób zrzeszonych w Organizacji</h3>
                <ol>
                    <li>Walne Zebranie osób zrzeszonych w Organizacji jest najwyższą władzą Organizacji.</li>
                    <li>Do kompetencji Walnego Zebrania osób zrzeszonych w Organizacji należy w szczególności:
                        <ol class="pkt">
                            <li>określanie kierunków działalności Organizacji;</li>
                            <li>decydowanie o strukturze organizacyjnej Organizacji;</li>
                            <li>wybór osób wchodzących w skład Zarządu Organizacji;</li>
                            <li>rozpatrywanie odwołania od uchwały Zarządu w sprawie wykluczenia osoby zrzeszonej w Organizacji oraz podejmowanie uchwały podtrzymującej lub uchylającej uchwałę Zarządu w sprawie wykluczenia osoby zrzeszonej w Organizacji;</li>
                            <li>rozpatrywanie wniosków i propozycji zgłaszanych przez Zarząd i poszczególnych osób zrzeszonych w Organizacji;</li>
                            <li>zatwierdzanie przedkładanego przez Zarząd pisemnego sprawozdania z działalności Organizacji w poprzednim roku akademickim, w tym z wykorzystania otrzymanych środków;</li>
                            <li>zatwierdzanie preliminarza rocznego działalności Organizacji;</li>
                            <li>uchwalanie zmian Regulaminu Organizacji;</li>
                            <li>podejmowanie uchwały w sprawie rozwiązania Organizacji;</li>
                            <li>podejmowanie uchwał w sprawie środków materialnych pozostających w dyspozycji Organizacji w razie jej rozwiązania.</li>
                        </ol>
                    </li>
                    <li>W Walnym Zebraniu osób zrzeszonych w Organizacji mają prawo uczestniczyć wszystkie osoby zrzeszone w Organizacji.</li>
                    <li>Zwyczajne Walne Zebranie osób zrzeszonych w Organizacji odbywa się co najmniej raz w roku akademickim, przy czym w semestrze zimowym musi się ono odbyć nie później niż do 15 listopada.</li>
                    <li>W razie potrzeby, w szczególności w przypadkach, o których mowa w § 3 ust. 11, jest zwoływane Nadzwyczajne Walne Zebranie osób zrzeszonych w Organizacji.</li>
                    <li>Walne zebranie osób zrzeszonych w Organizacji zwołuje Zarząd z własnej inicjatywy lub na wniosek 30% członków Organizacji.</li>
                    <li>O terminie, miejscu i proponowanym porządku obrad Walnego Zebrania osób zrzeszonych w Organizacji Zarząd informuje wszystkie osoby zrzeszone w Organizacji z co najmniej 7-dniowym wyprzedzeniem. Decyzją Zarządu, Walne Zebranie można przeprowadzić w trybie synchronicznym przy wykorzystaniu środków porozumiewania na odległość. Uchwały podjęte przez Walne Zebranie w ten sposób są ważne, jeśli możliwe jest zapewnienie tajności głosu (w wymaganych Regulaminem przypadkach), a także zapewnienie udziału w głosowaniach jedynie Członkom Organizacji (np. poprzez wymaganie zalogowania się przy użyciu konta studenckiego AGH).</li>
                    <li>Walne Zebranie osób zrzeszonych w Organizacji jest zdolne do podejmowania ważnych uchwał, jeżeli uczestniczy w nim co najmniej połowa aktualnej liczby osób zrzeszonych w Organizacji.</li>
                    <li>Jeżeli kworum, o którym mowa w ust. 8, nie zostanie osiągnięte w pierwszym terminie, Zarząd zwołuje Walne Zebranie osób zrzeszonych w Organizacji w drugim terminie, z zachowaniem trybu określonego w ust. 7. Uchwały podjęte podczas Walnego Zebrania osób zrzeszonych w Organizacji zwołanego w drugim terminie są ważne bez względu na liczbę osób uczestniczących w Walnym Zebraniu osób zrzeszonych w Organizacji, chyba że niniejszy Regulamin dla ważności poszczególnych uchwał wymaga obecności co najmniej połowy liczby osób zrzeszonych w Organizacji.</li>
                    <li>Uchwały na Walnym Zebraniu osób zrzeszonych w Organizacji są podejmowane zwykłą większością głosów, z wyjątkiem uchwał określonych w niniejszym Regulaminie, a wymagających innej większości.</li>
                </ol>

                <h3 class="mt-4">§ 5. Zarząd</h3>
                <ol>
                    <li>Zarząd jest wybierany przez Walne Zebranie osób zrzeszonych w Organizacji spośród osób zrzeszonych w Organizacji. Uchwały w sprawie wyboru Zarządu są podejmowane w głosowaniu tajnym bezwzględną większością głosów.</li>
                    <li>Zarząd Organizacji składa się z 3 osób, które spośród swego grona wybierają osobę przewodniczącą, kierującą pracami Zarządu i reprezentującą go na zewnątrz.</li>
                    <li>Dokumenty w imieniu Organizacji podpisuje Osoba przewodnicząca lub z jej upoważnienia inna osoba wchodząca w skład Zarządu.</li>
                    <li>Kadencja Zarządu trwa jeden rok akademicki.</li>
                    <li>Uchwały Zarządu są podejmowane zwykłą większością głosów.</li>
                    <li>Zarząd jest organem wykonawczym Organizacji.</li>
                    <li>Do kompetencji Zarządu należy w szczególności:
                        <ol class="pkt">
                            <li>reprezentowanie Organizacji wobec Władz Uczelni oraz na zewnątrz;</li>
                            <li>kierowanie działalnością Organizacji;</li>
                            <li>sporządzanie preliminarza rocznego działalności Organizacji;</li>
                            <li>sporządzanie pisemnego sprawozdania z działalności Organizacji w poprzednim roku akademickim, w tym z wykorzystania otrzymanych środków;</li>
                            <li>rozpatrywanie deklaracji członkowskich oraz podejmowanie uchwał w sprawie nabycia i utraty członkostwa w Organizacji;</li>
                            <li>zwoływanie Walnego Zebrania osób zrzeszonych w Organizacji w trybie określonym w niniejszym Regulaminie;</li>
                            <li>podejmowanie decyzji we wszystkich sprawach związanych z działalnością Organizacji, niezastrzeżonych dla Walnego Zebrania osób zrzeszonych w Organizacji.</li>
                        </ol>
                    </li>
                    <li>Ustępujący Zarząd jest obowiązany przedłożyć Walnemu Zebraniu osób zrzeszonych w Organizacji do zatwierdzenia sprawozdanie z działalności Organizacji w poprzednim roku akademickim, w tym z wykorzystania otrzymanych środków.</li>
                    <li>Na wniosek co najmniej 30% osób zrzeszonych w Organizacji Zarząd lub poszczególne osoby wchodzące w skład Zarządu mogą zostać przez Walne Zebranie osób zrzeszonych w Organizacji odwołane w czasie trwania kadencji większością 2/3 głosów przy obecności co najmniej połowy liczby osób zrzeszonych w Organizacji.</li>
                    <li>Wybór nowego Zarządu lub uzupełnienie jego składu odbywa się w trybie określonym w ust. 1.</li>
                    <li>Nowy zarząd ma obowiązek pisemnego zawiadomienia Prorektora AGH właściwego do spraw studenckich o dokonanej zmianie składu osobowego Zarządu w terminie 14 dni od dnia dokonania zmiany. Do zawiadomienia dołącza się kopię uchwały Walnego Zebrania osób zrzeszonych w Organizacji, na podstawie której dokonano zmiany.</li>
                </ol>

                <h3 class="mt-4">§ 6. Korzystanie ze sprzętu Organizacji</h3>
                <ol>
                    <li>Przez sprzęt Organizacji rozumie się sprzęt żeglarski o wartości powyżej 1000 złotych, w szczególności komplety żagli, pozostający w dyspozycji Organizacji.</li>
                    <li>Osoba zrzeszona może pobrać sprzęt Organizacji wyłącznie po uzyskaniu zgody Zarządu oraz po uprzednim wypełnieniu karty wypożyczenia i przekazaniu jej Zarządowi przed pobraniem sprzętu, w formie dokumentowej, w sposób umożliwiający identyfikację tej osoby. Wzór karty oraz sposób jej przekazywania (w tym formularz elektroniczny) określa Zarząd. Zarząd może odmówić zgody w szczególności, gdy sprzęt jest zarezerwowany w tym terminie, osoba zrzeszona nie ma doświadczenia lub umiejętności żeglarskich niezbędnych do prawidłowego użytkowania sprzętu albo nie może pobrać sprzętu na podstawie ust. 13.</li>
                    <li>Zabrania się pobierania, przewożenia i użytkowania sprzętu Organizacji bez zgody Zarządu oraz bez wypełnienia i przekazania Zarządowi karty wypożyczenia, o której mowa w ust. 2.</li>
                    <li>Kartę wypożyczenia wypełnia jedna osoba zrzeszona, wskazana jako odpowiedzialna za sprzęt w trakcie wyjazdu lub zawodów. Osoba ta odpowiada za sprzęt od chwili jego pobrania do chwili zwrotu i przesłania Zarządowi zdjęć, o których mowa w ust. 5.</li>
                    <li>Zwrot sprzętu następuje w terminie wskazanym w karcie wypożyczenia, nie później niż 7 dni od zakończenia zawodów lub wyjazdu. Po zwrocie sprzętu osoba odpowiedzialna za sprzęt przesyła Zarządowi zdjęcia sprzętu (całość oraz widoczne uszkodzenia, jeśli występują) i niezwłocznie zgłasza ewentualną utratę lub uszkodzenie.</li>
                    <li>Zarząd przechowuje karty wypożyczenia i prowadzi na ich podstawie ewidencję wydań i zwrotów sprzętu Organizacji.</li>
                    <li>Osoba, która użytkuje sprzęt Organizacji z naruszeniem ust. 2 lub 3, ponosi odpowiedzialność za jego utratę lub uszkodzenie jak osoba wypożyczająca, a ponadto jest zobowiązana niezwłocznie zwrócić sprzęt na wezwanie Zarządu.</li>
                    <li>W przypadku naruszenia ust. 2 lub 3 Zarząd, w drodze uchwały, może:
                        <ol class="pkt">
                            <li>udzielić osobie zrzeszonej upomnienia;</li>
                            <li>zakazać osobie zrzeszonej oraz osobom, które użytkowały sprzęt wspólnie z nią, korzystania ze sprzętu Organizacji na okres od 1 do 12 miesięcy;</li>
                            <li>wykluczyć osobę zrzeszoną z Organizacji, jeżeli naruszenie jest powtórne albo wiąże się z utratą sprzętu lub jego uszkodzeniem z winy osoby zrzeszonej, na zasadach określonych w § 3 ust. 7–12.</li>
                        </ol>
                    </li>
                    <li>Wybierając rodzaj i wymiar środka, o którym mowa w ust. 8, Zarząd bierze pod uwagę w szczególności:
                        <ol class="pkt">
                            <li>wartość sprzętu oraz okoliczność jego utraty lub uszkodzenia;</li>
                            <li>czas i okoliczności nieuprawnionego użytkowania sprzętu;</li>
                            <li>to, czy osoba zrzeszona niezwłocznie ujawniła naruszenie, zwróciła sprzęt lub naprawiła szkodę;</li>
                            <li>to, czy w przeszłości naruszała zasady korzystania ze sprzętu Organizacji.</li>
                        </ol>
                    </li>
                    <li>O rodzaju i wymiarze środka Zarząd informuje osobę zrzeszoną w formie dokumentowej wraz z uzasadnieniem.</li>
                    <li>Od uchwały w sprawie zakazu, o którym mowa w ust. 8 pkt 2, osobie, której ona dotyczy, przysługuje wniosek o ponowne rozpatrzenie sprawy przez Zarząd, złożony w formie dokumentowej w terminie 14 dni od otrzymania informacji, o której mowa w ust. 10. Zarząd rozpatruje wniosek w terminie 14 dni od jego otrzymania. Od negatywnego rozpatrzenia odwołania służy odwołanie do Walnego Zebrania, które rozpatruje je na najbliższym spotkaniu, bez konieczności zwoływania go w trybie nadzwyczajnym.</li>
                    <li>Na wniosek osoby, wobec której zastosowano zakaz, Zarząd może go skrócić, jeżeli osoba ta zwróciła sprzęt i naprawiła szkodę.</li>
                    <li>Osoba zrzeszona, która nie zwróciła wcześniej pobranego sprzętu lub nie rozliczyła szkody w sprzęcie, nie może pobierać sprzętu Organizacji do czasu zwrotu lub rozliczenia.</li>
                </ol>

                <h3 class="mt-4">§ 7. Postanowienia końcowe</h3>
                <ol>
                    <li>Zmiana Regulaminu wymaga uchwały Walnego Zebrania osób zrzeszonych w Organizacji podjętej większością 3/5 głosów przy obecności co najmniej połowy liczby osób zrzeszonych w Organizacji.</li>
                    <li>Zarząd Organizacji ma obowiązek zawiadamiania, w formie dokumentowej, Prorektora AGH właściwego do spraw studenckich o każdej zmianie treści niniejszego Regulaminu oraz każdej uchwale Walnego Zebrania osób zrzeszonych w Organizacji, w terminie 14 dni od dnia dokonania zmiany.</li>
                    <li>Walne Zebranie osób zrzeszonych w Organizacji większością 2/3 głosów przy obecności co najmniej połowy liczby osób zrzeszonych w Organizacji może podjąć uchwałę w sprawie zawieszenia działalności lub rozwiązania Organizacji.</li>
                    <li>Niniejszy Regulamin wchodzi w życie z dniem 17.10.2026 r.</li>
                </ol>

            </div>
            <!-- Page content ends here -->

        </div>
        <?php require_once('layout/footer.php'); ?>
    </div>

</body>

</html>
