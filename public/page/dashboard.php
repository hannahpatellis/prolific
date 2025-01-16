<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
}

$active_page = "dashboard";
$page_title = "Dashboard";
require_once("../partial/dash-header.php");
require_once("../resource/db.php");

$stmt_rand_string = "SELECT * FROM pieces";
$result_rand = $mysqli -> query($stmt_rand_string);
$rows = $result_rand->fetch_all(MYSQLI_ASSOC);

$random_index = array_rand($rows);
$random = $rows[$random_index];

$stmt_last_string = "SELECT * FROM pieces ORDER BY ID DESC LIMIT 1";
$result_last = $mysqli -> query($stmt_last_string);
$last = $result_last->fetch_all(MYSQLI_ASSOC);

require_once("../resource/env.php");
if($env['environment'] == 'dev') {
  $img_store_location = '/img_store/';
} else if($env['environment'] == 'prod') {
  $img_store_location = 'https://fs.hannahap.com/img_store/';
}

?>

<div class="row">
  <div class="col">
    <h1 id="welcome" class="d-flex justify-content-between align-items-center">Create and spend it all — every time.<span class="badge text-bg-primary rounded-pill"><?php print(count($rows)); ?> total pieces</span></h1>
  </div>
</div>

<?php require_once("../partial/dash-footer.php"); ?>