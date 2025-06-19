<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | SHE</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" href="resources/she-logos_black.png" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        .container-fluid {
            padding: 0;
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

        /* Navbar Toggle Animation */
        .navbar-toggler {
            border: none;
            background-color: #ff66a3;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1050;
        }

        .navbar-toggler span {
            display: block;
            width: 25px;
            height: 3px;
            background: black;
            margin: 5px auto;
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

        .badge {
            display: inline-block !important;
            /* Ensure visibility */
            opacity: 1 !important;
            /* Ensure full opacity */
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


        #cart-container {
            position: fixed;
            top: 0;
            right: -400px;
            /* Initially off-screen */
            width: 400px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease-in-out;
            z-index: 1050;
            overflow-y: auto;
            /* Allow scrolling within the cart */
        }

        /* When cart is open, slide it to the right */
        #cart-container.open {
            right: 0;
        }

        /* Optional: Overlay to dim the background */
        #cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            transition: opacity 0.3s ease-in-out;
            z-index: 1040;
        }

        #cart-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Disable page scrolling when cart is open */
        body.no-scroll {
            overflow: hidden;
        }

        /* Cart content styles */
        .cart-content {
            padding: 20px;
        }
    </style>
</head>

<body>


    <button class="navbar-toggler" onclick="toggleNavbar()">
        <span></span>
        <span></span>
        <span></span>
    </button>


    <div class="col-12">
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



    <div class="container-fluid overflow-hidden">
        <div class="row bg-white py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center" style="font-size: 20px;">
                    <a class="text-dark fs-5 text-decoration-none hp" href="">FAQs</a>
                    <span class="text-muted px-2 ">|</span>
                    <a class="hp text-dark fs-5 text-decoration-none" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="hp text-dark fs-5 text-decoration-none" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right mt-2">
                <div class="d-inline-flex align-items-center position-absolute top-0 end-0 pe-2">
                    <a class="text-dark px-2" href="">
                        <i class="bi bi-facebook fs-4"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="bi bi-twitter fs-4 p-1"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="bi bi-linkedin fs-4"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="bi bi-instagram fs-4"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="bi bi-youtube fs-3 p-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row align-items-center pb-2 d-flex" id="mainsearch1" style="background-color: pink;">
            <!-- Left Column -->
            <div class="col-lg-2 col-2 d-flex justify-content-start">
                <i class="bi bi-search text-dark fs-2 fw-bold search1" onclick="opensbar();"></i>
            </div>

            <!-- Center Column -->
            <div class="col-lg-8 col-8 d-flex justify-content-center">
                <img src="resources/she-logos_black.png" alt="She Cosmetics Logo" class="logohome">
            </div>

            <!-- Right Column -->
            <div class="col-lg-2 col-2 d-flex justify-content-end">
                <a href="users_chat.php" class="btn border">
                    <i class="bi bi-chat-heart-fill fs-3"></i>
                </a>
                <a href="cart.php" class="btn border position-relative">
                    <i class="bi bi-cart-fill fs-3"></i>
                    <!-- Badge -->
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                        <?php
                        $user = $_SESSION["u"]["email"];
                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "' ");
                        $cart_num = $cart_rs->num_rows;

                        echo $cart_num > 0 ? $cart_num : 0;
                        ?>
                    </span>
                </a>

                <a class="btn border position-relative" href="javascript:void(0);" onclick="toggleCart()">
                    <i class="bi bi-suit-heart-fill fs-3"></i>
                    <!-- Badge -->
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                        <?php
                        $user = $_SESSION["u"]["email"];
                        $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $user . "' ");
                        $watch_num = $watch_rs->num_rows;
                        echo $watch_num > 0 ? $watch_num : 0;
                        ?>
                    </span>
                </a>


            </div>
        </div>

        <!-- watchlist  -->



        <!-- Cart Container (hidden by default) -->
        <div id="cart-container">
            <div class="cart-header">
                <button class="btn btn-danger mb-0 mt-2" onclick="toggleCart()">X</button>
            </div>
            <div class="cart-content">
                <!-- Cart content goes here -->

                <div class="cart-content">
                    <?php

                    if (isset($_SESSION["u"])) {
                        $user = $_SESSION["u"]["email"];

                        $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $user . "' ");
                        $watch_num = $watch_rs->num_rows;

                        $product_rs = Database::search("SELECT * FROM `product`");
                        $product_data = $product_rs->fetch_assoc();


                        // Check if there are cart items in the session
                        if ($watch_num  > 0) {
                    ?>
                            <div class="col-12 col-lg-12">
                                <div class="row">
                                    <?php
                                    for ($x = 0; $x < $watch_num; $x++) {
                                        $watch_data = $watch_rs->fetch_assoc();
                                    ?>

                                        <!-- have products -->

                                        <div class="card mb-3 mx-0 mx-lg-2 col-12" style="background-color: #FAE6E7; border-radius: 12px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                            <div class="row g-0">
                                                <!-- Image Section -->
                                                <div class="col-12 text-center p-3">
                                                    <?php
                                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $watch_data["product_id"] . "'");
                                                    $image_data = $image_rs->fetch_assoc();
                                                    ?>
                                                    <img src="<?php echo $image_data["code"]; ?>" style="height: 200px; width: auto; border-radius: 8px;" class="img-fluid">
                                                </div>

                                                <!-- Product Details -->
                                                <div class="col-12 text-center px-4">
                                                    <?php
                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watch_data["product_id"] . "'");
                                                    $product_data = $product_rs->fetch_assoc();
                                                    ?>
                                                    <h5 class="card-title fs-4 fw-bold text-primary"><?php echo $product_data["title"]; ?></h5>

                                                    <?php
                                                    $clr_rs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $product_data["colour_id"] . "'");
                                                    $clr_data = $clr_rs->fetch_assoc();
                                                    ?>

                                                    <?php
                                                    $size_rs = Database::search("SELECT * FROM `size` WHERE `id`='" . $product_data["size_id"] . "'");
                                                    $size_data = $size_rs->fetch_assoc();
                                                    ?>

                                                    <p class="fs-5 text-black fw-bold mb-1"> Rs. <?php echo $product_data["price"]; ?>.00</p>
                                                    <p class="fs-6 text-secondary mb-1"><?php echo $product_data["qty"]; ?> Items available</p>

                                                    <?php
                                                    $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                    $seller_data = $seller_rs->fetch_assoc();
                                                    ?>
                                                </div>

                                                <!-- Buttons Section -->
                                                <div class="text-center px-3 pb-3 d-flex justify-content-around">
                                                    <a href="#" class="btn btn-success btn-sm" title="Buy Now">
                                                        <i class="bi bi-cart-check-fill"></i> <!-- Bootstrap "Buy" Icon -->
                                                    </a>
                                                    <a href="#" class="btn btn-warning btn-sm" title="Add to Cart" onclick="addToCart(<?php echo $watch_data['id']; ?>);">
                                                        <i class="bi bi-cart-plus-fill"></i> <!-- Bootstrap "Add to Cart" Icon -->
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm" title="Remove" onclick='removeFromWatchlist(<?php echo $watch_data["id"]; ?>);'>
                                                        <i class="bi bi-trash-fill"></i> <!-- Bootstrap "Remove" Icon -->
                                                    </a>
                                                </div>

                                            </div>
                                        </div>


                                        <!-- have products -->

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>


                        <?php
                        } else {
                            // If the cart is empty, display this message
                            echo "<p>Your Watchlist is empty.</p>";
                        }
                    } else {
                        ?>

                        <div class="col-12">
                            <div class="row">
                                <a class="btn btn-primary" href="index1.php">Please Sign In First</a>
                            </div>
                        </div>

                    <?php
                    }

                    ?>
                </div>

            </div>
        </div>

        <!-- watchlist  -->





        <div class="row align-items-center d-flex d-none" id="search1" style="background-color: pink; height: 100px;">
            <div class="col-12 d-flex justify-content-center align-items-center" style="height: 100%;">
                <div class="searchdiv">
                    <form action="">
                        <div class="input-group d-flex justify-content-center align-items-center" style="max-width: 1000px; width: 100%;">
                            <input type="text" class="form-control" placeholder="Search for products" id="basic_search_txt">
                            <div class="input-group-append" onclick="basicSearch(0);">
                                <span class="input-group-text bg-transparent text-primary">
                                    <i class="bi bi-search text-dark fw-bold"></i>
                                </span>
                            </div>
                            <div class="input-group-append" onclick="remove();">
                                <span class="input-group-text bg-transparent text-primary">
                                    <i class="bi bi-x text-dark fw-bold"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>


    <div class="container-fluid mb-5 mt-5">

    </div>


    <div class="container-fluid " id="basicSearchResult">
        <div class="row">

            <!-- carousel -->
            <div id="header-carousel" class="carousel slide ca" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="height: 500px;">
                        <img class="img-fluid" src="resources/carousel-1.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 400px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 500px;">
                        <img class="img-fluid" src="resources/carousel-2.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 400px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>

            <!-- carousel -->


            <div class="container-fluid pt-5">
                <div class="row px-xl-5 pb-3">
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="d-flex align-items-center border mb-4" style="padding: 30px; background-color: #FFD6FF;">
                            <h1 class="bi bi-check-lg text-dark m-0 mr-3"></h1>
                            <h5 class="font-weight-semi-bold m-0"> &nbsp; Quality Product</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="d-flex align-items-center border mb-4" style="padding: 30px; background-color: #FFD6FF;">
                            <h1 class="bi bi-truck text-dark m-0 mr-2"></h1>
                            <h5 class="font-weight-semi-bold m-0"> &nbsp; Free Shipping</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="d-flex align-items-center border mb-4" style="padding: 30px; background-color: #FFD6FF;">
                            <h1 class="bi bi-arrow-left-right text-dark m-0 mr-3"></h1>
                            <h5 class="font-weight-semi-bold m-0"> &nbsp; 14-Day Return</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="d-flex align-items-center border mb-4" style="padding: 30px; background-color: #FFD6FF;">
                            <h1 class="bi bi-telephone-fill text-dark m-0 mr-3"></h1>
                            <h5 class="font-weight-semi-bold m-0">&nbsp; 24/7 Support</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div>

                <div class="col-12 mb-3 ps-4 ">
                    <div class="row border border-info">

                        <div class="row px-xl-5 pb-3 mt-4">

                            <?php

                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            $category_data = $category_rs->fetch_assoc();

                            ?>

                            <!-- product -->
                            <?php

                            $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                    `status_id`='1'  AND `category_id`!='7' ORDER BY `datetime_added` DESC LIMIT 16");
                            $product_num = $product_rs->num_rows;

                            for ($z = 0; $z < $product_num; $z++) {
                                $product_data = $product_rs->fetch_assoc();

                            ?>

                                <div class="col-lg-3 col-md-6 col-sm-12 pb-5">
                                    <div class="card product-item border-0 mb-5 mt-2">
                                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex justify-content-center">

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                            $image_data = $image_rs->fetch_assoc();

                                            ?>

                                            <img class="img-fluid w-80 imgcat" src="<?php echo $image_data["code"]; ?>" alt="" style="height: 200px;">
                                        </div>
                                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3" style="background-color: #AECBEB;">
                                            <h5 class="fw-bold mb-3"><?php echo $product_data["title"]; ?></h5>
                                            <div class="d-flex justify-content-center">
                                                <h6>Rs. <?php echo $product_data["price"]; ?> .00</h6>
                                            </div>
                                        </div>

                                        <div class="card-footer d-flex justify-content-between bg-light border">

                                            <?php

                                            if (isset($_SESSION["u"])) {
                                            ?>

                                                <?php

                                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $product_data["id"] . "' AND
                `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                $watchlist_num = $watchlist_rs->num_rows;

                                                if ($watchlist_num == 1) {

                                                ?>
                                                    <button class="btn btn-sm text-dark p-0" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                        <i class="bi bi-heart-fill text-danger mr-1" id='heart<?php echo $product_data["id"]; ?>'></i>
                                                        Add To Wishlist
                                                    </button>


                                                <?php

                                                } else {
                                                ?>
                                                    <button class="btn btn-sm text-dark p-0" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                        <i class="bi bi-heart-fill text-dark mr-1" id='heart<?php echo $product_data["id"]; ?>'></i>
                                                        Add To Wishlist
                                                    </button>
                                                <?php
                                                }
                                                ?>

                                                <?php

                                                if ($product_data["qty"] > 0) {

                                                ?>

                                                    <button onclick="addToCart(<?php echo $product_data['id']; ?>);" class="btn btn-sm text-dark p-0">
                                                        <i class="bi bi-cart3 text-primary mr-1"></i>
                                                        Add To Cart
                                                    </button>

                                                <?php

                                                } else {

                                                ?>

                                                    <button class="btn btn-sm text-dark p-0 disabled"><i class="bi bi-cart3 text-dark mr-1"></i> Add to Cart</button>

                                                <?php

                                                }
                                                ?>
                                            <?php
                                            } else {

                                            ?>

                                                <a href="index.php" class="btn btn-sm text-dark p-0">
                                                    <i class="bi bi-heart-fill text-dark mr-1"></i>
                                                    Add To Wishlist
                                                </a>



                                                <?php

                                                if ($product_data["qty"] > 0) {

                                                ?>

                                                    <a href="index.php" class="btn btn-sm text-dark p-0">
                                                        <i class="bi bi-cart3 text-primary mr-1"></i>
                                                        Add To Cart
                                                    </a>

                                                <?php

                                                } else {

                                                ?>

                                                    <button class="btn btn-sm text-dark p-0 disabled"><i class="bi bi-cart3 text-dark mr-1"></i> Add to Cart</button>

                                                <?php

                                                }
                                                ?>

                                            <?php
                                            }

                                            ?>

                                        </div>
                                        <a href='<?php echo "singleproductview.php?id=" . $product_data["id"]; ?>' class="col-12 btn" style="background-color: pink;">Buy Now</a>
                                    </div>
                                </div>
                                <!-- product -->
                            <?php

                            }

                            ?>
                        </div>
                    </div>
                </div>

                <!-- Products -->

                <!-- Offer Start -->
                <div class="container-fluid offer pt-5 mb-5">
                    <div class="row px-xl-5">
                        <div class="col-md-6 pb-4">
                            <div class="position-relative text-center text-md-right text-white mb-2 py-5 px-5" style="background-color: #E1ECF7;">
                                <img src="resources/offer-1.png" alt="">
                                <div class="position-relative text-end">
                                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                                    <h1 class="mb-4 font-weight-semi-bold text-dark">Spring Collection</h1>
                                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-4">
                            <div class="position-relative text-center text-md-left text-white mb-2 py-5 px-5" style="background-color: #E1ECF7;">
                                <img src="resources/offer-2.png" alt="">
                                <div class="position-relative text-start">
                                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                                    <h1 class="mb-4 font-weight-semi-bold text-dark">Winter Collection</h1>
                                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Offer End -->

                <div class="col-12 mb-3 ps-4 mt-4">
                    <div class="row border border-info">

                        <div class="row px-xl-5 pb-3 mt-4">

                            <?php

                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            $category_data = $category_rs->fetch_assoc();

                            ?>

                            <!-- product -->
                            <?php

                            $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                    `status_id`='1' AND `category_id`='7' ORDER BY `datetime_added` DESC LIMIT 16");
                            $product_num = $product_rs->num_rows;

                            for ($z = 0; $z < $product_num; $z++) {
                                $product_data = $product_rs->fetch_assoc();

                            ?>

                                <div class="col-lg-3 col-md-6 col-sm-12 pb-5">
                                    <div class="card product-item border-0 mb-5 mt-2">
                                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex justify-content-center">

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                            $image_data = $image_rs->fetch_assoc();

                                            ?>

                                            <img class="img-fluid w-80 imgcat" src="<?php echo $image_data["code"]; ?>" alt="" style="height: 200px;">
                                        </div>
                                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3" style="background-color: #AECBEB;">
                                            <h5 class="fw-bold mb-3"><?php echo $product_data["title"]; ?></h5>
                                            <div class="d-flex justify-content-center">
                                                <h6>Rs. <?php echo $product_data["price"]; ?> .00</h6>
                                            </div>
                                        </div>

                                        <div class="card-footer d-flex justify-content-between bg-light border">

                                            <?php

                                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $product_data["id"] . "' AND
                                                            `user_email`='" . $_SESSION["u"]["email"] . "'");
                                            $watchlist_num = $watchlist_rs->num_rows;

                                            if ($watchlist_num == 1) {

                                            ?>
                                                <button class="btn btn-sm text-dark p-0" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                    <i class="bi bi-heart-fill text-danger mr-1" id='heart<?php echo $product_data["id"]; ?>'></i>
                                                    Add To Wishlist
                                                </button>


                                            <?php

                                            } else {
                                            ?>
                                                <button class="btn btn-sm text-dark p-0" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                    <i class="bi bi-heart-fill text-dark mr-1" id='heart<?php echo $product_data["id"]; ?>'></i>
                                                    Add To Wishlist
                                                </button>
                                            <?php
                                            }
                                            ?>

                                            <?php

                                            if ($product_data["qty"] > 0) {

                                            ?>

                                                <button onclick="addToCart(<?php echo $product_data['id']; ?>);" class="btn btn-sm text-dark p-0">
                                                    <i class="bi bi-cart3 text-primary mr-1"></i>
                                                    Add To Cart
                                                </button>

                                            <?php

                                            } else {

                                            ?>

                                                <button class="btn btn-sm text-dark p-0 disabled"><i class="bi bi-cart3 text-dark mr-1"></i> Add to Cart</button>

                                            <?php

                                            }
                                            ?>

                                        </div>
                                        <a href='<?php echo "singleproductview.php?id=" . $product_data["id"]; ?>' class="col-12 btn" style="background-color: pink;">Buy Now</a>
                                    </div>
                                </div>
                                <!-- product -->
                            <?php

                            }

                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>





    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        function toggleNavbar() {
            const navbar = document.getElementById('mainNavbar');
            navbar.classList.toggle('navbar-open');
            navbar.classList.toggle('block');
        }
    </script>

    <script>
        // Function to toggle the cart visibility
        function toggleCart() {
            const cartContainer = document.getElementById('cart-container');
            const cartOverlay = document.getElementById('cart-overlay');
            const body = document.body;

            // Toggle the "open" class to animate the cart container
            cartContainer.classList.toggle('open');

            // Toggle the "show" class to display the overlay
            cartOverlay.classList.toggle('show');

            // Disable page scroll if the cart is open
            if (cartContainer.classList.contains('open')) {
                body.classList.add('no-scroll');
            } else {
                body.classList.remove('no-scroll');
            }
        }

        // Optional: Close the cart if the user clicks outside
        document.getElementById('cart-overlay').addEventListener('click', toggleCart);

        // Add a class to the navbar when the page is scrolled
        window.addEventListener('scroll', function() {
            let navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

</body>

</html>