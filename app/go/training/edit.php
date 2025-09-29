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
  <div class="col-md-5 col-sm-12">
    <img class="piece" src="<?php print($env['img_store_url'] . $piece['Thumbnail']); ?>.jpg" width="100%" height="auto" />
    <a href="<?php print($env['img_store_url'] . $piece['Thumbnail']); ?>.jpg">
      <div class="mt-2"><pre><?php print $piece['Thumbnail']; ?></pre></div>
    </a>
  </div>
  <div class="col-md-7 col-sm-12">
    <div class="list-group">
      <div href="#" class="list-group-item">
        <small class="mb-1"><strong><?php print($piece['Collection']); ?></strong></small>
      </div>
      <?php if($piece['Subcollection']) { ?>
        <div href="#" class="list-group-item">
          <small class="mb-1"><strong><?php print($piece['Subcollection']); ?></strong></small>
        </div>
      <?php } ?>
      <?php if($piece['StartDate']) { ?>
        <div href="#" class="list-group-item">
          <small class="mb-1">Started work on... <strong><?php print($piece['StartDate']); ?></strong></small>
        </div>
      <?php } ?>
      <div href="#" class="list-group-item">
        <small class="mb-1">Finished work on... <strong><?php print($piece['EndDate']); ?></strong></small>
      </div>
      <?php if($piece['Location']) { ?>
        <div href="#" class="list-group-item">
          <small class="mb-1">Location(s): <strong><?php print($piece['Location']); ?></strong></small>
        </div>
      <?php } ?>
      <div href="#" class="list-group-item">
        <small class="mb-1">Color temperature: <strong><?php print($piece['Temperature']);?></strong></small>
      </div>
      <div href="#" class="list-group-item">
        <small class="mb-1">Background color: <strong><?php print($piece['Background']);?></strong></small>
      </div>
      <?php if($piece['Colors']) { ?>
        <div href="#" class="list-group-item">
          <small class="mb-1">Primary colors: <strong><?php print($piece['Colors']);?></strong></small>
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
    </div>
    <form action="/api/training/edit.php" method="POST" enctype="multipart/form-data">
      <div class="list-group">
        <div href="#" class="list-group-item">
          <p>AI training data: Form description</p>
          <textarea id="AITrainingForm" name="ai-training-form"><?php print($piece['AITrainingForm']); ?></textarea>
        </div>
        <div href="#" class="list-group-item">
          <p>AI training data: Colored form description</p>
          <textarea id="AITrainingColored" name="ai-training-colored"><?php print($piece['AITrainingColored']); ?></textarea>
        </div>
        <div href="#" class="list-group-item">
          <p>AI training data: Final piece description</p>
          <textarea id="AITrainingFinal" name="ai-training-final"><?php print($piece['AITrainingFinal']); ?></textarea>
        </div>
        <div href="#" class="list-group-item">
          <div class="form-check form-switch">
            <input class="form-check-input switch-exports" name="switch-exports" type="checkbox" role="switch" data-piece-id=<?php print($piece['Id']); ?> <?php if($piece['TrainingExports']) {print("checked");} ?>>
            <label class="form-check-label">Exports</label>
          </div>
          <div class="form-check form-switch">
            <input class="form-check-input switch-desc" name="switch-desc" type="checkbox" role="switch" data-piece-id=<?php print($piece['Id']); ?> <?php if($piece['TrainingDescriptions']) {print("checked");} ?>>
            <label class="form-check-label">Descriptions</label>
          </div>
        </div>
      </div>
      <input type="text" id="form-id" name="id" required value="<?php print($piece['Id']); ?>">

      <button type="submit" class="btn btn-warning mt-4">Update EMOH</button>
    </form>
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