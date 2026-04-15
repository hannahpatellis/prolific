<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
  exit;
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
  exit;
}

require_once __DIR__ . '/../../resources/csrf.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../resources/orm/config.php';

csrf_verify();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $piece_id = (int) $_POST['id'];
  $prepared_dates = prepare_dates($_POST);

  $piece = Art\PiecesQuery::create()->findPK($piece_id);

  if ($piece === null) {
    header("Location: /go/piece/edit.php?id=" . $piece_id . "&status=500&detail=notFound");
    exit;
  }

  $piece->fromArray([
    'Title'             => $_POST['title'] ?? '',
    'StartDate'         => $prepared_dates[0],
    'EndDate'           => $prepared_dates[1],
    'Collection'        => $_POST['collection'] ?? '',
    'Subcollection'     => $_POST['subcollection'] ?? '',
    'SizeHeight'        => $_POST['size-height'] ?? '',
    'SizeWidth'         => $_POST['size-width'] ?? '',
    'SizeUnit'          => $_POST['size-unit'] ?? '',
    'Location'          => $_POST['location'] ?? '',
    'Temperature'       => $_POST['temperature'] ?? '',
    'Background'        => $_POST['background'] ?? '',
    'Colors'            => $_POST['colors'] ?? '',
    'Description'       => $_POST['description'] ?? '',
    'Story'             => $_POST['story'] ?? '',
    'Notes'             => $_POST['notes'] ?? '',
    'AITrainingForm'    => $_POST['ai-training-form'] ?? '',
    'AITrainingColored' => $_POST['ai-training-colored'] ?? '',
    'AITrainingFinal'   => $_POST['ai-training-final'] ?? '',
  ]);
  $piece->save();
  header("Location: /go/piece/edit.php?id=" . $piece_id . "&status=201");
  exit;
} else {
  header("Location: /go/dashboard.php?status=500&detail=notPOST");
  exit;
}

function prepare_dates($raw_post) {
  $final_end_date = $raw_post["end-year"];
  if(!empty($raw_post["end-month"])) {
    $final_end_date .= "-" . $raw_post["end-month"];
    if(!empty($raw_post["end-day"])) {
      $final_end_date .= "-" . $raw_post["end-day"];
    }
  }
  $final_start_date = $raw_post["start-year"] ?? '';
  if(!empty($raw_post["start-month"])) {
    $final_start_date .= "-" . $raw_post["start-month"];
    if(!empty($raw_post["start-day"])) {
      $final_start_date .= "-" . $raw_post["start-day"];
    }
  }
  return array($final_start_date, $final_end_date);
}

?>
