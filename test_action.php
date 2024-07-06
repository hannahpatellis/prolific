<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$env['img_store_location'] = '/Users/hannah/git/prolific/test/';

$identifier = process_image($_FILES, $env);

print($identifier);


function process_image($file, $env) {
  $new_img_name = uniqid();
  $target_dir = $env['img_store_location'];
  $target_file = $target_dir . basename($new_img_name.".jpg");
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($file["img_upload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($file["img_upload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG/JPEG files are allowed.";
    $uploadOk = 0;
  }

  // Set a maximum height and width
  $width = 1024;
  $height = 1024;

  list($width_orig, $height_orig) = getimagesize($file["img_upload"]["tmp_name"]);

  $ratio_orig = $width_orig/$height_orig;

  if ($width/$height > $ratio_orig) {
    $width = $height*$ratio_orig;
  } else {
    $height = $width/$ratio_orig;
  }

  // Resample
  $image_p = imagecreatetruecolor($width, $height);
  $image = imagecreatefromjpeg($file["img_upload"]["tmp_name"]);
  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

  // Output/save
  imagejpeg($image_p, $target_file, 100);

  return $new_img_name;
}

?>