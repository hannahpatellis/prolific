<?php

require_once(__DIR__ . "/../resources/db.php");

$stmt_rand_string = "SELECT * FROM pieces";
$result_rand = $mysqli -> query($stmt_rand_string);
$rows = $result_rand->fetch_all(MYSQLI_ASSOC);

print(count($rows));

?>