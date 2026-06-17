<?php
require_once(__DIR__ . '/session_bootstrap.php');
session_destroy();
header('Location: /index.php');
exit;
?>