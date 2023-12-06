<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = ini_get('error_reporting');
include("../../includes/conn.php");

function generateRandomString() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    $length = 10;

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
function userid() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    $length = 10;

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function checkemail($email) {
    global $conn;
    $sql = "SELECT * FROM shop_users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists";
        return false;
    }

    // Email is valid and does not exist
    return true;
}

function checkphonenumber($phone) {
    global $conn;
    $sql = "SELECT * FROM shop_users WHERE phonenumber='$phone'";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Error: ".mysqli_error($conn);
    }
    else{
        if (mysqli_num_rows($result) > 0) {
            echo "Phone number already exists";
            return false;
        }
    }
    // Phone number is valid and does not exist
    return true;
}

function adduserdetails($fnameparam,$lnameparam,$emailparam,$pass,$phone_numberparam){
    global $conn;
    global $error;
    $password = mysqli_real_escape_string($conn, sha1($pass));
    $fname = mysqli_real_escape_string($conn, htmlspecialchars($fnameparam, ENT_QUOTES, 'UTF-8'));
    $lname = mysqli_real_escape_string($conn, htmlspecialchars($lnameparam, ENT_QUOTES, 'UTF-8'));
    $email = mysqli_real_escape_string($conn, htmlspecialchars($emailparam, ENT_QUOTES, 'UTF-8'));
    $phone_number = mysqli_real_escape_string($conn, htmlspecialchars($phone_numberparam, ENT_QUOTES, 'UTF-8'));
    $reg_date = date('jS F, Y');
    $userid = userid();
    $sql = "INSERT INTO shop_users(
        firstname,email,password,phonenumber,lastname,regdate
        )
        VALUES(
            '$fname','$email','$password','$phone_number','$lname','$reg_date'
        )
        ";
    $result = mysqli_query($conn, $sql);
    if($result){
        //session_start();
        $_SESSION['id'] = $userid;
            echo 'passed';
        }
    else{
        echo "Error: ".mysqli_error($conn);
    }
}
//check if email and phone number exist
if(isset($_POST['signup'])){
    if (checkemail($_POST['email']) && checkphonenumber($_POST['phone_number'])) {
        adduserdetails(
            $_POST['fname'], 
            $_POST['lname'], 
            $_POST['email'], 
            $_POST['password'], 
            $_POST['phone_number'],
        );
    }
}