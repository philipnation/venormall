<?php
session_start();
include("../includes/script.php");
if(isset($_POST['update_address'])){
  $city = $_POST['city'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  $address = remove_($_POST['address']);
  $userid = $_SESSION['user_id'];
  $sql = "UPDATE users SET address='$address', country='$country', state='$state', city='$city' WHERE id='$userid'";
  $result = mysqli_query($conn, $sql);
  if($result){
    $_SESSION['country'] = $country;
    $_SESSION['state'] = $state;
    $_SESSION['city'] = $city;
    $_SESSION['address'] = $address;
    header("Location: profile");
  }
  else{
    echo 'did not work';
  }
}
?>