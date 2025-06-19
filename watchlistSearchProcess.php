<?php

session_start();
require "connection.php";

$txt = $_POST["t"];

$query = "SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'";
$p_rs = Database::search("SELECT * FROM `product`");
$p_data = $p_rs->fetch_assoc();

if (!empty($txt)) {
    $query  .=" AND `product_id` = '".$p_data["id"]."'";
    // $query .= " AND $p_data['title'] LIKE '%" . $txt . "%' ";
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php


            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 8;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>

                <div class="card mb-3 mx-0 mx-lg-2 col-12 " style="background-color: #FAE6E7;">
                    <div class="row g-0">
                        <div class="col-md-4">

                            <?php
                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["product_id"] . "'");
                            $image_data = $image_rs->fetch_assoc();
                            ?>

                            <img src="<?php echo $image_data["code"]; ?>" style="height: 180px;" class="img-fluid rounded-start mt-1">
                        </div>
                        <div class="col-md-5">
                            <div class="card-body">
                                <?php

                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();

                                ?>
                                <h5 class="card-title fs-2 fw-bold text-primary"><?php echo $product_data["title"]; ?></h5>
                                <?php

                                $clr_rs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $product_data["colour_id"] . "'");
                                $clr_data = $clr_rs->fetch_assoc();

                                ?>
                                <span class="fs-5 fw-bold text-black-50">Colour : <?php echo $clr_data["name"]; ?></span>
                                &nbsp;&nbsp; <br />

                                <?php
                                $size_rs = Database::search("SELECT * FROM `size` WHERE `id`='" . $product_data["size_id"] . "'");
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
                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                $seller_data = $seller_rs->fetch_assoc();
                                ?>
                                <span class="fs-5 fw-bold text-black"><?php echo $seller_data["fname"]; ?></span>
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

            <?php

            }

            ?>

            <?php

            ?>

            <?php

            ?>


        </div>
    </div>

    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>