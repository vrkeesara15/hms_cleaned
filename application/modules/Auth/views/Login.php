<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Font & Icon -->
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/font/inter/inter.min.css">
  <link href="<?php echo assets_url(); ?>new/plugins/material-design-icons-iconfont/material-design-icons.min.css" rel="stylesheet">
  <!-- Plugins -->
  <!-- CSS plugins goes here -->
  <!-- Main Style -->
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/plugins/simplebar/simplebar.min.css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/css/style.min.css" id="main-css">
  <link rel="stylesheet" href="<?php echo assets_url(); ?>new/css/sidebar-royal.min.css" id="theme-css"> <!-- options: blue,cyan,dark,gray,green,pink,purple,red,royal,ash,crimson,namn,frost -->
  <title>Hanshitha Management Services</title>
</head>

<body class="login-page">

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-7 col-xl-8 d-none d-lg-block">
        <img src="<?php echo assets_url(); ?>new/img/auth.svg" alt="" class="img-fluid w-100">
      </div>
      <div class="col-lg-5 col-xl-4 d-flex justify-content-center align-items-start">
        <div class="card mb-3">
          <div class="card-body p-4">
            <h6>Hanshitha Management Services</h6>
            <p class="font-weight-light text-secondary">Welcome! Please login to continue.</p>
            <hr>
             <?php
          if (isset($sign_in_error) || isset($username_email_error)) { 
          ?>
          <div class="alert alert-danger alert-dismissable">
          <i class="fa fa-ban"></i>
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <b>Alert!</b> 
          <?php if (isset($sign_in_error)) { 
          echo $sign_in_error; 
          }elseif(isset($username_email_error)) {
          echo $username_email_error; 
          }?>
          </div>
          <?php } ?>
            <form class="needs-validation" novalidate method="post" action="<?php echo base_url();?>Auth/login">
              <div class="form-group">
                <label class="font-size-sm" for="InputEmail">Email address</label>
                <input type="email" class="form-control bg-gray-200 border-gray-200"  placeholder="Enter Email" autocomplete="off"  name="user_name" id="user_name">
              </div>
              <div class="form-group">
                <label class="font-size-sm" for="InputPassword">Password</label>
                <input type="password" class="form-control bg-gray-200 border-gray-200" placeholder="Enter Password" name="user_password" id="user_password" placeholder="Enter your password" required>
              </div>
              <!-- <div class="form-group d-flex justify-content-between align-items-center">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="remember">
                  <label class="custom-control-label" for="remember">Remember me</label>
                </div>
                <a href="forgot-password.html" class="text-primary text-decoration-underline small">Forgot password ?</a>
              </div> -->
              <!-- <button type="button" class="btn btn-primary btn-block">LOG IN</button> -->
                <button type="submit" class="btn btn-primary w-100">Sign in</button>
              <!-- <div class="divider-text">or</div> -->
              <!-- <button type="button" class="btn btn-sm btn-outline-primary btn-block has-icon"><i class="fab fa-facebook"></i> Login with Facebook</button>
              <button type="button" class="btn btn-sm btn-outline-info btn-block has-icon"><i class="fab fa-facebook"></i> Login with Twitter</button> -->
             <!--  <div class="small mt-4">
                Don't have an account ?
                <a href="register.html" class="text-decoration-underline">Register</a>
              </div> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Plugins -->
  <!-- JS plugins goes here -->
 <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    void(function() {
      document.querySelectorAll('.needs-validation').forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        })
      })
    })()
  </script>
</body>

</html>