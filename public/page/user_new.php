<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: dashboard.php?error=forbidden');
}

$active_page = "admin";
$page_title = "New user";
require_once("../partial/dash-header.php");

?>

<div class="row">
  <div class="col">
    <h1>Add a user</h1>
  </div>
</div>