<?php require_once("../partial/gen-header.php"); ?>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="hannahap" viewBox="0 0 1024 1024">
    <title>Hannah A. Patellis</title>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M512,65.31c-246.31,0-446.69,200.39-446.69,446.69s200.38,446.69,446.69,446.69,446.69-200.38,446.69-446.69S758.31,65.31,512,65.31ZM893.51,512c0,211.86-171.15,384.22-381.51,384.22s-381.51-172.36-381.51-384.22S301.63,127.78,512,127.78s381.51,172.36,381.51,384.22Z"/>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M495.99,269.35c-2.57,17.34-20.35,140.63-30.18,201.05-38.64-14.29-74.02-18.95-109.16-15.48-18.36,1.81-35.94,6.12-52.23,12.82-16.5,6.78-31.82,16.05-45.54,27.56-13.72,11.52-32.43,35.32-43.77,67.58-9.12,25.93-16.18,66.1,1.93,110.26,11.55,28.15,31.55,51.52,57.85,67.58,23.65,14.44,51.75,22.4,79.11,22.4,10.36,0,20.45-1.13,30-3.36,42.02-9.8,74.32-34.83,96-74.41,17.85-32.59,25.98-67.59,30.52-90.75,1.83-9.31,3.67-18.92,5.49-28.66,34.25,23.97,61.7,54.48,82.13,88.64,19.67,32.89,33.87,64.89,27.49,108.67l64.86.09,74.13-493.99h-64.61l-52.26,346.43c-5.47-8.49-11.44-16.88-17.83-25.07-28-35.89-63.6-67.15-103.33-90.99,9.78-69.28,31.92-213.48,34.43-230.37h-65.03ZM457.03,534.05c-2.95,16.35-6.02,32.67-9.14,48.59-5.06,25.85-11.38,52.69-23.22,73.92-12.8,22.95-30.76,36.84-54.89,42.47-16.61,3.87-36.1,1.39-53.48-6.81-19.08-9-33.78-24.16-41.38-42.7-10.85-26.44-6.18-51.21-.36-67.33,6.6-18.26,17.36-33.09,24.58-39.15,10.43-8.75,22.4-15.45,35.59-19.91,13.12-4.44,27.49-6.69,42.72-6.69,25,0,51.76,5.92,79.59,17.62Z"/>
  </symbol>
</svg>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 text-center text-lg-start">
      <svg class="bi pe-none mb-4" width="70" height="70"><use xlink:href="#hannahap"></use></svg>
      <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Welcome to PROlific</h1>
      <p class="col-lg-10 fs-4">The artwork database of Hannah A. Patellis</p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
      <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method="POST" action="/action/login.php">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" name="username" placeholder="hannah">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        <hr class="my-4">
        <small class="text-body-secondary">Authorized usage only</small>
      </form>
    </div>
  </div>
</div>

<?php require_once("../partial/gen-footer.php"); ?>