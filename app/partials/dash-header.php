<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php print($page_title); ?> | Prolific by Hannah A. Patellis</title>
    <link href="/assets/css/style.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="/favicon-96x96.png?v=20260411" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg?v=20260411" />
    <link rel="shortcut icon" href="/favicon.ico?v=20260411" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=20260411" />
    <meta name="apple-mobile-web-app-title" content="Prolific" />
    <link rel="manifest" href="/site.webmanifest?v=20260411" />


    <script async src="https://ana-ab.hannahap.com/js/pa-yPvUntvFx2ARGk6qXeLci.js"></script>
    <script>window.plausible=window.plausible||function(){(plausible.q=plausible.q||[]).push(arguments)},plausible.init=plausible.init||function(i){plausible.o=i||{}};
    plausible.init()</script>
  </head>

  <body>
    <nav>
      <div id="nav-stage">
  
        <div id="nav-top">
          <div id="nav-left">
            <!-- <div class="nav-entry">
              <a href="/go/dashboard.php"><img id="profile-pic" src="/assets/img/logo.png" /></a>
            </div> -->
            <div class="nav-entry" id="flag">
              <a href="/go/dashboard.php">Prolific</a>
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
          <?php if($_SESSION['isAdmin'] == true) { ?>
            <a href="/go/cfa/index.php" class="nav-link <?php if($active_page == "cfa") {print('nav-active" aria-current="page');} ?>">
              <div class="nav-entry">CFA Records</div>
            </a>
            <a href="/go/training/gallery.php" class="nav-link <?php if($active_page == "training") {print('nav-active" aria-current="page');} ?>">
              <div class="nav-entry">AI Training</div>
            </a>
            <a href="/go/admin/index.php" class="nav-link <?php if($active_page == "admin") {print('nav-active" aria-current="page');} ?>">
              <div class="nav-entry">Administration</div>
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
      <?php if($page_title != "Stage") { ?><div id="main-stage"><?php } ?>



