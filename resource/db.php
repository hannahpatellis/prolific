<?php

require_once("env.php");

$mysqli = mysqli_init();
if (!$mysqli) {
  die("mysqli_init failed");
}

$mysqli -> ssl_set(NULL, NULL, $env["sql_cert"], NULL, NULL);

if (!$mysqli -> real_connect($env['sql_uri'], $env['sql_user'], $env['sql_password'], "art", $env['sql_port'])) {
  die("Connect Error: " . mysqli_connect_error());
}

?>