<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}

$active_page = "gallery";
$page_title = "Gallery list";
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
    <a href="/go/gallery/grid.php"><button type="button" class="btn btn-outline-primary" id="view-btn-grid">Grid view</button></a>
  </div>
</div>

<div class="row" id="view-list">
  <div class="col">
    <div id="table-wrapper"></div>
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

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>