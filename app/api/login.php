<?php

session_start();
if(isset($_SESSION['active']) && $_SESSION['active'] == true) {
  header('Location: /go/dashboard.php');
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../resources/orm/config.php';

$query = new Art\UsersQuery();
$row = $query->filterByUsername($_POST['username'])->limit(1)->find()->toArray();

if (password_verify($_POST['password'], $row[0]['PasswordHash'])) {
    $_SESSION['active'] = true;
    $_SESSION['user'] = $row[0]['Username'];
    $_SESSION['first_name'] = $row[0]['FirstName'];
    $_SESSION['last_name'] = $row[0]['LastName'];
    $_SESSION['isAdmin'] = $row[0]['Isadmin'];
    $_SESSION['selectionOnly'] = $row[0]['Selectiononly'];
    header('Location: /go/dashboard.php');
} else {
  header('Location: /go/login.php?status=incorrect_login');
}

?>