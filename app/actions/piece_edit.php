<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

require_once(__DIR__ . "/../resources/db.php");
require_once(__DIR__ . "/../resources/env.php");

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
  array("ai-training-form","ai_training_form",false,false),
  array("ai-training-colored","ai_training_colored",false,false),
  array("ai-training-final","ai_training_final",false,false),
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $piece_id = $_POST['id'];
  $prepared_dates = prepare_dates($_POST);
  $stmt_string = prepare_query(strip_sql_array($map), $piece_id);
  $stmt = $mysqli->prepare($stmt_string);
  $stmt->bind_param("sssssssssssssssssss", $_POST["title"], $prepared_dates[0], $prepared_dates[1], $_POST["collection"], $_POST["subcollection"], $_POST["size-height"], $_POST["size-width"], $_POST["size-unit"], $_POST["location"], $_POST["temperature"], $_POST["background"], $_POST["colors"], $_POST["description"], $_POST["story"], $_POST["notes"], $_POST["ai-training-form"], $_POST["ai-training-colored"], $_POST["ai-training-final"], $_POST["id"]);
  $stmt->execute();
  array_push($errors, $mysqli->error_list);
  $stmt->close();
  $mysqli->close();
  header("Location: /go/piece/edit.php?id=" . $piece_id . "&status=201");
} else {
  // array_push($errors, "The request method was not POST");
  header("Location: /go/piece/edit.php?id=" . $piece_id . "&status=500&detail=notPOST");
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
function prepare_query($stripped_sql_array, $piece_id) {
  $stmt_string = "UPDATE pieces SET ";
  for($int = 0; $int < count($stripped_sql_array); $int++) {
    if($int == count($stripped_sql_array) - 1) {
      $stmt_string = $stmt_string . $stripped_sql_array[$int] . " = ? ";
    }
    else {
      $stmt_string = $stmt_string . $stripped_sql_array[$int] . " = ?, ";
    }
  }
  $stmt_string = $stmt_string . " WHERE id = ?";
  return $stmt_string;
}

?>