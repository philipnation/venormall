<?php
function numberFormat($number) {
    $result = number_format($number,0,',',',');
    return $result;
}

function getbags(){
    global $conn;
    $sql = "SELECT * FROM bags WHERE id = '$_SESSION[shopuser]'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}

function getorders(){
    global $conn;
    global $userid;
    $sql = "SELECT * FROM orders WHERE storeuserid = $userid";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
function gettotalincome(){
    global $conn;
    $sql = "SELECT * FROM orders WHERE status = 0";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
function getproducts(){
    global $conn;
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
function getmessage(){
    global $conn;
    $sql = "SELECT * FROM messages WHERE userid = '$_SESSION[user_id]'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
function getactivity(){
    global $conn;
    $sql = "SELECT * FROM storeuser_notification WHERE userid = '$_SESSION[user_id]'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
function getnotificationcount(){
    global $conn;
    $sql = "SELECT * FROM storeuser_notification WHERE userid = '$_SESSION[shopuser]'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
function getfullactivity(){
    global $conn;
    $sql = "SELECT * FROM storeuser_notification WHERE userid = '$_SESSION[shopuser]' ORDER BY id DESC LIMIT 3";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>=1){
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['title'];
            $activity = $row['activity'];
            echo "<li class='media'>
                <div class='media-body'>
                <!--<div class='float-right'><small>10m</small></div>-->
                <div class='media-title'>$title</div>
                <small>$activity</small>
                </div>
                </li>
            ";
        }
    }
    else{
        echo "<li class='media'>
        <div class='media-body'>
        <div class='media-title'>NO ACTIVITY</div>
        <small>no activity yet</small>
        </div>
        </li>";
    }
}
function getfullnotification(){
    global $conn;
    $sql = "SELECT * FROM storeuser_notification WHERE userid = '$_SESSION[shopuser]' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) >= 1){
        while($row = mysqli_fetch_assoc($result)){
            $notifyid = $row['id'];
            $activity = $row['activity'];
            echo "
                <form method='POST' action='handle/deletenotification'>
                <a class='dropdown-item' style='margin-left:0%;padding-left:0%;'>
                <div class='dropdown-item-desc'>
                <input name='id' value='$notifyid' hidden>
                <input disabled style='width:100%;border: 1px solid transparent;background-color:transparent;' value='$activity'/>
                <div class='time'><button style='border: 1px solid transparent;background-color:transparent;color:red;'>delete</button></div>
                </div>
                </a>
                </form>
            ";
        }
    }else{
        echo "
            <form method='POST' action='handle/deletenotification'>
            <a class='dropdown-item' style='margin-left:0%;padding-left:0%;'>
            <div class='dropdown-item-desc'>no notification.</div>
            </a>
            </form>
        ";
    }
}
function getfullbag($number){
    global $conn;
    
    $sql = "SELECT * FROM orders WHERE storeuserid = '$_SESSION[shopuser]' ORDER BY id DESC LIMIT $number";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>=1){
        while($row = mysqli_fetch_assoc($result)){
                $bagid = $row['id'];
                $bagtotalprice = numberFormat($row['order_total']);
                $bagname = $row['ordername'];
            echo "<tr>
            <td>
            <!--<a href='editbag-$bagid' class='btn btn-primary btn-action mr-1' style='border: 1px solid transparent;' data-toggle='tooltip' title='Edit'><i class='ion ion-edit'></i></a>-->
            $bagname
            <div class='table-links'>
                total price: <a href='#'>NGN $bagtotalprice</a>
                <div class='bullet'></div>
                <a href='reuse-$bagid'>View</a>
            </div>
            </td>
            <td>
            <a href='reuse-$bagid' class='btn btn-danger btn-action' style='border: 1px solid transparent;background-color:green;' data-toggle='tooltip' title='Delivered'><i class='fa fa-check'></i></a>
            <a href='deletebag-$bagid' class='btn btn-danger btn-action' style='border: 1px solid transparent;' data-toggle='tooltip' title='Not Delievred'><i class='fa fa-exclamation'></i></a>
            </td>
        </tr>
            ";
        }
    }
    else{
        echo "<tr>
        <td>
        No order placed yet. <b>What is holding you?</b>
        </td>
    </tr>";
    }
}
function getsinglebag($id){
    global $conn;
    
    $sql = "SELECT * FROM orders WHERE storeuserid = '$id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $bagid = $row['id'];
        $bagtotalprice = numberFormat($row['order_total']);
        $bagname = $row['ordername'];
        echo "<tr>
        <td>
          <form method='POST' action='#'>
          <input name='bagid' value='$bagid' hidden>
          <input style='margin-top:6px;width:100%;' name='bagname' value='$bagname'/>
          <div class='table-links'>
            total price: <a href='#'>NGN $bagtotalprice</a>
            <div class='bullet'></div>
            <a href='#'>View</a>
          </div>
        </td>
        <td>
          <button name='bagbtn' style='border: 1px solid transparent;background-color:transparent;margin:0%;padding:0%;'>
          <a class='btn btn-danger btn-action' style='border: 1px solid transparent;background-color:green;' data-toggle='tooltip' title='update'>
          <i class='fa fa-check'></i>
          </a>
          </button>
          </form>
        </td>
      </tr>
        ";
    }
}

function getsingleorder($id){
    global $conn;
    
    $sql = "SELECT * FROM orders WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $orderid = $row['id'];
        $ordertotalprice = numberFormat($row['total_price']);
        $ordername = $row['ordername'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        #$country = $row['country'];
        $state = $row['state'];
        $city = $row['city'];
        $address = $row['address'];
        $phonenumber = $row['phonenumber'];
        $product = $row['product'];
        $payment_method = $row['payment_method'];
        $unitprice = $row['unitprice'];
        $food_price = $row['product_total_price'];
        $orderproduct = explode (",", $product);
        $orderunitprice = explode (",", $unitprice);
        $orderfood_price =  explode (",", $food_price);
        $date = $row['date'];
        echo "<tr>
        <td>
          order name: $ordername<br><br>
          customer name: $firstname $lastname<br><br>
          state: $state<br><br>
          city: $city<br><br>
          address: $address<br><br>
          phone number: <a href='tel: $phonenumber'>$phonenumber</a><br><br>
          date: $date<br><br>
          Total price: NGN $ordertotalprice<br><br>
          payment method: $payment_method<br><br>
            ";
            echo "<p style='text-align: center;font-weight:bolder;font-size:12pt;'>orders</p>";
            foreach($orderproduct as $measureindex =>$measuretype){
                $measurevalue = $orderunitprice[$measureindex];
                $order_price = $orderfood_price[$measureindex];
                $quantity = $order_price/$measurevalue;
                $sql2 = "SELECT * FROM products WHERE food_stuffs = '$measuretype'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $productid = $row2['id'];
                $sql3 = "SELECT * FROM product_measure WHERE product_id = '$productid' AND price='$measurevalue.00'";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                echo "
                    <hr>NGN$measurevalue per one ($quantity) - $measuretype ($row3[name]) -> NGN$order_price<br>
                    ";
            }
                echo "
        </td>
      </tr>
        ";
    }
}
?>