<?php
include("header.php");

function product_code() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    $length = 10;

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

if(isset($_POST['add_product'])){
    $file=$_FILES['file'];
    $filename=$_FILES['file']['name'];
    $filetmpname=$_FILES['file']['tmp_name'];
    $filesize=$_FILES['file']['size'];
    $fileerror=$_FILES['file']['error'];
    $filetype=$_FILES['file']['type'];

    $fileext=explode('.', $filename);
    $fileactualext=strtolower(end($fileext));

    $allowed=array('jpg', 'png', 'jpeg');


    $product_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8'));
    $cost_price = mysqli_real_escape_string($conn, htmlspecialchars($_POST['cost_price'], ENT_QUOTES, 'UTF-8'));
    $selling_price= mysqli_real_escape_string($conn, htmlspecialchars($_POST['selling_price'], ENT_QUOTES, 'UTF-8'));
    $product_category = mysqli_real_escape_string($conn, htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8'));
    $stock = mysqli_real_escape_string($conn, htmlspecialchars($_POST['stock'], ENT_QUOTES, 'UTF-8'));
    $product_description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['product_description'], ENT_QUOTES, 'UTF-8'));
    $product_code = product_code();

    if (in_array($fileactualext, $allowed)){
        if ($filesize<5000000000){
            $rand_no = rand(100, 100000);
            $filenamenew=$product_name.$rand_no.".".$fileactualext;
            $filedestination='../stores/assets/images/product_image/'.$filenamenew;
            move_uploaded_file($filetmpname, $filedestination);
            $add_sql=mysqli_query($conn,"INSERT INTO products(userid,category,product_code,product_name,product_price,product_image,amount_in_stock,product_description,cost_price,selling_price)
            VALUES('$userid','$product_category','$product_code','$product_name','$selling_price','$filenamenew','$stock','$product_description','$cost_price','$selling_price')")or die(mysqli_error($conn));
            $result=mysqli_query($conn, $add_sql);
            echo "<script>location.href='./products'</script>";
        }else{
            echo "too large";
        }

    }
    else{
        //echo "video must be jpg, jpeg or mp4";
        echo "<script>location.href='addproduct?errorimg'</script>";
    }
}
?>
<?php
  $social_media_sql = "SELECT * FROM categories WHERE userid='$userid'";
  $social_media_result = mysqli_query($conn, $social_media_sql);
  if(mysqli_num_rows($social_media_result) <= 0){
    //echo "<script>location.href='addproduct?errornocat'</script>";
    echo "<script>location.href='category'</script>";
  }
?>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <form class="card-body" action="#" method="post" enctype='multipart/form-data'>
                <?php
                if(isset($_GET['errorimg'])){
                    echo "<h4 class='small' style='color:red;text-align:center;'>Image must be in JPG or PNG or JPEG Format</h4>";
                }
                elseif(isset($_GET['errornocat'])){
                  echo "<h4 class='small' style='color:red;text-align:center;'>Add Category First before Adding Products. <a href='category'>Add</a></h4>";
              }
                ?>
                  <h4 class="card-title">ADD PRODUCT</h4>
                  <div class="forms-sample"><!--was form-->
                    <div class="form-group">
                      <label for="exampleInputName1">Product Name</label>
                      <input type="text" class="form-control" name="product_name" placeholder="Product Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Cost Price</label>
                      <input type="number" class="form-control" name="cost_price" placeholder="Cost Price">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Selling Price</label>
                      <input type="number" class="form-control" name="selling_price" placeholder="Selling Price">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Product Category</label>
                        <select class="form-control" name="category">
                    <?php
                        $category_sql = "SELECT * FROM categories WHERE userid='$userid'";
                        $category_result = mysqli_query($conn, $category_sql);
                        if(mysqli_num_rows($category_result)>0){
                            while($category_row = mysqli_fetch_assoc($category_result)){
                                echo "<option value='$category_row[category]'>$category_row[category]</option>";
                            }
                        }
                        else{
                            echo "<option value='none'>no category available</option>";
                        }
                    ?>
                    </select>
                    </div>
                    <!--<div class="form-group">
                      <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="exampleSelectGender">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                    </div>-->
                    <div class="form-group">
                      <label>Product Image</label>
                      <div class="input-group col-xs-12">
                        <input type="file" class="form-control file-upload-info" name="file" placeholder="Upload Image">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Amount in Stock</label>
                      <input type="number" class="form-control" name="stock" placeholder="Amount in Stock">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Product Descriptuon</label>
                      <textarea type="text" class="form-control" name="product_description" placeholder="Product Description"></textarea>
                    </div>
                    <button class="btn btn-primary me-2" name="add_product">Add Product</button>
                    <button class="btn btn-light">Cancel</button>
                </form><!--was /form-->
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

  <?php
include '../stores/notify.html';
?>
</html>
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
</body>
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
</html>
