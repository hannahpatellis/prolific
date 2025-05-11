<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}

$active_page = "gallery";
$page_title = "Gallery grid";
require_once(__DIR__ . "/../../partials/dash-header.php"); 
require_once(__DIR__ . "/../../resources/db.php");

$stmt_string = "SELECT * FROM pieces ORDER BY id DESC";
$result = $mysqli -> query($stmt_string);
$rows = $result->fetch_all(MYSQLI_ASSOC);

require_once(__DIR__ . "/../../resources/env.php");

?>

<div class="row">
  <div class="col d-flex justify-content-between align-items-center">
    <h1>Gallery view</h1>
    <a href="/go/gallery/list.php"><button type="button" class="btn btn-outline-primary" id="view-btn-list">List view</button></a>
  </div>
</div>

<div class="row" id="view-grid">
  <div class="col" id="grid">
    <?php foreach($rows as $row) { ?>
      <a href="/go/piece/view.php?id=<?php print($row['id']); ?>"><img class="grid-item" src="<?php print($env['img_store_url']); print($row['thumbnail']); ?>.jpg" width="200px" height="auto" /></a>
    <?php } ?>
  </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>