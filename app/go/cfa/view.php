<?php

// session_start();
// if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
//   header('Location: /go/login.php?error=forbidden');
//   exit;
// }
// if($_SESSION['isAdmin'] != true) {
//   header('Location: /go/dashboard.php?error=forbidden');
//   exit;
// }

$adminRequired = true;
require_once __DIR__ . '/../../resources/permissions.php';

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../resources/orm/config.php';

$query = new Art\CfaQuery();
$cfa = $query->findPK($_GET['id'])->toArray();

$pieceQuery = new Art\PiecesQuery();
$piece = $pieceQuery->findPK($cfa['PieceId'])->toArray();

$active_page = "cfa";
$page_title = 'CFA record: ' . $cfa['PieceId'] . '.' . $cfa['PieceIdRun'] . '.' . $cfa['PieceIdCount'];
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div class="row">
  <div class="col">
    <h1 class="d-flex justify-content-between align-items-center"><span class="me-3">CFA record: <?php print((int)$cfa['PieceId'] . '.' . (int)$cfa['PieceIdRun'] . '.' . (int)$cfa['PieceIdCount']); ?></span><span class="badge text-bg-primary rounded-pill me-3"><?php print(h($piece['Title'])); ?></span></h1>
  </div>
</div>

<?php if(isset($_GET['status']) && $_GET['status'] == '201') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-success" role="alert">CFA record updated successfully!</div>
    </div>
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == '500') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger" role="alert">There was an error updating the CFA record<?php if($_GET['detail']) {print(": " . htmlspecialchars($_GET['detail'], ENT_QUOTES, 'UTF-8'));}; ?></div>
    </div>
  </div>
<?php } ?>

<div class="row">
  <div class="col-md-4 col-sm-12">
    <a href="/go/piece/stage.php?id=<?php print((int)$piece['Id']); ?>">
      <img class="piece" src="<?php print($env['img_store_url'] . h($piece['Thumbnail'])); ?>.jpg" width="100%" height="auto" />
    </a>
    <a href="<?php print($env['img_store_url'] . h($piece['Thumbnail'])); ?>.jpg">
      <div class="mt-2"><pre><?php print h($piece['Thumbnail']); ?></pre></div>
    </a>
  </div>
  <div class="col-md-8 col-sm-12">
    <div class="list-group">
      
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print(h($piece['Title'])); ?></h3>
        <small>Piece title</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print((int)$cfa['PieceId'] . ', ' . (int)$cfa['PieceIdRun'] . ', ' . (int)$cfa['PieceIdCount']); ?></h3>
        <small>Piece, Piece Run, Run Count</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print(h($piece['SizeHeight'])." x ".h($piece['SizeWidth'])." ".h($piece['SizeUnit'])); ?></h3>
        <small>Size of original canvas</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print(h($cfa['PrintCompany'])); ?></h3>
        <small>Print company</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print(h($cfa['PrintMedium'])); ?></h3>
        <small>Print medium</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print(h($cfa['PrintCost'])); ?></h3>
        <small>Print cost</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print(h($cfa['PrintDateSent'])); ?></h3>
        <small>Date sent</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print(h($cfa['PrintDateReceipt'])); ?></h3>
        <small>Date receipt</small>
      </div>
      <?php if($cfa['PrintNotes']) { ?>
        <div href="#" class="list-group-item">
          <p>Print notes</p>
          <textarea id="PrintNotes"><?php print(h($cfa['PrintNotes'])); ?></textarea>
        </div>
      <?php } ?>

      <?php if($cfa['BuyerName']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print(h($cfa['BuyerName'])); ?></h3>
          <small>Buyer name</small>
        </div>
      <?php } ?>
      <?php if($cfa['BuyerLocation']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print(h($cfa['BuyerLocation'])); ?></h3>
          <small>Buyer location</small>
        </div>
      <?php } ?>
      <?php if($cfa['BuyerDatePurchase']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print(h($cfa['BuyerDatePurchase'])); ?></h3>
          <small>Buyer date purchase</small>
        </div>
      <?php } ?>
      <?php if($cfa['BuyerDateReceipt']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print(h($cfa['BuyerDateReceipt'])); ?></h3>
          <small>Buyer date receipt</small>
        </div>
      <?php } ?>
      <?php if($cfa['Notes']) { ?>
        <div href="#" class="list-group-item">
          <p>General notes</p>
          <textarea id="Notes"><?php print(h($cfa['Notes'])); ?></textarea>
        </div>
      <?php } ?>
    </div>

    <?php if($_SESSION['isAdmin'] == true) { ?>
      <a href="/go/cfa/edit.php?id=<?php print((int)$cfa['RecordId']); ?>" type="link" class="btn btn-warning mt-4">Edit this CFA record</a>
    <?php } ?>
  </div>
</div>

<script src="/assets/js/simplemde.min.js"></script>
<script type="text/javascript">
<?php if($cfa['PrintNotes']) { ?>
  var simplemdePrintNotes = new SimpleMDE({
    element: document.getElementById("PrintNotes"),
    toolbar: false
  });
  simplemdePrintNotes.togglePreview();
<?php } ?>
<?php if($cfa['Notes']) { ?>
  var simplemdeNotes = new SimpleMDE({
    element: document.getElementById("Notes"),
    toolbar: false
  });
  simplemdeNotes.togglePreview();
<?php } ?>
</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>