<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}

require_once(__DIR__ . "/../../resources/db.php");
$stmt_get_img = "SELECT * FROM pieces WHERE id=$_GET[id]";
$result_get_img = $mysqli -> query($stmt_get_img);
$img = $result_get_img->fetch_all(MYSQLI_ASSOC);
$piece = $img[0];

$stmt_num = "SELECT * FROM pieces";
$result_num = $mysqli -> query($stmt_num);
$rows = $result_num->fetch_all(MYSQLI_ASSOC);
$total_pieces = count($rows);

$active_page = "gallery";
$page_title = $piece['title'];
require_once(__DIR__ . "/../../partials/dash-header.php");

require_once(__DIR__ . "/../../resources/env.php");

?>

<div id="show-stage">
    <div id="stage-img">
        <a href="/go/piece/stage.php?id=<?php print $piece['id'] - 1; ?>">
            <img class="stage-direction <?php if($piece['id'] == 1) { print("hidden"); } ?>" id="direction-left" src="/assets/img/square-chevron-left.svg" height="50px" />
        </a>
        <a href="/go/piece/view.php?id=<?php print $piece['id']; ?>">
            <img src="<?php print($env['img_store_url']); print($piece['thumbnail']); ?>.jpg" />
        </a>
        <a href="/go/piece/stage.php?id=<?php print $piece['id'] + 1; ?>">
            <img class="stage-direction <?php if($total_pieces == $piece['id']) { print("hidden"); } ?>" id="direction-right" src="/assets/img/square-chevron-right.svg" height="50px" />
        </a>
    </div>
    <div id="stage-desc">   
        <h1 class="d-flex justify-content-between align-items-center"><?php print($piece['title']); ?><span class="badge text-bg-primary rounded-pill">#<?php print($piece['id']); ?></span></h1>
    </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>