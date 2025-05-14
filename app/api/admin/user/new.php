<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../resources/orm/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $prepared_password_hash = prepare_password_hash($_POST);
  if(!$prepared_password_hash) {
    header("Location: /go/admin/user/new.php?status=500&detail=passwordMismatch");
  } else {
    $prepared_properties = prepare_properties($_POST, $prepared_password_hash);
    $new_user = new Art\Users();
    $new_user->fromArray($prepared_properties);
    $new_user->setUpdatedAt('now');
    $new_user->save();
    header("Location: /go/admin/user/new.php?status=201");
  }
} else {
  header("Location: /go/admin/user/new.php?status=500&detail=notPOST");
}

function prepare_password_hash($raw_post) {
  if($raw_post['Password'] == $raw_post['PasswordConfirmation']) {
    return password_hash($raw_post['Password'], PASSWORD_BCRYPT);
  } else {
    return false;
  }
}

function prepare_properties($raw_post, $prepared_password_hash) {
  return array(
    'Username' => $raw_post['Username'],
    'FirstName' => $raw_post['FirstName'],
    'LastName' => $raw_post['LastName'],
    'Email' => $raw_post['Email'],
    'Isadmin' => $raw_post['Isadmin'],
    'Selectiononly' => $raw_post['Selectiononly'],
    'PasswordHash' => $prepared_password_hash
  );
}

?>