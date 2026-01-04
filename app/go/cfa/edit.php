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

$query = new Art\CfaQuery();
$cfa = $query->findPK($_GET['id'])->toArray();

$pieceQuery = new Art\PiecesQuery();
$piece = $pieceQuery->findPK($cfa['PieceId'])->toArray();

$active_page = "cfa";
$page_title = "Edit CFA record: " . $cfa['PieceId'] . '.' . $cfa['PieceIdRun'] . '.' . $cfa['PieceIdCount'];
require_once(__DIR__ . "/../../partials/dash-header.php");

if($cfa['PrintDateSent']) {
  $deconst_print_sent_date = deconstruct_date($cfa['PrintDateSent']);
}
if($cfa['PrintDateReceipt']) {
  $deconst_print_receipt_date = deconstruct_date($cfa['PrintDateReceipt']);
}
if($cfa['BuyerDatePurchase']) {
  $deconst_buyer_purchase_date = deconstruct_date($cfa['BuyerDatePurchase']);
}
if($cfa['BuyerDateReceipt']) {
  $deconst_buyer_receipt_date = deconstruct_date($cfa['BuyerDateReceipt']);
}

function deconstruct_date($incoming_date) {
  if(strlen($incoming_date) == 4) {
    $final_year = $incoming_date;
  } if(strlen($incoming_date) == 7) {
    $final_year = substr($incoming_date, 0, 4);
    $final_month = substr($incoming_date, 5, 6);
  } if(strlen($incoming_date) == 10) {
    $final_year = substr($incoming_date, 0, 4);
    $final_month = substr($incoming_date, 5, 2);
    $final_day = substr($incoming_date, 8, 2);
  }
  return array($final_year, $final_month, $final_day);
}


print_r(!empty($deconst_buyer_receipt_date));

?>

<div class="row">
  <div class="col">
    <h1 class="d-flex justify-content-between align-items-center"><span class="me-3">Edit CFA record: <?php print($cfa['PieceId'] . '.' . $cfa['PieceIdRun'] . '.' . $cfa['PieceIdCount']); ?></span><span class="badge text-bg-primary rounded-pill me-3"><?php print($piece['Title']); ?></span></h1>
  </div>
</div>

<?php if(isset($_GET['status']) && $_GET['status'] == '201') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-success" role="alert">New CFA record added successfully!</div>
    </div>
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == '500') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger" role="alert">There was an error adding the new CFA record<?php if($_GET['detail']) {print(": ".$_GET['detail']);}; ?></div>
    </div>
  </div>
<?php } ?>

