<?php

session_start();
if (isset($_SESSION['active']) && $_SESSION['active'] == true) {
  header('Location: page/dashboard.php');
} else {
  header('Location: page/login.php');
}

?>