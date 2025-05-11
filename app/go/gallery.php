<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}

$active_page = "gallery";
$page_title = "Gallery";
require_once(__DIR__ . "/../partials/dash-header.php"); 
require_once(__DIR__ . "/../resources/db.php");

$stmt_string = "SELECT * FROM pieces ORDER BY id DESC";
$result = $mysqli -> query($stmt_string);
$rows = $result->fetch_all(MYSQLI_ASSOC);

require_once(__DIR__ . "/../resources/env.php");

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

<div class="row" id="view-list">
  <div class="col">
    <div id="table-wrapper"></div>
  </div>
</div>

<div class="row" id="view-grid">
  <div class="col" id="grid">
    <?php foreach($rows as $row) { ?>
      <a href="/go/piece/view.php?id=<?php print($row['id']); ?>"><img class="grid-item" src="<?php print($env['img_store_url']); print($row['thumbnail']); ?>.jpg" width="200px" height="auto" /></a>
    <?php } ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
<script type="text/javascript">

const db = <?php print(json_encode($rows)); ?>;
const dbTable = db.map((row) => {
  return [
    row.id,
    row.thumbnail,
    row.title,
    row.collection,
    row.subcollection,
    row.description,
    row.notes,
    row.story
  ];
});

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

// console.log(db);
// console.log(dbTable);

new gridjs.Grid({
  columns: [
    "ID",
    {
      name: 'Thumbnail',
      formatter: (cell, row) => gridjs.html(`<a href='/go/piece/view.php?id=${row.cells[0].data}'><img src='<?php print($env['img_store_url']); ?>${cell}.jpg' height="80px" width="auto" /></a>`)
    }, 
    {
      name: 'Title',
      formatter: (cell, row) => gridjs.html(`<a href='/go/piece/view.php?id=${row.cells[0].data}'>${cell}</a>`)
    },
    {
      name: 'Collection',
      formatter: (cell, row) => {
        let subcol = row.cells[4].data.length >= 1 ? ` / ${row.cells[4].data}` : "";
        let format = `${cell}${subcol}`;
        return gridjs.html(`${format}`);
      }
    },
    { 
      name: 'Subcollection',
      hidden: true
    },
    { 
      name: 'Description',
      hidden: true
    },
    { 
      name: 'Notes',
      hidden: true
    },
    { 
      name: 'Story',
      hidden: true
    }
  ],
  search: {
    ignoreHiddenColumns: false,
  },
  data: dbTable
}).render(document.getElementById("table-wrapper"));

</script>

<?php require_once(__DIR__ . "/../partials/dash-footer.php"); ?>