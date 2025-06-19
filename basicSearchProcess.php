<?php

require "connection.php";
session_start();

$txt = $_POST["t"];

$query = "SELECT * FROM `product`";

if (!empty($txt)) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' ";
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


                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex justify-content-center">

                            <?php

                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                            $image_data = $image_rs->fetch_assoc();

                            ?>

                            <img class="img-fluid w-80  imgcat" src="<?php echo $image_data["code"]; ?>" alt="" style="height: 200px;">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h5 class="fw-bold mb-3"><?php echo $selected_data["title"]; ?></h5>
                            <div class="d-flex justify-content-center">
                                <h6>Rs. <?php echo $selected_data["price"]; ?> .00</h6>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between bg-light border">

                            <?php

                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $selected_data["id"] . "' AND
                                                            `user_email`='" . $_SESSION["u"]["email"] . "'");
                            $watchlist_num = $watchlist_rs->num_rows;

                            if ($watchlist_num == 1) {

                            ?>
                                <button class="btn btn-sm text-dark p-0" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'>
                                    <i class="bi bi-heart-fill text-danger mr-1" id='heart<?php echo $selected_data["id"]; ?>'></i>
                                    Add To Wishlist
                                </button>


                            <?php

                            } else {
                            ?>
                                <button class="btn btn-sm text-dark p-0" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'>
                                    <i class="bi bi-heart-fill text-dark mr-1" id='heart<?php echo $selected_data["id"]; ?>'></i>
                                    Add To Wishlist
                                </button>
                            <?php
                            }
                            ?>

                            <?php

                            if ($selected_data["qty"] > 0) {

                            ?>

                                <button onclick="addToCart(<?php echo $selected_data['id']; ?>);" class="btn btn-sm text-dark p-0">
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
                        <a href='<?php echo "singleproductview.php?id=" . $selected_data["id"]; ?>' class="col-12 btn btn-success">Buy Now</a>
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