<?php
include("header.php");
if(isset($_GET['deliver'])){
    $oid = $_GET['deliver'];
    $date = date('jS F, Y');
    $deliver_sql = "UPDATE orders SET action='delivered' WHERE ordername='$oid'";
    $deliver_result = mysqli_query($conn, $deliver_sql);
    if($deliver_result){
        $order_get_result = mysqli_query($conn, "SELECT * FROM orders WHERE ordername='$oid' AND userid='$userid'");
        $order_get_row = mysqli_fetch_assoc($order_get_result);
        $order_insert_result = mysqli_query($conn,"INSERT INTO order_report(userid,orderid,price_sold,price_gained,delivery_fee,date_ordered,date_delivered)
        VALUES('$userid','$oid','$order_get_row[order_total]','$order_get_row[selling_price]','$order_get_row[delivery_fee]','$order_get_row[date]','$date')");
        if($order_insert_result){
           echo "<script>location.href='./'</script>";
            //var_dump($order_get_row);
        }
        else{
            echo "error".mysqli_error($conn);
        }
    }
    else{
        echo "error";
    }
}
if(isset($_GET['decline'])){
    $oid = $_GET['decline'];
    $deliver_sql = "UPDATE orders SET action='declined' WHERE ordername='$oid'";
    $deliver_result = mysqli_query($conn, $deliver_sql);
    if($deliver_result){
        //header("Location: ./orders");
        echo "<script>location.href='./'</script>";
    }
    else{
        echo "error";
    }
}
if(!isset($_GET['ordername'])){
    //header("Location: ./orders");
}
else{
    $ordername = $_GET['ordername'];
    $single_order_sql = "SELECT * FROM orders WHERE ordername = '$ordername'";
    $single_order_result = mysqli_query($conn, $single_order_sql);
    if(mysqli_num_rows($single_order_result) > 0 ){
        $single_order_row = mysqli_fetch_assoc($single_order_result);
        $product_name = explode (",", $single_order_row['product_name']);
        $product_price = explode (",", $single_order_row['product_price']);
        $product_quantity = explode (",", $single_order_row['product_quantity']);
        $product_image = explode (",", $single_order_row['product_image']);
        $product_quantity_total = explode (",", $single_order_row['product_quantity_total']);
        $status = $single_order_row['action'];
        //$product_id = $single_order_row['product_code'];
    }
    else{
        header("Location: ../");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="recent-purchases-listing" class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>product</th>
                                <th>quantity</th>
                                <th>amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($product_name as $index =>$name){
                                    $image = $product_image[$index];
                                    $price = $product_price[$index];
                                    $quantity = $product_quantity[$index];
                                    $quantity_total = $product_quantity_total[$index];
                                    echo "
                                            <tr>
                                        <td>
                                            <div class='td-content'>
                                                <img src='../stores/assets/images/product_image/$image' alt='p-img'>
                                                <h4>
                                                    <p style='text-transform: capitalize;'>$name</p>
                                                    <p>NGN $price</p>
                                                </h4>
                                            </div>
                                        </td>
                                        <td>
                                            <div class='td-content'>
                                                <h4>
                                                    <p style='margin-bottom: 8px;'>$quantity</p>
                                                    <!--<p style='text-transform: capitalize;'>Available stock: 50</p>-->
                                                </h4>
                                            </div>
                                        </td>
                                        <td>
                                            <div class='td-content' style='text-transform: uppercase;'>
                                                NGN $quantity_total
                                            </div>
                                        </td>
                                    </tr>
                                        ";
                                }
                            ?>
                            <tr>
                                <td>Date - <?php echo $single_order_row['date'] ?></td>
                                <td></td>
                                <td style="text-transform: uppercase;">Total - NGN <?php echo $single_order_row['order_total'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="view-ord-details">
                <div class="view-headers">
                    <a href="#" id="shippingBtn" onclick="shipping()">
                        <header>delivery</header>
                    </a>
                    <a href="#" id="paymentBtn"  onclick="payment()">
                        <header>send mail/sms</header>
                    </a>
                </div>
            </div>

        </div>

        <div class="row">
                    <div class="col-md-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>PAYMENT METHOD</th>
                                            <th>STATUS</th>
                                            <th>DELIVERY NOTE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $single_order_row['payment_method'] ?></td>
                                            <td style="color: <?php if($status == 'pending'){echo 'yellow';}elseif($status == 'delivered'){echo 'green';}elseif($status == 'declined'){echo 'red';} ?>;"><?php echo $single_order_row['action'] ?></td>
                                            <td><?php echo $single_order_row['delivery_note'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            if($status == 'delivered' || $status=='declined'){

                            }
                            else{
                                echo "";?>
                                <button name="send_email" class="btn btn-primary me-2"><a href="decline-<?php echo $ordername ?>" style="text-decoration:none;color:#fff">order declined</a></button><br>
                                <button name="send_sms" class="btn btn-danger me-2"><a href="deliver-<?php echo $ordername ?>" style="text-decoration:none;color:#fff">order delivered</a></button>
                                <?php echo "";
                            }
                            ?>
                            <!--<div class="info-table">
                                <header class="info-header">
                                    Shipping information
                                </header>
                                <div class="table-responsive">
                                    <table class="table custom-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>shipping name</th>
                                                <th>estimated delivery time</th>
                                                <th>shiiping rate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>standard shipping</td>
                                                <td>3-5 working days</td>
                                                <td>NGN50.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>-->
                        </div>
                    </div>



                    <div class="payment-cont" id="payment-cont">
                        <div class="payment-box">
                            <div class="payment-headers">
                                <!--<header class="site-name">reach out</header>-->
                            </div>
                            <div class="payment-form-box">
                                <!--<header>Payment Information</header>-->
                                <!--<div class="details">
                                    <form>
                                        <div class="form-groups">
                                            <input type="text" placeholder='subject' name="subject">
                                        </div>
                                        <div class="form-groups">
                                            <textarea name="message" id="" cols="30" rows="10" placeholder="message"></textarea>
                                        </div>
                                        <div class="form-groups">
                                            <button class="pay-btn" name="send_email">send email</button>
                                            <button class="pay-btn" name="send_sms">send sms</button>
                                        </div>
                                    </form>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

        <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" style="text-align:center;">CUSTOMER'S DETAILS</h4>
                  <div class="forms-sample"><!--was form-->
                    <div class="form-group">
                      <label for="exampleInputName1">Fisrt Name</label>
                      <input type="text" class="form-control" id="name" value="<?php echo $single_order_row['firstname'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Last Name</label>
                      <input type="text" class="form-control" id="email" value="<?php echo $single_order_row['lastname'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Email</label>
                      <input type="text" class="form-control" id="business_name" value="<?php echo $user_row['email'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Phone Number</label>
                      <input type="tel" class="form-control" id="mobile" pattern='[0-9]{10,}' value="<?php echo $single_order_row['phone_number'] ?>">
                    </div>
                    <br>
                    <h4 class="card-title" style="text-align:center;">DELIVERY DETAILS</h4>
                    <br>
                    <div class="form-group">
                      <label for="exampleInputName1">Country</label>
                      <input type="text" class="form-control" id="name" value="<?php echo $single_order_row['country'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">State</label>
                      <input type="text" class="form-control" id="email" value="<?php echo $single_order_row['state'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">City</label>
                      <input type="text" class="form-control" id="business_name" value="<?php echo $single_order_row['city'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Street Address</label>
                      <input type="tel" class="form-control" id="mobile" pattern='[0-9]{10,}' value="<?php echo $single_order_row['street_address'] ?>">
                    </div>
                    <!--<button class="btn btn-primary me-2" id="update-button">Update</button>
                    <button class="btn btn-light">Cancel</button>-->
                </div><!--was /form-->
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!--<footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard  </a> templates</span>
        </div>
        </footer>-->
        <!-- partial -->
      </div>
    </div>
</body>
<!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/file-upload.js"></script>
  <!-- End custom js for this page-->
</html>