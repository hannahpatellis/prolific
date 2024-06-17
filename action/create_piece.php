<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../resource/db.php");

$errors = array();

// HTML name, SQL field, required?, needs formatting?
$map = array (
  array("title","title",true,false),
  array("start-year","start_date",false,true),
  array("start-month","start_date",false,true),
  array("start-day","start_date",false,true),
  array("end-year","end_date",true,true),
  array("end-month","end_date",false,true),
  array("end-day","end_date",false,true),
  array("collection","collection",true,false),
  array("subcollection","subcollection",false,false),
  array("size-height","size_height",true,false),
  array("size-width","size_width",true,false),
  array("size-unit","size_unit",true,false),
  array("location","location",false,false),
  array("temperature","temperature",true,false),
  array("background","background",true,false),
  array("colors","colors",false,false),
  array("description","description",false,false),
  array("story","story",false,false),
  array("notes","notes",false,false),
  array("file","thumbnail",false,true)
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $prepared_dates = prepare_dates($_POST);
  $returnedFileUUID = process_image($_FILES);
  $stmt_string = prepare_query(strip_sql_array($map));
  $stmt = $mysqli->prepare($stmt_string);
  $stmt->bind_param("ssssssssssssssss", $_POST["title"], $prepared_dates[0], $prepared_dates[1], $_POST["collection"], $_POST["subcollection"], $_POST["size-height"], $_POST["size-width"], $_POST["size-unit"], $_POST["location"], $_POST["temperature"], $_POST["background"], $_POST["colors"], $_POST["description"], $_POST["story"], $_POST["notes"], $returnedFileUUID);
  $stmt->execute();
  array_push($errors, $mysqli->error_list);
  $stmt->close();
  $mysqli->close();
  header("Location: /page/add.php?status=201");
} else {
  // array_push($errors, "The request method was not POST");
  header("Location: /page/add.php?status=500&detail=notPOST");
}

function strip_html_array($input_array) {
  $stripped_array = array();
  for($int = 0; $int < count($input_array); $int++) {
    array_push($stripped_array, $input_array[$int][0]);
  }
  return $stripped_array;
}
function strip_sql_array($input_array) {
  $stripped_array = array();
  for($int = 0; $int < count($input_array); $int++) {
    if(!in_array($input_array[$int][1], $stripped_array)) {
      array_push($stripped_array, $input_array[$int][1]);
    }
  }
  return $stripped_array;
}
function strip_post_array($input_array) {
  $stripped_array = array();
  foreach($input_array as $key => $value) {
    array_push($stripped_array, $key);
  }
  return $stripped_array;
}
function prepare_dates($raw_post) {
  $final_end_date = $raw_post["end-year"];
  if($raw_post["end-month"]) {
    $final_end_date = $final_end_date . "-" . $raw_post["end-month"];
    if($raw_post["end-day"]) {
      $final_end_date = $final_end_date . "-" . $raw_post["end-day"];
    }
  }
  $final_start_date = $raw_post["start-year"];
  if($raw_post["start-month"]) {
    $final_start_date = $final_start_date . "-" . $raw_post["start-month"];
    if($raw_post["start-day"]) {
      $final_start_date = $final_start_date . "-" . $raw_post["start-day"];
    }
  }
  return array($final_start_date, $final_end_date);
}
function prepare_query($stripped_sql_array) {
  $stmt_string = "INSERT INTO pieces (";
  for($int = 0; $int < count($stripped_sql_array); $int++) {
    if($int == 0) {
      $stmt_string = $stmt_string . $stripped_sql_array[$int];
    }
    else {
      $stmt_string = $stmt_string . "," . $stripped_sql_array[$int];
    }
  }
  $stmt_string = $stmt_string . ") VALUES (";
  for($int = 0; $int < count($stripped_sql_array); $int++) {
    if($int == 0) {
      $stmt_string = $stmt_string . "?";
    }
    else {
      $stmt_string = $stmt_string . ",?";
    }
  }
  $stmt_string = $stmt_string . ")";
  return $stmt_string;
}
function process_image($file) {
  $new_img_name = uniqid();
  $target_dir = "../img_store/";
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