<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = ini_get('error_reporting');
session_start();
include("../conn.php");

function checkRegistrationLimit() {
    $maxAttempts = 50; // Maximum number of registration attempts allowed
    $ip = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

    // Check if the session variable for the registration attempts exists
    if (!isset($_SESSION['registration_attempts'][$ip])) {
        $_SESSION['registration_attempts'][$ip] = 1; // Initialize the attempts count for the IP
        return true; // Allow the registration request
    }

    // If the number of attempts exceeds the limit, return false
    if ($_SESSION['registration_attempts'][$ip] >= $maxAttempts) {
        echo "Too many registration trials. Please try again later.";
        return false;
    }

    $_SESSION['registration_attempts'][$ip]++; // Increment the attempts count
    return true; // Allow the registration request
}

function adduserdetails($user, $message){
    global $conn;
    global $error;
    $user = mysqli_real_escape_string($conn, htmlspecialchars($user, ENT_QUOTES, 'UTF-8'));
    $message = mysqli_real_escape_string($conn, htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
    $date = date('jS M, Y');
    //Use Capital F to replace M to the month Will be in Full.
    if($user == "all"){
        $user_result = mysqli_query($conn, "SELECT * FROM users");
        while($user_row = mysqli_fetch_assoc($user_result)){
            $ids = $user_row['userid'];
            $sql = "INSERT INTO notifications(
                userid,message,date
                )
                VALUES(
                    '$ids','$message','$date'
                )
                ";
            $result = mysqli_query($conn, $sql);
        }
    }
    else{
        $sql = "INSERT INTO notifications(
            userid,message,date
            )
            VALUES(
                '$user','$message','$date'
            )
            ";
        $result = mysqli_query($conn, $sql);
    }
    if($result){
        echo "done";
    }
    else{
        echo 'error'.mysqli_error($conn);
    }
}
//check if email and phone number exist
if (checkRegistrationLimit()) {
    adduserdetails(
        $_POST['user'], 
        $_POST['message']
    );
}