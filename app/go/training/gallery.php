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

$query = new Art\PiecesQuery();
$pieces = $query->orderById('desc')->find()->toArray();

$active_page = "training";
$page_title = "AI model training gallery";
require_once(__DIR__ . "/../../resources/env.php");
require_once(__DIR__ . "/../../partials/dash-header.php"); 

?>

<div class="row">
  <div class="col d-flex justify-content-between align-items-center">
    <h1>AI model training gallery</h1>
  </div>
</div>

<div class="row" id="view-list">
  <div class="col">
    <div id="table-wrapper"></div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
<script type="text/javascript">

const db = <?php print(json_encode($pieces)); ?>;
const dbTable = db.map((row) => {
  return [
    row.Id,
    row.Thumbnail,
    row.TrainingExports,
    row.TrainingDescriptions
  ];
});

// console.log(db);
// console.log(dbTable);

new gridjs.Grid({
  columns: [
    "ID",
    {
      name: 'Thumbnail',
      formatter: (cell, row) => gridjs.html(`<a href='/go/training/edit.php?id=${row.cells[0].data}'><img src='<?php print($env['img_store_url']); ?>${cell}.jpg' height="80px" width="auto" /></a>`)
    },
    { 
      name: 'TrainingExports',
      formatter: (cell, row) => gridjs.html(`<a href='/go/training/edit.php?id=${row.cells[0].data}'>${cell}</a>`)
    },
    { 
      name: 'TrainingDescriptions',
      formatter: (cell, row) => gridjs.html(`<a href='/go/training/edit.php?id=${row.cells[0].data}'>${cell}</a>`)
    }
  ],
  search: {
    ignoreHiddenColumns: false,
  },
  data: dbTable
}).render(document.getElementById("table-wrapper"));

</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>