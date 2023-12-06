<?php
include("../../includes/conn.php");
function validatelogin($email, $password){
    global $conn;
    $email = mysqli_real_escape_string($conn, htmlspecialchars($email, ENT_QUOTES, 'UTF-8'));
    $pass= mysqli_real_escape_string($conn, htmlspecialchars($password, ENT_QUOTES, 'UTF-8'));
    $passw = sha1($pass);
    $sql = "SELECT * FROM shop_users WHERE email = '$email' AND password='$passw'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['shopuser'] = $row['id'];
        echo "dashboard";
		//echo "<script>locaion.href='index'</script>";
    }
    else{
        echo "incorrect details: ".mysqli_error($conn);
    }
}

if(isset($_POST["signin"])) {
	validatelogin($_POST['email'], $_POST['password']);
}