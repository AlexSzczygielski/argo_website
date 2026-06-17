<?php
require_once(__DIR__ . '/session_bootstrap.php');
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /dashboard/login.php');
    exit;
}
require_once(__DIR__ . '/csrf.php');
?>