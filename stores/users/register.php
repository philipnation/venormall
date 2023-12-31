<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/favicon.ico">
<link rel="icon" type="image/png" href="./assets/img/favicon.ico">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>venormall</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,600,800" rel="stylesheet">
    
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
<!-- Main CSS -->
<link href="../../assets/css/main.css" rel="stylesheet"/>
    
<!-- Animation CSS -->
<link href="../../assets/css/vendor/aos.css" rel="stylesheet"/>
<style>
	.custom-loader {
		margin: auto;
		width:25px;
		height:25px;
		border-radius:50%;
		border:5px solid;
		border-color:#000000;
		border-right-color: #FFFFFF;
		animation:s2 0.5s infinite linear;
	}
		@keyframes s2 {to{transform: rotate(1turn)}}
</style>
</head>
    
<body id="body"> 
    
    
<!--------------------------------------
NAVBAR
--------------------------------------->
<nav class="topnav navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #0D0E52;">
<div class="container-fluid">
	<a class="navbar-brand d-sm-block d-md-none" href="./index.html"><strong>venormall</strong></a>
	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="navbar-collapse collapse" id="navbarColor02">
		<ul class="navbar-nav mr-auto d-flex align-items-center">
			<li class="nav-item">
				<a class="nav-link" href="./">home</a>
			</li>
		</ul>
	</div>
</div>
</nav>
<!-- End Navbar -->
    
<!-- Main -->
<div class="d-md-flex h-md-100 align-items-center">
	<div class="col-md-6 p-0 bg-indigo h-md-100">
		<div class="text-white d-md-flex align-items-center h-100 p-5 text-center justify-content-center" style="background-color: #0D0E52;">
			<div class="logoarea pt-5 pb-5">
				<!--
				<p>
					<i class="fa fa-anchor fa-3x"></i>
				</p>
				-->
				<h1 class="mb-0 mt-3 display-4">venormall</h1>
				<h5 class="mb-4 font-weight-light">Get started with venormall. Create your store now!</h5>
				<a class="btn btn-outline-white btn-lg" href="login">Login</a>
				</a>
			</div>
		</div>
	</div>
	<!-- HTML for the main page -->
  
  <script src="../../assets/js/ajax.js"></script>
  <script>
  $(document).ready(function() {
	$('#signup').click(function() {
		const btn_login = document.getElementById("signup")
        btn_login.innerHTML = "<div class='custom-loader'></div>"
		var fname = $("#fname").val();
		var lname = $("#lname").val();
		var email = $("#email").val();
		var phone_number = $("#phonenumber").val();
		var password = $("#password").val();
        var signup = $("#signup").val();
        $.post("handle/signup.php", {
            //The building_unique_id is the post array and then the second onces are the variables
            fname: fname,
			lname: lname,
			email: email,
			phone_number: phone_number,
            signup:signup,
			password: password,
        }, function(data, status){
            $("#notification").html(data);
            //alert(data);
			if(data == 'passed'){
				setTimeout(function(){
					btn_login.innerHTML = "Register Successful"
				},500)
			}
			else{
				setTimeout(function(){
					btn_login.innerHTML = "Register"
				},500)
				setTimeout(function(){
					//location.href='login'
				},800)
				const notificationbody = document.querySelector("#notificationbody")
				const notification = document.querySelector("#notification")
				notificationbody.style.display = 'block'
				notification.innerHTML = data
			}
        });
	});
  });
  </script>
  
	<div class="col-md-6 p-0 bg-white h-md-100 loginarea" id="contents">
		<div class="d-md-flex align-items-center h-md-100 justify-content-center">
			<!-- was form -->
			<div class="border rounded p-5">
			<div class="alert alert-danger" role="alert" id="notificationbody" style="display: none;">
				<i class="fas fa-bullhorn"></i> <span id="notification"></span> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<!--<span aria-hidden="true">×</span>-->
				</button>
			</div>
				<h3 class="mb-4 text-center">register</h3>
				<div class="form-group">
					<input type="text" class="form-control" id="fname" aria-describedby="nameHelp" placeholder="First name" required="">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="lname" aria-describedby="businessnameHelp" placeholder="Last name" required="">
				</div>
				<div class="form-group">
					<input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="E-mail" required="">
				</div>
                <div class="form-group">
					<input type="tel" class="form-control" id="phonenumber" aria-describedby="emailHelp" placeholder="Phone number" required="">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password" placeholder="Password" required="">
				</div>
				<button type="submit" id="signup" class="btn btn-success btn-block shadow-sm" style="background-color: #0D0E52; border: 1px solid #0D0E52;">Register</button>
			</div>
			<!--was form-->
		</div>
	</div>
</div>
<!-- End Main -->
    
    
<!------------------------------------------
DEMO MODAL & DONATE BUTTON ONLY - DON'T COPY
------------------------------------------->
<div style="position:fixed; bottom:20px;left:20px;">
	<a href="https://www.wowthemes.net/donate/" target="_blank"></a>
</div>
<!--------------------------------------
END DEMO MODAL & DONATE BUTTON
--------------------------------------->
    
    
   
<!--------------------------------------
JAVASCRIPTS
--------------------------------------->    
<script src="../../assets/js/vendor/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/js/vendor/popper.min.js" type="text/javascript"></script>
<script src="../../assets/js/vendor/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/js/functions.js" type="text/javascript"></script>
    
<!-- Animation -->
<script src="../../assets/js/vendor/aos.js" type="text/javascript"></script>
<noscript>
    <style>
        *[data-aos] {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
    </style>
</noscript>
<script>
    AOS.init({
        duration: 700
    });
</script>
 
<!-- Disable animation on less than 1200px, change value if you like -->
<script>
AOS.init({
  disable: function () {
    var maxWidth = 1200;
    return window.innerWidth < maxWidth;
  }
});
</script>

</body>
</html>
