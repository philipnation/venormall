<?php
include('header.php');
?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                    <h4><?php echo $user_row['business_name'] ?>, Manage your products</h4>
                    <p class="mb-md-0">Add, Edit and delete products.</p>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          
          
          <div class="row">
            <div class="col-md-12 stretch-card">
             <div class="card">
                <div class="card-body">
                  <p class="card-title">Products</p>
                  <div class="table-responsive">
                  <ul class="navbar-nav mr-lg-4 w-100">
                    <li class="nav-item nav-search d-lg-block w-100">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="search">
                            <i class="mdi mdi-magnify"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control" id="search_product" placeholder="Search Order" aria-label="search" aria-describedby="search">
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
                            <th>Images</th>
                            <th>Products</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="result">
                      <?php
                        $count = 0;
                        $product_sql = "SELECT * FROM products WHERE userid='$userid'";
                        $product_result = mysqli_query($conn, $product_sql);
                        if(mysqli_num_rows($product_result)>0){
                            while($product_row = mysqli_fetch_assoc($product_result)){
                                $selling_price = number_format($product_row['selling_price']);
                                $count++;
                                echo "
                                <tr>
                                    <td>$count</td>
                                    <td><img src='../stores/assets/images/product_image/$product_row[product_image]' alt='$product_row[product_name]'></td>
                                    <td>$product_row[product_name]</td>
                                    <td>$product_row[category]</td>
                                    <td>NGN $selling_price</td>
                                    <td>
                                    <div class='icons'>
                                        <!--<a href='#' class='small' title='copy single link'><i class='fa fa-link copy'><span style='display:none;'>localhost/venormall/stores/s/product-$product_row[product_code]-$userid</span></i></a>-->
                                        <a href='editproduct-$product_row[id]' class='atc' title='edit $product_row[product_name]'><i class='fa fa-pencil'></i></a>
                                        <a href='deleteproduct-$product_row[id]' class='atc' title='delete $product_row[product_name]'><i class='fa fa-trash'></i></a>
                                    </div>
                                    </td>
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

