<?php
require_once(__DIR__ . '/session_bootstrap.php');
require_once(__DIR__ . '/activity_log.php');
log_action('auth.logout');
session_destroy();
header('Location: /index.php');
exit;
?>