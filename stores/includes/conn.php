<?php
$db_host = 'localhost';
$db_username = 'energych_root';
$db_password = 'energychleen';
$db_name = 'energych_test';
$conn = mysqli_connect($db_host,$db_username,$db_password,$db_name);
if(!$conn){
    echo 'Error: '.mysqli_connect_error();
}
?>