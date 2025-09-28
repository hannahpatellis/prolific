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

$active_page = "training";
$page_title = $piece['Title'];
require_once(__DIR__ . "/../../resources/env.php");
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div class="row">
  <div class="col">
    <h1 class="d-flex justify-content-between align-items-center"><?php print($piece['Title']); ?><span class="badge text-bg-primary rounded-pill">#<?php print($piece['Id']); ?></span></h1>
  </div>
</div>

<div class="row">
  <div class="col-md-4 col-sm-12">
    <img class="piece" src="<?php print($env['img_store_url'] . $piece['Thumbnail']); ?>.jpg" width="100%" height="auto" />
    <a href="<?php print($env['img_store_url'] . $piece['Thumbnail']); ?>.jpg">
      <div class="mt-2"><pre><?php print $piece['Thumbnail']; ?></pre></div>
    </a>
  </div>
  <div class="col-md-8 col-sm-12">
    <div class="list-group">
      
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print($piece['Collection']); ?></h3>
        <small>Part of collection...</small>
      </div>
      <?php if($piece['Subcollection']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['Subcollection']); ?></h3>
          <small>Part of subcollection(s)...</small>
        </div>
      <?php } ?>
      <?php if($piece['StartDate']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['StartDate']); ?></h3>
          <small>Started work on...</small>
        </div>
      <?php } ?>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print($piece['EndDate']); ?></h3>
        <small>Finished work on...</small>
      </div>
      <?php if($piece['Location']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['Location']); ?></h3>
          <small>Creation location(s)...</small>
        </div>
      <?php } ?>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print($piece['Temperature']);?></h3>
        <small>Color temperature</small>
      </div>
      <div href="#" class="list-group-item">
        <h3 class="mb-1"><?php print($piece['Background']);?></h3>
        <small>Background color</small>
      </div>
      <?php if($piece['Colors']) { ?>
        <div href="#" class="list-group-item">
          <h3 class="mb-1"><?php print($piece['Colors']);?></h3>
          <small>Primary featured colors</small>
        </div>
      <?php } ?>
      <?php if($piece['Description']) { ?>
        <div href="#" class="list-group-item">
          <p>Visual description</p>
          <textarea id="Description"><?php print($piece['Description']); ?></textarea>
        </div>
      <?php } ?>
      <?php if($piece['Story']) { ?>
        <div href="#" class="list-group-item">
          <p>Story</p>
          <textarea id="Story"><?php print($piece['Story']); ?></textarea>
        </div>
      <?php } ?>
      <?php if($piece['Notes']) { ?>
        <div href="#" class="list-group-item">
          <p>Notes</p>
          <textarea id="Notes"><?php print($piece['Notes']); ?></textarea>
        </div>
      <?php } ?>
      <?php if($piece['AITrainingForm']) { ?>
        <div href="#" class="list-group-item">
          <p>AI training data: Form description</p>
          <textarea id="AITrainingForm"><?php print($piece['AITrainingForm']); ?></textarea>
        </div>
      <?php } ?>
      <?php if($piece['AITrainingColored']) { ?>
        <div href="#" class="list-group-item">
          <p>AI training data: Colored form description</p>
          <textarea id="AITrainingColored"><?php print($piece['AITrainingColored']); ?></textarea>
        </div>
      <?php } ?>
      <?php if($piece['AITrainingFinal']) { ?>
        <div href="#" class="list-group-item">
          <p>AI training data: Final piece description</p>
          <textarea id="AITrainingFinal"><?php print($piece['AITrainingFinal']); ?></textarea>
        </div>
      <?php } ?>
    </div>
    <a href="#" type="link" class="btn btn-warning mt-4">Update this piece</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script type="text/javascript">
  var simplemdeNotes = new SimpleMDE({
    element: document.getElementById("Notes"),
    toolbar: false
  });

  var simplemdeStory = new SimpleMDE({
    element: document.getElementById("Story"),
    toolbar: false
  });

  var simplemdeDescription = new SimpleMDE({
    element: document.getElementById("Description"),
    toolbar: false
  });
  
  var simplemdeAITrainingForm = new SimpleMDE({
    element: document.getElementById("AITrainingForm"),
    toolbar: false
  });

  var simplemdeAITrainingColored = new SimpleMDE({
    element: document.getElementById("AITrainingColored"),
    toolbar: false
  });

  var simplemdeAITrainingFinal = new SimpleMDE({
    element: document.getElementById("AITrainingFinal"),
    toolbar: false
  });
</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>