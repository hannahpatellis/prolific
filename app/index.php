<?php

session_start();
if (isset($_SESSION['active']) && $_SESSION['active'] == true) {
  header('Location: /go/dashboard.php');
  exit;
} else {
  header('Location: /go/login.php');
  exit;
}

?>