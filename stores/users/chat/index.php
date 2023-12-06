<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: ../login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>automated chat</title>
    <link rel="stylesheet" href="../dist/css/chat.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../../js/ajax.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
</head>
<body style="margin:auto;">
    <div class="wrapper" style="margin-top: 25%;">
        <div class="title">myafia automated chat <span style="float: right;"><a href="../" style="color: white;text-decoration:none;margin-right:10px;">home</a></span></div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hello <?php echo $_SESSION['firstname'] ?>, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>
    <!--<script>
        $(document).ready(function(){
            $("#data").on("keyup", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>Typing...</p></div></div>';
                $(".form").append($msg);
                //$("#data").val('');
            });
        });
    </script>-->



    <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
    
</body>
</html>