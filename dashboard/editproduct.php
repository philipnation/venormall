<?php
include("header.php");
$p_id = $_GET['productid'];
$p_result = mysqli_query($conn, "SELECT * FROM products WHERE id='$p_id' AND userid='$userid'");
$p_row = mysqli_fetch_assoc($p_result);

if(isset($_POST['add_product'])){
    $product_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8'));
    $cost_price = mysqli_real_escape_string($conn, htmlspecialchars($_POST['cost_price'], ENT_QUOTES, 'UTF-8'));
    $selling_price= mysqli_real_escape_string($conn, htmlspecialchars($_POST['selling_price'], ENT_QUOTES, 'UTF-8'));
    $product_category = mysqli_real_escape_string($conn, htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8'));
    $stock = mysqli_real_escape_string($conn, htmlspecialchars($_POST['stock'], ENT_QUOTES, 'UTF-8'));
    $product_description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['product_description'], ENT_QUOTES, 'UTF-8'));

    $add_sql=mysqli_query($conn,"UPDATE products SET category='$product_category',product_name='$product_name',product_price='$selling_price',amount_in_stock='$stock',product_description='$product_description',cost_price='$cost_price',selling_price='$selling_price' WHERE id='$p_id' AND userid='$userid'");
    $result=mysqli_query($conn, $add_sql);
    echo "<script>location.href='./products'</script>";

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
                ?>
                  <h4 class="card-title">ADD PRODUCT</h4>
                  <div class="forms-sample"><!--was form-->
                    <div class="form-group">
                      <label for="exampleInputName1">Product Name</label>
                      <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="<?php echo $p_row['product_name'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Cost Price</label>
                      <input type="number" class="form-control" name="cost_price" placeholder="Cost Price" value="<?php echo $p_row['cost_price'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Selling Price</label>
                      <input type="number" class="form-control" name="selling_price" placeholder="Selling Price" value="<?php echo $p_row['selling_price'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Product Category</label>
                        <select class="form-control" name="category">
                        <option value="<?php echo $p_row['category'] ?>"><?php echo $p_row['category'] ?></option>
                                    <?php
                                    $category_sql = "SELECT * FROM categories WHERE userid='$userid'";
                                    $category_result = mysqli_query($conn, $category_sql);
                                    if(mysqli_num_rows($category_result)>0){
                                        while($category_row = mysqli_fetch_assoc($category_result)){
                                            if($category_row['category'] == $p_row['category']){

                                            }
                                            else{
                                                echo "<option value='$category_row[category]'>$category_row[category]</option>";
                                            }
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
                    <!--<div class="form-group">
                      <label>Product Image</label>
                      <div class="input-group col-xs-12">
                        <input type="file" class="form-control file-upload-info" name="file" placeholder="Upload Image">
                      </div>
                    </div>-->
                    <div class="form-group">
                      <label for="exampleInputCity1">Amount in Stock</label>
                      <input type="number" class="form-control" name="stock" placeholder="Amount in Stock" value="<?php echo $p_row['amount_in_stock'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Product Descriptuon</label>
                      <textarea type="text" class="form-control" name="product_description" placeholder="Product Description"><?php echo $p_row['product_description'] ?></textarea>
                    </div>
                    <button class="btn btn-primary me-2" name="add_product">Update Product</button>
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
<script>
  $(document).ready(function() {
	$('#update-button').click(function() {
		var name = $("#name").val();
		var business_name = $("#business_name").val();
		var email = $("#email").val();
		var mobile = $("#mobile").val();
        $.post("includes/update_account.php", {
            //The building_unique_id is the post array and then the second onces are the variables
            name: name,
			business_name: business_name,
			email: email,
			mobile: mobile
        }, function(data, status){
            $("#notification").html(data);
            //alert(data);
            showNotification()
            //document.getElementById("productmessage").innerText = "updated"
            setTimeout(closenotification, 1000)
        });
	});
  });
  </script>
</html>
<?php

if(isset($_POST['add_image'])){
    $file=$_FILES['file'];
    $filename=$_FILES['file']['name'];
    $filetmpname=$_FILES['file']['tmp_name'];
    $filesize=$_FILES['file']['size'];
    $fileerror=$_FILES['file']['error'];
    $filetype=$_FILES['file']['type'];

    $fileext=explode('.', $filename);
    $fileactualext=strtolower(end($fileext));

    $allowed=array('jpg', 'png', 'jpeg');

    if (in_array($fileactualext, $allowed)){
        if ($filesize<5000000000){
            $rand_no = rand(100, 100000);
            $filenamenew="logo".$rand_no.".".$fileactualext;
            $filedestination='../stores/assets/images/logo/'.$filenamenew;
            move_uploaded_file($filetmpname, $filedestination);
            $add_sql=mysqli_query($conn,"UPDATE store_setting SET logo = '$filenamenew' WHERE userid = '$userid'")or die(mysqli_error($conn));
            $result=mysqli_query($conn, $add_sql);
            echo "<script>location.href = 'store'</script>";
        }else{
            echo "too large";
        }

    }
    else{
        echo "video must be jpg, jpeg or mp4";
    }
}
?>
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
        //alert("Copied: " + text);
        document.getElementById("productmessage").innerText = "URL copied"
        showNotification()
        setTimeout(closenotification,1000)
    });
</script>
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

</html>
