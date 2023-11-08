<?php
include("conn.php");
function total($var){
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM $var");
    $count = mysqli_num_rows($result);
    return $count;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/font/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/images/logo.png">
    <title>dashboard</title>
</head>
<body>
    <div class="wrapper">
        <p class="logo-name"><span>VENOR</span>MALL</p>
        <header>
            <p><?php echo date("jS l M Y") ?></p>
            <nav>
                <div class="brand-name">
                    Hi, ADMIN
                </div>
                <div class="brand-logo">
                    <img src="assets/images/profile.png" alt="Profile">
                </div>
            </nav>
        </header>
        <div class="dashboard-body">
            <div class="earn-history">
                <!--<p>Earnings</p>-->
                <nav>
                    <div>Total Users</div>
                    <div><?php echo total('users'); ?></div>
                </nav>
                <div class="earning">
                    <nav>
                        <div>
                            <p>Total stores <span></span></p>
                            <p><?php echo total('store_setting'); ?></p>
                        </div>
                        <div class="brand-logo">
                            <img src="assets/images/screenshot/e-goldcart.png" alt="">
                        </div>
                    </nav>
                </div>

                <div class="earning">
                    <nav>
                        <div>
                            <p>Total Users</p>
                            <p><?php echo total('users'); ?></p>
                        </div>
                        <div class="brand-logo">
                            <!--<img src="assets/images/screenshot/e-goldcart.png" alt="">-->
                            <i class="fa fa-user"></i>
                        </div>
                    </nav>
                </div>

                <p>Recent Users <a href="#">all</a></p>
                <div class="history">
                        <div>
                            <?php
                            $result_users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
                            while($user_row = mysqli_fetch_assoc($result_users)){
                                echo "
                                    <div class='history-details'>
                                        <p>$user_row[name] - $user_row[business_name]</p>
                                        <p>$user_row[reg_date] <a href='user?id=$user_row[userid]'>details</a></p>
                                    </div>
                                ";
                            }
                            ?>
                        </div>
                </div>
            </div>
            <br><br>
            <footer>
                <a class="active" href="index.php">
                    <i class="fa fa-home"></i>
                    <p>Home</p>
                </a>
                <a href="#">
                    <i class="fa fa-repeat"></i>
                    <p>Sub Plans</p>
                </a>
                <a href="notification.php">
                    <i class="fa fa-bell"></i>
                    <p>Messaging</p>
                </a>
                <a href="account.html">
                    <i class="fa fa-store"></i>
                    <p>Stores</p>
                </a>
            </footer>
        </div>
    </div>
</body>
</html>