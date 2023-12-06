<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>afia &rsaquo; Register</title>

  <link rel="stylesheet" href="dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="dist/css/demo.css">
  <link rel="stylesheet" href="dist/css/style.css">
  <link rel="stylesheet" href="font/css/all.css">
  <script src="js/ajax.js"></script>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              AFIA
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="#">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="frist_name">First Name</label>
                      <input id="frist_name" type="text" class="form-control" name="firstname" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Last Name</label>
                      <input id="last_name" type="text" class="form-control" name="lastname" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="emailreg" onchange="checkemail()" onkeyup="checkemail()" required>
                    <span id="emailcheck" style="color: red;"></span>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input type="password" class="form-control" name="password" id="passwordin" onkeyup="checkpass()">
                      <i class="fa fa-check" style="color: green; display: none;" id="tick"></i>
                      <span id="incorrectpassword"></span>
                      
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input disabled id="password2" type="password" class="form-control" name="password-confirm" onkeyup="passmatch()" required>
                      <span id="passmatch"></span>
                    </div>
                  </div>

                  <div class="form-divider">
                    Your Home
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Country</label>
                      <select class="form-control" name="country">
                        <option value="none">--select country--</option>
                        <option value="nigeria">Nigeria</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label>State</label>
                      <select class="form-control" name="state">
                        <option value="none">--select state--</option>
                        <option value="anambra">Anambra</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label>City</label>
                      <select class="form-control" name="city">
                        <option value="none">--select city--</option>
                        <option value="onitsha">onitsha</option>
                        <option value="obosi">obosi</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Address</label>
                      <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group col-6">
                      <label>phone number</label>
                      <input type="text" name="phone" class="form-control" id="phonereg" onchange="checkphone()" onkeyup="checkphone()" required>
                      <span id="phonecheck" style="color: red;"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="register" id="registerbtn">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; afia 2023
            </div>
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
  <script src="dist/modules/moment.min.js"></script>
  <script src="dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="dist/js/sa-functions.js"></script>
  
  <script src="dist/js/scripts.js"></script>
  <script src="dist/js/custom.js"></script>
  <!--<script src="dist/js/demo.js"></script>-->
</body>
</html>

<?php
include("includes/script.php");
if(isset($_POST['register'])){
    $country = $_POST['country'];
    $firstname = remove_($_POST['firstname']);
    $lastname = remove_($_POST['lastname']);
    $address = remove_($_POST['address']);
    $state = $_POST['state'];
    $city = remove_($_POST['city']);
    $email = remove_($_POST['email']);
    $phonenumber = remove_($_POST['phone']);
    $password = remove_($_POST['password']);
    $regdate = date("l F jS Y");
    $sql = "INSERT INTO users(country, firstname, lastname, address, state, city, email, phonenumber, password, regdate)VALUES('$country','$firstname','$lastname','$address','$state','$city','$email','$phonenumber','$password', '$regdate')";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "<script>alert('UNsuccessful')</script>";
    }
    else{
        echo "<script>alert('successful')</script>";
        echo "<script>location.href='login'</script>";
    }
}
?>

<script>
    function passmatch(){
      var password = document.getElementById("passwordin")
      var password2 = document.getElementById("password2")
      var showcorrectpass = document.getElementById("passmatch")
      var registerbtn = document.getElementById("registerbtn")
      if(password2.value.length == 0){
          showcorrectpass.innerHTML = ""
          registerbtn.disabled = false
      }
      else if(password.value != password2.value){
          showcorrectpass.innerHTML = 'password does not match'
          showcorrectpass.style.color = 'red'
          registerbtn.disabled = true
      }
      else{
          showcorrectpass.innerHTML = "password match"
          showcorrectpass.style.color = 'green'
          registerbtn.disabled = false
      }
    }
    function checkpass(){
      var password = document.getElementById("passwordin")
      var password2 = document.getElementById("password2")
      var tick = document.getElementById("tick")
      var registerbtn = document.getElementById("registerbtn")
      var showcorrectpass = document.getElementById("incorrectpassword")
      var messagepass = ['password is less than six', 'correct']
      var passmatch = document.getElementById("passmatch")
      var registerbtn = document.getElementById("registerbtn")
      if(password.value.length == 0){
          showcorrectpass.innerHTML = ""
          registerbtn.disabled = false
      }
      else if(password.value.length <=6){
          showcorrectpass.innerHTML = messagepass[0]
          password2.disabled = true
          password2.value = ""
          passmatch.innerHTML = ""
          showcorrectpass.style.color = 'red'
          tick.style.display = "none"
          registerbtn.disabled = true
      }
      else{
          showcorrectpass.innerHTML = ""//messagepass[1]
          showcorrectpass.style.color = 'green'
          password2.disabled = false
          tick.style.display = "block"
          registerbtn.disabled = false
      }
    }
</script>

<script>
    function checkemail(){
    $(document).ready(function(){

        $("#emailreg").keyup(function(){
            var name = $("#emailreg").val().toLowerCase();
            $.post("ajax/checkemail.php", {
                sugess: name
            }, function(data, status){
                $("#emailcheck").html(data);
            });
        });
    });
}
function checkphone(){
    $(document).ready(function(){

        $("#phonereg").keyup(function(){
            var name = $("#phonereg").val().toLowerCase();
            $.post("ajax/checkphonenumber.php", {
                sugess: name
            }, function(data, status){
                $("#phonecheck").html(data);
            });
        });
    });
}
</script>