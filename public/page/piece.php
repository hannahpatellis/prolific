<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
}

require_once("../resource/db.php");
$stmt_string = "SELECT * FROM pieces WHERE id=$_GET[id]";
$result = $mysqli -> query($stmt_string);
$rows = $result->fetch_all(MYSQLI_ASSOC);
$piece = $rows[0];

$active_page = "gallery";
$page_title = $piece['title'];
require_once("../partial/dash-header.php");

require_once("../resource/env.php");
if($env['environment'] == 'dev') {
  $img_store_location = '/img_store/';
} else if($env['environment'] == 'prod') {
  $img_store_location = 'https://fs.hannahap.com/img_store/';
}

?>

<div class="row">
  <div class="col">
    <h1 class="d-flex justify-content-between align-items-center"><?php print($piece['title']); ?><span class="badge text-bg-primary rounded-pill">#<?php print($piece['id']); ?></span></h1>
  </div>
</div>

<div class="row">
  <div class="col-md-4 col-sm-12">
    <a href="<?php print($img_store_location); print($piece['thumbnail']); ?>.jpg">
      <img class="piece" src="<?php print($img_store_location); print $piece['thumbnail']; ?>.jpg" width="100%" height="auto" />
    </a>
    <div class="mt-2"><pre><?php print $piece['thumbnail']; ?></pre></div>
  </div>
  <div class="col-md-8 col-sm-12">
    <div class="list-group">
      
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print($piece['collection']); ?></h3>
        <small>Part of collection...</small>
      </div>
      <?php if($piece['subcollection']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['subcollection']); ?></h3>
          <small>Part of subcollection(s)...</small>
        </div>
      <?php } ?>
      <?php if($piece['start_date']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['start_date']); ?></h3>
          <small>Started work on...</small>
        </div>
      <?php } ?>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print($piece['end_date']); ?></h3>
        <small>Finished work on...</small>
      </div>
      <?php if($piece['location']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['location']); ?></h3>
          <small>Creation location(s)...</small>
        </div>
      <?php } ?>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print($piece['size_height']." x ".$piece['size_width']." ".$piece['size_unit']); ?></h3>
        <small>Size of original canvas</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print($piece['temperature']);?></h3>
        <small>Color temperature</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print($piece['background']);?></h3>
        <small>Background color</small>
      </div>
      <?php if($piece['colors']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['colors']);?></h3>
          <small>Primary featured colors</small>
        </div>
      <?php } ?>
      <?php if($piece['description']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['description']); ?></h3>
          <small>Visual description</small>
        </div>
      <?php } ?>
      <?php if($piece['story']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['story']); ?></h3>
          <small>Story</small>
        </div>
      <?php } ?>
      <?php if($piece['notes']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['notes']); ?></h3>
          <small>Notes</small>
        </div>
      <?php } ?>
    </div>
    <a href="/page/edit.php?id=<?php print($piece['id']); ?>" type="link" class="btn btn-warning mt-4">Edit this piece</a>
  </div>
</div>

<?php require_once("../partial/dash-footer.php"); ?>