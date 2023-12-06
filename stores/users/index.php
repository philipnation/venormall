<?php include("header.php"); ?>
      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div>Dashboard</div>
          </h1>
          <div class="row">
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-icon text-danger">
                  <i class="fa fa-shopping-bag" style="color :#0D0E52;"></i>
                </div>
                <div class="card-wrap">
                  <a href="#" style="color: black;text-decoration:none;">
                  <div class="card-body">
                    <?php echo getbags(); ?>
                  </div>
                  <div class="card-header">
                    <h4>Saved Orders</h4>
                  </div>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-icon text-danger">
                  <i class="fa fa-tasks" style="color :#0D0E52;"></i>
                </div>
                <div class="card-wrap">
                  <a href="#" style="color: black;text-decoration:none;">
                  <div class="card-body">
                  <?php echo getnotificationcount(); ?>
                  </div>
                  <div class="card-header">
                    <h4>notification</h4>
                  </div>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-icon text-danger">
                  <i class="fa fa-shopping-cart" style="color :#0D0E52;"></i>
                </div>
                <div class="card-wrap">
                  <a href="../cart" style="color: black;text-decoration:none;">
                  <div class="card-body">
                  <?php echo $total_price; ?>
                  </div>
                  <div class="card-header">
                    <h4>items</h4>
                  </div>
                  </a>
                </div>
              </div>
            </div>                  
          </div>
          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>pending items in cart(<?php echo $total_price ?>)</h4>
                </div>
                <div class="card-body">
                  <!--<canvas id="myChart" height="158"></canvas>-->
                  <div class="statistic-details mt-sm-4">
                    <?php
                    $total_price = 0;
                    ?> 
                    <?php		
                      foreach ($_SESSION["shopping_cart"] as $product){
                    ?>
                    <?php
                        $c = 'SELECT * FROM products WHERE id='.$product['item_id'].'';
                        $d = mysqli_query($conn, $c) or die (mysqli_error($conn));
                        while ($row = mysqli_fetch_assoc($d)){
                            $id = $row['id'];
                            $food_image = $row['product_image'];
                            $food_description = $row['product_description'];
                            $total_price += $product["item_price"];
                            $_SESSION['total_price'] = $total_price;
                            $price = numberFormat($product['item_price']);
                            echo "
                            <div class='statistic-details-item'>
                                  <div class='detail-value'><i class='fa fa-shopping-bag'></i></div>
                                  <div class='detail-value'>NGN $price </div>
                                  <div class='detail-name'>quantity: $product[item_quantity]</div>
                                  <div class='detail-name'>$product[item_name]</div>
                            </div>
                        ";
                        }
                    }
                    if(empty($_SESSION["shopping_cart"])){
                      echo "<div class='statistic-details-item'>
                      <p style='text-align:center;color:black;'>Cart is empty</p>
                      </div>
                      ";
                    }
                    
                    ?> 
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Recent Activities</h4>
                    <a href="delactivities" class="btn btn-primary" style="border: 1px solid transparent;">Delete all</a>
                </div>
                <div class="card-body">             
                  <ul class="list-unstyled list-unstyled-border">
                    <?php getfullactivity(); ?>
                  </ul>
                  <!--<div class="text-center">
                    <a href="#" class="btn btn-primary btn-round" style="border: 1px solid transparent;">
                      View All
                    </a>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!--<div class="col-lg-5 col-md-12 col-12 col-sm-12">
              <form method="post" class="needs-validation" novalidate="">
                <div class="card">
                  <div class="card-header">
                    <h4>Quick message to customer support</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="title" class="form-control" required>
                      <div class="invalid-feedback">
                        Please fill in the title
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Content</label>
                      <textarea class="summernote-simple"></textarea>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-primary" style="border: 1px solid transparent;">Send message</button>
                  </div>
                </div>
              </form>
            </div>-->
            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <div class="float-right">
                    <a href="bags" class="btn btn-primary" style="border: 1px solid transparent;">View All</a>
                  </div>
                  <h4>Orders</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Orders</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php getfullbag(5); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2023 <div class="bullet"></div> <!--Design By <a href="https://multinity.com/">Multinity</a>-->
        </div>
        <div class="footer-right"></div>
      </footer>
    </div>
  </div>

  <script src="dist/modules/jquery.min.js"></script>
  <script src="dist/modules/popper.js"></script>
  <script src="dist/modules/tooltip.js"></script>
  <script src="dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="dist/js/sa-functions.js"></script>
  
  <script src="dist/modules/chart.min.js"></script>
  <script src="dist/modules/summernote/summernote-lite.js"></script>
  <script src="dist/js/scripts.js"></script>
  <script src="dist/js/custom.js"></script>
  <!--<script src="dist/js/demo.js"></script>-->
</body>
</html>