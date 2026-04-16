<?php

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