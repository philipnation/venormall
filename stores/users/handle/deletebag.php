<?php
include("../handle/script.php");
$id = $_GET['id'];
$sql = "DELETE FROM bags WHERE id='$id'";
$result = mysqli_query($conn, $sql);
header("Location: bags");
?>