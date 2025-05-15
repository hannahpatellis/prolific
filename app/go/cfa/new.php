<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

$active_page = "cfa";
$page_title = "New CFA record";
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div class="row">
  <div class="col">
    <h1>New CFA record <?php if(isset($_GET['id'])) {print("for piece #".$_GET['id']);} ?></h1>
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

<form action="/api/cfa/new.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-PieceId" name="PieceId" placeholder="Piece ID" required value="<?php if(isset($_GET['id'])) {print($_GET['id']);} ?>">
        <label for="form-PieceId">Piece ID*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-PieceIdRun" name="PieceIdRun" placeholder="Run number" required>
        <label for="form-PieceIdRun">Run Number*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-PieceIdCount" name="PieceIdCount" placeholder="Count number" required>
        <label for="form-PieceIdCount">Count Number*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-PrintDateSent-year" name="PrintDateSent-year" aria-label="Print date sent year" required>
          <option value="2025" select>2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
        </select>
        <label for="form-PrintDateSent-year">Print date sent year*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-PrintDateSent-month" name="PrintDateSent-month" aria-label="Print date sent month">
          <option select></option>
          <option value="01">1 (January)</option>
          <option value="02">2 (February)</option>
          <option value="03">3 (March)</option>
          <option value="04">4 (April)</option>
          <option value="05">5 (May)</option>
          <option value="06">6 (June)</option>
          <option value="07">7 (July)</option>
          <option value="08">8 (August)</option>
          <option value="09">9 (September)</option>
          <option value="10">10 (October)</option>
          <option value="11">11 (November)</option>
          <option value="12">12 (December)</option>
        </select>
        <label for="form-PrintDateSent-month">Print date sent month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintDateSent-day" name="PrintDateSent-day" placeholder="Print date sent day">
        <label for="form-PrintDateSent-day">Print date sent day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-PrintDateReceipt-year" name="PrintDateReceipt-year" aria-label="Print date received year">
          <option select></option>
          <option value="2025">2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
        </select>
        <label for="form-PrintDateReceipt-year">Print date received year</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-PrintDateReceipt-month" name="PrintDateReceipt-month" aria-label="Print date received month">
          <option select></option>
          <option value="01">1 (January)</option>
          <option value="02">2 (February)</option>
          <option value="03">3 (March)</option>
          <option value="04">4 (April)</option>
          <option value="05">5 (May)</option>
          <option value="06">6 (June)</option>
          <option value="07">7 (July)</option>
          <option value="08">8 (August)</option>
          <option value="09">9 (September)</option>
          <option value="10">10 (October)</option>
          <option value="11">11 (November)</option>
          <option value="12">12 (December)</option>
        </select>
        <label for="form-PrintDateReceipt-month">Print date received month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintDateReceipt-day" name="PrintDateReceipt-day" placeholder="Print date received day">
        <label for="form-PrintDateReceipt-day">Print date received day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintCompany" name="PrintCompany" placeholder="Print company" required>
        <label for="form-PrintCompany">Print company*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintMedium" name="PrintMedium" placeholder="Print medium" required>
        <label for="form-PrintMedium">Print medium*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintCost" name="PrintCost" placeholder="Print cost" required>
        <label for="form-PrintCost">Print cost ($x.xx)*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-PrintNotes" name="PrintNotes" placeholder="Print notes">
        <label for="form-PrintNotes">Print notes</label>
      </div>
    </div>
  </div>

  <hr />

  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-BuyerName" name="BuyerName" placeholder="Buyer name">
        <label for="form-BuyerName">Buyer name</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-BuyerLocation" name="BuyerLocation" placeholder="Buyer location">
        <label for="form-BuyerLocation">Buyer location</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-BuyerDatePurchase-year" name="BuyerDatePurchase-year" aria-label="Buy date purchased year">
          <option select></option>
          <option value="2025">2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
        </select>
        <label for="form-BuyerDatePurchase-year">Buy date purchased year</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-BuyerDatePurchase-month" name="BuyerDatePurchase-month" aria-label="Buy date purchased month">
          <option select></option>
          <option value="01">1 (January)</option>
          <option value="02">2 (February)</option>
          <option value="03">3 (March)</option>
          <option value="04">4 (April)</option>
          <option value="05">5 (May)</option>
          <option value="06">6 (June)</option>
          <option value="07">7 (July)</option>
          <option value="08">8 (August)</option>
          <option value="09">9 (September)</option>
          <option value="10">10 (October)</option>
          <option value="11">11 (November)</option>
          <option value="12">12 (December)</option>
        </select>
        <label for="form-BuyerDatePurchase-month">Buy date purchased month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-BuyerDatePurchase-day" name="BuyerDatePurchase-day" placeholder="Buy date purchased day">
        <label for="form-BuyerDatePurchase-day">Buy date purchased day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-BuyerDateReceipt-year" name="BuyerDateReceipt-year" aria-label="Buy date received year">
          <option select></option>
          <option value="2025">2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
        </select>
        <label for="form-BuyerDateReceipt-year">Buy date received year</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-BuyerDateReceipt-month" name="BuyerDateReceipt-month" aria-label="Buy date received month">
          <option select></option>
          <option value="01">1 (January)</option>
          <option value="02">2 (February)</option>
          <option value="03">3 (March)</option>
          <option value="04">4 (April)</option>
          <option value="05">5 (May)</option>
          <option value="06">6 (June)</option>
          <option value="07">7 (July)</option>
          <option value="08">8 (August)</option>
          <option value="09">9 (September)</option>
          <option value="10">10 (October)</option>
          <option value="11">11 (November)</option>
          <option value="12">12 (December)</option>
        </select>
        <label for="form-BuyerDateReceipt-month">Buy date received month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-BuyerDateReceipt-day" name="BuyerDateReceipt-day" placeholder="Buy date received day">
        <label for="form-BuyerDateReceipt-day">Buy date received day</label>
      </div>
    </div>
  </div>

  <hr />

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <p class="form-text">Notes</p>
        <textarea id="form-Notes" name="Notes"></textarea>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col">
      <button type="submit" class="btn btn-success">Add CFA record</button>
    </div>
  </div>
</form>

<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script type="text/javascript">
  var simplemdeNotes = new SimpleMDE({
    element: document.getElementById("form-Notes"),
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "unordered-list", "|", "link", "image", "table", "horizontal-rule"],
    spellChecker: true
  });
</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>