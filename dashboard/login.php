<?php
//Session
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: /dashboard/panel.php');
    exit;
}
require_once(__DIR__ . '/csrf.php');
$page_title = "SKR Argo AGH - Logowanie";
$page_description = "Logowanie do panelu";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";

//Authorization logic
if($_SERVER['REQUEST_METHOD']== 'POST'){
    csrf_verify();
    try{
        $email = $_POST['email'];
        $psswd = $_POST['psswd'];
        if($email && $psswd){
            //Fetch DB data
            require_once(__DIR__ . "/../db/db.php");
            $pdo = get_pdo();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email =:email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $db_credentials = $stmt->fetch();

            //Check credentials
            if($db_credentials && password_verify($psswd, $db_credentials['password'])){
                //success - redirect
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $db_credentials['id'];
                $_SESSION['user_name'] = $db_credentials['name'] . " " . $db_credentials['surname'];
                $_SESSION['admin'] = $db_credentials['admin'];
                header('Location: /dashboard/panel.php');
                exit;
            } else{
                $error = "Zły adres e-mail lub hasło, spróbuj ponownie.";
            }
        }

    } catch (Exception $e) {
        error_log($e->getMessage()); // log the real error
        $error = "Błąd logowania. Spróbuj ponownie."; // show this to user
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <?php require_once(__DIR__ . '/../layout/header.php');?>
</head>
<body>

<!-- Page content starts here -->
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center login-bg">
    <div class="card p-4 login-card">
        <div class="text-center mb-4">
            <img src="/storage/images/argologo.svg" alt="Argo" class="login-logo">
            <h4 class="mt-3">SKR ARGO AGH</h4>
            <h5 class="mt-3">Logowanie do panelu klubowicza</h5>
        </div>

        <form method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hasło</label>
                <input type="password" name="psswd" class="form-control" required>
            </div>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary w-100">Zaloguj się</button>
        </form>
    </div>
</div>
</body>
</html>