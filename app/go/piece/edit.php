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
$piece = $query->findPK($_GET['id'])->toArray();

$active_page = "gallery";
$page_title = "Update: ".$piece['Title'];
require_once(__DIR__ . "/../../partials/dash-header.php");

$deconst_end_date = deconstruct_date($piece['EndDate']);
$deconst_start_date = deconstruct_date($piece['StartDate']);

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

require_once(__DIR__ . "/../../resources/env.php");

?>

<div class="row">
  <div class="col d-flex align-items-center">
    <a href="/go/piece/view.php?id=<?php print($piece['Id']); ?>">
      <img src="<?php print($env['img_store_url'] . $piece['Thumbnail']); ?>.jpg" width="auto" height="100px" style="margin-right: 20px" />
    </a>
    <h1>Update: <?php print($piece['Title']); ?></h1>
  </div>
</div>


<?php if(isset($_GET['status']) && $_GET['status'] == '201') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-success" role="alert">"<?php print($piece['Title']); ?>" was updated successfully</div>
    </div>
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == '500') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger" role="alert">There was an error updating this EMOH<?php if($_GET['detail']) {print(": ".$_GET['detail']);}; ?></div>
    </div>
  </div>
<?php } ?>

<form action="/actions/piece_edit.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-title" name="title" placeholder="Title" required value="<?php print($piece['Title']); ?>">
        <label for="form-title">EMOH Title*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-start-year" name="start-year" aria-label="Start year">
          <option value="2024" <?php if($deconst_start_date[0] == '2024') {print("selected");} ?>>2024</option>
          <option value="2023" <?php if($deconst_start_date[0] == '2023') {print("selected");} ?>>2023</option>
          <option value="2022" <?php if($deconst_start_date[0] == '2022') {print("selected");} ?>>2022</option>
          <option value="2021" <?php if($deconst_start_date[0] == '2021') {print("selected");} ?>>2021</option>
          <option value="2020" <?php if($deconst_start_date[0] == '2020') {print("selected");} ?>>2020</option>
          <option value="2019" <?php if($deconst_start_date[0] == '2019') {print("selected");} ?>>2019</option>
        </select>
        <label for="form-start-year">Start year</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-start-month" name="start-month" aria-label="Start month">
          <option selected></option>
          <option value="01" <?php if($deconst_start_date[1] == '01') {print("selected");} ?>>1 (January)</option>
          <option value="02" <?php if($deconst_start_date[1] == '02') {print("selected");} ?>>2 (February)</option>
          <option value="03" <?php if($deconst_start_date[1] == '03') {print("selected");} ?>>3 (March)</option>
          <option value="04" <?php if($deconst_start_date[1] == '04') {print("selected");} ?>>4 (April)</option>
          <option value="05" <?php if($deconst_start_date[1] == '05') {print("selected");} ?>>5 (May)</option>
          <option value="06" <?php if($deconst_start_date[1] == '06') {print("selected");} ?>>6 (June)</option>
          <option value="07" <?php if($deconst_start_date[1] == '07') {print("selected");} ?>>7 (July)</option>
          <option value="08" <?php if($deconst_start_date[1] == '08') {print("selected");} ?>>8 (August)</option>
          <option value="09" <?php if($deconst_start_date[1] == '09') {print("selected");} ?>>9 (September)</option>
          <option value="10" <?php if($deconst_start_date[1] == '10') {print("selected");} ?>>10 (October)</option>
          <option value="11" <?php if($deconst_start_date[1] == '11') {print("selected");} ?>>11 (November)</option>
          <option value="12" <?php if($deconst_start_date[1] == '12') {print("selected");} ?>>12 (December)</option>
        </select>
        <label for="form-start-month">Start month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-start-day" name="start-day" placeholder="Start day" value="<?php print($deconst_start_date[2]); ?>">
        <label for="form-start-day">Start day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-start-year" name="end-year" aria-label="End year" required>
          <option value="2024" <?php if($deconst_end_date[0] == '2024') {print("selected");} ?>>2024</option>
          <option value="2023" <?php if($deconst_end_date[0] == '2023') {print("selected");} ?>>2023</option>
          <option value="2022" <?php if($deconst_end_date[0] == '2022') {print("selected");} ?>>2022</option>
          <option value="2021" <?php if($deconst_end_date[0] == '2021') {print("selected");} ?>>2021</option>
          <option value="2020" <?php if($deconst_end_date[0] == '2020') {print("selected");} ?>>2020</option>
          <option value="2019" <?php if($deconst_end_date[0] == '2019') {print("selected");} ?>>2019</option>
        </select>
        <label for="form-end-year">End year*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-end-month" name="end-month" aria-label="End month">
          <option selected></option>
          <option value="01" <?php if($deconst_end_date[1] == '01') {print("selected");} ?>>1 (January)</option>
          <option value="02" <?php if($deconst_end_date[1] == '02') {print("selected");} ?>>2 (February)</option>
          <option value="03" <?php if($deconst_end_date[1] == '03') {print("selected");} ?>>3 (March)</option>
          <option value="04" <?php if($deconst_end_date[1] == '04') {print("selected");} ?>>4 (April)</option>
          <option value="05" <?php if($deconst_end_date[1] == '05') {print("selected");} ?>>5 (May)</option>
          <option value="06" <?php if($deconst_end_date[1] == '06') {print("selected");} ?>>6 (June)</option>
          <option value="07" <?php if($deconst_end_date[1] == '07') {print("selected");} ?>>7 (July)</option>
          <option value="08" <?php if($deconst_end_date[1] == '08') {print("selected");} ?>>8 (August)</option>
          <option value="09" <?php if($deconst_end_date[1] == '09') {print("selected");} ?>>9 (September)</option>
          <option value="10" <?php if($deconst_end_date[1] == '10') {print("selected");} ?>>10 (October)</option>
          <option value="11" <?php if($deconst_end_date[1] == '11') {print("selected");} ?>>11 (November)</option>
          <option value="12" <?php if($deconst_end_date[1] == '12') {print("selected");} ?>>12 (December)</option>
        </select>
        <label for="form-end-month">End month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-end-day" name="end-day" placeholder="End day" value="<?php print($deconst_end_date[2]); ?>">
        <label for="form-end-day">End day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-collection" name="collection" aria-label="Collection" required>
          <option value="General" <?php if($piece['Collection'] == 'General') {print("selected");} ?>>General</option>
          <option value="Journey North" <?php if($piece['Collection'] == 'Journey North') {print("selected");} ?>>Journey North</option>
          <option value="The Era" <?php if($piece['Collection'] == 'The Era') {print("selected");} ?>>The Era</option>
          <option value="Untitled Trans Collection" <?php if($piece['Collection'] == 'Untitled Trans Collection') {print("selected");} ?>>Untitled Trans Collection</option>
          <option value="I am ICONIC" <?php if($piece['Collection'] == 'I am ICONIC') {print("selected");} ?>>I am ICONIC</option>
          <option value="My Dearest Eli" <?php if($piece['Collection'] == 'My Dearest Eli') {print("selected");} ?>>My Dearest Eli</option>
          <option value="Endless Comfort" <?php if($piece['Collection'] == 'Endless Comfort') {print("selected");} ?>>Endless Comfort</option>
          <option value="Waiting for You" <?php if($piece['Collection'] == 'Waiting for You') {print("selected");} ?>>Waiting for You</option>
          <option value="Can't Stop Thinking About You" <?php if($piece['Collection'] == 'Can\'t Stop Thinking About You') {print("selected");} ?>>Can't Stop Thinking About You</option>
        </select>
        <label for="form-collection">Collection*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-subcollection" name="subcollection" placeholder="Subcollection" data-role="tagsinput" value="<?php print($piece['Subcollection']); ?>">
        <label for="form-subcollection">Subcollection(s)</label>
        <div class="form-text">Comma separated</div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-height" name="size-height" placeholder="Height" required value="<?php print($piece['SizeHeight']); ?>">
        <label for="form-height">Height*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-width" name="size-width" placeholder="Width" required value="<?php print($piece['SizeWidth']); ?>">
        <label for="form-width">Width*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-size-unit" name="size-unit" aria-label="Size unit" required>
          <option value="px" <?php if($piece['SizeUnit'] == 'px') {print("selected");} ?>>px</option>
          <option value="in" <?php if($piece['SizeUnit'] == 'in') {print("selected");} ?>>in</option>
          <option value="mm" <?php if($piece['SizeUnit'] == 'mm') {print("selected");} ?>>mm</option>
          <option value="cm" <?php if($piece['SizeUnit'] == 'cm') {print("selected");} ?>>cm</option>
        </select>
        <label for="form-size-unit">Size unit*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-location" name="location" placeholder="Location" data-role="tagsinput" value="<?php print($piece['Location']); ?>">
        <label for="form-location">Creation location(s)</label>
        <div class="form-text">Comma separated</div>
      </div>
    </div>
  </div>

  <hr />

  <div class="row">
    <div class="col-sm-12 col-md-4">
      <div class="form-floating">
        <select class="form-select" id="form-temperature" name="temperature" aria-label="Temperature" required>
          <option value="Cool" <?php if($piece['Temperature'] == 'Cool') {print("selected");} ?>>Cool</option>
          <option value="Warm" <?php if($piece['Temperature'] == 'Warm') {print("selected");} ?>>Warm</option>
        </select>
        <label for="form-temperature">Temperature*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-floating">
        <select class="form-select" id="form-background" name="background" aria-label="Background" required>
          <option value="White" <?php if($piece['Background'] == 'White') {print("selected");} ?>>White</option>
          <option value="Black" <?php if($piece['Background'] == 'Black') {print("selected");} ?>>Black</option>
          <option value="Light color" <?php if($piece['Background'] == 'Light color') {print("selected");} ?>>Light color</option>
          <option value="Dark color" <?php if($piece['Background'] == 'Dark color') {print("selected");} ?>>Dark color</option>
        </select>
        <label for="form-background">Background*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-colors" name="colors" placeholder="Primary featured colors" value="<?php print($piece['Colors']); ?>">
        <label for="form-colors">Primary featured colors</label>
        <div class="form-text">Comma separated</div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <p class="form-text">Visual description</p>
      <textarea id="form-description" name="description"><?php print($piece['Description']); ?></textarea>
    </div>
  </div>
  
  <div class="row">
    <div class="col">
      <p class="form-text">Story</p>
      <textarea id="form-story" name="story"><?php print($piece['Story']); ?></textarea>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <p class="form-text">Notes</p>
      <textarea id="form-notes" name="notes"><?php print($piece['Notes']); ?></textarea>
    </div>
  </div>

  <input type="text" id="form-id" name="id" required value="<?php print($piece['Id']); ?>">

  <div class="row mb-4">
    <div class="col">
      <button type="submit" class="btn btn-warning">Update EMOH</button>
    </div>
  </div>
</form>

<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script type="text/javascript">
  var simplemdeNotes = new SimpleMDE({
    element: document.getElementById("form-notes"),
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "unordered-list", "|", "link", "image", "table", "horizontal-rule"],
    spellChecker: true
  });
  var simplemdeStory = new SimpleMDE({
    element: document.getElementById("form-story"),
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "unordered-list", "|", "link", "image", "table", "horizontal-rule"],
    spellChecker: true
  });
  var simplemdeDescription = new SimpleMDE({
    element: document.getElementById("form-description"),
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "unordered-list", "|", "link", "image", "table", "horizontal-rule"],
    spellChecker: true
  });
</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>