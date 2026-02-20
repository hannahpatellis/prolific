<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../resources/orm/config.php';

$query = new Art\PiecesQuery();
$pieces = $query->orderById('asc')->find()->toArray();

$active_page = "gallery";
$page_title = "Stage";
require_once(__DIR__ . "/../../resources/env.php");
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<link type="text/css" rel="stylesheet" href="/assets/css/lightgallery-bundle.min.css" />

<div id="show-stage">
    <div id="inline-gallery-container"></div>
</div>

<script type="text/javascript" src="/assets/js/lightgallery.min.js"></script>
<script type="text/javascript">

const db = <?php print(json_encode($pieces)); ?>;
const dbTable = db.map((row) => {
  return {
    src: `<?php print($env['img_store_url']); ?>${row.Thumbnail}.jpg`,
    thumb: `<?php print($env['img_store_url']); ?>${row.Thumbnail}.jpg`,
    subHtml: `<h1 class="d-flex justify-content-between align-items-center">${row.Title}<span class="badge text-bg-primary rounded-pill">#${row.Id}</span></h1>`,
  };
});

const lgContainer = document.getElementById('inline-gallery-container');
const inlineGallery = lightGallery(lgContainer, {
    container: lgContainer,
    dynamic: true,
    closable: false,
    showMaximizeIcon: true,
    counter: false,
    download: true,
    appendSubHtmlTo: '#stage-desc',
    slideDelay: 400,
    dynamicEl: dbTable
});

inlineGallery.openGallery(<?php print($_GET['id']-1); ?>);

</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>