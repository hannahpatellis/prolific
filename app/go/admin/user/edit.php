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

require_once __DIR__ . '/../../../resources/csrf.php';
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../resources/orm/config.php';

$query = new Art\UsersQuery();
$user = $query->findPK($_GET['id'])->toArray();

$active_page = "admin";
$page_title = "Edit user: " . $user['Username'];
require_once(__DIR__ . "/../../../partials/dash-header.php");

?>
<div class="row justify-content-center"><div class="col-md-8 col-sm-12">
<div class="row">
  <div class="col d-flex align-items-center">
    <h1>Edit user: <?php print(h($user['Username'])); ?></h1>
  </div>
</div>

<?php if(isset($_GET['status']) && $_GET['status'] == '200') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-success" role="alert">Updated this user successfully!</div>
    </div>
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == '500') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger" role="alert">There was an error updating the user<?php if($_GET['detail']) {print(": " . h($_GET['detail']));}; ?></div>
    </div>
  </div>
<?php } ?>

<form action="/api/admin/user/edit.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-Username" name="Username" placeholder="Username" required value="<?php print(h($user['Username'])) ?>">
        <label for="form-Username">Username*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="email" class="form-control" id="form-Email" name="Email" placeholder="Email" value="<?php print(h($user['Email'])) ?>">
        <label for="form-Email">Email</label>
      </div>
    </div>
  </div> 

  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-FirstName" name="FirstName" placeholder="First name" required value="<?php print(h($user['FirstName'])) ?>">
        <label for="form-FirstName">First name*</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-LastName" name="LastName" placeholder="Last name" value="<?php print(h($user['LastName'])) ?>">
        <label for="form-LastName">Last name</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="password" class="form-control" id="form-Password" name="Password" placeholder="Password">
        <label for="form-Password">Password</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-floating">
        <input type="password" class="form-control" id="form-PasswordConfirmation" name="PasswordConfirmation" placeholder="Password (Confirmation)">
        <label for="form-PasswordConfirmation">Password (Confirmation)</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-check form-switch">
        <input class="form-check-input" role="switch" type="checkbox" value="Isadmin" name="Isadmin" id="form-Isadmin" <?php if($user['Isadmin']) {echo 'checked';} ?>>
        <label class="form-check-label" for="form-Isadmin">Administrator</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" role="switch" type="checkbox" value="Selectiononly" name="Selectiononly" id="form-Selectiononly" <?php if($user['Selectiononly']) {echo 'checked';} ?>>
        <label class="form-check-label" for="form-Selectiononly">Selections only</label>
      </div>
    </div>
  </div>

  <input type="hidden" id="form-id" name="Id" value="<?php print((int)$user['Id']); ?>">

  <div class="row mb-4">
    <div class="col">
      <button type="submit" class="btn btn-warning">Update user</button>
    </div>
  </div>
</form>
</div></div>

<?php 

require_once(__DIR__ . "/../../../partials/beforeunload.js.php");
require_once(__DIR__ . "/../../../partials/dash-footer.php");

?>