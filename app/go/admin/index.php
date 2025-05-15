<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../resources/orm/config.php';

$query = new Art\UsersQuery();
$users = $query->find()->toArray();

$active_page = "admin";
$page_title = "Administration";
require_once(__DIR__ . "/../../partials/dash-header.php");

?>

<div class="row">
  <div class="col d-flex justify-content-between align-items-center">
    <h1>Administration</h1>
    <a href="/go/admin/user/new.php"><button type="button" class="btn btn-primary">New user</button></a>
  </div>
</div>

<div class="row">
  <div class="col">
    <table class="table table-dark table-striped table-hover align-middle table-responsive-sm">
      <tbody>
        <tr>
            <th>Username</th>
            <th>User type</th>
            <th>Actions</th>
          </tr>
        <?php foreach($users as $user) { ?>
          <tr>
            <td><?php print($user['Username']); ?></td>
            <td><?php if($user['Isadmin']) {print("Administrator");} else {print("Visitor");} ?></td>
            <td><?php if($user['Isadmin']) { ?>
              <button type="button" class="btn btn-dark" disabled>Edit user</button>
              <button type="button" class="btn btn-dark" disabled>Delete user</button>
            <?php } else { ?>
              <a href="/go/admin/user/edit.php?id=<?php print($user['Id']); ?>"><button type="button" class="btn btn-warning">Edit user</button></a>  
              <a href="/go/admin/user/delete.php?id=<?php print($user['Id']); ?>"><button type="button" class="btn btn-outline-danger">Delete user</button></a>
            <?php } ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>