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

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("Location: /go/admin/index.php?status=500&detail=notPOST");
  exit;
}

$user_id = (int) $_POST['Id'];
$user = Art\UsersQuery::create()->findPK($user_id);

if ($user === null) {
  header("Location: /go/admin/index.php?status=500&detail=userNotFound");
  exit;
}

// Handle password: only update if either field is non-empty
$password = $_POST['Password'];
$password_confirmation = $_POST['PasswordConfirmation'];

if (!empty($password) || !empty($password_confirmation)) {
  if ($password !== $password_confirmation) {
    header("Location: /go/admin/user/edit.php?id=" . $user_id . "&status=500&detail=passwordMismatch");
    exit;
  }
  $user->setPasswordHash(password_hash($password, PASSWORD_BCRYPT));
}

$user->setUsername($_POST['Username']);
$user->setFirstName($_POST['FirstName']);
$user->setLastName($_POST['LastName']);
$user->setEmail($_POST['Email']);
$user->setIsadmin(isset($_POST['Isadmin']) ? true : false);
$user->setSelectiononly(isset($_POST['Selectiononly']) ? true : false);
$user->setUpdatedAt('now');
$user->save();

header("Location: /go/admin/user/edit.php?id=" . $user_id . "&status=200");
exit;

?>