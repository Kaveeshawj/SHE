<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/she-logos_black.png" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php require "header.php";
            require "connection.php"; ?>

            <div class="container-fluid mb-5" style="background-color: #FFB3C6;">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
                    <h1 class="fw-bold text-uppercase mb-3 fs-1">Women's Clothing </h1>
                    <div class="d-inline-flex">
                        <p class="m-0"><a href="home.php">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Dresses</p>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-5">
                <div class="row px-xl-5">
                    <!-- Shop Sidebar Start -->
                    <div class="col-lg-3 col-md-12">

                        <!-- Color Start -->
                        <div class="border-bottom mb-4 pb-4">
                            <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                            <select class="form-select" id="c">
                                <option value="0">Select Color</option>

                                <?php
                                $color_rs = Database::search("SELECT * FROM `colour`");
                                $color_num = $color_rs->num_rows;

                                for ($x = 0; $x < $color_num; $x++) {
                                    $color_data = $color_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $color_data["id"]; ?>"><?php echo $color_data["name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Color End -->

                        <!-- Size Start -->
                        <div class="mb-3">
                            <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                            <select class="form-select" id="size">
                                <option>Select size</option>
                                <?php
                                $size_rs = Database::search("SELECT * FROM `size`");
                                $size_num = $size_rs->num_rows;

                                for ($x = 0; $x < $size_num; $x++) {
                                    $size_data = $size_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $size_data["id"]; ?>"><?php echo $size_data["name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Size End -->

                        <div class="col-12 col-lg-12 mt-2 mb-1 d-grid mb-5">
                                <button class="btn btn-primary" onclick="advancedSearch(0);">Search</button>
                            </div>

                    </div>
                    <!-- Shop Sidebar End -->

                    <div class="col-lg-9 col-md-12 mt-4">
                        <div class="row pb-3">
                            <div class="col-12 pb-1">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <form action="">
                                        <div class="input-group ms-3 col-xs-4">
                                            <input type="text" size="40" class="form-control" placeholder="Search by name" id="basic_search_txt">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent text-primary">
                                                    <i class="bi bi-search" onclick="basicSearch(0);"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                    <div class=" col-12 col-lg-9  rounded mb-2">
                                        <div class="row">
                                            <div class="offset-4 offset-lg-8 col-8 col-lg-4 mt-2 mb-2 p-2">
                                                <select class="form-select border border-start-0 border-top-0 border-end-0 border-2 fw-bold fs-6" id="s">
                                                    <option value="0">SORT BY</option>
                                                    <option value="1">PRICE HIGH TO LOW</option>
                                                    <option value="2">PRICE LOW TO HIGH</option>
                                                    <option value="3">QUANTITY HIGH TO LOW</option>
                                                    <option value="4">QUANTITY LOW TO HIGH</option>
                                                </select>

                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3 mt-6">
                                        <input type="text" class="form-control" placeholder="Price From..." id="pf"/>
                                    </div> 

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Price To..." id="pt"/>
                                    </div>

                        </div>
                    </div>

                    <div class="col-12 ms-3 rounded mb-2" style="background-color: #FFE5EC;" id="basicSearchResult">
                        <div class="row">
                            <div class="">
                                <div class="row justify-content-center gap-2" id="viewArea">

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='1' ");
                                    $product_num = $product_rs->num_rows;

                                    for ($x = 0; $x < $product_num; $x++) {
                                        $product_data = $product_rs->fetch_assoc();

                                        if ($product_data["category_id"] == 1) {

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

                                    <?php
                                        }
                                    }

                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <?php require "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>