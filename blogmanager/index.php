<?php
include("header.php");
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
                                        <h4 class="card-title">Blog Posts</h4>
                                        <h5 class="card-subtitle">Overview Blogs Posted so far</h5>
                                    </div>
                                    <div class="col-7">
                                        <div class="text-end upgrade-btn">
                                            <a href="addservice.php" class="btn btn-danger text-white">add +</a>
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
                                            <th class="border-top-0">Title</th>
                                            <th class="border-top-0">Image</th>
                                            <th class="border-top-0">Details</th>
                                            <th class="border-top-0">edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM blogs";
                                        $result = mysqli_query($conn, $sql);
                                        if (!$result) {
                                            # code...
                                            echo mysqli_error($conn);
                                        }
                                        $i = 0;
                                        while($row = mysqli_fetch_assoc($result)){
                                            $i++;
                                            echo "
                                            <tr>
                                            <td>$i</td>
                                            <td>
                                                <label class='label label-danger'>$row[title]</label>
                                            </td>
                                            <td>
                                                <img class='btn btn-circle d-flex btn-info text-white' style='background: transparent; width:80px;height:80px;border:1px solid transparent' src='../assets/img/blogimages/$row[image]'>
                                            </td>
                                            <td>$row[message]</td>
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
                <div class="row" style="display: none;">
                    <!-- column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Recent Comments</h4>
                            </div>
                            <div class="comment-widgets scrollable">
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="p-2"><img src="assets/images/users/1.jpg" alt="user" width="50"
                                            class="rounded-circle"></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">James Anderson</h6>
                                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing
                                            and type setting industry. </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-end">April 14, 2021</span> <span
                                                class="label label-rounded label-primary">Pending</span> <span
                                                class="action-icons">
                                                <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                                <a href="javascript:void(0)"><i class="ti-heart"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2"><img src="assets/images/users/4.jpg" alt="user" width="50"
                                            class="rounded-circle"></div>
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium">Michael Jorden</h6>
                                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing
                                            and type setting industry. </span>
                                        <div class="comment-footer ">
                                            <span class="text-muted float-end">April 14, 2021</span>
                                            <span class="label label-success label-rounded">Approved</span>
                                            <span class="action-icons active">
                                                <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                <a href="javascript:void(0)"><i class="icon-close"></i></a>
                                                <a href="javascript:void(0)"><i class="ti-heart text-danger"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2"><img src="assets/images/users/5.jpg" alt="user" width="50"
                                            class="rounded-circle"></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">Johnathan Doeting</h6>
                                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing
                                            and type setting industry. </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-end">April 14, 2021</span>
                                            <span class="label label-rounded label-danger">Rejected</span>
                                            <span class="action-icons">
                                                <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                                <a href="javascript:void(0)"><i class="ti-heart"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Temp Guide</h4>
                                <div class="d-flex align-items-center flex-row m-t-30">
                                    <div class="display-5 text-info"><i class="wi wi-day-showers"></i>
                                        <span>73<sup>°</sup></span></div>
                                    <div class="m-l-10">
                                        <h3 class="m-b-0">Saturday</h3><small>Ahmedabad, India</small>
                                    </div>
                                </div>
                                <table class="table no-border mini-table m-t-20">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted">Wind</td>
                                            <td class="font-medium">ESE 17 mph</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Humidity</td>
                                            <td class="font-medium">83%</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Pressure</td>
                                            <td class="font-medium">28.56 in</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Cloud Cover</td>
                                            <td class="font-medium">78%</td>
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
                    href="https://wa.me/+2348120188577">Phitenxt</a>.
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