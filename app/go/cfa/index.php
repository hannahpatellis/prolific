<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

$active_page = "cfa";
$page_title = "Certified fine art records";
require_once(__DIR__ . "/../../partials/dash-header.php");
require_once(__DIR__ . "/../../resources/db.php");

// $stmt_cfa_list = "SELECT * FROM cfa ORDER BY id DESC";
// $results_cfa_list = $mysqli -> query($stmt_cfa_list);
// $cfas = $results_cfa_list->fetch_all(MYSQLI_ASSOC);

?>

<div class="row">
  <div class="col d-flex justify-content-between align-items-center">
    <h1>Certified fine art records</h1>
    <a href="/go/cfa/new.php"><button type="button" class="btn btn-primary">New CFA record</button></a>
  </div>
</div>

<div class="row">
  <div class="col">
    <table class="table table-dark table-striped table-hover align-middle">
      <tbody>
        <tr>
            <th>ID.Run.Count</th>
            <th>Actions</th>
          </tr>
        <?php // foreach($users as $user) { ?>
          <tr>
            <td>199.9.10</td>
            <td>
              <a href="/go/cfa/edit.php?id=<?php // print($user['id']); ?>"><button type="button" class="btn btn-warning">Edit CFA record</button></a>  
            </td>
          </tr>
        <?php // } ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>