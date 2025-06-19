<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist | SHE</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/she-logos_black.png" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php require "header.php"; ?>

            <div class="container-fluid mb-5" style="background-color: #FFB3C6;">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                    <h1 class="fw-bold text-uppercase mb-3 fs-1">Wishlist <i class="bi bi-suit-heart-fill fs-1"></i></h1>
                    <div class="d-inline-flex">
                        <p class="m-0"><a href="home.php">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Wishlist</p>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-5">
                <div class="row">
                    <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                        <input type="text" class="form-control" placeholder="Search in Wishlist" id="watchlist_txt"/>
                    </div>
                    <div class="col-12 col-lg-2 mb-3 d-grid">
                        <button class="btn btn-primary" onclick="watchlistSearch(0);">Search</button>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center" id="basicSearchResult">

                <?php
                require "connection.php";
                $user = $_SESSION["u"]["email"];

                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $user . "' ");
                $watch_num = $watch_rs->num_rows;

                $product_rs = Database::search("SELECT * FROM `product`");
                $product_data = $product_rs->fetch_assoc();

                if ($watch_num == 0) {
                ?>
                    <!-- empty view -->
                    <div class="col-12" style="background-color: #FAE6E7;">
                        <div class="row">
                            <div class="col-12 emptyView"></div>
                            <div class="col-12 text-center mb-2">
                                <label class="col-12 form-label fs-1 fw-bold">You have no items in your Wishlist yet.</label>
                            </div>
                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                <a href="home.php" class="btn  fs-3 fw-bold" style="background-color: #D14F7B;">Start Shopping</a>
                            </div>
                        </div>
                    </div>
                    <!-- empty view -->
                <?php
                } else {
                ?>
                    <div class="col-12 col-lg-9" >
                        <div class="row">
                            <?php
                            for ($x = 0; $x < $watch_num; $x++) {
                                $watch_data = $watch_rs->fetch_assoc();
                            ?>

                                <!-- have products -->

                                <div class="card mb-3 mx-0 mx-lg-2 col-12 " style="background-color: #FAE6E7;">
                                    <div class="row g-0">
                                        <div class="col-md-4">

                                            <?php
                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $watch_data["product_id"] . "'");
                                            $image_data = $image_rs->fetch_assoc();
                                            ?>

                                            <img src="<?php echo $image_data["code"]; ?>" style="height: 180px;" class="img-fluid rounded-start mt-1">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="card-body">
                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watch_data["product_id"] . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                                ?>
                                                <h5 class="card-title fs-2 fw-bold text-primary"><?php echo $product_data["title"]; ?></h5>
                                                <?php

                                                $clr_rs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $product_data["colour_id"] . "'");
                                                $clr_data = $clr_rs->fetch_assoc();

                                                ?>
                                                <span class="fs-5 fw-bold text-black-50">Colour : <?php echo $clr_data["name"]; ?></span>
                                                &nbsp;&nbsp; <br/>

                                                <?php
                                                $size_rs = Database::search("SELECT * FROM `size` WHERE `id`='".$product_data["size_id"]."'");
                                                $size_data = $size_rs->fetch_assoc();
                                                ?>

                                                <span class="fs-5 fw-bold text-black-50">Size : <?php echo $size_data["name"]; ?></span>
                                                &nbsp;&nbsp;
                                                
                                                <br />
                                                <span class="fs-5 fw-bold text-black-50">Price :</span>&nbsp;&nbsp;
                                                <span class="fs-5 fw-bold text-black">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                <br />
                                                <span class="fs-5 fw-bold text-black-50">Quantity :</span>&nbsp;&nbsp;
                                                <span class="fs-5 fw-bold text-black"><?php echo $product_data["qty"]; ?> Items available</span>
                                                <br />
                                                <span class="fs-5 fw-bold text-black-50">Seller :</span>&nbsp;&nbsp;
                                                <?php
                                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$product_data["user_email"]."'");
                                                $seller_data = $seller_rs->fetch_assoc();
                                                ?>
                                                <span class="fs-5 fw-bold text-black"><?php echo $seller_data["fname"];?></span>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mt-5">
                                            <div class="card-body d-lg-grid">
                                                <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                                <a href="#" class="btn btn-outline-warning mb-2" onclick="addToCart(<?php echo $watch_data['id']; ?>);">Add to cart</a>
                                                <a href="#" class="btn btn-outline-danger mb-2" onclick='removeFromWatchlist(<?php echo $watch_data["id"]; ?>);'>Remove</a>
                                            </div>
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
                }

                ?>

            </div>



            <?php require "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>