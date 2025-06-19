<?php
session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel | SHE</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/she-logos_black.png" />

    </head>

    <body onload="startTime();" class="bodyA">

        <div class="col-12" style="background-color: #74EBD5;background-image: linear-gradient(90deg,#C8B6FF 0%,#F191AC 100%);">
            <div class="row">

                <div class="row align-items-center pb-2">
                    <div class="col-lg-3 d-none d-lg-block mt-0">
                        <a href="" class="text-decoration-none">
                            <div class="logo p-0" style="height: 100px;"></div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-6 text-left">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search...." id="basic_search_txt">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="bi bi-search text-dark fw-bold" onclick="basicSearch(0);"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="col-12 align-items-start vh-100 " style="background-color: #C8B6FF;background-image: linear-gradient(30deg,#F191AC 0%,#C8B6FF 100%);">
                            <div class="row g-1 text-start ">

                                <div class="col-12 mt-3 text-white">
                                    <span class="fs-2 fw-bold text-dark">Menu</span>
                                </div>

                                <?php

                                $profile_image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $_SESSION["au"]["email"] . "' ");
                                $profile_image_data = $profile_image_rs->fetch_assoc();

                                if (isset($profile_image_data["path"])) {
                                ?>

                                    <div class="col-12 d-flex justify-content-center mb-3">
                                        <img src="<?php echo $profile_image_data["path"] ?>" class="rounded-circle mt-3" style="width: 100px;" id="viewImage" />
                                    </div>

                                <?php
                                } else {

                                ?>

                                    <div class="col-12 d-flex justify-content-center mb-3">
                                        <img src="resources/user.svg" class="rounded-circle mt-3" style="width: 100px;" id="viewImage" />
                                    </div>

                                <?php
                                }

                                ?>


                                <div class="col-12 mt-3">
                                    <h5 class="text-dark text-center"><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h5>
                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="col-11 mt-2 text-white">
                                    <div class="row">
                                        <span class=" fw-bold ms-2 dash  pb-3 ad "><i class="bi bi-speedometer2"></i> Dashboard</span>
                                    </div>
                                    <div class="row">
                                        <span class=" fw-bold ms-2 dash mt-3 pb-3 ad" onclick="window.location = 'manageusers.php';"><i class="bi bi-person-plus-fill"></i> Manage Users</span>
                                    </div>
                                    <div class="row">
                                        <span class=" fw-bold ms-2 dash mt-3  pb-3 ad" onclick="window.location = 'manageProducts.php';"><i class="bi bi-tablet-fill"></i> Manage Products</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border border-3 opacity-50">
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label fw-bold ms-2   pb-3 ad"><i class="bi bi-gear-fill"></i> Components</label>
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label fw-bold ms-2  pb-3 ad"><i class="bi bi-tools"></i> Utilities</label>
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label fw-bold ms-2 pb-3 ad" onclick="window.location = 'generateReports.php';"><i class="bi bi-folder-fill"></i> Reports</label>
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label fw-bold ms-2  pb-3 ad" onclick="window.location = 'tables.php';"><i class="bi bi-bar-chart-line-fill"></i> Charts</label>
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label fw-bold ms-2 mb-2 ad"><i class="bi bi-table"></i> Tables</label>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-10 bg-light">
                    <div class="row">

                        <div class="row col-12 fw-bold mb-1 mt-3">
                            <div class="col-6">
                                <h2 class="fw-bold">Dashboard</h2>
                            </div>
                            <div class="col-6 ">
                                <div class="row justify-content-end">
                                    <?php

                                    $d = new DateTime();
                                    $tz = new DateTimeZone("Asia/Colombo");
                                    $d->setTimezone($tz);
                                    $date = $d->format("Y-m-d");

                                    ?>
                                    <div class="col-lg-4">
                                        <span class="text-end fw-bold fs-3 text-dark"><?php echo $date; ?></span>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="text-end fw-bold fs-3 text-dark" id="txt"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-5 border-top ">
                                    <div class="card-body" style="background-color: #FFCBB2;">
                                        <h5 class="text-muted">Monthly Earnings</h5>

                                        <?php

                                        $today = date("Y-m-d");
                                        $thismonth = date("m");
                                        $thisyear = date("Y");

                                        $a = "0";
                                        $b = "0";
                                        $c = "0";
                                        $e = "0";
                                        $f = "0";

                                        $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                        $invoice_num = $invoice_rs->num_rows;

                                        for ($x = 0; $x < $invoice_num; $x++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();

                                            $f = $f + $invoice_data["qty"]; //total qty

                                            $d = $invoice_data["date"];
                                            $splitDate = explode(" ", $d); //seperate date from time
                                            $pdate = $splitDate[0]; //sold date

                                            if ($pdate == $today) {
                                                $a = $a + $invoice_data["total"];
                                                $c = $c + $invoice_data["qty"];
                                            }

                                            $splitMonth = explode("-", $pdate); //seperate date as year,month & date
                                            $pyear = $splitMonth[0]; //year
                                            $pmonth = $splitMonth[1]; //month

                                            if ($pyear == $thisyear) {
                                                if ($pmonth == $thismonth) {
                                                    $b = $b + $invoice_data["total"];
                                                    $e = $e + $invoice_data["qty"];
                                                }
                                            }
                                        }

                                        ?>

                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">Rs.<?php echo $b; ?>.00</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5.86%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- new customer  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-5 border-top border-top-primary">
                                    <div class="card-body" style="background-color: #83B0E1;">
                                        <h5 class="text-muted">Total Customers</h5>
                                        <div class="metric-value d-inline-block">
                                            <?php

                                            $user = Database::search("SELECT * FROM `user`");
                                            $user_num = $user->num_rows;

                                            ?>
                                            <h1 class="mb-1"><?php echo $user_num ?></h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end new customer  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- visitor  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-5 border-top border-top-primary">
                                    <div class="card-body" style="background-color: #F6EF7C;">
                                        <h5 class="text-muted">Monthly Sellngs</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $e ?> Items</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end visitor  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-5 border-top border-top-primary">
                                    <div class="card-body" style="background-color: #ACD8AA;">
                                        <h5 class="text-muted">Total Orders</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $x ?> Items</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-danger bg-danger-light bg-danger-light "><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1">4%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total orders  -->
                            <!-- ============================================================== -->
                        </div>

                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="col-12 mb-5 mt-3" style="background-color: black;">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center my-3">
                                    <label class="form-label fs-4 fw-bold text-white">Total Active time</label>
                                </div>
                                <div class="col-12 col-lg-10 text-center text-white my-3">
                                    <?php

                                    $start_date = new DateTime("2022-09-27 00:00:00");

                                    $tdate = new DateTime();
                                    $tz = new DateTimeZone("Asia/Colombo");
                                    $tdate->setTimezone($tz);

                                    $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                    $difference = $end_date->diff($start_date);

                                    ?>
                                    <label class="form-label fs-4 fw-bold text-white">
                                        <?php
                                        echo $difference->format('%Y') . " Years  " . $difference->format('%m') . " Months  " .
                                            $difference->format('%d') . " Days  " . $difference->format('%H') . " Hours  " .
                                            $difference->format('%i') . " Minutes  " . $difference->format('%s') . " Seconds ";
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Mostly sold Item</label>
                                </div>
                                <?php

                                $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence`
                                FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence`
                                DESC LIMIT 1 ");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {
                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `product_id`='" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                    $qty_data = $qty_rs->fetch_assoc();

                                ?>
                                    <div class="col-12 d-flex justify-content-center shadow">
                                        <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-top img-thumbnail" style="height: 250px;">
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br />
                                        <span class="fs-6 fw-bold"><?php echo $qty_data["qty_total"]; ?> items</span><br />
                                        <span class="fs-6 fw-bold">Rs. <?php echo $qty_data["qty_total"] * $product_data["price"]; ?>. 00</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="firstPlace"></div>
                                    </div>
                                <?php

                                } else {
                                ?>
                                    <div class="col-12 d-flex justify-content-center shadow">
                                        <img src="resources/2530800_cam_camera_clip_image_photo_icon.svg" class="img-fluid rounded-top img-thumbnail" style="height: 250px;">
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">------</span><br />
                                        <span class="fs-6 fw-bold">----- items</span><br />
                                        <span class="fs-6 fw-bold">Rs. ----- . 00</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="firstPlace"></div>
                                    </div>
                                <?php
                                }

                                ?>

                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
                            <div class="row g-1">
                                <?php
                                if ($freq_num > 0) {
                                    $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $product_data["user_email"] . "'");
                                    $profile_data = $profile_rs->fetch_assoc();

                                    $user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                    $user_data1 = $user_rs1->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Most Famous Seller</label>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center shadow">
                                        <?php

                                        if (isset($profile_data["path"])) {
                                        ?>

                                            <img src="<?php echo $profile_data["path"]; ?>" class="img-fluid rounded-top img-thumbnail" style="height: 250px;">

                                        <?php

                                        } else {
                                        ?>

                                            <img src="resources/user.svg" class="img-fluid rounded-top img-thumbnail" style="height: 250px;">

                                        <?php

                                        }

                                        ?>

                                        <!-- <img src="resources/profile image/girlimg.jpg" class="img-fluid rounded-top img-thumbnail" style="height: 250px;"> -->
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $user_data1["fname"] . " " . $user_data1["lname"]; ?></span><br />
                                        <span class="fs-6 fw-bold"><?php echo $user_data1["email"]; ?></span><br />
                                        <span class="fs-6 fw-bold"><?php echo $user_data1["mobile"]; ?></span>
                                    </div>
                                    <div class="col-12">
                                        <div class="firstPlace"></div>
                                    </div>
                                <?php

                                } else {

                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold">Most Famous Seller</label>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center shadow">

                                        <img src="resources/4715018_avatar_people_person_profile_user_icon.svg" class="img-fluid rounded-top img-thumbnail" style="height: 250px;">
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">----</span><br />
                                        <span class="fs-6 fw-bold">----@gmail.com</span><br />
                                        <span class="fs-6 fw-bold">-------</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="firstPlace"></div>
                                    </div>
                                <?php

                                }

                                ?>

                            </div>
                        </div>


                    </div>
                </div>

                <?php
                $con  = mysqli_connect("localhost", "root", "Princess@18", "she", "3306");
                if (!$con) {
                    # code...
                    echo "Problem in database connection! Contact administrator!";
                } else {
                    $sql = "SELECT * FROM invoice INNER JOIN `product` ON product.id=invoice.product_id";
                    $result = mysqli_query($con, $sql);
                    $chart_data = "";
                    while ($row = mysqli_fetch_array($result)) {

                        $productname[]  = $row['title'];
                        $sales[] = $row['total'];
                    }
                }

                // $sql =Database::search( "SELECT * FROM `invoice`");
                // $result = $sql->num_rows;
                // $chart_data = "";
                // $row = $result->fetch_assoc();
                // while ($row) {

                //     $productname[]  = $row['product_id'];
                //     $sales[] = $row['total'];
                // }
                ?>


                <div class="offset-3" style="width:60%;height:30%;text-align:center">
                    <h2 class="page-header fw-bold">Analytics Reports </h2>
                    <div class="fw-bold">Product </div>
                    <canvas id="chartjs_bar"></canvas>
                </div>
                <script src="//code.jquery.com/jquery-1.9.1.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
                <script type="text/javascript">
                    var ctx = document.getElementById("chartjs_bar").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode($productname); ?>,
                            datasets: [{
                                backgroundColor: [
                                    "#5969ff",
                                    "#ff407b",
                                    "#25d5f2",
                                    "#ffc750",
                                    "#2ec551",
                                    "#7040fa",
                                    "#ff004e",
                                    "#5969ff",
                                    "#ff407b",
                                    "#25d5f2",
                                    "#ffc750",
                                    "#2ec551",
                                    "#7040fa",
                                    "#ff004e"
                                ],
                                data: <?php echo json_encode($sales); ?>,
                            }]
                        },
                        options: {
                            legend: {
                                display: true,
                                position: 'bottom',

                                labels: {
                                    fontColor: '#71748d',
                                    fontFamily: 'Circular Std Book',
                                    fontSize: 14,
                                }
                            },


                        }
                    });
                </script>

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>


<?php

} else {
    echo ("You are not a valid user");
}

?>