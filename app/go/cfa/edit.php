<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

$active_page = "cfa";
$page_title = "Edit CFA record";
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div class="row">
  <div class="col d-flex align-items-center">
    <h1>Update:</h1>
  </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>