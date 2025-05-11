<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

$active_page = "admin";
$page_title = "Administration";
require_once(__DIR__ . "/../../partials/dash-header.php");
require_once(__DIR__ . "/../../resources/db.php");

$stmt_user_list = "SELECT * FROM users ORDER BY id DESC";
$results_user_list = $mysqli -> query($stmt_user_list);
$users = $results_user_list->fetch_all(MYSQLI_ASSOC);

?>

<div class="row">
  <div class="col d-flex justify-content-between align-items-center">
    <h1>Administration</h1>
    <a href="/go/admin/user/new.php"><button type="button" class="btn btn-primary">New user</button></a>
  </div>
</div>

<div class="row">
  <div class="col">
    <table class="table table-striped table-hover align-middle" id="gallery-table-list">
      <tbody class="table-group-divider">
        <?php foreach($users as $user) { ?>
          <tr>
            <td><?php print($user['id']); ?></td>
            <td><?php print($user['username']); ?></td>
            <td><?php if($user['isAdmin']) {print("Administrator");} else {print("Visitor");} ?></td>
            <td><?php if($user['isAdmin']) {print("");} else { ?>
              <a href="/go/admin/user/edit.php?id="<?php print($user['id']); ?>"><button type="button" class="btn btn-warning">Edit user</button></a>  
              <a href="/go/admin/user/delete.php?id=<?php print($user['id']); ?>"><button type="button" class="btn btn-danger">Delete user</button></a>
            <?php } ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>