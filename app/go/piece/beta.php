<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../resources/orm/config.php';

$query = new Art\PiecesQuery();
$piece = $query->findPK($_GET['id'])->toArray();
$pieces = $query->find()->toArray();
$total_pieces = count($pieces);

$active_page = "gallery";
$page_title = $piece['Title'];
require_once(__DIR__ . "/../../resources/env.php");
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div id="show-stage">
    <div id="stage-img">
        <a href="/go/piece/stage.php?id=<?php print $piece['Id'] - 1; ?>">
            <img class="stage-direction <?php if($piece['Id'] == 1) { print("hidden"); } ?>" id="direction-left" src="/assets/img/square-chevron-left.svg" height="50px" />
        </a>
        <a href="/go/piece/view.php?id=<?php print $piece['Id']; ?>">
            <img id="stage-image" src="<?php print($env['img_store_url']); print($piece['Thumbnail']); ?>.jpg" />
        </a>
        <a href="/go/piece/stage.php?id=<?php print $piece['Id'] + 1; ?>">
            <img class="stage-direction <?php if($total_pieces == $piece['Id']) { print("hidden"); } ?>" id="direction-right" src="/assets/img/square-chevron-right.svg" height="50px" />
        </a>
    </div>
    <div id="stage-desc">   
        <h1 class="d-flex justify-content-between align-items-center"><?php print($piece['Title']); ?><span class="badge text-bg-primary rounded-pill">#<?php print($piece['Id']); ?></span></h1>
    </div>
</div>

<script type="text/javascript" src="/assets/js/list.min.2.3.1.js"></script>
<script type="text/javascript">

</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>