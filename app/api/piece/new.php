<?php

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
  $prepared_dates = prepare_dates($_POST);
  $returnedFileUUID = process_image($_FILES, $env);

  if ($returnedFileUUID === false) {
    header("Location: /go/piece/new.php?status=500&detail=imageError");
    exit;
  }

  $new_piece = new Art\Pieces();
  $new_piece->fromArray([
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
    'Thumbnail'         => $returnedFileUUID,
  ]);
  $new_piece->save();
  header("Location: /go/piece/new.php?status=201");
  exit;
} else {
  header("Location: /go/piece/new.php?status=500&detail=notPOST");
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

function process_image($file, $env) {
  if (!isset($file["img_upload"]) || $file["img_upload"]["error"] !== UPLOAD_ERR_OK) {
    return false;
  }

  // Validate it is an actual image and get its MIME type
  $check = getimagesize($file["img_upload"]["tmp_name"]);
  if ($check === false) {
    return false;
  }

  // Allow only JPEG
  if (!in_array($check["mime"], ["image/jpeg", "image/jpg"])) {
    return false;
  }

  // Check file size
  if ($file["img_upload"]["size"] > 500000) {
    return false;
  }

  $new_img_name = uniqid();
  $target_dir = $env['img_store_path'];
  $target_file = $target_dir . $new_img_name . ".jpg";

  // Check if file already exists (uniqid collision guard)
  if (file_exists($target_file)) {
    return false;
  }

  // Set a maximum height and width
  $max_width = 1024;
  $max_height = 1024;

  list($width_orig, $height_orig) = getimagesize($file["img_upload"]["tmp_name"]);
  $ratio_orig = $width_orig / $height_orig;

  $width = $max_width;
  $height = $max_height;

  if ($width / $height > $ratio_orig) {
    $width = $height * $ratio_orig;
  } else {
    $height = $width / $ratio_orig;
  }

  // Resample and save
  $image_p = imagecreatetruecolor($width, $height);
  $image = imagecreatefromjpeg($file["img_upload"]["tmp_name"]);
  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
  imagejpeg($image_p, $target_file, 100);

  return $new_img_name;
}

?>
