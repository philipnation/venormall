<?php
include("header.php");
if (isset($_GET['draftid'])) {
    # code...
    mysqli_query($conn,"UPDATE blogs SET status='draft' WHERE id='$_GET[draftid]'");
    echo "<script>location.href='./'</script>";
}
elseif (isset($_GET['deleteid'])) {
    # code...
    mysqli_query($conn,"DELETE FROM blogs WHERE id='$_GET[deleteid]'");
    echo "<script>location.href='./'</script>";
}
?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <!--<li class="breadcrumb-item active" aria-current="page">Library</li>-->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex">
                                    <div>
                                        <h4 class="card-title">Users</h4>
                                        <h5 class="card-subtitle">Users History</h5>
                                    </div>
                                    <div class="col-7">
                                        <div class="text-end upgrade-btn">
                                            <a href="addservice.php" class="btn btn-danger text-white">Send Message</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">S/N</th>
                                            <th class="border-top-0">Business Name</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Venor Credit</th>
                                            <th class="border-top-0">Plan</th>
                                            <th class="border-top-0">More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM users";
                                        $result = mysqli_query($conn, $sql);
                                        if (!$result) {
                                            # code...
                                            echo mysqli_error($conn);
                                        }
                                        $i = 0;
                                        while($row = mysqli_fetch_assoc($result)){
                                            $venorcredit = number_format($row['venorcredit']);
                                            $i++;
                                            echo "
                                            <tr>
                                            <td>$i</td>
                                            <td>
                                                <label class='label label-danger'>$row[business_name]</label>
                                            </td>
                                            <td>$row[name]</td>
                                            <td>$row[email]</td>
                                            <td>NGN $venorcredit</td>
                                            <td>$row[plan]</td>
                                            <td><a href='single.php?id=$row[id]'><i class='fa fa-bars'></i></a></td>
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
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Blog Post</h4>
                            </div>
                            <div class="comment-widgets scrollable">
                            <?php
                            function getFirst22Words($sentence) {
                                // Split the sentence into an array of words
                                $words = explode(' ', $sentence);
                            
                                // Get the first 22 words using array_slice and join them back into a string
                                $result = implode(' ', array_slice($words, 0, 20));
                            
                                return $result;
                            }
                                        $sql = "SELECT * FROM blogs";
                                        $result = mysqli_query($conn, $sql);
                                        if (!$result) {
                                            # code...
                                            echo mysqli_error($conn);
                                        }
                                        while($blog_row = mysqli_fetch_assoc($result)){
                                            $message = getFirst22Words($blog_row['message']);
                                            echo "
                                                <!-- Comment Row -->
                                                <div class='d-flex flex-row comment-row m-t-0'>
                                                    <div class='p-2'><img src='../assets/img/blogimages/$blog_row[image]' alt='user' width='50'
                                                            class='rounded-circle'></div>
                                                    <div class='comment-text w-100'>
                                                        <h6 class='font-medium'>$blog_row[title]</h6>
                                                        <span class='m-b-15 d-block'>$message</span>
                                                        <div class='comment-footer'>
                                                            <span class='text-muted float-end'>$blog_row[date]</span> <span
                                                                class='label label-rounded label-primary'>$blog_row[status]</span> <span
                                                                class='action-icons'>
                                                                <a href='edit.php?id=$blog_row[id]'><i class='ti-pencil-alt'></i></a>
                                                                <a href='index.php?draftid=$blog_row[id]'><i class='ti-save'></i></a>
                                                                <a href='index.php?deleteid=$blog_row[id]'><i class='ti-trash'></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            ";
                                        }
                                        ?>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Venormall Stats</h4>
                                <div class="d-flex align-items-center flex-row m-t-30">
                                    <div class="display-5 text-info"><i class="wi wi-day-showers"></i>
                                        <span>73<sup>°</sup></span></div>
                                    <div class="m-l-10">
                                        <h3 class="m-b-0"><?php echo date('jS F, Y') ?></h3><small>Imo State, Nigeria</small>
                                    </div>
                                </div>
                                <?php
                                    function get_totals($table){
                                        global $conn;
                                        $result = mysqli_query($conn,"SELECT * FROM $table");
                                        if (!$result) {
                                            return "Error: ".mysqli_error($conn);
                                        }
                                        else{
                                            return mysqli_num_rows($result);
                                        }
                                    }
                                ?>
                                <table class="table no-border mini-table m-t-20">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted">Total Users</td>
                                            <td class="font-medium"><?php echo get_totals("users") ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Total Stores</td>
                                            <td class="font-medium"><?php echo get_totals("store_setting") ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Total referral</td>
                                            <td class="font-medium"><?php echo get_totals("referral") ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Total Orders from all Stores</td>
                                            <td class="font-medium"><?php echo get_totals("orders") ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Total Products from all Stores</td>
                                            <td class="font-medium"><?php echo get_totals("products") ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Total Blog Posts</td>
                                            <td class="font-medium"><?php echo get_totals("blogs") ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <ul class="row list-style-none text-center m-t-30">
                                    <li class="col-3">
                                        <h4 class="text-info"><i class="wi wi-day-sunny"></i></h4>
                                        <span class="d-block text-muted">09:30</span>
                                        <h3 class="m-t-5">70<sup>°</sup></h3>
                                    </li>
                                    <li class="col-3">
                                        <h4 class="text-info"><i class="wi wi-day-cloudy"></i></h4>
                                        <span class="d-block text-muted">11:30</span>
                                        <h3 class="m-t-5">72<sup>°</sup></h3>
                                    </li>
                                    <li class="col-3">
                                        <h4 class="text-info"><i class="wi wi-day-hail"></i></h4>
                                        <span class="d-block text-muted">13:30</span>
                                        <h3 class="m-t-5">75<sup>°</sup></h3>
                                    </li>
                                    <li class="col-3">
                                        <h4 class="text-info"><i class="wi wi-day-sprinkle"></i></h4>
                                        <span class="d-block text-muted">15:30</span>
                                        <h3 class="m-t-5">76<sup>°</sup></h3>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved. Designed and Developed by <a
                    href="https://wa.me/+2348120188577">VenorTeam</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
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
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.js"></script>
</body>

</html>