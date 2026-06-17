<?php
$page_title = "Polityka prywatności - SKR Argo AGH";
$page_description = "Informacje o przetwarzaniu danych osobowych na stronie SKR Argo AGH";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <?php require_once('layout/header.php'); ?>
</head>

<body>

    <div class="page-container">
        <div class="content-wrap">
            <?php require_once('layout/navbar.php'); ?>

            <!-- Page content starts here -->
            <div class="container p-4">
                <h1 class="mt-5"><strong>Polityka prywatności</strong></h1>
                <p class="text-muted">Ostatnia aktualizacja: 17.06.2026</p>

                <h3 class="mt-4">1. Administrator danych osobowych</h3>
                <p>
                    Administratorem danych osobowych zbieranych za pośrednictwem strony
                    <a href="https://argo.agh.edu.pl">argo.agh.edu.pl</a> jest
                    <strong>Studenckie Koło Regatowe Argo AGH</strong>, działające przy
                    Akademii Górniczo-Hutniczej im. Stanisława Staszica w Krakowie,
                    al. Mickiewicza 30, 30-059 Kraków.
                </p>
                <p>
                    Kontakt w sprawach związanych z przetwarzaniem danych:
                    <a href="mailto:argo@agh.edu.pl">argo@agh.edu.pl</a>.
                </p>

                <h3 class="mt-4">2. Jakie dane są zbierane</h3>
                <p><strong>Osoby odwiedzające stronę:</strong></p>
                <ul>
                    <li>Strona nie zbiera danych osobowych od zwykłych odwiedzających.</li>
                    <li>Wykorzystywany jest jedynie techniczny plik cookie sesji
                        (<code>PHPSESSID</code>) niezbędny do działania mechanizmu logowania.</li>
                    <li>Strona nie korzysta z narzędzi analitycznych
                        (Google Analytics itp.) ani reklamowych.</li>
                </ul>

                <p class="mt-3"><strong>Członkowie klubu korzystający z panelu CMS:</strong></p>
                <ul>
                    <li>Imię i nazwisko</li>
                    <li>Adres e-mail w domenie <code>@agh.edu.pl</code></li>
                    <li>Hasło — przechowywane wyłącznie w postaci hashu bcrypt
                        (nie da się go odzyskać w postaci jawnej)</li>
                    <li>Treści publikowane w panelu (posty na blogu, zdjęcia) wraz z informacją o autorze</li>
                </ul>

                <h3 class="mt-4">3. Cele i podstawa prawna przetwarzania</h3>
                <p>Dane członków przetwarzane są w celu:</p>
                <ul>
                    <li>udostępnienia panelu administracyjnego do publikowania treści na stronie klubu,</li>
                    <li>prowadzenia kont użytkowników, ich autoryzacji oraz przypisywania autorstwa publikowanych treści.</li>
                </ul>
                <p>
                    Podstawą prawną przetwarzania jest <strong>art. 6 ust. 1 lit. f RODO</strong> —
                    uzasadniony interes administratora polegający na prowadzeniu strony internetowej
                    studenckiego koła naukowego i umożliwieniu jego członkom publikowania treści.
                </p>

                <h3 class="mt-4">4. Sposób tworzenia kont i nadawania haseł</h3>
                <p>
                    Konta w panelu CMS są zakładane wyłącznie przez administratora — członkowie
                    nie rejestrują się samodzielnie. Hasła są generowane losowo przez administratora
                    (hasła o wysokiej entropii) i przekazywane członkom drogą e-mailową.
                    Członkowie nie mają możliwości samodzielnej zmiany hasła w panelu.
                </p>
                <p>
                    Decyzja ta jest celowa i ma na celu:
                </p>
                <ul>
                    <li>zapobieganie używaniu słabych haseł, podatnych na ataki słownikowe,</li>
                    <li>wyeliminowanie ryzyka, że członek użyje tego samego hasła co w innych
                        serwisach — w razie ewentualnego wycieku bazy danych ogranicza to szkody
                        wyłącznie do strony klubu.</li>
                </ul>

                <h3 class="mt-4">5. Okres przechowywania danych</h3>
                <p>
                    Dane członków są przechowywane do momentu zgłoszenia żądania ich usunięcia.
                    Konto może zostać usunięte w dowolnym momencie na prośbę użytkownika
                    (patrz §8) lub z inicjatywy administratora.
                </p>

                <h3 class="mt-4">6. Odbiorcy danych</h3>
                <p>
                    Dane są przechowywane wyłącznie na infrastrukturze Akademii Górniczo-Hutniczej
                    (serwer <code>web.agh.edu.pl</code>, baza danych <code>mysql.agh.edu.pl</code>).
                </p>
                <p>
                    Dane nie są przekazywane podmiotom zewnętrznym ani transferowane poza
                    Europejski Obszar Gospodarczy. Tabela użytkowników jest wyłączona z
                    automatycznych kopii zapasowych — dane uwierzytelniające nie opuszczają
                    infrastruktury AGH.
                </p>

                <h3 class="mt-4">7. Bezpieczeństwo danych</h3>
                <p>Strona stosuje m.in. następujące środki ochrony:</p>
                <ul>
                    <li>Hasła przechowywane są w postaci hashu bcrypt (algorytm odporny na ataki brute-force).</li>
                    <li>Cała komunikacja odbywa się przez HTTPS.</li>
                    <li>Pliki cookies sesji oznaczone są flagami <code>Secure</code>, <code>HttpOnly</code> i <code>SameSite=Lax</code>.</li>
                    <li>Formularze w panelu są chronione tokenami CSRF.</li>
                    <li>Wszystkie zapytania do bazy danych korzystają z prepared statements (PDO).</li>
                    <li>Treści w edytorze są filtrowane przed zapisem, aby zapobiec wstrzykiwaniu skryptów.</li>
                </ul>

                <h3 class="mt-4">8. Twoje prawa</h3>
                <p>
                    Zgodnie z RODO masz prawo dostępu do swoich danych, ich sprostowania,
                    usunięcia, ograniczenia przetwarzania, wniesienia sprzeciwu oraz prawo
                    wniesienia skargi do Prezesa Urzędu Ochrony Danych Osobowych
                    (<a href="https://uodo.gov.pl" target="_blank" rel="noopener">uodo.gov.pl</a>).
                </p>
                <p>
                    W celu realizacji swoich praw skontaktuj się z administratorem pod adresem
                    <a href="mailto:argo@agh.edu.pl">argo@agh.edu.pl</a>.
                </p>

                <h3 class="mt-4">9. Pliki cookies</h3>
                <p>
                    Strona korzysta wyłącznie z technicznego pliku cookie sesji (<code>PHPSESSID</code>),
                    niezbędnego do działania mechanizmu logowania w panelu CMS. Jest to plik niezbędny
                    w rozumieniu art. 173 ust. 3 ustawy Prawo telekomunikacyjne — jego stosowanie
                    nie wymaga osobnej zgody użytkownika.
                </p>
                <p>
                    Strona nie używa plików cookies analitycznych ani reklamowych.
                </p>

                <h3 class="mt-4">10. Zmiany w polityce prywatności</h3>
                <p>
                    Polityka może być aktualizowana — aktualna data ostatniej zmiany jest podana
                    na początku tego dokumentu. O istotnych zmianach członkowie zostaną
                    poinformowani drogą e-mailową.
                </p>
            </div>
            <!-- Page content ends here -->

        </div>
        <?php require_once('layout/footer.php'); ?>
    </div>

</body>

</html>
