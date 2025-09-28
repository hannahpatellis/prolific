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

<div class="row" id="training-grid">
  <div class="col">
    <div id="item-wrap">
      <?php foreach($pieces as $piece) { ?>
        <div class="item">
          <a href="/go/training/edit.php?id=<?php print($piece['Id']); ?>">
            <img class="training-item" src="<?php print($env['img_store_url']); print($piece['Thumbnail']); ?>.jpg" />
          </a>
          <h1>#<?php print($piece['Id']); ?></h1>
          <div class="slider-container">
            <div class="form-check form-switch">
              <input class="form-check-input switch-exports" type="checkbox" role="switch" data-piece-id=<?php print($piece['Id']); ?> <?php if($piece['TrainingExports']) {print("checked");} ?>>
              <label class="form-check-label">Exports</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input switch-desc" type="checkbox" role="switch" data-piece-id=<?php print($piece['Id']); ?> <?php if($piece['TrainingDescriptions']) {print("checked");} ?>>
              <label class="form-check-label">Descriptions</label>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $('.switch-exports').change(function () {
    alert("Exports: " + $(this).data("pieceId") + " is now " + $(this).prop('checked'));
  });
  $('.switch-desc').change(function () {
    alert("Descriptions: " + $(this).data("pieceId") + " is now " + $(this).prop('checked'));
  });
</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>