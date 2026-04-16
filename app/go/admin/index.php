<?php

// session_start();
// if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
//   header('Location: /go/login.php?error=forbidden');
//   exit;
// }
// if($_SESSION['isAdmin'] != true) {
//   header('Location: /go/dashboard.php?error=forbidden');
//   exit;
// }

$adminRequired = true;
require_once __DIR__ . '/../../resources/permissions.php';

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
    <h1>User administration</h1>
    <a href="/go/admin/user/new.php"><button type="button" class="btn btn-success">New user</button></a>
  </div>
</div>

<?php if(isset($_GET['status']) && $_GET['status'] == '200') { ?>
  <div class="row">
    <div class="col">
      <?php if(isset($_GET['detail']) && $_GET['detail'] == 'deleteSuccess') { ?>
        <div class="alert alert-success" role="alert">User deleted successfully.</div>
      <?php } ?>
    </div>
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == '500') { ?>
  <div class="row">
    <div class="col">
      <?php if(isset($_GET['detail']) && $_GET['detail'] == 'deleteUserNotFound') { ?>
        <div class="alert alert-danger" role="alert">There was an error deleting the user<?php if($_GET['detail']) {print(": " . htmlspecialchars($_GET['detail'], ENT_QUOTES, 'UTF-8'));}; ?></div>
      <?php } ?>
    </div>
  </div>
<?php } ?>

<div class="row">
  <div class="col">
    <table class="table table-dark table-striped table-hover align-middle table-responsive-sm">
      <tbody>
        <tr>
            <th>Username</th>
            <th>Display name</th>
            <th>User type</th>
            <th></th>
          </tr>
        <?php foreach($users as $user) { ?>
          <tr>
            <td><?php print($user['Username']); ?></td>
            <td><?php print($user['FirstName'] . ' ' . $user['LastName']); ?></td>
            <td><?php if($user['Isadmin']) {print("Administrator");} else {print("Visitor");} ?></td>
            <td><?php if($user['Isadmin']) { } else {?>
              <a href="/go/admin/user/edit.php?id=<?php print($user['Id']); ?>">
                <svg id="icn-edit" class="me-2" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512" height="16px" width="auto">
                  <path class="icn-std" d="M383.1,448H63.1V128h156.1l64-64H63.1C28.65,64,0,92.65,0,128v320c0,35.35,28.65,64,63.1,64h319.1c35.34,0,63.1-28.65,63.1-64v-220.1s-63.1,63.99-63.1,63.99v156.11h.9ZM497.9,42.19l-28.13-28.14c-18.75-18.75-49.14-18.75-67.88,0l-38.62,38.63,96.01,96.01,38.62-38.63c18.8-18.73,18.8-49.12,0-67.87ZM147.3,274.4l-19.04,95.22c-1.68,8.4,5.73,15.8,14.12,14.12l95.23-19.04c4.65-.93,8.91-3.21,12.26-6.56l186.8-186.8-96.01-96.01-186.86,186.87c-3.3,3.3-5.6,7.6-6.5,12.2Z"/>
                </svg>
              </a>  
              <a href="/go/admin/user/delete.php?id=<?php print($user['Id']); ?>">
                <svg id="icn-delete" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 448 512" height="16px" width="auto">
                  <path class="icn-std" d="M53.21,467c1.56,24.84,23.02,45,47.9,45h245.8c24.88,0,46.33-20.16,47.9-45l21.19-339H32l21.21,339ZM432,32h-112l-11.58-23.16C305.71,3.42,300.17,0,294.11,0h-140.21c-6.06,0-11.6,3.42-14.31,8.84l-11.59,23.16H16C7.16,32,0,39.16,0,48v32c0,8.84,7.16,16,16,16h416c8.84,0,16-7.16,16-16v-32c0-8.84-7.2-16-16-16Z"/>
                </svg>
              </a>
            <?php } ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once(__DIR__ . "/../../partials/dash-footer.php"); ?>