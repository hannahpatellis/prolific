<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
  exit;
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
  exit;
}

require_once __DIR__ . '/../../../resources/csrf.php';
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../resources/orm/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: /go/admin/index.php');
  exit;
}
csrf_verify();

$user_id = (int) $_POST['id'];

$user = Art\UsersQuery::create()->findPK($user_id);

if ($user === null) {
  header('Location: /go/admin/index.php?status=500&detail=deleteUserNotFound');
  exit;
}

$user->delete();
header('Location: /go/admin/index.php?status=200&detail=deleteSuccess');
exit;

?>