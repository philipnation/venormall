<?php
include("header.php");
?>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">PROFILE</h4>
                  <p class="card-description">
                    Update profile
                  </p>
                  <div class="forms-sample"><!--was form-->
                    <div class="form-group">
                      <label for="exampleInputName1">FullName</label>
                      <input type="text" class="form-control" id="name" value="<?php echo $user_row['name'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Email</label>
                      <input type="text" class="form-control" id="email" value="<?php echo $user_row['email'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Status</label>
                      <input type="text" class="form-control" id="delivery_fee" value="<?php echo $user_row['action'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Plan</label>
                      <input type="text" class="form-control" id="plan" value="<?php echo $user_row['plan'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">business_name</label>
                      <input type="text" class="form-control" id="business_name" value="<?php echo $user_row['business_name'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Phone Number</label>
                      <input type="tel" class="form-control" id="mobile" pattern='[0-9]{10,}' value="<?php echo $user_row['phone_number'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Referral Code</label>
                      <input type="text" class="form-control" id="color" value="<?php echo $user_row['ref_code'] ?>" readonly>
                      <i class="fa fa-copy"></i>
                    </div>
                    <button class="btn btn-primary me-2" id="update-button">Update</button>
                    <button class="btn btn-light">Cancel</button>
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
