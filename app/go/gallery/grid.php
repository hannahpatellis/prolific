<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../resources/orm/config.php';

$query = new Art\PiecesQuery();
$pieces = $query->orderById('desc')->find()->toArray();

$active_page = "gallery";
$page_title = "Gallery grid";
require_once(__DIR__ . "/../../resources/env.php");
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div class="row">
  <div class="col d-flex justify-content-between align-items-center">
    <h1>Gallery view</h1>
  </div>
</div>

<div id="gallery">
  <div class="list">
  </div>
</div>

<script type="text/javascript" src="/assets/js/list.min.2.3.1.js"></script>
<script type="text/javascript">
const db = <?php print(json_encode($pieces)); ?>;
const dbTable = db.map((row) => {
  return {
    link: `/go/piece/view.php?id=${row.Id}`,
    thumbnail: `<?php print($env['img_store_url']); ?>${row.Thumbnail}.jpg`,
    title: row.Title,
    end_date: row.EndDate,
    collection: row.Collection,
    subcollection: row.Subcollection,
    temperature: row.Temperature,
    background: row.Background,
    colors: row.Colors,
    description: row.Description,
    story: row.Story,
    notes: row.Notes,
    location: row.Location
  };
});

var options = {
  valueNames: [
    { name: 'link', attr: 'href' },
    { name: 'thumbnail', attr: 'src' },
    'title',
    'end_date',
    'collection',
    'subcollection',
    'temperature',
    'background',
    'colors',
    'description',
    'story',
    'notes',
    'location'
  ],
  item: `<div><a class="link"><img class="thumbnail grid-item" /></a>
  <p class="hidden title"></p>
  <p class="hidden end_date"></p>
  <p class="hidden collection"></p>
  <p class="hidden subcollection"></p>
  <p class="hidden temperature"></p>
  <p class="hidden background"></p>
  <p class="hidden colors"></p>
  <p class="hidden description"></p>
  <p class="hidden story"></p>
  <p class="hidden notes"></p>
  <p class="hidden location"></p></div>`
};

var galleryGrid = new List('gallery', options, dbTable);
</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>