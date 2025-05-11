<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php print($page_title); ?> | Prolific by Hannah A. Patellis</title>
    <link href="/assets/css/style.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <meta name="apple-mobile-web-app-title" content="PROlific">
    <meta name="apple-mobile-web-app-capable" content="yes">
  </head>

  <body>
    <nav>
      <div id="nav-stage">
  
        <div id="nav-top">
          <div id="nav-left">
            <div class="nav-entry">
              <a href="/go/dashboard.php"><img id="profile-pic" src="/assets/img/hannah.jpg" /></a>
            </div>
            <div class="nav-entry" id="flag">
              Prolific
            </div>
          </div>

          <div id="nav-expand">
            <div id="nav-expand-icon" role="button">
              <img src="/assets/img/bars-light.svg" alt="Expand navigation" height="24px" width="auto">
            </div>
          </div>
        </div>

        <div id="nav-right">
          <a href="/go/gallery/grid.php" class="nav-link <?php if($active_page == "gallery") {print('nav-active" aria-current="page');} ?>">
            <div class="nav-entry">Gallery</div>
          </a>
          <a href="/go/cfa/index.php" class="nav-link <?php if($active_page == "cfa") {print('nav-active" aria-current="page');} ?>">
            <div class="nav-entry">Certified</div>
          </a>
          <?php if($_SESSION['isAdmin'] == true) { ?>
            <a href="/go/admin/index.php" class="nav-link <?php if($active_page == "admin") {print('nav-active" aria-current="page');} ?>">
              <div class="nav-entry">Admin</div>
            </a>
            <div class="nav-entry" id="nav-divider">
              |
            </div>
            <a href="/go/piece/new.php" class="nav-link <?php if($active_page == "newpiece") {print('nav-active" aria-current="page');} ?>">
              <div class="nav-entry">New piece</div>
            </a>
          <?php } ?>
        </div>
      </div>
    </nav>

    <div id="main">
      <div id="main-stage">



