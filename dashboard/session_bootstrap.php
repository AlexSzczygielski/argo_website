<?php
/**
 * Session bootstrap — sets cookie security flags before session_start().
 *
 * Required (not session_start() directly) by every dashboard entry point:
 *  - auth_check.php (every protected page)
 *  - login.php      (the only unprotected page that uses sessions)
 *
 * Flags only take effect when set before session_start(), so this file
 * must be required before any session access.
 */

if (session_status() === PHP_SESSION_NONE) {
    $is_prod = getenv('APP_ENV') === 'production';

    // HTTPS-only — pinned to env, not connection, so login over HTTP
    // on prod fails closed rather than leaking a cookie in plain text.
    ini_set('session.cookie_secure',   $is_prod ? '1' : '0');
    // JS can't read PHPSESSID via document.cookie — XSS can't steal sessions
    ini_set('session.cookie_httponly', '1');
    // browser refuses to send cookie on cross-site POSTs — CSRF belt-and-braces
    ini_set('session.cookie_samesite', 'Lax');

    session_start();
}
