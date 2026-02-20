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

<link type="text/css" rel="stylesheet" href="/assets/css/lightgallery-bundle.css" />

<div id="show-stage">
    <div id="stage-img">
        <div id="inline-gallery-container"></div>
    </div>
    <div id="stage-desc">   
 
    </div>
</div>

<script type="text/javascript" src="js/lightgallery.min.js"></script>

<script type="text/javascript">

const lgContainer = document.getElementById('inline-gallery-container');
const inlineGallery = lightGallery(lgContainer, {
    container: lgContainer,
    dynamic: true,
    closable: false,
    showMaximizeIcon: true,
    appendSubHtmlTo: '.lg-item',
    slideDelay: 400,
    dynamicEl: [
        {
            src: 'https://fs.hannahap.com/img_store/<?php print($piece['Thumbnail'];) ?>.jpg',
            thumb: 'https://fs.hannahap.com/img_store/<?php print($piece['Thumbnail'];) ?>.jpgh',
            subHtml: `<div class="lightGallery-captions">
                <h4>Caption 1</h4>
                <p>Description of the slide 1</p>
            </div>`,
        },
        {
            src: 'img/img2.jpg',
            thumb: 'img/thumb2.jpg',
            subHtml: `<div class="lightGallery-captions">
                <h4>Caption 2</h4>
                <p>Description of the slide 2</p>
            </div>`,
        },
        ...
    ],
});

inlineGallery.openGallery();

</script>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>