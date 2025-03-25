<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: login.php?error=forbidden');
}

require_once("../resource/db.php");
$stmt_get_img = "SELECT * FROM pieces WHERE id=$_GET[id]";
$result_get_img = $mysqli -> query($stmt_get_img);
$img = $result_get_img->fetch_all(MYSQLI_ASSOC);
$piece = $img[0];

require_once("../resource/db.php");

$stmt_num = "SELECT * FROM pieces";
$result_num = $mysqli -> query($stmt_num);
$rows = $result_num->fetch_all(MYSQLI_ASSOC);
$total_pieces = count($rows);

$active_page = "gallery";
$page_title = $piece['title'];
require_once("../partial/dash-header.php");

require_once("../resource/env.php");
if($env['environment'] == 'dev') {
  $img_store_location = 'https://fs.hannahap.com/img_store/';
} else if($env['environment'] == 'prod') {
  $img_store_location = 'https://fs.hannahap.com/img_store/';
}

?>

<div id="show-stage">
    <div id="stage-img">
        <a href="show_stage.php?id=<?php print $piece['id'] - 1; ?>">
            <img class="stage-direction <?php if($piece['id'] == 1) { print("hidden"); } ?>" id="direction-left" src="../asset/img/square-chevron-left.svg" height="50px" />
        </a>
        <a href="piece_view.php?id=<?php print $piece['id']; ?>">
            <img src="<?php print($img_store_location); print($piece['thumbnail']); ?>.jpg" />
        </a>
        <a href="show_stage.php?id=<?php print $piece['id'] + 1; ?>">
            <img class="stage-direction <?php if($total_pieces == $piece['id']) { print("hidden"); } ?>" id="direction-right" src="../asset/img/square-chevron-right.svg" height="50px" />
        </a>
    </div>
    <div id="stage-desc">   
        <h1 class="d-flex justify-content-between align-items-center"><?php print($piece['title']); ?><span class="badge text-bg-primary rounded-pill">#<?php print($piece['id']); ?></span></h1>
    </div>
</div>

<?php require_once("../partial/dash-footer.php"); ?>