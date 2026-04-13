<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
  exit;
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
  exit;
}

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../resources/orm/config.php';

$user_id = (int) $_GET['id'];

$user = Art\UsersQuery::create()->findPK($user_id);

if ($user === null) {
  header('Location: /go/admin/index.php?status=500&detail=deleteUserNotFound');
  exit;
}

$user->delete();
header('Location: /go/admin/index.php?status=200&detail=deleteSuccess');
exit;

?>