<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.price,product.qty,product.description,product.title,
    product.datetime_added,product.delivery_fee_colombo,product.delivert_fee_other,
    product.category_id,product.colour_id,product.status_id,product.user_email FROM `product`
    WHERE product.id = '" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $product_data["title"]; ?> | SHE</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
            <!-- <link rel="stylesheet" href="style.css" /> -->

            <link rel="icon" href="resources/she-logos_black.png" />

            <style>
                .hover-scale {
                    transition: transform 0.3s ease;
                }

                .hover-scale:hover {
                    transform: scale(1.1);
                }

                .hover-shadow {
                    transition: box-shadow 0.3s ease;
                }

                .hover-shadow:hover {
                    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.3);
                }

                .breadcrumb a {
                    color: #6c757d;
                    transition: color 0.3s;
                }

                .breadcrumb a:hover {
                    color: pink;
                    text-decoration: none;
                }

                .image-container {
                    border: 2px solid #e0e0e0;
                    border-radius: 20px;
                    background: linear-gradient(135deg, #f9f9f9, #e9e9e9);
                    overflow: hidden;
                }

                input[type="number"]::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                }

                .shadow {
                    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1) !important;
                }

                .card {
                    transition: transform 0.3s, box-shadow 0.3s;
                }

                .card:hover {
                    transform: scale(1.05);
                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                }

                .badge {
                    font-size: 0.9rem;
                }

                .btn {
                    transition: background-color 0.3s, color 0.3s;
                }

                .btn:hover {
                    background-color: #0d6efd;
                    color: #fff;
                }

            </style>

        </head>

        <body class="bodyA">

            <div class="container-fluid">
                <div class="row">

                    <?php include "header.php"; ?>

                    <!--  -->
                    <div class="p-5">
                        <div class="row bg-light p-4 shadow-lg rounded-4">
                            <!-- Sidebar: Image Thumbnails -->
                            <div class="col-12 col-lg-2 d-flex flex-column align-items-center mb-3 animate__animated animate__fadeInLeft">
                                <ul class="list-unstyled">
                                    <?php
                                    $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                    $images_num = $images_rs->num_rows;
                                    $img = array();

                                    if ($images_num != 0) {
                                        for ($x = 0; $x < $images_num; $x++) {
                                            $images_data = $images_rs->fetch_assoc();
                                            $img[$x] = $images_data["code"];
                                    ?>
                                            <li class="mb-2">
                                                <img src="<?php echo $img["$x"]; ?>"
                                                    class="img-thumbnail rounded cursor-pointer hover-shadow"
                                                    style="height: 90px; object-fit: cover; transition: transform 0.3s;"
                                                    onclick="loadMainImage(<?php echo $x; ?>);" />
                                            </li>
                                        <?php
                                        }
                                    } else {
                                        for ($i = 0; $i < 3; $i++) {
                                        ?>
                                            <li class="mb-2">
                                                <img src="resources/addImg.svg"
                                                    class="img-thumbnail rounded"
                                                    style="height: 90px; object-fit: contain;" />
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>

                            <!-- Main Product Image -->
                            <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center mb-3 animate__animated animate__zoomIn">
                                <div class="image-container position-relative shadow rounded-4 overflow-hidden">
                                    <img id="mainImg" src="<?php echo $img[0] ?? 'resources/defaultProduct.png'; ?>"
                                        class="img-fluid rounded hover-scale"
                                        style="max-height: 350px; object-fit: contain; transition: transform 0.3s;" />
                                </div>
                            </div>

                            <!-- Product Details -->
                            <div class="col-12 col-lg-6 animate__animated animate__fadeInRight">
                                <!-- Breadcrumb -->
                                <nav class="breadcrumb bg-transparent px-0 mb-3">
                                    <a class="breadcrumb-item text-secondary fw-bold" href="home.php">Home</a>
                                    <a class="breadcrumb-item text-secondary fw-bold" href="home.php">Product</a>
                                    <span class="breadcrumb-item active text-primary fw-bold"><?php echo $product_data["title"]; ?></span>
                                </nav>

                                <!-- Title -->
                                <h1 class="display-6 text-dark fw-bold mb-3"><?php echo $product_data["title"]; ?></h1>

                                <!-- Price -->
                                <h2 class="h4 text-danger fw-bold mb-4">LKR. <?php echo $product_data["price"]; ?>.00</h2>

                                <!-- Quantity Selector -->
                                <div class="d-flex align-items-center mb-4">
                                    <label class="me-3 fw-semibold">Quantity:</label>
                                    <input type="number" class="form-control w-25 text-center rounded-4 shadow-sm"
                                        value="1" min="1" max="<?php echo $product_data["qty"]; ?>"
                                        id="qty_input" onkeyup='checkValue(<?php echo $product_data["qty"]; ?>);' />
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-3 mb-4">
                                    <button class="btn btn-primary w-100 hover-scale shadow rounded-4 fw-bold" onclick="payments(<?php echo $pid; ?>);">Buy Now</button>
                                    <button class="btn btn-dark w-100 hover-scale shadow rounded-4 fw-bold">
                                        <i class="bi bi-cart"></i> Add to Cart
                                    </button>
                                    <button class="btn btn-outline-danger w-100 hover-scale shadow rounded-4 fw-bold">
                                        <i class="bi bi-heart"></i> Wishlist
                                    </button>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <h4 class="h5 fw-bold">Product Description:</h4>
                                    <p class="text-muted small"> <?php echo $product_data["description"]; ?></p>
                                </div>

                                <!-- Personalization (Optional) -->
                                <?php if ($product_data["category_id"] == 7) { ?>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Personalize This Cake:</label>
                                        <input type="text" class="form-control rounded-4 shadow-sm" placeholder="Add your custom message" />
                                    </div>
                                    <div>
                                        <label class="form-label fw-bold">Include Gift Tag (+RS.200.00):</label>
                                        <textarea class="form-control rounded-4 shadow-sm" placeholder="To- John Doe, From- Sam Peter"></textarea>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                    <!--  -->

                    <!-- suggestions -->
                    <div class="col-12 bg-light mt-5 border-top border-2 border-secondary">
                        <div class="row me-0 mt-4 mb-5">
                            <div class="col-12 d-flex justify-content-center">
                                <span class="fw-bold display-5" style="color: pink;">Suggested Products</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-light py-4">
                        <div class="row g-3 justify-content-center">

                            <?php
                            $relatted_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $product_data["category_id"] . "' AND
        `status_id`='1' LIMIT 5 OFFSET 0");

                            $relatted_num = $relatted_rs->num_rows;

                            for ($x = 0; $x < $relatted_num; $x++) {
                                $relatted_data = $relatted_rs->fetch_assoc();
                            ?>

                                <div class="col-12 col-md-4 col-lg-2">
                                    <div class="card border-0 shadow-sm animate__animated animate__fadeInUp">
                                        <?php
                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $relatted_data["id"] . "'");
                                        $image_data = $image_rs->fetch_assoc();
                                        ?>
                                        <img src="<?php echo $image_data["code"]; ?>" class="card-img-top img-thumbnail rounded-3" style="height: 180px; object-fit: cover;" alt="Product Image">

                                        <div class="card-body text-center">
                                            <h5 class="card-title text-truncate fw-bold text-dark"> <?php echo $relatted_data["title"]; ?> </h5>
                                            <p class="text-primary fs-5">LKR. <?php echo $relatted_data["price"]; ?>.00</p>

                                            <?php if ($relatted_data["qty"] > 0) { ?>
                                                <span class="badge bg-success mb-2">In Stock</span>
                                                <p class="text-muted small"><?php echo $relatted_data["qty"]; ?> items available</p>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class="btn btn-outline-primary btn-sm rounded-circle" title="View Product" onclick="window.location.href='<?php echo "singleproductview.php?id=" . $relatted_data['id'] ?>';">
                                                        <i class="bi bi-wallet2"></i>
                                                    </button>
                                                    <button class="btn btn-outline-primary btn-sm rounded-circle" title="Add to Cart" onclick="addToCart(<?php echo $relatted_data['id']; ?>);">
                                                        <i class="bi bi-cart"></i>
                                                    </button>

                                                    <?php
                                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $relatted_data["id"] . "' AND
                            `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                    $watchlist_num = $watchlist_rs->num_rows;

                                                    if ($watchlist_num == 1) {
                                                    ?>
                                                        <button class="btn btn-outline-danger btn-sm rounded-circle" title="Remove from Wishlist" onclick="addToWatchlist(<?php echo $relatted_data['id']; ?>);">
                                                            <i class="bi bi-heart-fill"></i>
                                                        </button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-outline-primary btn-sm rounded-circle" title="Add to Wishlist" onclick="addToWatchlist(<?php echo $relatted_data['id']; ?>);">
                                                            <i class="bi bi-heart"></i>
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                            <?php } else { ?>
                                                <span class="badge bg-danger mb-2">Out of Stock</span>
                                                <p class="text-danger small">0 items available</p>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class="btn btn-outline-secondary btn-sm rounded-circle disabled" title="Out of Stock">
                                                        <i class="bi bi-wallet2"></i>
                                                    </button>
                                                    <button class="btn btn-outline-secondary btn-sm rounded-circle disabled" title="Out of Stock">
                                                        <i class="bi bi-cart"></i>
                                                    </button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </div>

                    <!-- suggestions -->

                

                </div>
            </div>

            <?php include "footer.php";?>

            <script src="//code.jquery.com/jquery-1.9.1.js"></script>



            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>

        </body>

        </html>

<?php

    } else {
        echo ("Sorry for the Inconvenience");
    }
} else {
    echo ("Something went wrong");
}

?>