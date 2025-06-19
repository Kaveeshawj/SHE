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

            <?php require "header.php"; ?>

            <div class="container-fluid mb-5" style="background-color: #FFB3C6;">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                    <h1 class="fw-bold text-uppercase mb-3 fs-1">Our Shop</h1>
                    <div class="d-inline-flex">
                        <p class="m-0"><a href="home.php">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Shop</p>
                    </div>
                </div>
            </div>

            <!-- Shop Start -->
            <div class="container-fluid pt-5">
                <div class="row px-xl-5">
                    <!-- Shop Sidebar Start -->
                    <div class="col-lg-3 col-md-12">
                        <!-- Price Start -->
                        <div class="border-bottom mb-4 pb-4">
                            <h5 class="font-weight-semi-bold mb-4">Filter by category</h5>
                            <select class="form-select" id="c1">
                                <option value="0">Select Category</option>

                                <?php
                                require "connection.php";

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for($x = 0;$x < $category_num; $x++){
                                    $category_data = $category_rs->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $category_data["id"];?>"><?php echo $category_data["name"];?></option>
                                    
                                    <?php
                                }

                                ?>
                                
                            </select>
                        </div>
                        <!-- Price End -->

                        <!-- Color Start -->
                        <div class="border-bottom mb-4 pb-4">
                            <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                            <select class="form-select" id="c3">
                                <option value="0">Select Color</option>
                                
                                <?php
                                $color_rs = Database::search("SELECT * FROM `colour`");
                                $color_num = $color_rs->num_rows;

                                for($x = 0;$x < $color_num; $x++){
                                    $color_data = $color_rs->fetch_assoc();

                                    ?>
                                    <option value="<?php echo $color_data["id"];?>"><?php echo $color_data["name"];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Color End -->

                        <!-- Size Start -->
                        <div class="mb-5">
                            <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                            <select class="form-select" id="size">
                                <option>Select size</option>
                                <?php
                                $size_rs = Database::search("SELECT * FROM `size`");
                                $size_num = $size_rs->num_rows;

                                for($x = 0;$x < $size_num; $x++){
                                    $size_data = $size_rs->fetch_assoc();

                                    ?>
                                    <option value="<?php echo $size_data["id"];?>"><?php echo $size_data["name"];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div> 
                        <!-- Size End -->
                        
                        <div class="col-12">
                        <div class="row">
                            <button class="btn btn-primary mb-4 col-12" onclick="shopSearch(0);">Search</button>
                        </div>
                        </div>

                    </div>
                    <!-- Shop Sidebar End -->

                    <div class="col-lg-9 col-md-12">
                        <div class="row pb-3">
                            <div class="col-12 pb-1">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                <form action="">
                                <div class="input-group ms-3">
                                    <input type="text" size="40" class="form-control" id="t" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="bi bi-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                                    <div class="col-12 col-lg-6  rounded mb-2">
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

                            <!-- EMPTY -->
                            <div class="col-12 ms-3 rounded mb-2" style="background-color: #FFE5EC;">
                                <div class="row">
                                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                                        <div class="row" id="viewArea">
                                            <div class="offset-5 col-2 mt-5">
                                                <span class="fw-bold text-black"><i class="bi bi-search" style="font-size: 100px;"></i></span>
                                            </div>
                                            <div class="offset-3 col-6 mt-3 mb-5">
                                                <span class="h1 text-black fw-bold">No Items Searched Yet...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- EMPTY -->

                            <!-- <div class="col-lg-4 col-md-6 col-sm-12 pb-1 ms-3">
                                <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>$123.00</h6>
                                            <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </div>


                </div>
            </div>



            <?php require "footer.php"; ?>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
</body>

</html>