<?php

// session_start();
// if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
//   header('Location: /go/login.php?error=forbidden');
//   exit;
// }
// if($_SESSION['isAdmin'] != true) {
//   header('Location: /go/dashboard.php?error=forbidden');
//   exit;
// }

$adminRequired = true;
require_once __DIR__ . '/../../resources/permissions.php';

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
    <a href="/go/cfa/new.php"><button type="button" class="btn btn-success">New CFA record</button></a>
  </div>
</div>

<div class="row">
  <div class="col">
    <table class="table table-dark table-striped table-hover align-middle table-responsive-sm">
      <tbody class="table-hover">
        <tr>
          <th>CFA ID</th>
          <th>Title</th>
          <th>Printer and medium</th>
          <th></th>
        </tr>
        <?php foreach($cfas as $cfa) { 
            $pieceQuery = new Art\PiecesQuery();
            $piece = $pieceQuery->findPK($cfa['PieceId'])->toArray();
          ?>
          <tr>
            <td><?php print((int)$cfa['PieceId'] . '.' . (int)$cfa['PieceIdRun'] . '.' . (int)$cfa['PieceIdCount']); ?></td>
            <td><?php print(h($piece['Title'])); ?></td>
            <td><?php print(h($cfa['PrintCompany']) . ' (' . h($cfa['PrintMedium']) . ')'); ?></td>
            <td>
              <a href="/go/cfa/view.php?id=<?php print((int)$cfa['RecordId']); ?>">
                <svg id="icn-view" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 576 512" height="16px" width="auto">
                  <path class="icn-std" d="M572.5,238.1c-54.2-122.6-161.6-206.1-284.5-206.1S57.69,115.6,3.47,238.1c-1.91,5.3-3.47,12.9-3.47,17.9s1.56,12.6,3.47,17.03c54.25,123.47,161.63,206.97,284.53,206.97s230.3-83.58,284.5-206.1c1.9-5.3,3.5-13.8,3.5-17.9,0-5-1.6-12.6-3.5-17.9ZM432,256c0,79.45-64.47,144-143.9,144s-144.1-64.5-144.1-144,64.5-144,144-144,144,64.5,144,144ZM288,160c-2.3,0-5.6.4-8.5.8,5.3,9.2,8.5,19.8,8.5,31.2,0,35.35-28.65,64-64,64-11.4,0-22.9-3.3-31.3-8.5-.3,3-.7,6.1-.7,8.5,0,52.1,43,96,96,96s96-42.99,96-95.99-43.9-96.01-96-96.01Z"/>
                </svg>
              </a>  
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>