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
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Prolific" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="theme-color" content="#beb5ad" />
    <link rel="manifest" href="/site.webmanifest?v=20260411" />
    <script>if ('serviceWorker' in navigator) { navigator.serviceWorker.register('/sw.js'); }</script>


    <script async src="https://ana-ab.hannahap.com/js/pa-yPvUntvFx2ARGk6qXeLci.js"></script>
    <script>window.plausible=window.plausible||function(){(plausible.q=plausible.q||[]).push(arguments)},plausible.init=plausible.init||function(i){plausible.o=i||{}};
    plausible.init()</script>
  </head>

  <body>
    <nav>
      <div id="nav-stage">
  
        <div id="nav-top">
          <div id="nav-left">
            <div class="nav-entry">
              <a href="/go/dashboard.php">
                <svg id="icn-logo" class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" width="40px" height="40px">
                  <path class="icn-std" d="M512,136.05c-205.84,0-373.3,168.65-373.3,375.95s167.46,375.94,373.3,375.94,373.3-168.65,373.3-375.94-167.46-375.95-373.3-375.95ZM686.65,757.93l-63.46-.08c6.24-42.84-7.65-74.15-26.9-106.33-19.99-33.42-46.86-63.27-80.36-86.73-1.78,9.53-3.58,18.93-5.37,28.04-4.44,22.66-12.4,56.91-29.87,88.8-21.21,38.73-52.82,63.22-93.93,72.81-9.34,2.18-19.22,3.28-29.35,3.28-26.77,0-54.26-7.78-77.41-21.92-25.73-15.71-45.3-38.58-56.6-66.12-17.72-43.21-10.81-82.52-1.89-107.89,11.1-31.57,29.4-54.86,42.83-66.13,13.42-11.26,28.42-20.34,44.56-26.97,15.95-6.55,33.14-10.77,51.11-12.54,34.39-3.39,69,1.17,106.81,15.15,9.61-59.11,27.01-179.76,29.53-196.72h63.63c-2.45,16.53-24.12,157.62-33.69,225.42,38.88,23.32,73.71,53.91,101.1,89.03,6.25,8.02,12.09,16.23,17.44,24.53l51.14-338.98h63.22l-72.54,483.35Z"/>
                  <path class="icn-std" d="M512,12C236.3,12,12,236.3,12,512s224.3,500,500,500,500-224.3,500-500S787.7,12,512,12ZM512,949.08c-241,0-437.07-196.07-437.07-437.08S270.99,74.92,512,74.92s437.08,196.07,437.08,437.08-196.07,437.08-437.08,437.08Z"/>
                  <path class="icn-std" d="M338.54,522.88c-12.9,4.37-24.62,10.92-34.82,19.49-7.06,5.92-17.59,20.43-24.05,38.3-5.7,15.77-10.26,40.01.35,65.88,7.44,18.14,21.82,32.98,40.49,41.78,17.01,8.02,36.08,10.45,52.33,6.66,23.61-5.5,41.18-19.1,53.7-41.55,11.58-20.77,17.77-47.04,22.72-72.33,3.05-15.57,6.06-31.55,8.95-47.54-27.24-11.44-53.42-17.24-77.88-17.24-14.9,0-28.96,2.2-41.8,6.55Z"/>
                </svg>
              </a>
            </div>
            <div class="nav-entry serif" id="flag">
              <a href="/go/dashboard.php">Prolific</a>
            </div>
          </div>

          <div id="nav-expand">
            <div id="nav-expand-icon" role="button">
              <svg id="icn-nav-bars" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 448 512" height="24px" width="auto">
                <path class="icn-std" d="M416,224H31.1c-16.8,0-31.1,14.3-31.1,32s14.3,32,31.1,32h384c18.6,0,32.9-14.3,32.9-32s-14.3-32-32-32ZM416,384H31.1c-16.8,0-31.1,14.3-31.1,31.1s14.3,32.9,31.1,32.9h384c18.6,0,32.9-14.3,32.9-32s-14.3-32-32-32ZM416,64H31.1c-16.8,0-31.1,14.3-31.1,31.1s14.3,32.9,31.1,32.9h384c18.6,0,32.9-14.3,32.9-32s-14.3-32-32-32Z"/>
              </svg>
            </div>
          </div>
        </div>

        <div id="nav-right">
          <a href="/go/gallery/grid.php" class="nav-link <?php if($active_page == "gallery") {print('nav-active" aria-current="page');} ?>">
            <div class="nav-entry">Gallery</div>
          </a>
          <?php if($_SESSION['isAdmin'] == true) { ?>
            <a href="/go/cfa/index.php" class="nav-link <?php if($active_page == "cfa") {print('nav-active" aria-current="page');} ?>">
              <div class="nav-entry">CFA</div>
            </a>
            <a href="/go/training/gallery.php" class="nav-link <?php if($active_page == "training") {print('nav-active" aria-current="page');} ?>">
              <div class="nav-entry">AI Training</div>
            </a>
            <a href="/go/admin/index.php" class="nav-link <?php if($active_page == "admin") {print('nav-active" aria-current="page');} ?>">
              <div class="nav-entry">Admin</div>
            </a>
            <a href="/go/piece/new.php" class="nav-link">
              <div class="nav-entry">
                <svg id="icn-new-emoh" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 603.31 448" height="24px" width="auto">
                  <path class="icn-std" d="M603.31,224.01c0-8.84-7.16-16-15.99-15.99h-74.51v-74.51c0-8.84-7.16-16-15.99-15.99s-16,7.16-15.99,15.99l.03,74.53h-74.53c-8.84,0-16,7.16-15.99,15.99,0,8.83,7.15,16,15.99,15.99l74.53-.03v74.51c0,8.83,7.15,16,15.99,15.99,8.84,0,16-7.16,15.99-15.99l-.03-74.51h74.51c8.85.07,16.07-7.14,15.99-15.98Z"/>
                  <path class="icn-std" d="M495.34,354.47c-8.34-.31-15.34,6.16-15.34,14.5v15.03c0,17.67-14.33,32-32,32H64c-17.67,0-32-14.33-32-32V64c0-17.67,14.33-32,32-32h384c17.67,0,32,14.33,32,32v14.82c0,8.26,6.8,15.08,15.05,14.72.58-.03,1.17-.04,1.76-.04h.18c8.25.03,15.01-6.47,15.01-14.72v-14.79C512,28.64,483.3-.01,448-.01H64C28.65,0,0,28.65,0,64v320c0,35.35,28.65,64,64,64h384c35.35,0,64-28.65,64-64v-14.78c0-8.24-6.77-14.75-15.01-14.72"/>
                  <path class="icn-std" d="M226.61,368.9c-.98,0-1.94-.01-2.91-.04-35.69-.85-65.06-16.58-74.81-40.07-4.37-10.52-4.71-20.16-1.03-28.66,6.38-14.74,22.26-20.72,37.62-26.5,30.42-11.45,33.9-18.19,35.75-27.18,3.33-16.18-3.97-40.07-11.02-63.17-5.54-18.14-10.77-35.28-11.88-50.98-1.53-21.67,5.48-37.23,20.82-46.26h0c31.49-18.53,78.46.98,111.69,46.38,14.23,19.44,22.66,46.8,23.72,77.02,1.11,31.48-5.61,63.58-19.43,92.83-23.25,49.21-70.72,66.62-108.51,66.62h0ZM180,309.6c-2.54,1.41-3.62,4.53-2.52,7.22,0,.03.02.06.03.08,4.9,11.8,24.2,20.42,46.92,20.97,28.48.68,65.16-11.79,82.65-48.83,11.71-24.8,17.41-51.94,16.48-78.5-.85-24.08-7.16-45.31-17.76-59.8-25.19-34.42-56.45-46.51-70.96-37.97h0c-2.29,1.35-6.56,3.86-5.61,17.36.86,12.19,5.59,27.7,10.61,44.11,8.19,26.82,16.66,54.54,11.74,78.46-6.5,31.62-34.65,42.21-55.2,49.95-4.85,1.83-12,4.51-16.39,6.95h0Z"/>
                </svg>
              </div>
            </a>
          <?php } ?>
          <a href="/api/logout.php" class="nav-link">
            <div class="nav-entry">
              <svg id="icn-logout" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 433.31 448" height="24px" width="auto">
                <path class="icn-std" d="M295.34,354.47c-8.34-.31-15.34,6.16-15.34,14.5v15.03c0,17.67-14.33,32-32,32H64c-17.67,0-32-14.33-32-32V64c0-17.67,14.33-32,32-32h184c17.67,0,32,14.33,32,32v14.82c0,8.26,6.8,15.08,15.05,14.72.58-.03,1.17-.04,1.76-.04h.18c8.25.03,15.01-6.47,15.01-14.72v-14.79C312,28.64,283.3,0,248,0H64C28.65,0,0,28.65,0,64v320c0,35.35,28.65,64,64,64h184c35.35,0,64-28.65,64-64v-14.78c0-8.24-6.77-14.75-15.01-14.72"/>
                <path class="icn-std" d="M321.31,303.99c0,4.09,1.56,8.19,4.69,11.31,6.25,6.25,16.38,6.25,22.62,0l80-80c6.25-6.25,6.25-16.38,0-22.62l-80-80c-6.25-6.25-16.38-6.25-22.62,0s-6.25,16.38,0,22.62l52.71,52.69h-217.4c-8.84,0-16,7.2-16,16s7.16,16,16,16h217.4l-52.7,52.7c-3.1,3.1-4.7,7.2-4.7,11.3h0Z"/>
              </svg>
            </div>
          </a>
        </div>
      </div>
    </nav>

    <div id="main">
      <?php if($page_title != "Stage") { ?><div id="main-stage"><?php } ?>



