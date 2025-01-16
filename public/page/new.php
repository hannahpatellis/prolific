<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
}

$active_page = "newnote";
$page_title = "New note";
require_once("../partial/dash-header.php"); ?>

<div class="row">
  <div class="col">
    <h1>New note</h1>
  </div>
</div>

<?php require_once("../partial/dash-footer.php"); ?>