<?php
include 'header.php';
include '../stores/notify.html';
if (isset($_GET['catid'])) {
  # code...
  $catid = $_GET['catid'];
  mysqli_query($conn, "DELETE FROM categories WHERE id='$catid'");
}
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">MANAGE CATEGORIES</h4>
                  <button class="btn btn-primary me-2" id="update-button" onclick="document.getElementById('add_media_form').style.display = 'block'">Add</button>
                  <?php
                    $social_media_sql = "SELECT * FROM categories WHERE userid='$userid'";
                    $social_media_result = mysqli_query($conn, $social_media_sql);
                    if(mysqli_num_rows($social_media_result) > 0){
                        echo "
                            <button class='btn btn-primary me-2' id='update-button' onclick='document.getElementById('update_media_form').style.display = 'block''>Update</button>
                        ";
                    }
                    ?>
                  <br><br>
                  <div class="forms-sample"><!--was form-->
                  <div class="update-details" id="add_media_form" style="display: none;">
                <div class="form-groups-cont">
                    <div class='form-group'>
                        <label for=''>Category Name</label>
                        <div class='input-box'>
                            <input type='text' placeholder="Category Name" id="media_link">
                        </div>
                    </div>
                    <button class="btn btn-primary me-2" id="add_media">Add Category</button><br><br>
                </div>
            </div>

            <div class="update-details" id="update_media_form" style="display: none;">
                <div class="form-groups-cont">
                        <label for=''>Old Category Name</label>
                        <div class='form-group'>
                            <select name="media_name" id="media_update_name" style="font-size: 9pt;">
                            <?php
                            $social_media_sql = "SELECT * FROM categories WHERE userid='$userid'";
                            $social_media_result = mysqli_query($conn, $social_media_sql);
                            if(mysqli_num_rows($social_media_result) > 0){
                                while($social_media_row = mysqli_fetch_assoc($social_media_result)){
                                    echo "
                                    <option value='$social_media_row[category]'>$social_media_row[category]</option>
                                    ";
                                }
                            }
                            else{
                              echo "<option value='none'>no category added</option>";
                            }
                        ?>
                            </select>
                        </div>
                    <div class='form-group'>
                        <label for=''>New Category Name</label>
                        <div class='input-box'>
                            <input type='text' placeholder="New Category Name" id="media_update_link">
                        </div>
                    </div>
                    <button class="btn btn-primary me-2" id="update_media">Update Category</button>
                </div>
            </div>

                  <?php
                    $social_media_sql = "SELECT * FROM categories WHERE userid='$userid'";
                    $social_media_result = mysqli_query($conn, $social_media_sql);
                    if(mysqli_num_rows($social_media_result) > 0){
                        while($social_media_row = mysqli_fetch_assoc($social_media_result)){
                            echo "
                            <div class='form-group'>
                                <input type='text' class='form-control' id='name' value='$social_media_row[category]' readonly>
                                <a href='category?catid=$social_media_row[id]'><i class='fa fa-trash'></i></a>
                            </div>
                            ";
                        }
                    }
                    else{
                        echo "<p style='text-align:center;'>No Category Added Yet</p>";
                    }
                    ?>
                   <!-- <button class="btn btn-primary me-2" id="update-button">Update</button>
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
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
</body>
<?php
include '../stores/notify.html';
?>
<script>
  $(document).ready(function() {
	$('#add_media').click(function() {
		var link = $("#media_link").val();
        $.post("includes/add_category.php", {
            //The building_unique_id is the post array and then the second onces are the variables
            link: link
        }, function(data, status){
            $("#notification").html(data);
            //alert(data);
            showNotification()
            document.getElementById("productmessage").innerText = "Category added"
            setTimeout(closenotification, 1000)
            setTimeout(function(){
                location.reload()
            }, 1500)
        });
	});
  });
  </script>

<script>
  $(document).ready(function() {
	$('#update_media').click(function() {
		var old_name = $("#media_update_name").val();
        var new_name = $("#media_update_link").val();
        $.post("includes/add_category.php", {
            //The building_unique_id is the post array and then the second onces are the variables
            old_name:old_name,
            new_name:new_name
        }, function(data, status){
            $("#notification").html(data);
            //alert(data);
            showNotification()
            document.getElementById("productmessage").innerText = "social media added"
            setTimeout(closenotification, 1000)
            setTimeout(function(){
                location.reload()
            }, 1500)
        });
	});
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
</html>