<?php
include('header.php');
?>
<?php
    function get_report($var){
        global $conn;
        global $userid;
        $today = date("d");
        $month = date("m");
        $year = date("Y");
        if($var == "day"){
            $report_sql = "SELECT order_date, order_total FROM orders WHERE userid='$userid' AND DAY(order_date) = $today AND MONTH(order_date) = $month AND YEAR(order_date) = $year AND action = 'delivered'";
        }
        elseif($var == "month"){
            $report_sql = "SELECT order_date, order_total FROM orders WHERE userid='$userid' AND MONTH(order_date) = $month AND YEAR(order_date) = $year AND action = 'delivered'";
        }
        elseif($var == "year"){
            $report_sql = "SELECT order_date, order_total FROM orders WHERE userid='$userid' AND YEAR(order_date) = $year AND action = 'delivered'";
        }
        $report_result = mysqli_query($conn, $report_sql);
        echo mysqli_num_rows($report_result);
    }
    function get_rep_total($var){
        global $conn;
        global $userid;
        $today = date("d");
        $month = date("m");
        $year = date("Y");
        $count = 0;
        if($var == "day"){
            $report_sql = "SELECT order_date, order_total FROM orders WHERE userid='$userid' AND DAY(order_date) = $today AND MONTH(order_date) = $month AND YEAR(order_date) = $year AND action = 'delivered'";
        }
        elseif($var == "month"){
            $report_sql = "SELECT order_date, order_total FROM orders WHERE userid='$userid' AND MONTH(order_date) = $month AND YEAR(order_date) = $year  AND action = 'delivered'";
        }
        elseif($var == "year"){
            $report_sql = "SELECT order_date, order_total FROM orders WHERE userid='$userid' AND YEAR(order_date) = $year AND action = 'delivered'";
        }
        $report_result = mysqli_query($conn, $report_sql);
        while($report_row = mysqli_fetch_assoc($report_result)){
            $count += $report_row['order_total'];
            //echo $report_row['order_total']."<br>";
        }
        echo number_format($count);
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
                    <h4>You can know how your company is going</h4>
                    <p class="mb-md-0">View Order details...</p>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">

                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Today</small>
                            <h6 class="me-2 mb-0">Total Order: <?php get_report('day'); ?></h6>
                            <p class="me-2 mb-0">NGN <?php get_rep_total('day'); ?></p>
                          </div>
                        </div>

                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">This Month</small>
                            <h6 class="me-2 mb-0">Total Order: <?php get_report('month'); ?></h6>
                            <p class="me-2 mb-0">NGN <?php get_rep_total('month'); ?></p>
                          </div>
                        </div>

                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <div class="d-flex flex-column justify-content-around">
                            <small class="me-2 mb-0">This Year</small>
                            <h6 class="text-muted">Total Order: <?php get_report('year'); ?></h6>
                            <p class="me-2 mb-0">NGN <?php get_rep_total('year'); ?></p>
                          </div>
                        </div>
                        
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12 stretch-card">
             <div class="card">
                <div class="card-body">
                  <p class="card-title">Recent Orders</p>
                  <div class="table-responsive">
                  <ul class="navbar-nav mr-lg-4 w-100">
                    <li class="nav-item nav-search d-lg-block w-100">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="search">
                            <i class="mdi mdi-magnify"></i>
                          </span>
                        </div>
                        <!--<input type="text" class="form-control" id="search_product" placeholder="Search Order" aria-label="search" aria-describedby="search">-->
                      </div>
                    </li>
                  </ul>
                  <script>
                      $(document).ready(function(){

                      $("#search_product").keyup(function(){
                          var name = $("#search_product").val();
                          $.post("includes/search_product.php", {
                              sugess: name
                          }, function(data, status){
                              $("#result").html(data);
                              //alert(data)
                          });
                      });
                      });
                  </script>
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>DATE DELIVERY</th>
                          <th>DELIVERY FEE</th>
                          <th>CUSTOMER PAID</th>
                          <th>SELLING PRICE</th>
                          <th>GAIN</th>
                        </tr>
                      </thead>
                      <tbody id="result">
                      <?php
                        $count = 0;
                        $report_result = mysqli_query($conn, "SELECT * FROM order_report WHERE userid='$userid'");
                        if(mysqli_num_rows($report_result) > 0){
                            while($report_row = mysqli_fetch_assoc($report_result)){
                                $gain = number_format($report_row['price_sold'] - $report_row['price_gained']);
                                $price_sold = number_format($report_row['price_sold']);
                                $price_gained = number_format($report_row['price_gained']);
                                $count++;
                                echo "
                                    <tr>
                                        <td>$count</td>
                                        <td>$report_row[date_delivered]</td>
                                        <td>NGN $report_row[delivery_fee]</td>
                                        <td>NGN $price_sold</td>
                                        <td>NGN $price_gained</td>
                                        <td>NGN $gain</td>
                                    </tr>
                                    ";
                            }
                        }
                        else{
                            echo "
                            <tr>
                                <td></td>
                                <td></td>
                                <td>no report available</td>
                                <td></td>
                                <td></td>
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

