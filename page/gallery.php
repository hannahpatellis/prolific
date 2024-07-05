<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
}

$active_page = "gallery";
$page_title = "Gallery";
require_once("../partial/dash-header.php"); 
require_once("../resource/db.php");

$stmt_string = "SELECT * FROM pieces ORDER BY id DESC";
$result = $mysqli -> query($stmt_string);
$rows = $result->fetch_all(MYSQLI_ASSOC);

require_once("../resource/env.php");
if($env['environment'] == 'dev') {
  $img_store_location = '/img_store/';
} else if($env['environment'] == 'prod') {
  $img_store_location = 'https://fs.hannahap.com/img_store/';
}

?>

<div class="row">
  <div class="col d-flex justify-content-between align-items-center">
    <h1>Gallery view</h1>
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-outline-primary" id="view-btn-grid">Grid view</button>
      <button type="button" class="btn btn-outline-primary" id="view-btn-list">List view</button>
    </div>
  </div>
</div>

<hr /> 

<div class="row" id="view-list">
  <div class="col">
    <table class="table table-striped table-hover align-middle">
      <tbody class="table-group-divider">
        <tr>
        <?php foreach($rows as $row) { ?>
          <tr>
            <td class="col-img">
              <a href="/page/piece.php?id=<?php print $row['id']; ?>"><img src="<?php print($img_store_location); print($row['thumbnail']); ?>.jpg" height="100px" width="auto" /></a>
            </td>
            <th scope="row"><?php print $row['title']; ?></th>
            <td><?php print $row['collection']; ?></td>
            <td><?php print $row['subcollection']; ?></td>
            <td><a href="/page/piece.php?id=<?php print $row['id']; ?>"><span class="badge text-bg-primary rounded-pill">#<?php print($row['id']); ?></span></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<div class="row" id="view-grid">
  <div class="col" id="grid">
    <?php foreach($rows as $row) { ?>
      <a href="/page/piece.php?id=<?php print($row['id']); ?>"><img class="grid-item" src="<?php print($img_store_location); print($row['thumbnail']); ?>.jpg" width="200px" height="auto" /></a>
    <?php } ?>
  </div>
</div>

<script type="text/javascript">

const gridDiv = document.getElementById('view-grid');
const listDiv = document.getElementById('view-list');

const gridBtn = document.getElementById('view-btn-grid');
const listBtn = document.getElementById('view-btn-list');

function setGridView() {
  gridBtn.classList.remove("btn-outline-primary");
  gridBtn.classList.add("btn-primary");
  listBtn.classList.remove("btn-primary");
  listBtn.classList.add("btn-outline-primary");

  listDiv.style.display = "none";
  gridDiv.style.display = "block";
}

function setListView() {
  gridBtn.classList.remove("btn-primary");
  gridBtn.classList.add("btn-outline-primary");
  listBtn.classList.remove("btn-outline-primary");
  listBtn.classList.add("btn-primary");

  gridDiv.style.display = "none";
  listDiv.style.display = "block";
}

gridBtn.addEventListener("click", setGridView);
listBtn.addEventListener("click", setListView);

setGridView();

</script>

<?php require_once("../partial/dash-footer.php"); ?>