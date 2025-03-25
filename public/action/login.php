<?php

session_start();
if(isset($_SESSION['active']) && $_SESSION['active'] == true) {
  header('Location: ../page/dashboard.php');
}

require_once("../resource/db.php");

$stmt_user = "SELECT * FROM users WHERE username='$_POST[username]' LIMIT 1";
$result_user = $mysqli -> query($stmt_user);
$row = $result_user->fetch_all(MYSQLI_ASSOC);

if (password_verify($_POST['password'], $row[0]['password_hash'])) {
    $_SESSION['active'] = true;
    $_SESSION['user'] = $row[0];
    $_SESSION['isAdmin'] = $row[0]['isAdmin'];
    header('Location: ../page/dashboard.php');
} else {
  header('Location: ../page/login.php?status=incorrect_login');
}

?>