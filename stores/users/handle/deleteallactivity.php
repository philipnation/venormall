<?php
include("../../includes/conn.php");
include("script.php");
session_start();
$sql = "DELETE FROM storeuser_notification WHERE userid='$_SESSION[shopuser]'";
$result = mysqli_query($conn, $sql);
if($result){
    header("Location: home");
}
else{
    echo "not deleted";
}
?>