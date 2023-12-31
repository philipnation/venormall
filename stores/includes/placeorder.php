<?php
session_start();
include("conn.php");
if(!empty($_SESSION["shopping_cart"])) {
    $total_price = 0;
    foreach ($_SESSION["shopping_cart"] as $product){
        $total_price += $product["unit_price"]*$product['item_quantity'];
    }
}
else{
    $total_price = 0;
}
// Get the selling price for each order starts
$selling_price = 0;
foreach ($_SESSION["shopping_cart"] as $product){
$selling_sql = "SELECT * FROM products WHERE id='$product[item_id]'";
$selling_result = mysqli_query($conn, $selling_sql);
while($selling_row = mysqli_fetch_assoc($selling_result)){
    echo $product['item_id'];
    $selling_price += $selling_row['cost_price']*$product['item_quantity'];
}
}
// Get the selling price ends


    foreach ($_SESSION["shopping_cart"] as $product){
       // $price .= $product['item_price']. ",";
        $image .= $product['product_image']. ",";
        $unitprice .= $product['unit_price']. ",";
        $quantity .= $product['item_quantity']. ",";
        $name .= $product['item_name']. ",";
        $price .= $product['unit_price']*$product['item_quantity']. ",";
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $note = mysqli_real_escape_string($conn, $_POST['note']);
        $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
        $date = date('jS F, Y');
        $chartdate = date("Y-m-d");
        $time = date("h:i:sa");
        }
        $quantity = rtrim($quantity, ",");
        $price = rtrim($price, ",");
        $unitprice = rtrim($unitprice, ",");
        $image = rtrim($image, ",");
        $name = rtrim($name, ",");
        $ordername = "order".rand(10000, 9000000);
        $sql = "INSERT INTO orders(userid,storeuserid,ordername,firstname,lastname,country,state,city,street_address,phone_number,product_name,product_image,product_price,product_quantity_total,product_quantity,order_total, payment_method,email,delivery_note,date,action,order_date,selling_price,delivery_fee)
        VALUES('$_SESSION[userid]','$_SESSION[shopuser]','$ordername','$firstname', '$lastname', '$country', '$state', '$city', '$address', '$phone', '$name', '$image', '$unitprice', '$price', '$quantity','$total_price', '$payment_method','$email','$note','$date','pending','$chartdate','$selling_price','$_SESSION[delivery_fee]')";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $activitysql = "INSERT INTO storeuser_notification(userid,title,activity)
        VALUES('$_SESSION[shopuser]','Order placed','You just placed an order of NGN $total_price')";
        $activityresult = mysqli_query($conn, $activitysql) or die(mysqli_error($conn));


        require_once ('../../vendor/autoload.php'); // if you use Composer
        //require_once('ultramsg.class.php'); // if you download ultramsg.class.php
        $ultramsg_token="xj2mrzv2rpek300f"; // Ultramsg.com token
        $instance_id="instance68439"; // Ultramsg.com instance id
        $client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

        $to="$_SESSION[phone]";
        $body=" A user Just Placed an Order:
        User Details:
        Firstname: $firstname
        LastName: $lastname
        Country: $country
        State: $state
        City: $city
        Address: $address
        Phone Number: $phone
        Email: $email

        Order Details:
        Order ID: $ordername
        Product names/Number: $name - (NGN) $price
        Delivery Note: $note
        Date: $date
        Time: $time
        Total: NGN $total_price
        "; 
        $api=$client->sendChatMessage($to,$body);
        //print_r($api);

        //Send Image
        if($result){
            $_SESSION['customer_name'] = $firstname." ".$lastname;
            $_SESSION['customer_address'] = $address;
            $_SESSION['order_id'] = $ordername;
            header("Location: placed");
        }
        else{
            echo "Error".mysqli_error($conn);
        }
    ?>