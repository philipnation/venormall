<?php
include("header.php")
?>
<?php
if(isset($_POST['update'])){
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
                $rand = rand(100000, 9999999);
                $filenamenew=$rand.".".$fileactualext;
                $filedestination='../assets/img/'.$filenamenew;
                move_uploaded_file($filetmpname, $filedestination);
                $sql = "INSERT INTO sliding_images(image)VALUES('$filenamenew')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>location.href = 'index.php'</script>";
                }
                else{
                    echo "error";
                }
            }else{
                echo "too large";
            }

    }
    else{
        echo "video must be jpg, jpeg or mp4";
    }
}
?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Add image</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">add sliding image</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" method="post" action="#" enctype='multipart/form-data'>
                                    <div class="form-group">
                                        <label class="col-md-12">Image</label>
                                        <div class="col-md-12">
                                            <input type="file" name="file"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success text-white" name="update">Add image</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved. Designed and Developed by <a
                    href="https://wa.me/+2348120188577">Phitenxt</a>.
            </footer>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.js"></script>
</body>

</html>