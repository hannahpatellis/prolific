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
  <div class="col">
    <h1>Delete the user "<?php print($user['Username']); ?>"?</h1>
    <p>Please confirm you wish to delete the user "<?php print($user['Username']); ?>." This cannot be undone.</p>
    <hr />
    <div>
      <a href="/api/admin/user/delete.php?id=<?php print($user['Id']); ?>"><button type="button" class="btn btn-danger" id="delete-user">Delete user</button></a>
      <a href="/go/admin/user/edit.php?id=<?php print($user['Id']); ?>"><button type="button" class="btn btn-outline-primary" id="delete-user">Go back</button></a>
    </div>
  </div>
</div>

<?php require_once(__DIR__ . "/../../../partials/dash-footer.php"); ?>