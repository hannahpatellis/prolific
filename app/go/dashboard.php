<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../resources/orm/config.php';

$query = new Art\PiecesQuery();
$total_pieces = $query->count();

$active_page = "dashboard";
$page_title = "Dashboard";
require_once(__DIR__ . "/../partials/dash-header.php");

?>

<?php if(isset($_GET['error']) && $_GET['error'] == 'forbidden') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger" role="alert">Sorry, you do not have permission to complete that action</div>
    </div>
  </div>
<?php } ?>

<div id="dash-note">
  <h1 id="welcome">Create — and every single time, spend it all.</h1>
</div>

<div id="dash-counter">
  <span class="badge text-bg-primary rounded-pill"><?php print($total_pieces); ?> total pieces</span>
</div> 

<?php require_once(__DIR__ . "/../partials/dash-footer.php"); ?>