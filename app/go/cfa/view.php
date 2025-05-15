<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../resources/orm/config.php';

$query = new Art\CfaQuery();
$cfa = $query->findPK($_GET['id'])->toArray();

$active_page = "cfa";
$page_title = 'CFA record: ' . $cfa['PieceId'] . '.' . $cfa['PieceIdRun'] . '.' . $cfa['PieceIdCount'];
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div class="row">
  <div class="col d-flex align-items-center">
    <h1>CFA record: <?php print($cfa['PieceId'] . '.' . $cfa['PieceIdRun'] . '.' . $cfa['PieceIdCount']); ?></h1>
  </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>