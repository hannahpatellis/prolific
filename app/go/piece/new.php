<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

$active_page = "newpiece";
$page_title = "New piece";
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div class="row">
  <div class="col">
    <h1>Add a piece</h1>
  </div>
</div>

<?php if(isset($_GET['status']) && $_GET['status'] == '201') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-success" role="alert">New EMOH added successfully!</div>
    </div>
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == '500') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger" role="alert">There was an error adding the new EMOH<?php if($_GET['detail']) {print(": ".$_GET['detail']);}; ?></div>
    </div>
  </div>
<?php } ?>

<form action="/actions/piece_new.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-title" name="title" placeholder="Title" required>
        <label for="form-title">EMOH Title*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-start-year" name="start-year" aria-label="Start year">
          <option value="2026" select>2026</option>
          <option value="2025">2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
          <option value="2022">2022</option>
          <option value="2021">2021</option>
          <option value="2020">2020</option>
          <option value="2019">2019</option>
        </select>
        <label for="form-start-year">Start year</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-start-month" name="start-month" aria-label="Start month">
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
        <label for="form-start-month">Start month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-start-day" name="start-day" placeholder="Start day">
        <label for="form-start-day">Start day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-start-year" name="end-year" aria-label="End year" required>
          <option value="2026" select>2026</option>
          <option value="2025">2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
          <option value="2022">2022</option>
          <option value="2021">2021</option>
          <option value="2020">2020</option>
          <option value="2019">2019</option>
        </select>
        <label for="form-end-year">End year*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-end-month" name="end-month" aria-label="End month">
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
        <label for="form-end-month">End month</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-end-day" name="end-day" placeholder="End day">
        <label for="form-end-day">End day</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-collection" name="collection" aria-label="Collection" required>
          <option value="General">General</option>
          <option value="Journey North" selected>Journey North</option>
          <option value="The Era">The Era</option>
          <option value="Untitled Trans Collection">Untitled Trans Collection</option>
          <option value="I am ICONIC">I am ICONIC</option>
          <option value="My Dearest Eli">My Dearest Eli</option>
          <option value="Endless Comfort">Endless Comfort</option>
          <option value="Waiting for You">Waiting for You</option>
          <option value="Can't Stop Thinking About You">Can't Stop Thinking About You</option>
        </select>
        <label class="form-label" for="form-collection">Collection*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-subcollection" name="subcollection" placeholder="Subcollection" data-role="tagsinput">
        <label for="form-subcollection">Subcollection(s)</label>
        <div class="form-text">Comma separated</div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-height" name="size-height" placeholder="Height" required>
        <label for="form-height">Height*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-width" name="size-width" placeholder="Width" required>
        <label for="form-width">Width*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <select class="form-select" id="form-size-unit" name="size-unit" aria-label="Size unit" required>
          <option value="px" selected>px</option>
          <option value="in">in</option>
          <option value="mm">mm</option>
          <option value="cm">cm</option>
        </select>
        <label for="form-size-unit">Size unit*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-location" name="location" placeholder="Location" data-role="tagsinput">
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
          <option value="Cool" selected>Cool</option>
          <option value="Warm">Warm</option>
        </select>
        <label for="form-temperature">Temperature*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-floating">
        <select class="form-select" id="form-background" name="background" aria-label="Background" required>
          <option value="White" selected>White</option>
          <option value="Black">Black</option>
          <option value="Light color">Light color</option>
          <option value="Dark color">Dark color</option>
        </select>
        <label for="form-background">Background*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-floating">
        <input type="text" class="form-control" id="form-colors" name="colors" placeholder="Primary featured colors">
        <label for="form-colors">Primary featured colors</label>
        <div class="form-text">Comma separated</div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
      <p class="form-text">Visual description</p>
      <textarea id="form-description" name="description"></textarea>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col">
      <div class="form-floating">
        <p class="form-text">Story</p>
        <textarea id="form-story" name="story"></textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <p class="form-text">Notes</p>
        <textarea id="form-notes" name="notes"></textarea>
      </div>
    </div>
  </div>

  <hr />

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <p class="form-text">AI training data: Form description</p>
        <textarea id="form-ai-training-form" name="ai-training-form"></textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <p class="form-text">AI training data: Colored form description</p>
        <textarea id="form-ai-training-colored" name="ai-training-colored"></textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <p class="form-text">AI training data: Final piece description</p>
        <textarea id="form-ai-training-final" name="ai-training-final"></textarea>
      </div>
    </div>
  </div>

  <hr />

  <div class="row">
    <div class="col">
      <div class="input-group">
        <input type="file" class="form-control" id="form-file" name="img_upload" required>
      </div>
      <div class="form-text"><a href="#" data-bs-toggle="modal" data-bs-target="#imgrequirements">View consistency requirements for exporting EMOHs for this database</a></div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col">
      <button type="submit" class="btn btn-success">Add EMOH</button>
    </div>
  </div>
</form>

<div class="modal fade" tabindex="-1" id="imgrequirements" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <?php include_once(__DIR__ . "/../../partials/img_requirements.php"); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
  var simplemdeAITrainingForm = new SimpleMDE({
    element: document.getElementById("form-ai-training-form"),
    toolbar: [],
    spellChecker: true
  });
  var simplemdeAITrainingColored = new SimpleMDE({
    element: document.getElementById("form-ai-training-colored"),
    toolbar: [],
    spellChecker: true
  });
  var simplemdeAITrainingFinal = new SimpleMDE({
    element: document.getElementById("form-ai-training-final"),
    toolbar: [],
    spellChecker: true
  });
</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>