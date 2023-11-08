<?php
include 'header.php';
include '../stores/notify.html';
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
                  <h4 class="card-title">PROFILE</h4>
                  <p class="card-description">
                    social media accounts
                  </p>
                  <button class="btn btn-primary me-2" id="update-button" onclick="document.getElementById('add_media_form').style.display = 'block'">Add</button>
                  <button class="btn btn-primary me-2" id="update-button" onclick="document.getElementById('update_media_form').style.display = 'block'">Update</button>
                  <br><br>
                  <div class="forms-sample"><!--was form-->
                  <div class="update-details" id="add_media_form" style="display: none;">
                <div class="form-groups-cont">
                        <label for=''>name</label>
                        <div class='form-group'>
                            <select name="media_name" id="media_name" style="font-size: 9pt;">
                                <option value="none">--select social media--</option>
                                <option value="whatsapp">whatsapp</option>
                                <option value="facebook">facebook</option>
                                <option value="twitter">twitter</option>
                                <option value="instagram">instagram</option>
                            </select>
                        </div>
                    <div class='form-group'>
                        <label for=''>link</label>
                        <div class='input-box'>
                            <input type='url' placeholder="" id="media_link">
                        </div>
                    </div>
                    <button class="btn btn-primary me-2" id="add_media">add social media</button><br><br>
                </div>
            </div>

            <div class="update-details" id="update_media_form" style="display: none;">
                <div class="form-groups-cont">
                        <label for=''>name</label>
                        <div class='form-group'>
                            <select name="media_name" id="media_update_name" style="font-size: 9pt;">
                                <option value="none">--select social media--</option>
                                <option value="whatsapp">whatsapp</option>
                                <option value="facebook">facebook</option>
                                <option value="twitter">twitter</option>
                                <option value="instagram">instagram</option>
                            </select>
                        </div>
                    <div class='form-group'>
                        <label for=''>new link</label>
                        <div class='input-box'>
                            <input type='url' placeholder="" id="media_update_link">
                        </div>
                    </div>
                    <button class="btn btn-primary me-2" id="update_media">update social media</button>
                </div>
            </div>

                  <?php
                    $social_media_sql = "SELECT * FROM social_media WHERE userid='$userid'";
                    $social_media_result = mysqli_query($conn, $social_media_sql);
                    if(mysqli_num_rows($social_media_result) > 0){
                        while($social_media_row = mysqli_fetch_assoc($social_media_result)){
                            echo "
                            <div class='form-group'>
                                <label for='exampleInputName1'>$social_media_row[name]</label>
                                <input type='text' class='form-control' id='name' value='$social_media_row[link]' readonly>
                            </div>
                            ";
                        }
                    }
                    else{
                        echo "<small>no social media added</small>";
                    }
                    ?>
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
</body>
<?php
include '../stores/notify.html';
?>
<script>
  $(document).ready(function() {
	$('#add_media').click(function() {
		var name = $("#media_name").val();
		var link = $("#media_link").val();
        $.post("includes/add_media.php", {
            //The building_unique_id is the post array and then the second onces are the variables
            name: name,
            link: link
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

<script>
  $(document).ready(function() {
	$('#update_media').click(function() {
		var update_name = $("#media_update_name").val();
		var link = $("#media_update_link").val();
        $.post("includes/add_media.php", {
            //The building_unique_id is the post array and then the second onces are the variables
            update_name: update_name,
            link: link
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