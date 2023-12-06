<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>profile</title>

  <link rel="stylesheet" href="dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="dist/css/demo.css">
  <link rel="stylesheet" href="dist/css/style.css">
</head>

<body>
    <section class="section">
      <div class="container mt-5">
        <div class="row" style="margin:auto;display: flex;justify-content:center;align-items:center;">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">

            </div>

            <div class="card card-primary" style="margin-top:100px;">
              <div class="card-header"><h4>Profile</h4></div>

              <div class="card-body">
                <form method="POST">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="frist_name">First Name</label>
                      <input id="frist_name" type="text" class="form-control" name="frist_name" value="<?php echo $firstname ?>" disabled>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Last Name</label>
                      <input id="last_name" type="text" class="form-control" name="last_name" value="<?php echo $lastname ?>" disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" name="email" value="<?php echo $email ?>" disabled>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password <span style="color:red;">(Protected)</span></label>
                      <input id="password" type="text" class="form-control" name="password" value="<?php echo $password ?>" disabled>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Phone number</label>
                      <input id="password2" type="text" class="form-control" name="password-confirm" value="<?php echo $phone ?>" disabled>
                    </div>
                  </div>

                  <div class="form-divider">
                    Your Home
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Country</label>
                      <input id="password2" type="text" class="form-control" name="password-confirm" value="<?php echo $country ?>" disabled>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">State</label>
                      <input id="password2" type="text" class="form-control" name="password-confirm" value="<?php echo $state ?>" disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">City</label>
                      <input id="password2" type="text" class="form-control" name="password-confirm" value="<?php echo $city ?>" disabled>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Address</label>
                      <input id="password2" type="text" class="form-control" name="password-confirm" value="<?php echo $address ?>" disabled>
                    </div>
                  </div>

                  <!--<div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                      update
                    </button>
                  </div>-->
                </form>
              </div>
            </div>
            <!-- <div class="simple-footer"> -->
              <!-- Copyright &copy;  2023 -->
            <!-- </div> -->
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="dist/modules/jquery.min.js"></script>
  <script src="dist/modules/popper.js"></script>
  <script src="dist/modules/tooltip.js"></script>
  <script src="dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="dist/js/sa-functions.js"></script>
  
  <script src="dist/modules/chart.min.js"></script>
  <script src="dist/modules/summernote/summernote-lite.js"></script>
  <script src="dist/js/scripts.js"></script>
  <script src="dist/js/custom.js"></script>
  <!--<script src="../dist/js/demo.js"></script>-->
</body>
</html>