<form action="/api/cfa/edit.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-PieceId" name="PieceId" placeholder="Piece ID" required value="<?php print($cfa['PieceId']) ?>">
        <label for="form-PieceId">Piece ID*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-PieceIdRun" name="PieceIdRun" placeholder="Run number" required value="<?php print($cfa['PieceIdRun']); ?>">
        <label for="form-PieceIdRun">Run Number*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-PieceIdCount" name="PieceIdCount" placeholder="Count number" required value="<?php print($cfa['PieceIdCount']); ?>">
        <label for="form-PieceIdCount">Count Number*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-PrintDateSent-year" name="PrintDateSent-year" aria-label="Print date sent year" required>
          <option select></option> 
          <option value="2026" <?php if($deconst_print_sent_date[0] == '2026') {print("selected");} ?>>2026</option>  
          <option value="2025" <?php if($deconst_print_sent_date[0] == '2025') {print("selected");} ?>>2025</option>
          <option value="2024" <?php if($deconst_print_sent_date[0] == '2024') {print("selected");} ?>>2024</option>
          <option value="2023" <?php if($deconst_print_sent_date[0] == '2023') {print("selected");} ?>>2023</option>
          <option value="2022" <?php if($deconst_print_sent_date[0] == '2022') {print("selected");} ?>>2022</option>
        </select>
        <label for="form-PrintDateSent-year">Print date sent year*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-PrintDateSent-month" name="PrintDateSent-month" aria-label="Print date sent month">
          <option select></option>
          <option value="01" <?php if($deconst_print_sent_date[1] == '01') {print("selected");} ?>>1 (January)</option>
          <option value="02" <?php if($deconst_print_sent_date[1] == '02') {print("selected");} ?>>2 (February)</option>
          <option value="03" <?php if($deconst_print_sent_date[1] == '03') {print("selected");} ?>>3 (March)</option>
          <option value="04" <?php if($deconst_print_sent_date[1] == '04') {print("selected");} ?>>4 (April)</option>
          <option value="05" <?php if($deconst_print_sent_date[1] == '05') {print("selected");} ?>>5 (May)</option>
          <option value="06" <?php if($deconst_print_sent_date[1] == '06') {print("selected");} ?>>6 (June)</option>
          <option value="07" <?php if($deconst_print_sent_date[1] == '07') {print("selected");} ?>>7 (July)</option>
          <option value="08" <?php if($deconst_print_sent_date[1] == '08') {print("selected");} ?>>8 (August)</option>
          <option value="09" <?php if($deconst_print_sent_date[1] == '09') {print("selected");} ?>>9 (September)</option>
          <option value="10" <?php if($deconst_print_sent_date[1] == '10') {print("selected");} ?>>10 (October)</option>
          <option value="11" <?php if($deconst_print_sent_date[1] == '11') {print("selected");} ?>>11 (November)</option>
          <option value="12" <?php if($deconst_print_sent_date[1] == '12') {print("selected");} ?>>12 (December)</option>
        </select>
        <label for="form-PrintDateSent-month">Print date sent month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintDateSent-day" name="PrintDateSent-day" placeholder="Print date sent day" value="<?php if(!empty($deconst_print_sent_date[2])) {print($deconst_print_sent_date[2]);} ?>">
        <label for="form-PrintDateSent-day">Print date sent day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-PrintDateReceipt-year" name="PrintDateReceipt-year" aria-label="Print date received year">
          <option select></option> 
          <option value="2026" <?php if($deconst_print_receipt_date[0] == '2026') {print("selected");} ?>>2026</option>  
          <option value="2025" <?php if($deconst_print_receipt_date[0] == '2025') {print("selected");} ?>>2025</option>
          <option value="2024" <?php if($deconst_print_receipt_date[0] == '2024') {print("selected");} ?>>2024</option>
          <option value="2023" <?php if($deconst_print_receipt_date[0] == '2023') {print("selected");} ?>>2023</option>
          <option value="2022" <?php if($deconst_print_receipt_date[0] == '2022') {print("selected");} ?>>2022</option>
        </select>
        <label for="form-PrintDateReceipt-year">Print date received year</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-PrintDateReceipt-month" name="PrintDateReceipt-month" aria-label="Print date received month">
          <option select></option>
          <option value="01" <?php if($deconst_print_receipt_date[1] == '01') {print("selected");} ?>>1 (January)</option>
          <option value="02" <?php if($deconst_print_receipt_date[1] == '02') {print("selected");} ?>>2 (February)</option>
          <option value="03" <?php if($deconst_print_receipt_date[1] == '03') {print("selected");} ?>>3 (March)</option>
          <option value="04" <?php if($deconst_print_receipt_date[1] == '04') {print("selected");} ?>>4 (April)</option>
          <option value="05" <?php if($deconst_print_receipt_date[1] == '05') {print("selected");} ?>>5 (May)</option>
          <option value="06" <?php if($deconst_print_receipt_date[1] == '06') {print("selected");} ?>>6 (June)</option>
          <option value="07" <?php if($deconst_print_receipt_date[1] == '07') {print("selected");} ?>>7 (July)</option>
          <option value="08" <?php if($deconst_print_receipt_date[1] == '08') {print("selected");} ?>>8 (August)</option>
          <option value="09" <?php if($deconst_print_receipt_date[1] == '09') {print("selected");} ?>>9 (September)</option>
          <option value="10" <?php if($deconst_print_receipt_date[1] == '10') {print("selected");} ?>>10 (October)</option>
          <option value="11" <?php if($deconst_print_receipt_date[1] == '11') {print("selected");} ?>>11 (November)</option>
          <option value="12" <?php if($deconst_print_receipt_date[1] == '12') {print("selected");} ?>>12 (December)</option>
        </select>
        <label for="form-PrintDateReceipt-month">Print date received month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintDateReceipt-day" name="PrintDateReceipt-day" placeholder="Print date received day" value="<?php if(!empty($deconst_print_receipt_date[2])) {print($deconst_print_receipt_date[2]);} ?>">
        <label for="form-PrintDateReceipt-day">Print date received day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintCompany" name="PrintCompany" placeholder="Print company" required value="<?php print($cfa['PrintCompany']); ?>">
        <label for="form-PrintCompany">Print company*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintCost" name="PrintCost" placeholder="Print cost" required value="<?php print($cfa['PrintCost']); ?>">
        <label for="form-PrintCost">Print cost ($x.xx)*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintMedium" name="PrintMedium" placeholder="Print medium" required value="<?php print($cfa['PrintMedium']); ?>">
        <label for="form-PrintMedium">Print medium*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <p class="form-text">Print Notes</p>
        <textarea id="form-PrintNotes" name="PrintNotes"><?php print($cfa['PrintNotes']); ?></textarea>
      </div>
    </div>
  </div>

  <hr />

  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-BuyerName" name="BuyerName" placeholder="Buyer name" value="<?php print($cfa['BuyerName']); ?>">
        <label for="form-BuyerName">Buyer name</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-BuyerLocation" name="BuyerLocation" placeholder="Buyer location" value="<?php print($cfa['BuyerLocation']); ?>">
        <label for="form-BuyerLocation">Buyer location</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-BuyerDatePurchase-year" name="BuyerDatePurchase-year" aria-label="Buy date purchased year">
          <option select></option> 
          <option value="2026" <?php if($deconst_buyer_purchase_date[0] == '2026') {print("selected");} ?>>2026</option>
        </select>
        <label for="form-BuyerDatePurchase-year">Buy date purchased year</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-BuyerDatePurchase-month" name="BuyerDatePurchase-month" aria-label="Buy date purchased month">
          <option select></option>
          <option value="01" <?php if($deconst_buyer_purchase_date[1] == '01') {print("selected");} ?>>1 (January)</option>
          <option value="02" <?php if($deconst_buyer_purchase_date[1] == '02') {print("selected");} ?>>2 (February)</option>
          <option value="03" <?php if($deconst_buyer_purchase_date[1] == '03') {print("selected");} ?>>3 (March)</option>
          <option value="04" <?php if($deconst_buyer_purchase_date[1] == '04') {print("selected");} ?>>4 (April)</option>
          <option value="05" <?php if($deconst_buyer_purchase_date[1] == '05') {print("selected");} ?>>5 (May)</option>
          <option value="06" <?php if($deconst_buyer_purchase_date[1] == '06') {print("selected");} ?>>6 (June)</option>
          <option value="07" <?php if($deconst_buyer_purchase_date[1] == '07') {print("selected");} ?>>7 (July)</option>
          <option value="08" <?php if($deconst_buyer_purchase_date[1] == '08') {print("selected");} ?>>8 (August)</option>
          <option value="09" <?php if($deconst_buyer_purchase_date[1] == '09') {print("selected");} ?>>9 (September)</option>
          <option value="10" <?php if($deconst_buyer_purchase_date[1] == '10') {print("selected");} ?>>10 (October)</option>
          <option value="11" <?php if($deconst_buyer_purchase_date[1] == '11') {print("selected");} ?>>11 (November)</option>
          <option value="12" <?php if($deconst_buyer_purchase_date[1] == '12') {print("selected");} ?>>12 (December)</option>
        </select>
        <label for="form-BuyerDatePurchase-month">Buy date purchased month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-BuyerDatePurchase-day" name="BuyerDatePurchase-day" placeholder="Buy date purchased day" value="<?php if(!empty($deconst_buyer_purchase_date[2])) {print($deconst_buyer_purchase_date[2]);} ?>">
        <label for="form-BuyerDatePurchase-day">Buy date purchased day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-BuyerDateReceipt-year" name="BuyerDateReceipt-year" aria-label="Buy date received year">
          <option select></option> 
          <option value="2026" <?php if($deconst_buyer_receipt_date[0] == '2026') {print("selected");} ?>>2026</option>
        </select>
        <label for="form-BuyerDateReceipt-year">Buy date received year</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-BuyerDateReceipt-month" name="BuyerDateReceipt-month" aria-label="Buy date received month">
          <option select></option>
          <option value="01" <?php if($deconst_buyer_receipt_date[1] == '01') {print("selected");} ?>>1 (January)</option>
          <option value="02" <?php if($deconst_buyer_receipt_date[1] == '02') {print("selected");} ?>>2 (February)</option>
          <option value="03" <?php if($deconst_buyer_receipt_date[1] == '03') {print("selected");} ?>>3 (March)</option>
          <option value="04" <?php if($deconst_buyer_receipt_date[1] == '04') {print("selected");} ?>>4 (April)</option>
          <option value="05" <?php if($deconst_buyer_receipt_date[1] == '05') {print("selected");} ?>>5 (May)</option>
          <option value="06" <?php if($deconst_buyer_receipt_date[1] == '06') {print("selected");} ?>>6 (June)</option>
          <option value="07" <?php if($deconst_buyer_receipt_date[1] == '07') {print("selected");} ?>>7 (July)</option>
          <option value="08" <?php if($deconst_buyer_receipt_date[1] == '08') {print("selected");} ?>>8 (August)</option>
          <option value="09" <?php if($deconst_buyer_receipt_date[1] == '09') {print("selected");} ?>>9 (September)</option>
          <option value="10" <?php if($deconst_buyer_receipt_date[1] == '10') {print("selected");} ?>>10 (October)</option>
          <option value="11" <?php if($deconst_buyer_receipt_date[1] == '11') {print("selected");} ?>>11 (November)</option>
          <option value="12" <?php if($deconst_buyer_receipt_date[1] == '12') {print("selected");} ?>>12 (December)</option>
        </select>
        <label for="form-BuyerDateReceipt-month">Buy date received month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-BuyerDateReceipt-day" name="BuyerDateReceipt-day" placeholder="Buy date received day" value="<?php if(!empty($deconst_buyer_receipt_date[2])) {print($deconst_buyer_receipt_date[2]);} ?>">
        <label for="form-BuyerDateReceipt-day">Buy date received day</label>
      </div>
    </div>
  </div>

  <hr />

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <p class="form-text">Notes</p>
        <textarea id="form-Notes" name="Notes"><?php print($cfa['Notes']); ?></textarea>
      </div>
    </div>
  </div>

  <input type="text" id="form-id" name="RecordId" required value="<?php print($cfa['RecordId']); ?>">

  <div class="row mb-4">
    <div class="col">
      <button type="submit" class="btn btn-warning">Update CFA record</button>
    </div>
  </div>
</form>

<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script type="text/javascript">
  var simplemdePrintNotes = new SimpleMDE({
    element: document.getElementById("form-PrintNotes"),
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "unordered-list", "|", "link", "image", "table", "horizontal-rule"],
    spellChecker: true
  });
  var simplemdeNotes = new SimpleMDE({
    element: document.getElementById("form-Notes"),
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "unordered-list", "|", "link", "image", "table", "horizontal-rule"],
    spellChecker: true
  });
</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>