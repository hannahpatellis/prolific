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

<div id="dash-note">
  <h1 id="welcome">Create — and every single time, spend it all.</h1>
</div>

<div id="dash-counter">
  <span class="badge text-bg-primary rounded-pill"><?php print(count($rows)); ?> total pieces</span>
</div> 

<?php require_once("../partial/dash-footer.php"); ?>