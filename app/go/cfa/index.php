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
$cfas = $query->find()->toArray();

$active_page = "cfa";
$page_title = "Certified fine art records";
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div class="row">
  <div class="col d-flex justify-content-between align-items-center">
    <h1>Certified fine art records</h1>
    <a href="/go/cfa/new.php"><button type="button" class="btn btn-primary">New CFA record</button></a>
  </div>
</div>

<div class="row">
  <div class="col">
    <table class="table table-dark table-striped table-hover align-middle table-responsive-sm">
      <tbody>
        <tr>
            <th>ID . Run . Count</th>
            <th>Title</th>
            <th>Actions</th>
          </tr>
        <?php foreach($cfas as $cfa) { ?>
          <tr>
            <td><?php print($cfa['PieceId'] . '.' . $cfa['PieceIdRun'] . '.' . $cfa['PieceIdCount']); ?></td>
            <td>Placeholder</td>
            <td>
              <a href="/go/cfa/view.php?id=<?php print($cfa['RecordId']); ?>"><button type="button" class="btn btn-warning">Edit CFA record</button></a>  
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>