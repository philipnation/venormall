<?php
include('header.php');
function get__total(){
  global $conn;
  global $user_row;
  $report_sql = "SELECT * FROM referral WHERE ref_code='$user_row[ref_code]'";
  $report_result = mysqli_query($conn, $report_sql);
  echo mysqli_num_rows($report_result);
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
                    <h4>Referral</h4>
                    <p class="mb-md-0">VenorCredit</p>
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
                        <div class="d-flex d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">VenorCredit</small>
                              <a class="btn btn-secondary p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#">
                                <h5 class="mb-0 d-inline-block">NGN <?php echo number_format($user_row['venorcredit']) ?></h5>
                              </a>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Referred</small>
                            <h5 class="me-2 mb-0"><?php get__total(); ?></h5>
                          </div>
                        </div>
                        
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Referral Code</small>
                            <h5 class="me-2 mb-0" id="ref_code"><?php echo $user_row['ref_code'] ?></h5>
                            <i class="fa fa-copy" id="ref_copy" style="text-align: center;"></i>
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
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">A QUICK ONE</p>
                  <p class="mb-4"><em>"You can be earning steadly just by referring others. That's very easy. Am I right?"</em></p>
                  <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                  <!--<canvas id="cash-deposits-chart"></canvas>-->
                </div>
              </div>
            </div>
          <!--<div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Store About</p>
                  <h1>$ 28835</h1>
                  <h4><?php echo $store_row['store_description'] ?></h4>
                  <p class="text-muted"><?php echo $store_row['about'] ?></p>
                  <div id="total-sales-chart-legend"></div>                  
                </div>
                <canvas id="total-sales-chart"></canvas>
              </div>
            </div>-->
          </div>
          <div class="row">
            <div class="col-md-12 stretch-card">
             <div class="carde">
                <div class="card-body">
                  <p class="card-title">PEOPLE YOU REFERRED</p>
                  <div class="table-responsive">
                  <ul class="navbar-nav mr-lg-4 w-100">
                    <li class="nav-item nav-search d-lg-block w-100">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <!--<span class="input-group-text" id="search">
                            <i class="mdi mdi-magnify"></i>
                          </span>-->
                        </div>
                        <!--<input type="text" class="form-control" id="search_order" placeholder="Search Order" aria-label="search" aria-describedby="search">-->
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
                            <th>S/N</th>
                            <th>NAME</th>
                            <th>PLAN</th>
                            <th>CREDIT EARNED</th>
                            <th>STATUS</th>
                        </tr>
                      </thead>
                      <tbody id="order_tr">
                      <?php
                        
                        $count = 0;
                        $report_result = mysqli_query($conn, "SELECT * FROM referral WHERE ref_code='$user_row[ref_code]'");
                        if(mysqli_num_rows($report_result) > 0){
                            while($report_row = mysqli_fetch_assoc($report_result)){
                                $count++;
                                $invite_id = $report_row['userid'];
                                $invite_result = mysqli_query($conn, "SELECT * FROM users WHERE userid='$invite_id'");
                                $invite_row = mysqli_fetch_assoc($invite_result);
                                if($invite_row['plan'] == 'starter'){
                                    $plan_price = "NGN 2,000";
                                }
                                elseif($invite_row['plan'] == 'professional'){
                                    $plan_price = "NGN 5,000";
                                }
                                elseif($invite_row['plan'] == 'advanced'){
                                    $plan_price = "NGN 10,000";
                                }
                                else{
                                    $plan_price = 'Error';
                                }


                                # For status
                                
                                if($invite_row['status'] == 'unpaid'){
                                    $plan_status = "Pending";
                                }
                                elseif($invite_row['status'] == 'paid'){
                                    $plan_status = "Completed";
                                }
                                else{
                                    $plan_status = 'Error';
                                }
                                echo "
                                <tr>
                                            <td>$count</td>
                                            <td>$invite_row[name]</td>
                                            <td>$invite_row[plan]</td>
                                            <td>$plan_price</td>
                                            <td>$plan_status</td>
                                        </tr>
                                        ";
                                }
                            }
                            else{
                                echo "
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>NO REFERRAL YET</td>
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
  <script>
    var btn_copy = document.querySelector("#ref_copy").addEventListener("click", function() { 
        //alert(1)
        var copyText = document.createElement("textarea");
        var text =document.getElementById("ref_code").innerText
        copyText.value = text;
        document.body.appendChild(copyText);
        copyText.select();
        document.execCommand("copy");
        document.body.removeChild(copyText);
        alert("Referral Link Copied");
        document.getElementById("productmessage").innerText = "Referral code copied"
        showNotification()
        setTimeout(closenotification,1000)
    });
</script>
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

