

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | SHE</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/she-logos_black.png" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";
            require "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;

            ?>

                <div class="container-fluid mb-5" style="background-color: #FFB3C6;">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                        <h1 class="fw-bold text-uppercase mb-3 fs-1">Shopping Cart</h1>
                        <div class="d-inline-flex">
                            <p class="m-0"><a href="home.php">Home</a></p>
                            <p class="m-0 px-2">-</p>
                            <p class="m-0">Shopping Cart</p>
                        </div>
                    </div>
                </div>

                <?php

                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "' ");
                $cart_num = $cart_rs->num_rows;

                if ($cart_num == 0) {
                    // empty 
                ?>
                    <div class="col-12" style="background-color: #FAE6E7;">
                        <div class="row">
                            <div class="col-12 emptycart"></div>
                            <div class="col-12 text-center mb-2">
                                <label class="col-12 form-label fs-1 fw-bold">You have no items in your cart yet.</label>
                            </div>
                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                <a href="home.php" class="btn  fs-3 fw-bold" style="background-color: #D14F7B;" >Start Shopping</a>
                            </div>
                        </div>
                    </div>

                <?php
                } else {
                ?>

                    <div class="container-fluid pt-5">
                        <div class="row px-xl-5">
                            <div class="col-lg-8 table-responsive mb-5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead class="text-dark " style="background-color: #FFB3C6;">
                                        <tr>
                                            <th class="fs-5">Products</th>
                                            <th class="fs-5 col-3">Price</th>
                                            <th class="fs-5">Quantity</th>
                                            <th class="fs-5 col-3">Total</th>
                                            <th class="fs-5">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">

                                        <?php

                                        for ($x = 0; $x < $cart_num; $x++) {
                                            $cart_data = $cart_rs->fetch_assoc();
                                            $pid = $cart_data["product_id"];

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $total = $total + ($product_data["price"] * 1);

                                            $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN `city` ON
                                            user_has_address.city_id = city.id INNER JOIN `district` ON city.district_id = district.id WHERE
                                            `user_email`='" . $email . "'  ");

                                            $address_data = $address_rs->fetch_assoc();

                                            $ship = 0; 

                                            if ($address_data["did"] == 2) {
                                                $ship = $product_data["delivery_fee_colombo"];
                                                $shipping = $shipping + $product_data["delivery_fee_colombo"];
                                            } else {
                                                $ship = $product_data["delivert_fee_other"];
                                                $shipping = $shipping + $product_data["delivert_fee_other"];
                                            }

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "' ");
                                            $image_data = $image_rs->fetch_assoc();

                                            $clr_rs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $product_data["colour_id"] . "' ");
                                            $clr_data = $clr_rs->fetch_assoc();

                                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                                            $seller_data = $seller_rs->fetch_assoc();
                                            $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                        ?>

                                            <tr>
                                                <td class="align-middle fs-5"><img src="<?php echo ($image_data["code"]); ?>" alt="" style="width: 100px;"> </br><?php echo ($product_data["title"]); ?></td>
                                                <td class="align-middle fs-3">Rs. <?php echo ($product_data["price"]); ?> .00</td>
                                                <td class="align-middle">
                                                    <div class="input-group quantity mx-auto" style="width: 150px;">
                                                        <div class="input-group-btn ">
                                                            <button class="btn btn-sm  btn-minus" style="background-color: #EFD5D0;">
                                                                <i class="bi bi-dash-lg fs-3" onclick="qty_dec();"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" class="form-control form-control-sm fs-3 text-center" id="qty_input" style="background-color: white;" value="1">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm  btn-plus" style="background-color: #EFD5D0;">
                                                                <i class="bi bi-plus-lg text-dark fs-3" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle fs-3">Rs. <?php echo ($product_data["price"] * 1) + $ship; ?> .00</td>
                                                <td class="align-middle"><button class="btn btn-sm " style="background-color: #EFD5D0;"><i class="bi bi-x-lg fs-3" onclick="deletefromCart(<?php echo $cart_data['id']; ?>);"></i></button></td>
                                            </tr>
                                        <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>


                            <div class="col-lg-4">
                                <form class="mb-5" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control p-4 fs-4" placeholder="Coupon Code">
                                        <div class="input-group-append">
                                            <button class="btn fs-4  p-4" style="background-color: #FFB3C6;">Apply Coupon</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="card border-secondary mb-5">
                                    <div class="card-header border-0 p-3" style="background-color: #FFB3C6;">
                                        <h3 class="fw-bold m-0">Cart Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3 pt-1">
                                            <h6 class="font-weight-medium">Subtotal</h6>
                                            <h6 class="font-weight-medium">Rs. <?php echo $total; ?> .00</h6>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="font-weight-medium">Shipping</h6>
                                            <h6 class="font-weight-medium">Rs. <?php echo $shipping; ?> .00</h6>
                                        </div>
                                    </div>
                                    <div class="card-footer border-secondary bg-transparent">
                                        <div class="d-flex justify-content-between mt-2">
                                            <h5 class="font-weight-bold">Total</h5>
                                            <h5 class="font-weight-bold">Rs. <?php echo ($total + $shipping); ?> .00</h5>
                                        </div>

                                        <button class="btn btn-block fw-bold my-3 py-3 text-dark" style="background-color: #EFD5D0;" onclick="window.location.href='invoiceCheckout.php'">Proceed To Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                <?php
                }

                ?>

            <?php

            } else {
                echo ("Please signin or register");
            }

            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>