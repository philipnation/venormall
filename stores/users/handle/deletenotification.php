<?php
include("../../includes/conn.php");
include("script.php");
$id = $_POST['id'];
$sql = "DELETE FROM storeuser_notification WHERE id='$id'";
$result = mysqli_query($conn, $sql);
header("Location: ../home");
?>