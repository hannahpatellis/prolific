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

?>

<div class="row">
  <div class="col">
    <h1 class="d-flex justify-content-between align-items-center">Welcome!<span class="badge text-bg-primary rounded-pill"><?php print(count($rows)); ?> total pieces</span></h1>
  </div>
</div>

<hr /> 

<div class="row">
  <div class="col">
    <h2 class="mb-4">Last added</h2>
    <a href="/page/piece.php?id=<?php print($last[0]['id']); ?>">
      <img class="piece" src="/img_store/<?php print($last[0]['thumbnail']); ?>.jpg" width="100%" height="auto" />
    </a>
  </div>
  <div class="col">
    <h2 class="mb-4">Random</h2>
    <a href="/page/piece.php?id=<?php print($random['id']); ?>">
      <img class="piece" src="/img_store/<?php print($random['thumbnail']); ?>.jpg" width="100%" height="auto" />
    </a>
  </div>
</div>

<?php require_once("../partial/dash-footer.php"); ?>