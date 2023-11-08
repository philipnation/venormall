<?php
include("includes/conn.php");
session_start();
$userid = $_SESSION['id'];
$currency = "&#8358;";
if(!isset($_SESSION['id'])){
  header("location: ../login");
}
else{
  $sql = "SELECT * FROM users WHERE userid='$userid'";
  $result = mysqli_query($conn, $sql);
  $user_row = mysqli_fetch_assoc($result);

  //Get store details
  $store_sql = "SELECT * FROM store_setting WHERE userid='$userid'";
  $store_result = mysqli_query($conn, $store_sql);
  $store_row = mysqli_fetch_assoc($store_result);
}
function get_report_total($var){
    global $conn;
    global $userid;
    $today = date("d");
    $month = date("m");
    $year = date("Y");
    $count = 0;
    if($var == "day"){
        $report_sql = "SELECT order_date, order_total FROM orders WHERE userid='$userid' AND DAY(order_date) = $today AND MONTH(order_date) = $month AND YEAR(order_date) = $year AND action = 'delivered'";
    }
    elseif($var == "month"){
        $report_sql = "SELECT order_date, order_total FROM orders WHERE userid='$userid' AND MONTH(order_date) = $month AND YEAR(order_date) = $year  AND action = 'delivered'";
    }
    elseif($var == "year"){
        $report_sql = "SELECT order_date, order_total FROM orders WHERE userid='$userid' AND YEAR(order_date) = $year AND action = 'delivered'";
    }
    $report_result = mysqli_query($conn, $report_sql);
    while($report_row = mysqli_fetch_assoc($report_result)){
        $count += $report_row['order_total'];
        //echo $report_row['order_total']."<br>";
    }
    echo number_format($count);
}
function get_orders($var){
  global $conn;
  global $userid;
  $count = 0;
  $report_sql = "SELECT * FROM orders WHERE userid='$userid' AND action = '$var'";
  $report_result = mysqli_query($conn, $report_sql);
  echo mysqli_num_rows($report_result);
}
function get_products(){
  global $conn;
  global $userid;
  $count = 0;
  $report_sql = "SELECT * FROM products WHERE userid='$userid'";
  $report_result = mysqli_query($conn, $report_sql);
  echo mysqli_num_rows($report_result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>User Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="font/css/all.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../assets/img/venormall.jpg" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-dT2MOQEeK2e2Ak9IPoCg0Of4WTvQl+f/+U8L1TGfLM1U/6ACZz5R2GnGRgZpQjDjhxj1hoNqT2gMCPs6DO1KKQ==" crossorigin="anonymous" />
  <script src="js/ajax.js"></script>
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
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="./"><img src="../assets/img/venormall.jpg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="./"><img src="../assets/img/venormall.jpg" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
              <i class="mdi mdi-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <?php
                  $registrationDate = $user_row['reg_date'];
                  $trialPeriodDays = 13; //Change 14 and it will be 15 days free trial
                  $registrationTimestamp = strtotime($registrationDate);
                  $trialEndDate = strtotime("+$trialPeriodDays days", $registrationTimestamp);
                  $currentDate = time();
                  $secondsRemaining = $trialEndDate - $currentDate;
                  $daysRemaining = ceil($secondsRemaining / (60 * 60 * 24));
                  
                  if(isset($_GET['nid'])){
                        $nid = $_GET['nid'];
                        mysqli_query($conn, "DELETE FROM notifications WHERE id='$nid'");
                        echo "<script>location.href = 'notification'</script>";
                    }
                    elseif(isset($_GET['rid'])){
                        mysqli_query($conn, "UPDATE notifications SET unread='no' WHERE userid='$userid'");
                        echo "<script>location.href = 'notification'</script>";
                    }
                ?>
              <a class="dropdown-item">
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">venor support
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    <?php
                      if($user_row['status'] == 'unpaid'){
                        if($daysRemaining < 1){
                          echo "Your trial has ended.";
                        }
                        else{
                          echo "Your trial ends in $daysRemaining days";
                        }
                      }
                    ?>
                  </p>
                </div>
              </a>
              
              <?php
                    $history_result = mysqli_query($conn, "SELECT * FROM notifications WHERE userid = '$userid' ORDER BY id DESC");
                        if(mysqli_num_rows($history_result) > 0){
                            while($history_row = mysqli_fetch_assoc($history_result)){
                                echo "
                                  <a class='dropdown-item'>
                                    
                                    <div class='item-content flex-grow'>
                                      <h6 class='ellipsis font-weight-normal'>venor support
                                      </h6>
                                      <p class='font-weight-light small-text text-muted mb-0' style='width:100%;'>
                                          
                                        $history_row[message]
                                        
                                      </p>
                                    </div>
                                  </a>
                                   ";
                            }
                        }
                        else{
                            echo '
                                No Notification Yet.
                            ';
                        }
                        ?>
              
            </div>
          </li>
          <li class="nav-item dropdown me-4">
            <!--
            <a href='notification?nid=$history_row[id]'><i class='fa fa-trash'></i></a>
            <div class="item-thumbnail">
                    <img src="<?php if($store_row['logo'] == ""){echo "images/profile.png";}else{echo "../stores/assets/images/logo/$store_row[logo]";} ?>" alt="image" class="profile-pic">
            </div>-->
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="mdi mdi-message-text mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item" href="store">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="mdi mdi-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Edit Store Features
                  </p>
                </div>
              </a>
              <a class="dropdown-item" href="orders?status=pending">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="mdi mdi-account-box mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Orders</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    View Pending Orders
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="mdi mdi-whatsapp mx-0"></i>
                  </div>
                </div>
                <div class="item-content" href="https://wa.me/+2349158392739" target="_blank">
                  <h6 class="font-weight-normal">Customer Aid</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Get in touch through whatsapp
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="<?php if($store_row['logo'] == ""){echo "images/profile.png";}else{echo "../stores/assets/images/logo/$store_row[logo]";} ?>" alt="profile"/>
              <span class="nav-profile-name"><?php echo $user_row['business_name'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="https://<?php echo $store_row['store_name'] ?>.venormall.com" target="_blank">
                <i class="mdi mdi-settings text-primary"></i>
                View Your Store
              </a>
              <a class="dropdown-item" href="settings">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="exit">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="./">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="category">
              <i class="mdi mdi-circle-outline menu-icon"></i>
              <span class="menu-title">Category</span>
            </a>
          </li>
          <?php
          if ($user_row['plan'] != 'starter') {
            # code...
            echo '
            <li class="nav-item">
              <a class="nav-link" href="media">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Social Media Accounts</span>
              </a>
            </li>
            ';
          }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="report">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">Store Report</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="payment">
              <i class="mdi mdi-card menu-icon"></i>
              <span class="menu-title">Payment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="store">
              <i class="mdi mdi-settings menu-icon"></i>
              <span class="menu-title">Website Setting</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-tag menu-icon"></i>
              <span class="menu-title">Products</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="addproduct"> Add Products </a></li>
                <li class="nav-item"> <a class="nav-link" href="products"> View Products </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="settings">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-cart menu-icon"></i>
              <span class="menu-title">Orders</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="orders?status=pending"> Pending Orders </a></li>
                <li class="nav-item"> <a class="nav-link" href="orders?status=delivered"> Delivered Orders </a></li>
                <li class="nav-item"> <a class="nav-link" href="orders?status=declined"> Declined Orders </a></li>
                <!--<li class="nav-item"> <a class="nav-link" href="orders?status=all"> All Orders </a></li>-->
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="invite">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">Referral</span>
            </a>
          </li>
        </ul>
      </nav>