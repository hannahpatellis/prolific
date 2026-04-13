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

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../resources/orm/config.php';

$query = new Art\UsersQuery();
$user = $query->findPK($_GET['id'])->toArray();

$active_page = "admin";
$page_title = "Delete user: " . $user['Username'];
require_once(__DIR__ . "/../../../partials/dash-header.php");

?>

<div class="row">
  <div class="col d-flex align-items-center">
    <h1>Delete "<?php print($user['Username']); ?>"?</h1>
  </div>
</div>

<?php require_once(__DIR__ . "/../../../partials/dash-footer.php"); ?>