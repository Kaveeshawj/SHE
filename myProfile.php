<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my Profile | SHE</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/she-logos_black.png" />

    <style>
        .header-container {
            background: linear-gradient(90deg, #FFB3C6, #FFDFD3);
            color: #333;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb-container {
            font-size: 0.9rem;
            color: #555;
            margin-top: 0.5rem;
            /* Adjust spacing below the title */
        }

        h1 {
            margin: 0;
        }

        .col-lg-2,
        .col-lg-8 {
            display: flex;
            align-items: center;
        }

        .col-lg-8 {
            flex-direction: column;
            /* Align title and breadcrumb vertically */
        }

        .menu-btn {
            cursor: pointer;
            /* Makes the cursor a pointer */
            transition: transform 0.2s ease, color 0.2s ease;
            /* Adds smooth animation for hover/click */
            display: inline-block;
            /* Ensures the button behaves like an inline-block element */
        }

        /* Hover Animation */
        .menu-btn:hover {
            color: #ff6f61;
            /* Changes the color when hovered */
            transform: scale(1.1);
            /* Slightly enlarges the button on hover */
        }

        /* Click Animation */
        .menu-btn:active {
            transform: scale(0.95);
            /* Shrinks the button slightly when clicked */
        }

        /* Left Nav Styles */
        .navbar-collapse {
            transition: transform 0.4s ease-in-out;
            transform: translateX(-100%);
            background-color: #ffebf3;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            z-index: 1000;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
        }

        .navbar-open {
            transform: translateX(0);
        }

        .navbar-nav .nav-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f8d6e0;
        }

        .navbar-nav .nav-link {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ff66a3;
            transform: translateX(5px);
        }

        .dropdown-menu {
            background-color: #ffebf3;
            border-radius: 8px;
        }

        .dropdown-item {
            color: #333;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #ffcce6;
            transform: scale(1.05);
        }

        /* Toggler button styles */
        .navbar-toggler {
            border: none;
            background-color: #ff66a3;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            /* Arrange children vertically */
            align-items: center;
            /* Center children horizontally */
            justify-content: center;
            /* Center children vertically */
            gap: 5px;
            /* Add spacing between lines */
        }


        .navbar-toggler span {
            display: block;
            width: 25px;
            height: 3px;
            margin-bottom: 5px;
            background-color: black;
            transition: all 0.3s ease;

        }

        /* Navbar Toggle Hover Effect */
        .navbar-toggler:hover span {
            background-color: #ffe0f2;
        }

        /* Scrollable Navbar */
        .scrollable-navbar {
            background-color: #fff7fa;
            height: 600px;
            padding-left: 3px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 5px;
        }

        /* User Greeting */
        .user-greeting {
            text-align: left;
            font-size: 16px;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 1px solid #f1d4d7;
        }

        .welcome-text {
            font-weight: bold;
        }

        .signout {
            color: #ff66a3;
            cursor: pointer;
            font-weight: bold;
        }

        /* Categories */
        .categories {
            margin-top: 20px;
        }

        .categories .btn {
            background-color: #efd5d0;
            color: #333;
            border-radius: 5px;
            font-weight: bold;
        }

        .categories .dropdown-menu {
            background-color: #ffebf3;
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Navigation Links */
        .nav-links {
            margin-top: 20px;
        }

        .nav-links .nav-link {
            display: block;
            padding: 10px 0;
            font-size: 18px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-links .nav-link:hover {
            color: #ff66a3;
            transform: translateX(5px);
        }

        /* General Layout */
        .scrollable-navbar>div {
            margin-bottom: 20px;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }

        .header-container {
            background-color: #f8f9fa;
            /* Light background for visibility */
        }
    </style>



</head>



<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 mb-4">
                <div class="row">
                    <div class="header-container d-flex align-items-center justify-content-between py-4 mb-4">
                        <!-- Navbar toggler button -->
                        <button class="navbar-toggler col-lg-1 col-2 d-flex justify-content-start" onclick="toggleNavbar()">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <div class="col-lg-10 col-8 text-center">
                            <h1 class="fw-bold text-uppercase m-0">My Profile</h1>
                            <div class="breadcrumb-container mt-2">
                                <p class="m-0">
                                    <a href="home.php" class="text-decoration-none">Home</a>
                                    <span class="mx-2">-</span>
                                    My Profile
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-1 col-2"></div>
                        <!--  -->


                        <div class="col-12 ">
                            <div class="row">
                                <div class="col-lg-3 pl-3">
                                    <nav class="navbar navbar-expand-lg navbar-light">
                                        <div class="collapse navbar-collapse d-none" id="mainNavbar">
                                            <!-- Scrollable Container -->
                                            <div class="scrollable-navbar p-3">


                                                <!-- User Options -->
                                                <div class="navbar-nav ml-auto py-0 mt-3">
                                                    <?php
                                                    if (isset($_SESSION["u"])) {
                                                        $data = $_SESSION["u"];
                                                    ?>
                                                        <span class="text-lg-start"><b>Welcome </b> <?php echo $data["fname"]; ?>&nbsp;</span> |
                                                        <span class="text-lg-start fw-bold signout" onclick="signout();">&nbsp; Sign Out</span>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="index.php" class="nav-item nav-link fs-5">Login</a>
                                                        <a href="index.php" class="nav-item nav-link fs-5">Register</a>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                                <hr> <!-- Horizontal Line -->

                                                <!-- Categories Dropdown -->
                                                <div class="dropdown mt-3">
                                                    <a class="btn shadow-none d-flex text-dark align-items-center justify-content-between text-white w-100" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="height: 70px; padding: 0 30px; background-color: #EFD5D0;">
                                                        <h4 class="m-0 text-center text-dark">Categories</h4>
                                                        <i class="bi bi-caret-down-fill text-dark"></i>
                                                    </a>
                                                    <ul class="dropdown-menu collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0">
                                                        <li><a class="dropdown-item" href="dresses.php">Dresses</a></li>
                                                        <li><a class="dropdown-item" href="slippers.php">Slippers</a></li>
                                                        <li><a class="dropdown-item" href="jeweleries.php">Jeweleries</a></li>
                                                        <li><a class="dropdown-item" href="scrunchie.php">Scrunchies</a></li>
                                                        <li><a class="dropdown-item" href="#">Resin items</a></li>
                                                        <li><a class="dropdown-item" href="#">Dream catchers</a></li>
                                                        <li><a class="dropdown-item" href="cakes.php">Cakes</a></li>
                                                        <li><a class="dropdown-item" href="#">Beauty products</a></li>
                                                    </ul>
                                                </div>
                                                <hr> <!-- Horizontal Line -->

                                                <!-- Other Navbar Links -->
                                                <div class="mr-auto py-0 mt-3 mb-3">
                                                    <a href="home.php" class="nav-item nav-link fs-5">Home</a>
                                                </div>
                                                <hr>

                                                <div class="mr-auto py-0 mt-3 mb-3">
                                                    <div class="dropdown">
                                                        <a href="#"
                                                            class="nav-item nav-link fs-5 dropdown-toggle"
                                                            id="profileDropdown"
                                                            data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            My Profile
                                                        </a>
                                                        <ul class="dropdown-menu collapse navbar navbar-vertical navbar-light" aria-labelledby="profileDropdown">
                                                            <li>
                                                                <a href="myProfile.php" class="dropdown-item">Edit My Profile</a>
                                                            </li>
                                                            <li>
                                                                <a href="myProducts.php" class="dropdown-item">My Products</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="mr-auto py-0 mt-3 mb-3">
                                                    <a href="shop.php" class="nav-item nav-link fs-5">Shop</a>
                                                </div>
                                                <hr> <!-- Horizontal Line -->

                                                <div class="mr-auto py-0 mt-3 mb-3">
                                                    <a href="detail.php" class="nav-item nav-link fs-5">Contact</a>
                                                </div>
                                                <hr> <!-- Horizontal Line -->

                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <!--  -->

                    </div>



                    <?php

                    if (isset($_SESSION["u"])) {

                        $email  = $_SESSION["u"]["email"];

                        $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON
                    gender.id=user.gender_id WHERE `email` = '" . $email . "'");

                        $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $email . "'");

                        $address_rs = Database::search(("SELECT * FROM `user_has_address` INNER JOIN `city` ON
                    user_has_address.city_id=city.id INNER JOIN `district` ON
                    city.district_id=district.id INNER JOIN `province` ON
                    district.province_id= province.id WHERE `user_email` = '" . $email . "' "));

                        $data = $details_rs->fetch_assoc();
                        $image_data = $image_rs->fetch_assoc();
                        $address_data = $address_rs->fetch_assoc();

                    ?>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 bg-body rounded mt-4 mb-4">
                                    <div class="row g-2">

                                        <div class="col-md-3 border-end">
                                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                                <?php

                                                if (empty($image_data["path"])) {
                                                ?>
                                                    <img src="resources/user.svg" class="rounded mt-5" style="width: 150px;" />
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-5" style="width: 150px;" />
                                                <?php
                                                }

                                                ?>


                                                <span class="fw-bold"><?php echo $data["fname"]; ?></span>
                                                <span class="fw-bold text-black-50"><?php echo $email; ?></span>

                                            </div>
                                        </div>

                                        <div class="col-md-8 border-end" style="background-color: #FFFFE0;">
                                            <div class="p-3 py-5">

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h2 class="fw-bold">Profile Settings</h2>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class=" text-secondary">Personal Info</h4>
                                                </div>

                                                <div class="col-12">
                                                    <hr>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <?php

                                                            if (empty($image_data["path"])) {
                                                            ?>
                                                                <img src="resources/user.svg" alt="Avatar" class="d-flex align-self-center me-3 " style="  border-radius: 50%;" width="80">

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="<?php echo $image_data["path"]; ?>" alt="Avatar" class="d-flex align-self-center me-3 " style="  border-radius: 50%;" width="80">
                                                            <?php
                                                            }

                                                            ?>
                                                        </div>

                                                        <div class="col-3 d-flex">
                                                            <div class="align-items-center">
                                                                <input type="file" class="d-none" id="profileimg" accept="image/*" />
                                                                <label for="profileimg" class="btn btn-primary mt-3" style="background-color: #d63384; border: none; color: #fff; padding: 10px; border-radius: 5px; cursor: pointer;" onclick="changeImage();">Update Profile Image</label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                                <div class="row mt-4">

                                                    <div class="col-6">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $data["fname"]; ?>" id="fname" />
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="form-label">last Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $data["lname"]; ?>" id="lname" />
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Mobile</label>
                                                        <input type="text" class="form-control" value="<?php echo $data["mobile"]; ?>" id="mobile" />
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Password</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" readonly value="<?php echo $data["password"]; ?>" />
                                                            <span class="input-group-text bg-primary" id="basic-addon2">
                                                                <i class="bi bi-eye-slash-fill text-white"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control" readonly value="<?php echo $data["email"]; ?>" />
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Registered Date</label>
                                                        <input type="text" class="form-control" readonly value="<?php echo $data["joined_date"]; ?>" />
                                                    </div>

                                                    <?php

                                                    if (!empty($address_data["line1"])) {

                                                    ?>

                                                        <div class="col-12">
                                                            <label class="form-label">Address Line 01</label>
                                                            <input type="text" class="form-control" value="<?php echo $address_data["line1"]; ?>" id="line1" />
                                                        </div>

                                                    <?php

                                                    } else {

                                                    ?>

                                                        <div class="col-12">
                                                            <label class="form-label">Address Line 01</label>
                                                            <input type="text" class="form-control" id="line1" />
                                                        </div>

                                                    <?php

                                                    }

                                                    if (!empty($address_data["line2"])) {
                                                    ?>
                                                        <div class="col-12">
                                                            <label class="form-label">Address Line 02</label>
                                                            <input type="text" class="form-control" value="<?php echo $address_data["line2"]; ?>" id="line2" />
                                                        </div>
                                                    <?php



                                                    } else {

                                                    ?>
                                                        <div class="col-12">
                                                            <label class="form-label">Address Line 02</label>
                                                            <input type="text" class="form-control" id="line2" />
                                                        </div>
                                                    <?php
                                                    }

                                                    $province_rs = Database::search("SELECT * FROM `province` ");
                                                    $district_rs = Database::search("SELECT * FROM `district` ");
                                                    $city_rs = Database::search("SELECT * FROM `city` ");

                                                    ?>

                                                    <div class="col-6">
                                                        <label class="form-label">Province</label>
                                                        <select class="form-select" id="province">
                                                            <option value="0">Select Province</option>
                                                            <?php
                                                            $province_num = $province_rs->num_rows;
                                                            for ($x = 0; $x < $province_num; $x++) {
                                                                $province_data = $province_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $province_data["id"]; ?>" <?php

                                                                                                                    if (!empty($address_data["province_id"])) {

                                                                                                                        if ($province_data["id"] == $address_data["province_id"]) {
                                                                                                                    ?>selected<?php

                                                                                                                            }
                                                                                                                        }
                                                                                                                                ?>><?php echo $province_data["name"]; ?></option>


                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="form-label">District</label>
                                                        <select class="form-select" id="district">
                                                            <option value="0">Select District</option>
                                                            <?php

                                                            $district_num = $district_rs->num_rows;
                                                            for ($x = 0; $x < $district_num; $x++) {
                                                                $district_data = $district_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $district_data["id"]; ?>" <?php

                                                                                                                    if (!empty($address_data["district_id"])) {

                                                                                                                        if ($district_data["id"] == $address_data["district_id"]) {
                                                                                                                    ?>selected<?php

                                                                                                                            }
                                                                                                                        }
                                                                                                                                ?>><?php echo $district_data["name"]; ?></option>


                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="form-label">City</label>
                                                        <select class="form-select" id="city">
                                                            <option value="0">Select City</option>
                                                            <?php
                                                            $city_num = $city_rs->num_rows;
                                                            for ($x = 0; $x < $city_num; $x++) {
                                                                $city_data = $city_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $city_data["id"]; ?>" <?php

                                                                                                                if (!empty($city_data["city_id"])) {

                                                                                                                    if ($city_data["id"] == $city_data["province_id"]) {
                                                                                                                ?>selected<?php

                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>><?php echo $city_data["name"]; ?></option>


                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <?php
                                                    if (!empty($address_data["postal_code"])) {
                                                    ?>
                                                        <div class="col-6">
                                                            <label class="form-label">Postal Code</label>
                                                            <input type="text" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" id="pcode" />
                                                        </div>
                                                    <?php
                                                    } else {

                                                    ?>
                                                        <div class="col-6">
                                                            <label class="form-label">Postal Code</label>
                                                            <input type="text" class="form-control" id="pcode" />
                                                        </div>

                                                    <?php

                                                    }
                                                    ?>



                                                    <div class="col-12">
                                                        <label class="form-label">Gender</label>
                                                        <input type="text" class="form-control" readonly value="<?php echo $data["gender_name"]; ?>" />
                                                    </div>
                                                    <br /><br />

                                                    <div class="col-12 d-grid mt-3">
                                                        <button class="btn btn-primary col-12" style="background-color: #d63384; border: none; color: #fff; padding: 10px; border-radius: 5px; font-size: 18px; font-weight: bold; text-transform: uppercase;" onclick="updateProfile();">Update My Profile</button>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    <?php

                    }


                    ?>

                </div>
            </div>


            <?php require "footer.php"; ?>

        </div>
    </div>

    <!-- <script src="bootstrap.bundle.js"></script> -->
    <script src="script.js"></script>
    <script>
        function toggleNavbar() {
            const navbar = document.getElementById('mainNavbar');
            navbar.classList.toggle('navbar-open');
            navbar.classList.toggle('block');
        }
    </script>

</body>

</html>