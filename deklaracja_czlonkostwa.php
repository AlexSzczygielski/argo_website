<!DOCTYPE html>

<html lang="pl">

<head>
    <title>SKR Argo AGH - Deklaracja członkostwa</title>
    <?php require_once('layout/header.php'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="SKR ARGO AGH">

```
<style>
    /* Fix long links overflowing */
    a {
        word-break: break-word;
        overflow-wrap: anywhere;
    }
</style>
```

</head>

<body>

```
<div class="page-container">
    <div class="content-wrap">
        <?php require_once('layout/navbar.php'); ?>

        <!-- Page content starts here -->
        <div class="container py-4 px-3 px-md-4">
            <h1 class="mt-4 mb-4">Deklaracja członkostwa</h1>

            <div class="row align-items-start">

                <!-- Image (top on mobile, right on desktop) -->
                <div class="col-md-4 order-1 order-md-2 text-center">
                    <img src="storage/images/sail.png"
                         alt="Żagle"
                         class="img-fluid rounded mb-4"
                         style="max-height: 250px; object-fit: contain;">
                </div>

                <!-- Text content -->
                <div class="col-md-8 order-2 order-md-1">

                    <section class="mb-4">
                        <p class="lead">
                            Warunkiem członkostwa w Studenckim Kole Regatowym Argo AGH
                            jest wypełnienie deklaracji członkowskiej. Wypełnienie deklaracji
                            jest możliwe wyłącznie dla osób, które pozytywnie przeszły
                            procedurę akceptacji do klubu.
                        </p>
                    </section>

                    <section class="mb-4">
                        <h2>Deklaracje</h2>
                        <h4>2025/2026</h4>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="https://forms.cloud.microsoft/Pages/ResponsePage.aspx?id=PwOxgOAhgkq7wPBf3M07yM-Xa0THU7pMhLrElNwbQopUMEYyTkJWOUhZUE02ME9RMk1XUUZWSzNXSi4u"
                                   class="text-break">
                                    Deklaracja członkostwa 2025/2026
                                </a>
                            </li>
                        </ul>
                    </section>

                    <div class="mt-4 text-muted" style="font-style: italic; font-size: 0.9rem;">
                        UWAGA: Deklaracje należy wypełniać z maila w domenie student.agh.edu.pl!
                    </div>

                </div>
            </div>
        </div>
        <!-- Page content ends here -->

    </div>

    <?php require_once('layout/footer.php'); ?>
</div>
```

</body>

</html>
