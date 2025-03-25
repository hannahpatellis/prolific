<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: dashboard.php?error=forbidden');
}

require_once("../resource/db.php");
  
$stmt_string = "SELECT * FROM pieces WHERE id=$_GET[id]";
$result = $mysqli -> query($stmt_string);
$rows = $result->fetch_all(MYSQLI_ASSOC);
$piece = $rows[0];

$active_page = "gallery";
$page_title = "Update: ".$piece['title'];
require_once("../partial/dash-header.php");

$deconst_end_date = deconstruct_date($piece['end_date']);
$deconst_start_date = deconstruct_date($piece['start_date']);

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

require_once("../resource/env.php");
if($env['environment'] == 'dev') {
  $img_store_location = '/img_store/';
} else if($env['environment'] == 'prod') {
  $img_store_location = 'https://fs.hannahap.com/img_store/';
}

?>

<div class="row">
  <div class="col d-flex align-items-center">
    <a href="piece.php?id=<?php print($piece['id']); ?>">
      <img src="<?php print($img_store_location); print $piece['thumbnail']; ?>.jpg" width="auto" height="100px" style="margin-right: 20px" />
    </a>
    <h1>Update: <?php print($piece['title']); ?></h1>
  </div>
</div>


<?php if(isset($_GET['status']) && $_GET['status'] == '201') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-success" role="alert">"<?php print($piece['title']); ?>" was updated successfully</div>
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

<form action="/action/piece_edit.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-title" name="title" placeholder="Title" required value="<?php print($piece['title']); ?>">
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
          <option value="General" <?php if($piece['collection'] == 'General') {print("selected");} ?>>General</option>
          <option value="The Era" <?php if($piece['collection'] == 'The Era') {print("selected");} ?>>The Era</option>
          <option value="Untitled Trans Collection" <?php if($piece['collection'] == 'Untitled Trans Collection') {print("selected");} ?>>Untitled Trans Collection</option>
          <option value="I am ICONIC" <?php if($piece['collection'] == 'I am ICONIC') {print("selected");} ?>>I am ICONIC</option>
          <option value="My Dearest Eli" <?php if($piece['collection'] == 'My Dearest Eli') {print("selected");} ?>>My Dearest Eli</option>
          <option value="Endless Comfort" <?php if($piece['collection'] == 'Endless Comfort') {print("selected");} ?>>Endless Comfort</option>
          <option value="Waiting for You" <?php if($piece['collection'] == 'Waiting for You') {print("selected");} ?>>Waiting for You</option>
          <option value="Can't Stop Thinking About You" <?php if($piece['collection'] == 'Can\'t Stop Thinking About You') {print("selected");} ?>>Can't Stop Thinking About You</option>
        </select>
        <label for="form-collection">Collection*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-subcollection" name="subcollection" placeholder="Subcollection" data-role="tagsinput" value="<?php print($piece['subcollection']); ?>">
        <label for="form-subcollection">Subcollection(s)</label>
        <div class="form-text">Comma separated</div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-height" name="size-height" placeholder="Height" required value="<?php print($piece['size_height']); ?>">
        <label for="form-height">Height*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-width" name="size-width" placeholder="Width" required value="<?php print($piece['size_width']); ?>">
        <label for="form-width">Width*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-size-unit" name="size-unit" aria-label="Size unit" required>
          <option value="px" <?php if($piece['size_unit'] == 'px') {print("selected");} ?>>px</option>
          <option value="in" <?php if($piece['size_unit'] == 'in') {print("selected");} ?>>in</option>
          <option value="mm" <?php if($piece['size_unit'] == 'mm') {print("selected");} ?>>mm</option>
          <option value="cm" <?php if($piece['size_unit'] == 'cm') {print("selected");} ?>>cm</option>
        </select>
        <label for="form-size-unit">Size unit*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-location" name="location" placeholder="Location" data-role="tagsinput" value="<?php print($piece['location']); ?>">
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
          <option value="Cool" <?php if($piece['temperature'] == 'Cool') {print("selected");} ?>>Cool</option>
          <option value="Warm" <?php if($piece['temperature'] == 'Warm') {print("selected");} ?>>Warm</option>
        </select>
        <label for="form-temperature">Temperature*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-floating">
        <select class="form-select" id="form-background" name="background" aria-label="Background" required>
          <option value="White" <?php if($piece['background'] == 'White') {print("selected");} ?>>White</option>
          <option value="Black" <?php if($piece['background'] == 'Black') {print("selected");} ?>>Black</option>
          <option value="Light color" <?php if($piece['background'] == 'Light color') {print("selected");} ?>>Light color</option>
          <option value="Dark color" <?php if($piece['background'] == 'Dark color') {print("selected");} ?>>Dark color</option>
        </select>
        <label for="form-background">Background*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-colors" name="colors" placeholder="Primary featured colors" value="<?php print($piece['colors']); ?>">
        <label for="form-colors">Primary featured colors</label>
        <div class="form-text">Comma separated</div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <textarea class="form-control" placeholder="Visual description" id="form-description" name="description" style="height: 100px"><?php print($piece['description']); ?></textarea>
        <label for="form-description">Visual description</label>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col">
      <div class="form-floating">
        <textarea class="form-control" placeholder="Story" id="form-story" name="story" style="height: 100px"><?php print($piece['story']); ?></textarea>
        <label for="form-story">Story</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <textarea class="form-control" placeholder="Notes" id="form-notes" name="notes" style="height: 100px"><?php print($piece['notes']); ?></textarea>
        <label for="form-notes">Notes</label>
      </div>
    </div>
  </div>

  <input type="text" id="form-id" name="id" required value="<?php print($piece['id']); ?>">

  <div class="row mb-4">
    <div class="col">
      <button type="submit" class="btn btn-warning">Update EMOH</button>
    </div>
  </div>
</form>