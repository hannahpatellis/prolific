<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] != true) {
  header('Location: /go/login.php?error=forbidden');
}
if($_SESSION['isAdmin'] != true) {
  header('Location: /go/dashboard.php?error=forbidden');
}

$active_page = "admin";
$page_title = "New user";
require_once(__DIR__ . "/../../../partials/dash-header.php");

?>

<div class="row">
  <div class="col">
    <h1>Add a user</h1>
  </div>
</div>

<?php if(isset($_GET['status']) && $_GET['status'] == '201') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-success" role="alert">New user added successfully!</div>
    </div>
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == '500') { ?>
  <div class="row">
    <div class="col">
      <div class="alert alert-danger" role="alert">There was an error adding the new user<?php if($_GET['detail']) {print(": ".$_GET['detail']);}; ?></div>
    </div>
  </div>
<?php } ?>

<form action="/api/admin/user/new.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-Username" name="Username" placeholder="Username" required>
        <label for="form-Username">Username*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="email" class="form-control" id="form-Email" name="Email" placeholder="Email">
        <label for="form-Email">Email</label>
      </div>
    </div>
  </div> 

  <div class="row">
    <div class="col">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-FirstName" name="FirstName" placeholder="First name" required>
        <label for="form-FirstName">First name*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
       <input type="text" class="form-control" id="form-LastName" name="LastName" placeholder="Last name">
        <label for="form-LastName">Last name</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-floating">
        <input type="password" class="form-control" id="form-Password" name="Password" placeholder="Password" required>
        <label for="form-Password">Password*</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating">
        <input type="password" class="form-control" id="form-PasswordConfirmation" name="PasswordConfirmation" placeholder="Password (Confirmation)" required>
        <label for="form-PasswordConfirmation">Password (Confirmation)*</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-check form-switch">
        <input class="form-check-input" role="switch" type="checkbox" value="Isadmin" name="Isadmin" id="form-Isadmin">
        <label class="form-check-label" for="form-Isadmin">Administrator</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" role="switch" type="checkbox" value="Selectiononly" name="Selectiononly" id="form-Selectiononly" checked>
        <label class="form-check-label" for="form-Selectiononly">Selections only</label>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col">
      <button type="submit" class="btn btn-success">Add new user</button>
    </div>
  </div>
</form>

<?php require_once(__DIR__ . "/../../../partials/dash-footer.php"); ?>