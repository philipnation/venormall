<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>Examples &rsaquo; Register &mdash; Stisla</title>

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
              <div class="card-header"><h4>update delivery address</h4></div>

              <div class="card-body">
                <form method="POST" action="#">
                  <div class="row">
                  <div class="form-divider">
                    Your Home
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="text" class="d-block">Country</label>
                      <input type="text" class="form-control" name="country" style="width: 300px;">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="text" class="d-block">State</label>
                      <input type="text" class="form-control" name="state" style="width: 300px;">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="text" class="d-block">City</label>
                      <input type="text" class="form-control" name="city" style="width: 300px;">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-12">
                      <label for="text" class="d-block">Address</label>
                      <input type="text" class="form-control" name="address" style="width: 300px;">
                    </div>
                  </div><br><br><br>

                  
                  <div class="row">
                  <div class="form-group col-12">
                    <button type="submit" name="update_address" class="btn btn-primary btn-block" style="border: 1px solid transparent;">
                      update address
                    </button>
                  </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- <div class="simple-footer"> -->
              <!-- Copyright &copy; myafia 2023 -->
            <!-- </div> -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php
if(isset($_POST['update_address'])){
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $state = mysqli_real_escape_string($conn, $_POST['state']);
  $country = mysqli_real_escape_string($conn, $_POST['country']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $sql = "UPDATE shop_users SET address='$address', country='$country', state='$state', city='$city' WHERE id='$userid'";
  $result = mysqli_query($conn, $sql);
  if($result){
    echo "<script>alert('updated')</script>";
    echo "<script>location.href = 'profile'</script>";
  }
  else{
    echo 'did not work';
  }
}
?>

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
</body>
</html>