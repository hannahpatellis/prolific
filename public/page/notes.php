<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
}

$active_page = "notes";
$page_title = "Notes";
require_once("../partial/dash-header.php"); ?>

<div class="row">
  <div class="col">
    <h1>Notes</h1>
  </div>
</div>

<?php require_once("../partial/dash-footer.php"); ?>