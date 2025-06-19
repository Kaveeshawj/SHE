<?php
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Generate Reports | admin | SHE</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/she-logos_black.png" />


</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#C8B6FF 0%,#F191AC 100%);">

    <div class="container-fluid">
        <div class="row gy-3">

            <div class="col-12">
                <div class="row">

                    <div class="row g-0 p-2">


                        <div class="col-12 mb-2 ">

                            <div class="col-12">
                                <div class="col-12 text-center mt-3 mb-3">
                                    <h1>Popular Selling Products</h1>
                                </div>

                            </div>

                            <div class="col-12">
                                <hr class="border border-2 border-primary">
                            </div>
                            <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="PrintInvoice1();"><i class="bi bi-printer-fill"></i> Print</button>
                    <button class="btn btn-danger me-2"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>
                            <div class="col-11 mt-3 p-2 ms-5 mb-5  ">
                                <div class="row offset-1">

                                    <div class="col-10 ms-5 mt-4 " id="page1">
                                        <div class="row text-center">
                                            <table class="table bg-light pt-3">
                                                <thead>

                                                    <tr class="p-3">
                                                        <th scope="col" class="fs-4">Name</th>
                                                        <th scope="col" class="fs-4">Sales</th>
                                                        <th scope="col" class="fs-4">Stock</th>
                                                        <th scope="col" class="fs-4">Amount</th>
                                                        <th scope="col" class="fs-4">Action</th>
                                                    </tr>
                                                </thead>

                                                <?php

                                                $invoice_rs = Database::search("SELECT * FROM `invoice`  INNER JOIN `product` ON 
                                                product.id = invoice.product_id ORDER BY `total` DESC");
                                                $invoice_num = $invoice_rs->num_rows;

                                                for ($x = 0; $x < $invoice_num; $x++) {
                                                    $selected_data = $invoice_rs->fetch_assoc();

                                                ?>

                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"><?php echo  $selected_data["title"]; ?><br />
                                                                <p class="text-secondary">#<?php echo  $selected_data["order_id"]; ?></p>
                                                            </th>
                                                            <td class="bg-info">Rs. <?php echo $selected_data["total"]; ?> .00</td>

                                                            <?php

                                                            $product_data = Database::search("SELECT `qty` FROM `invoice` WHERE `product_id`='" . $selected_data["product_id"] . "' ");
                                                            $pro = $product_data->fetch_assoc();
                                                            ?>
                                                            <td><?php echo $selected_data["qty"]; ?> left</td>

                                                            <td class="bg-info"><?php  echo $pro["qty"]; ?> Items sold</td>

                                                            <td>
                                                                <button class="btn btn-outline-primary" onclick="">View Details</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>


                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>



                        <div class="col-12 mb-2 ">

                            <div class="col-12">
                                <div class="col-12 text-center mt-3 mb-3">
                                    <h1>Popular Sellers</h1>
                                </div>

                            </div>

                            <div class="col-12">
                                <hr class="border border-2 border-primary">
                            </div>
                            <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="PrintInvoice2();"><i class="bi bi-printer-fill"></i> Print</button>
                    <button class="btn btn-danger me-2"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>
                            <div class="col-11 mt-3 p-2 ms-5 mb-5  ">
                                <div class="row offset-1">

                                    <div class="col-10 ms-5 mt-4 " id="page2">
                                        <div class="row text-center">
                                            <table class="table bg-light pt-3">
                                                <thead>

                                                    <tr class="p-3">
                                                        <th scope="col" class="fs-4">Name</th>
                                                        <th scope="col" class="fs-4">Mobile</th>
                                                        <th scope="col" class="fs-4">Selling Items</th>
                                                        <th scope="col" class="fs-4">Profit</th>
                                                        <!-- <th scope="col" class="fs-4">Amount</th> -->
                                                        <th scope="col" class="fs-4">Action</th>
                                                    </tr>
                                                </thead>

                                                <?php

                                                // $invoice_rs1 = Database::search("SELECT * FROM `invoice`  INNER JOIN `product` ON 
                                                // product.id = invoice.product_id INNER JOIN `user` ON user.email=product.user_email");

                                                $invoice_rs1 = Database::search("SELECT DISTINCT `user_email`,`fname`,`lname`,`mobile` FROM `product` INNER JOIN `user` ON user.email=product.user_email");
                                                $invoice_num1 = $invoice_rs1->num_rows;

                                                for ($x = 0; $x < $invoice_num1; $x++) {
                                                    $selected_data1 = $invoice_rs1->fetch_assoc();

                                                ?>

                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" class="bg-success"><?php echo  $selected_data1["fname"] . " " . $selected_data1["lname"]; ?></th>
                                                            <td> <?php echo $selected_data1["mobile"]; ?> </td>
                                                            <td class="bg-info">
                                                                <?php

                                                                $product_data = Database::search("SELECT `title` FROM `product` WHERE `user_email`='" . $selected_data1["user_email"] . "' ");
                                                                $pro_rs = $product_data->num_rows;
                                                                for ($z = 0; $z < $pro_rs; $z++) {
                                                                    $pro = $product_data->fetch_assoc();
                                                                ?>
                                                                    <span class="pt-4 fw-bold"><?php echo $pro["title"]; ?></span><br />
                                                                <?php
                                                                }
                                                                ?>

                                                            </td>

                                                            <td class="bg-secondary">
                                                                <?php

                                                                $product_data1 = Database::search("SELECT `price`,`qty` FROM `product` WHERE `user_email`='" . $selected_data1["user_email"] . "' ");
                                                                $pro_rs1 = $product_data1->num_rows;
                                                                $d = 0;

                                                                for ($z = 0; $z < $pro_rs1; $z++) {
                                                                    $pro1 = $product_data1->fetch_assoc();
                                                                    $a = $pro1["price"];
                                                                    $b = $pro1["qty"];
                                                                    $c = $a * $b;
                                                                    $d = $d + $c;
                                                                }
                                                                ?>
                                                                <span class="pb-2 fw-bold">Rs. <?php echo $d; ?> .00</span><br />


                                                            </td>

                                                            <td>
                                                                <button class="btn btn-outline-primary" onclick="">View Details</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>



                        <div class="col-12 mb-2 ">

                            <div class="col-12">
                                <div class="col-12 text-center mt-3 mb-3">
                                    <h1>Most Engaged Users</h1>
                                </div>

                            </div>

                            <div class="col-12">
                                <hr class="border border-2 border-primary">
                            </div>
                            <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="PrintInvoice3();"><i class="bi bi-printer-fill"></i> Print</button>
                    <button class="btn btn-danger me-2"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>
                            <div class="col-11 mt-3 p-2 ms-5 mb-5  ">
                                <div class="row offset-1">

                                    <div class="col-10 ms-5 mt-4 " id="page3">
                                        <div class="row text-center">
                                            <table class="table bg-light pt-3">
                                                <thead>

                                                    <tr class="p-3">
                                                        <th scope="col" class="fs-4">Name</th>
                                                        <th scope="col" class="fs-4">Mobile</th>
                                                        <th scope="col" class="fs-4">Expends</th>
                                                        <th scope="col" class="fs-4">Amount</th>
                                                        <th scope="col" class="fs-4">Action</th>
                                                    </tr>
                                                </thead>

                                                <?php

                                                $invoice_rs = Database::search("SELECT DISTINCT `user_email`,`fname`,`lname`,`mobile` FROM `invoice`  INNER JOIN `user` ON 
                                                user.email = invoice.user_email ORDER BY `total` DESC");
                                                $invoice_num = $invoice_rs->num_rows;

                                                for ($x = 0; $x < $invoice_num; $x++) {
                                                    $selected_data = $invoice_rs->fetch_assoc();

                                                ?>

                                                    <tbody>
                                                        <tr>
                                                            <th class="bg-success" scope="row"><?php echo  $selected_data["fname"] . " " . $selected_data["lname"]; ?><br />
                                                            </th>
                                                            <td><?php echo $selected_data["mobile"]; ?></td>

                                                            <?php

                                                            $product_data1 = Database::search("SELECT `total`,`qty` FROM `invoice` WHERE `user_email`='" . $selected_data["user_email"] . "' ");
                                                            $pro_rs1 = $product_data1->num_rows;
                                                            $d = 0;
                                                            $e = 0;

                                                            for ($z = 0; $z < $pro_rs1; $z++) {
                                                                $pro1 = $product_data1->fetch_assoc();
                                                                $a = $pro1["total"];
                                                                $b = $pro1["qty"];
                                                                $d = $d + $a;
                                                                $e = $e + $b;
                                                            }
                                                            ?>

                                                            <td class="bg-info">Rs. <?php echo $d; ?> .00</td>
                                                            <td class="bg-secondary"><?php echo $e; ?> Items</td>

                                                            <td>
                                                                <button class="btn btn-outline-primary" onclick="">View Details</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>


                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>

                    <script src="bootstrap.bundle.js"></script>
                    <script src="script.js"></script>
</body>

</html>