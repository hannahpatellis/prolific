<?php

$dotENV = json_decode(require_once("env.json"), true);

print_r($dotENV);


session_start();

if($_SESSION['active']) {
  print("active session");
} else {
  print("not active session");
}

include_once("../partials/head.php");

print("<h1>Hi</h1>");

include_once("../partials/footer.php");

?>