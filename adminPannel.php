<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin | sms</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="links/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">

    <link rel="stylesheet" href="links/style.css">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/she-logos_black.png" />

</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <?php include "adminHeader.php"; ?>
        </div>

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome Admin!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-one w-100">
                            <div class="card-body">

                                <?php

                                $today = date("Y-m-d");
                                $thismonth = date("m");
                                $thisyear = date("Y");

                                $a = "0";
                                $b = "0";
                                $c = "0";
                                $e = "0";
                                $f = "0";
                                $g = "0";

                                $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                $invoice_num = $invoice_rs->num_rows;


                                for ($x = 0; $x < $invoice_num; $x++) {
                                    $invoice_data = $invoice_rs->fetch_assoc();

                                    $f = $f + $invoice_data["qty"]; //total qty

                                    $g = $g + $invoice_data["total"];

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


                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="db-info">
                                        <?php

                                        $user = Database::search("SELECT * FROM `user`");
                                        $user_num = $user->num_rows;

                                        ?>
                                        <h3><?php echo $user_num ?>+</h3>
                                        <h6>Customers</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-three w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fa-solid fa-store"></i>
                                    </div>
                                    <div class="db-info">
                                        <?php

                                        $sellers = Database::search("SELECT DISTINCT `user_email` from `product`");
                                        $se = $sellers->num_rows;

                                        ?>
                                        <h3><?php echo $se ?>+</h3>
                                        <h6>Sellers</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-two w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>Rs.<?php echo $b; ?>.00</h3>
                                        <h6>Monthly Earnings</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-four w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </div>
                                    <div class="db-info">
                                        <h3>Rs.<?php echo $g; ?>.00</h3>
                                        <h6>Total Earnings</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="card-title">Revenue</h5>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-inline-group text-right mb-0 pl-0">
                                            <li class="list-inline-item">
                                                <div class="form-group mb-0 amount-spent-select">
                                                    <select class="form-control form-control-sm">
                                                        <option>Today</option>
                                                        <option>Last Week</option>
                                                        <option>Last Month</option>
                                                    </select>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="apexcharts-area"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="card-title">Number of Students</h5>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-inline-group text-right mb-0 pl-0">
                                            <li class="list-inline-item">
                                                <div class="form-group mb-0 amount-spent-select">
                                                    <select class="form-control form-control-sm">
                                                        <option>Today</option>
                                                        <option>Last Week</option>
                                                        <option>Last Month</option>
                                                    </select>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h5 class="card-title">Mostly sold Item</h5>
                            </div>
                            <div class="card-body">
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
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h5 class="card-title">Most Famous Seller </h5>
                            </div>
                            <div class="card-body">
                            <?php
                                if ($freq_num > 0) {
                                    $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $product_data["user_email"] . "'");
                                    $profile_data = $profile_rs->fetch_assoc();

                                    $user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                    $user_data1 = $user_rs1->fetch_assoc();

                                ?>
                                    <div class="col-12 d-flex justify-content-center shadow">
                                        <?php

                                        if (isset($profile_data["path"])) {
                                        ?>

                                            <img src="<?php echo $profile_data["path"]; ?>" class="img-fluid rounded-top img-thumbnail" style="height: 250px;">

                                        <?php

                                        } else {
                                        ?>

                                            <img src="resources/user.svg" class="img-fluid rounded-top img-thumbnail" style="height: 250px;"/>

                                        <?php

                                        }

                                        ?>

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
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card flex-fill fb sm-box" style="color: black;">
                            <i class="fab fa-facebook"></i>
                            <h6>50,095</h6>
                            <p>Likes</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card flex-fill twitter sm-box">
                            <i class="fab fa-twitter"></i>
                            <h6>48,596</h6>
                            <p>Follows</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card flex-fill insta sm-box">
                            <i class="fab fa-instagram"></i>
                            <h6>52,085</h6>
                            <p>Follows</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card flex-fill linkedin sm-box">
                            <i class="fab fa-linkedin-in"></i>
                            <h6>69,050</h6>
                            <p>Follows</p>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <p>Copyright © 2020 Enchant.</p>
            </footer>
        </div>
    </div>
    <script src="links/jquery-3.6.0.min.js"></script>
    <script src="links/popper.min.js"></script>
    <script src="links/bootstrap.min.js"></script>
    <script src="links/jquery.slimscroll.min.js"></script>
    <script src="links/apexcharts.min.js"></script>
    <script src="links/chart-data.js"></script>
    <script src="links/script.js"></script>
</body>

</html>