<?php

require_once __DIR__ . '/env.php';

function h(?string $val): string {
    return htmlspecialchars($val ?? '', ENT_QUOTES, 'UTF-8');
}

session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'secure'   => $env['environment'] !== 'dev',
    'httponly' => true,
    'samesite' => 'Lax',
]);

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
  exit;
}

if(!isset($adminRequired)) {
  header('Location: /go/dashboard.php?error=permissionsSetupIncorrect');
  exit;
}
if(isset($adminRequired) && $adminRequired) {
    if($_SESSION['isAdmin'] != true) {
        header('Location: /go/dashboard.php?error=forbidden');
        exit;
    }
}

?>