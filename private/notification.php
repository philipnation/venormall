<?php
    include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venormall - Notification</title>

    <!--Favicon-->
    <link rel="icon" href="assets/images/logo.png">

    <!--Font familiy-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Serif:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">


    <!--Font icon-->
    <link rel="stylesheet" href="assets/font/css/all.css">

    <!--Local css-->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--Ajax cnd-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--Bootstrap js-->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <!--Local js-->
    <style>
        select, textarea{
            border:1px solid transparent;
            width:100%;
            resize:none;
        }
        select:focus-within, textarea:focus-within{
            outline:none;
        }
        textarea{
            height:100px;
            font-size:13pt;
        }
    </style>
</head>
<body id="body">
    <div class="main-login">
        <div class="header">
            <!--<div class="login-back"><a href="index.html"><i class="fa fa-arrow-left"></i></a></div>-->
            <div>Notification</div>
        </div>
        <div class="next-div">
            <!--<p style="color: black;">Get started</p>-->
            <p style="color: #fff;text-align:center;">Send Notication to users</p>
        </div>
        <p class="error"></p>
        <div class="svg">
            <img src="assets/img/images/svg.svg" alt="">
        </div>
        <div class="form-control">
            <div class="login-div">
                <!--<label for=""><i class="fa fa-user"></i></label>-->
                <select id="user" name="user">
                    <option value="none">--Select User--</option>
                    <option value="all">All Users</option>
                    <?php
                    $users_result = mysqli_query($conn, "SELECT * FROM users");
                    while($user_row = mysqli_fetch_assoc($users_result)){
                        echo "<option value='$user_row[userid]' style='color:#000'>$user_row[name]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="login-div">
                <!--<label for=""><i class="fa fa-repeat"></i></label>-->
                <textarea type="text" id="message" placeholder="Say Something..."></textarea>
            </div>
            <div class="login-div">
                <button class="btn-login" id="btn_login">Send</button>
            </div>
            <br>
            <p style="text-align:center;"><a href="./" style="color: #fff;text-decoration:none;">Back</a></p>
        </div>
    </div>
    <div class="svg_down">
        <img src="assets/img/images/svg_down.svg" alt="">
    </div>
    <script>
        $(document).ready(function() {
          $('#btn_login').click(function() {
              //alert(1)
              var user = $("#user").val();
              var message = $("#message").val();
              const error = document.querySelector('.error')
              if(message == "" || user == ""){
                    error.style.display = "block"
                    error.innerText = "Fill in all the inputs"
                    setTimeout(function(){
                        error.style.display = "none"
                    }, 2000)
              }
              else{
                    $.post("include/send_note.php", {
                        //The building_unique_id is the post array and then the second onces are the variables
                        message: message,
                        user : user,
                    }, function(data, status){
                        //$("#notification").html(data);
                        //alert(status);
                        if(data == "done"){
                            /*location.href = 'dashboard'*/
                            alert('Message sent')
                        }
                        else{
                            /*error.style.display = "block"
                            error.innerText = data
                            setTimeout(function(){
                                error.style.display = "none"
                            }, 3000)*/
                            alert('Erroe Sending Message')
                        }
                        });
                }
            });
        });
    </script>
</body>
</html>