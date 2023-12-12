<?php
session_start();
if(!isset($_SESSION['shopuser'])){
    header("Location: login");
}
include("../includes/conn.php");
//error_reporting(1);

$user_result = mysqli_query($conn,"SELECT * FROM shop_users WHERE id = '$_SESSION[shopuser]'");
$user_row = mysqli_fetch_assoc($user_result);
$userid = $user_row['id'];
$firstname = $user_row['firstname'];
$lastname = $user_row['lastname'];
$country = $user_row['country'];
$state = $user_row['state'];
$city = $user_row['city'];
$email = $user_row['email'];
$dateofreg = $user_row['regdate'];
$password = $user_row['password'];
$phone = $user_row['phonenumber'];
$address = $user_row['address'];
//error_reporting(0);
include("handle/script.php");
if(!empty($_SESSION["shopping_cart"])) {
    $total_price = 0;
    foreach ($_SESSION["shopping_cart"] as $product){
        $product["item_name"] = 1;
        $total_price += $product["item_name"];
    }
}

else{
    $total_price = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title><?php echo $firstname."'s dashboard" ?></title>

  <link rel="stylesheet" href="dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="dist/modules/summernote/summernote-lite.css">
  <link rel="stylesheet" href="dist/modules/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="dist/css/demo.css">
  <link rel="stylesheet" href="dist/css/style.css">
  <link rel="stylesheet" href="../font/css/all.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
            <!--<li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="ion ion-search"></i></a></li>-->
          </ul>
          <!--<div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit"><i class="ion ion-search"></i></button>
          </div>-->
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg <?php if(getnotificationcount() >= 1){echo 'beep';} else{echo '';} ?>"><i class="ion ion-ios-bell-outline"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="delnotification">delete all</a>
                </div>
              </div>
              <div class="dropdown-list-content">
                <?php getfullnotification(); ?>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
            <i class="ion ion-android-person d-lg-none"></i>
            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $firstname; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="profile" class="dropdown-item has-icon">
                <i class="ion ion-android-person"></i> Profile
              </a>
              <a href="logout" class="dropdown-item has-icon">
                <i class="ion ion-log-out"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="../">DASHBOARD</a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="dist/img/avatar/ava.jpg">
            </div>
            <div class="sidebar-user-details">
              <div class="user-name"><?php echo $firstname." ".$lastname ?></div>
              <div class="user-role">
                user
              </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
              <a href="home"><i class="ion ion-speedometer"></i><span>Home</span></a>
            </li>
            <li>
              <a href="orders"><i class="fa fa-shopping-bag" style="color :#0D0E52;"></i><span>Orders</span></a>
            </li>
            <li>
              <a href="profile"><i class="fa fa-user" style="color :#0D0E52;"></i><span>Profile</span></a>
            </li>
            <li>
              <a href="address"><i class="ion ion-ios-location-outline" style="color :#0D0E52;"></i><span>Change address</span></a>
            </li>

            <li class="menu-header">More</li>
            <li>
              <!-- <a href="chat"><i class="fa fa-comments" style="color :#0D0E52;"></i>AI chat <div class="badge badge-primary" style="background-color :#0D0E52;"></div></a> -->
            </li>
            <li>
              <a href="logout"><i class="fa fa-power-off" style="color :#0D0E52;"></i> logout</a>
            </li>          </ul>
        </aside>
      </div>