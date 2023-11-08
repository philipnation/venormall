<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<link rel="apple-touch-icon" sizes="76x76" href="user/images/logo.png">
<link rel="icon" type="image/png" href="assets/img/venormall.jpg">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>venormall</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,600,800" rel="stylesheet">
    
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="./assets/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
<!-- Main CSS -->
<link href="./assets/css/main.css" rel="stylesheet"/>
    
<!-- Animation CSS -->
<link href="./assets/css/vendor/aos.css" rel="stylesheet"/>
<link href="./assets/font/css/all.css" rel="stylesheet"/>
    <!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '546d628efda8fbb08c0744128eb64220973e19b2';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
<script async="async" src="https://static.mobilemonkey.com/js/mm_7653a0d0-7e3d-4a51-9b1f-ac9dbc63cf4d-54577490.js"></script>

<!-- Default Statcounter code for Venormall https://venormall.com -->
<script type="text/javascript">
var sc_project=12937651; 
var sc_invisible=1; 
var sc_security="e360030b"; 
</script>
<script type="text/javascript"
src="https://www.statcounter.com/counter/counter.js" async></script>
<noscript><div class="statcounter"><a title="Web Analytics"
href="https://statcounter.com/" target="_blank"><img class="statcounter"
src="https://c.statcounter.com/12937651/0/e360030b/1/" alt="Web Analytics"
referrerPolicy="no-referrer-when-downgrade"></a></div></noscript>
<!-- End of Statcounter Code -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-F162CZ76FV">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-F162CZ76FV');
</script>

</head>
    
<body> 
    
    
<!--------------------------------------
NAVBAR
--------------------------------------->
<nav class="topnav navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #0D0E52;">
<div class="container-fluid" style="background-color: #0D0E52;">
	<a class="navbar-brand" href="./" style="color: whitesmoke;"><strong>venormall.</strong></a>
	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="navbar-collapse collapse" id="navbarColor02" style="background-color: #0D0E52;">
		<ul class="navbar-nav mr-auto d-flex align-items-center">
			<li class="nav-item">
			<a class="nav-link" href="./" style="color: whitesmoke;">Home</a>
			</li>
			<!--
			<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Examples </a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="./landing">Home Landing</a>
				<a class="dropdown-item" href="./login">User Login</a>
				<a class="dropdown-item" href="./blog">Blog Index</a>
				<a class="dropdown-item" href="./page">Sample Page</a>
			</div>
			</li>
			-->
			<li class="nav-item">
				<a class="nav-link" href="pricing" style="color: whitesmoke;">Pricing</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="about" style="color: whitesmoke;">About</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="blogs" style="color: whitesmoke;">Blogs</a>
			</li>
			<!--<li class="nav-item">
				<a class="nav-link" href="about" style="color: whitesmoke;">Contact</a>
			</li>-->
			<li class="nav-item">
			    <?php
			    if($_SESSION['id']){
			        echo '<a class="nav-link" href="dashboard" style="color: whitesmoke;">dashboard</a>';
			    }else{
			        echo '<a class="nav-link" href="login" style="color: whitesmoke;">Login</a>';
			    }
			    ?>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto d-flex align-items-center">
			<li class="nav-item">
			<span class="nav-link" href="#">
			<a class="btn btn-info" href="#pricing" style="background-color: #0B5ED7;border: 1px #0B5ED7;color: #fff;">get started</a>
			</span>
			</li>
		</ul>
	</div>
</div>
</nav>
<!-- End Navbar -->