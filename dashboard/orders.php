<?php
include('header.php');
if(!isset($_GET['status'])){
  echo "<script>location.href='./'</script>";
}
if($_GET['status'] != "pending" && $_GET['status'] != "delivered" && $_GET['status'] != "declined"){
  echo "<script>location.href='./'</script>";
}

?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                    <h4>Welcome back, <?php echo $user_row['business_name'] ?></h4>
                    <p class="mb-md-0">Manage your Store with ease....</p>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stretch-card">
             <div class="card">
                <div class="card-body">
                  <p class="card-title"><?php echo $_GET['status'] ?> Orders</p>
                  <div class="table-responsive">
                  <ul class="navbar-nav mr-lg-4 w-100">
                    <li class="nav-item nav-search d-lg-block w-100">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="search">
                            <i class="mdi mdi-magnify"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control" id="search_order" placeholder="Search Order" aria-label="search" aria-describedby="search">
                      </div>
                    </li>
                  </ul>
                  <script>
                      $(document).ready(function(){

                      $("#search_order").keyup(function(){
                          var name = $("#search_order").val();
                          $.post("includes/search_order.php", {
                              sugess: name
                          }, function(data, status){
                              $("#order_tr").html(data);
                              //alert(data)
                          });
                      });
                      });
                  </script>
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Products</th>
                            <th>Customer</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="order_tr">
                      <?php
                        $order_sql = "SELECT * FROM orders WHERE userid='$userid' AND action='$_GET[status]' ORDER BY id DESC";
                        $order_result = mysqli_query($conn, $order_sql);
                        while($order_row = mysqli_fetch_assoc($order_result)){
                          $product_image = explode (",", $order_row['product_image']);
                          $order_total = number_format($order_row['order_total']);
                          echo "
                          <tr>
                          <td>
                              $order_row[ordername]
                          </td>
                          <td>
                          ";
                              foreach($product_image as $image){
                                  echo "
                                      <img src='../stores/assets/images/product_image/$image' alt='pro' style='display:none;'>
                                      ";
                              }
                                  echo "
                              <p>$order_row[product_name]</p>
                          </td>
                          <td>
                              $order_row[firstname] $order_row[lastname]
                              $order_row[email]
                          </td>
                          <td>
                              $order_row[product_price]
                          </td>
                          <td>
                              $order_row[product_quantity]
                          </td>
                          <td>
                              $order_row[street_address]
                          </td>
                          <td>
                              $order_row[date]
                          </td>
                          <td>
                              $currency$order_total
                          </td>
                          <td>
                              <div class='d-flex justify-content-between align-items-end flex-wrap'>
                                <button type='button' class='btn btn-icon me-3 d-md-block '>
                                <!--bg-white-->
                                <a href='vieworder-$order_row[ordername]'><i class='mdi mdi-eye text-muted'></i></a>
                                </button>
                              </div>
                          </td>
                      </tr>
                          ";
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
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
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->

  <script src="js/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>

