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

require_once(__DIR__ . "/../../resources/db.php");
require_once(__DIR__ . "/../../resources/env.php");

$errors = array();
$switch_exports = 0;
$switch_descriptions = 0;

print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $piece_id = $_POST['id'];
  if (isset($_POST["switch-exports"])) { $switch_exports = 1; }
  if (isset($_POST["switch-desc"])) { $switch_descriptions = 1; }
  $stmt_string = "UPDATE pieces SET ai_training_form = ?, ai_training_colored = ?, ai_training_final = ?, training_exports = ?, training_descriptions = ? WHERE id = " . $piece_id . ";";
  print_r("exports" . $switch_exports);
  print_r("desc" . $switch_descriptions);
  $stmt = $mysqli->prepare($stmt_string);
  $stmt->bind_param("sssss", $_POST["ai-training-form"], $_POST["ai-training-colored"], $_POST["ai-training-final"], $switch_exports, $switch_descriptions);
  $stmt->execute();
  array_push($errors, $mysqli->error_list);
  $stmt->close();
  $mysqli->close();
  header("Location: /go/training/gallery.php?status=201");
} else {
  array_push($errors, "The request method was not POST");
  header("Location: /go/training/gallery.php?&status=500&detail=notPOST");
}

?>