<?php
$page_title = "SKR Argo AGH";
$page_description = "Checklista Regaty Omega";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <title>SKR Argo AGH - Checklist Omega</title>
    <?php require_once('layout/header.php'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Checklist Omega - SKR ARGO AGH">

    <style>
        a {
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        .checklist-section h2 {
            color: #1e3f66;
            margin-top: 2rem;
        }

        .form-check-label {
            font-size: 1rem;
        }

        .checklist-card {
            background: #fff;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>

<div class="page-container">
    <div class="content-wrap">

        <?php require_once('layout/navbar.php'); ?>

        <div class="container py-4 px-3 px-md-4">

            <h1 class="mt-4 mb-3">Checklist Omega</h1>

            <p class="lead mb-4">
                Lista rzeczy na regaty - Omega.
            </p>

            <div class="row">

                <!-- IMAGE -->
                <div class="col-md-4 text-center mb-4">
                    <img src="storage/images/argologo.svg"
                         alt="Omega sailing boat"
                         class="img-fluid rounded"
                         style="max-height: 300px; object-fit: contain;">
                </div>

                <!-- CHECKLIST -->
                <div class="col-md-8 checklist-section">

                    <!-- SAILS -->
                    <div class="checklist-card">
                        <h2>Żagle</h2>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="main">
                            <label class="form-check-label" for="main">Grot + zapas</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="jib">
                            <label class="form-check-label" for="jib">Fok + zapas</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="spinnaker">
                            <label class="form-check-label" for="spinnaker">Spinbom</label>
                        </div>
                    </div>

                    <!-- BOAT / RIGGING -->
                    <div class="checklist-card">
                        <h2>Płetwy</h2>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="centerboard">
                            <label class="form-check-label" for="centerboard">Miecz</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rudder">
                            <label class="form-check-label" for="rudder">Ster</label>
                        </div>
                    </div>

                    <!-- RIGGING -->
                    <div class="checklist-card">
                        <h2>Regulacje</h2>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ropes">
                            <label class="form-check-label" for="ropes">Talia grota</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ropes">
                            <label class="form-check-label" for="ropes">Szoty Foka</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ropes">
                            <label class="form-check-label" for="ropes">Obciągacz</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ropes">
                            <label class="form-check-label" for="ropes">Cunningham</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ropes">
                            <label class="form-check-label" for="ropes">Achtersztag</label>
                        </div>
                    </div>

                    <div class="checklist-card">
                        <h2>Maszt</h2>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="centerboard">
                            <label class="form-check-label" for="centerboard">Maszt (zabezpieczony)</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="centerboard">
                            <label class="form-check-label" for="centerboard">Bom (zabezpieczony)</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rudder">
                            <label class="form-check-label" for="rudder">Sztag</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rudder">
                            <label class="form-check-label" for="rudder">Achtersztag</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rudder">
                            <label class="form-check-label" for="rudder">Wanty krótkie x2</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rudder">
                            <label class="form-check-label" for="rudder">Wanty długie x2</label>
                        </div>
                    </div>

                    <!-- TOOLS -->
                    <div class="checklist-card">
                        <h2>Inne</h2>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="spare">
                            <label class="form-check-label" for="spare">Strech (do masztu)</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="spare">
                            <label class="form-check-label" for="spare">Korki</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="spare">
                            <label class="form-check-label" for="spare">Wiosełko</label>
                        </div>
                        <div class=" text-muted" style="font-style: italic; font-size: 0.9rem;">
                            (Wymagane w przepisach xd)
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tape">
                            <label class="form-check-label" for="tape">Silver tape</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tools">
                            <label class="form-check-label" for="tools">Skrzynka narzędziowa</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tools">
                            <label class="form-check-label" for="tools">Torba ze szpejem - czarna/zielona</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tools">
                            <label class="form-check-label" for="tools">Torba IKEA (pasy + wanty)</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tools">
                            <label class="form-check-label" for="tools">Ciśnienie w oponach - ok. 2,5 bara</label>
                        </div>
                    </div>

                    <!-- DOCUMENTS -->
                    <div class="checklist-card">
                        <h2>Dokumenty</h2>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="insurance">
                            <label class="form-check-label" for="insurance">Ubezpieczenie łódki</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="insurance">
                            <label class="form-check-label" for="insurance">Certyfikat klasowy (dowód rejestracyjny łódki)</label>
                        </div>
                    </div>

                    <div class="mt-4 text-muted" style="font-style: italic; font-size: 0.9rem;">
                        Lista ma charakter orientacyjny.
                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php require_once('layout/footer.php'); ?>
</div>

</body>
</html>