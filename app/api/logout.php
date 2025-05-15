<?php

session_start();
session_unset();
session_destroy();

header('Location: /go/login.php?status=logout_success');

?>