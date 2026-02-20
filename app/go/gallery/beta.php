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

<div class="row" id="view-grid">
  <div class="col" id="grid">
    <?php foreach($pieces as $piece) { ?>
      <a href="/go/piece/view.php?id=<?php print($piece['Id']); ?>"><img class="grid-item" src="<?php print($env['img_store_url']); print($piece['Thumbnail']); ?>.jpg" /></a>
    <?php } ?>
  </div>
</div>

<div id="gallery">
</div>

<script type="text/javascript" src="/assets/js/list.min.2.3.1.js"></script>
<script type="text/javascript">

</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>