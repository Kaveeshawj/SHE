<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | Admin | SHE</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/she-logos_black.png" />


</head>

<body class="bodyA" style="background-color: #74EBD5;background-image: linear-gradient(90deg,#C8B6FF 0%,#F191AC 100%);">

    <div class="container-fluid">
        <div class="row gy-3">

            <div class="col-12">
                <div class="row">

                    <div class="row g-0 p-2">


                        <div class="col-12 mb-2 ">

                            <div class="col-12">
                                <div class="col-12 text-center mt-3 mb-3">
                                    <h1>Manage All Products</h1>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="offset-lg-3 offset-0 col-12 col-lg-6 mb-3">
                                            <div class="row">
                                                <div class="col-9">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-3 d-grid">
                                                    <button class="btn btn-primary">Search Product</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12">
                                <hr class="border border-2 border-primary">
                            </div>

                            <div class="col-11 mt-3 p-2 ms-5 mb-5 bg-light ">
                                <div class="row offset-1">

                                    <div class="col-10 ms-5 mt-4 ">
                                        <div class="row text-center">
                                            <table class="table">
                                                <thead>

                                                    <tr class="p-1">
                                                        <th scope="col" class="fs-4">ID</th>
                                                        <th scope="col" class="fs-4">Product Image</th>
                                                        <th scope="col" class="fs-4">Title</th>
                                                        <th scope="col" class="fs-4">Price</th>
                                                        <th scope="col" class="fs-4">Qty</th>
                                                        <th scope="col" class="fs-4">Registered Date</th>
                                                        <th scope="col" class="fs-4">EDIT</th>
                                                    </tr>
                                                </thead>

                                                <?php
                                                require "connection.php";

                                                $query = "SELECT * FROM `product`";
                                                $pageno;

                                                if (isset($_GET["page"])) {
                                                    $pageno = $_GET["page"];
                                                } else {
                                                    $pageno = 1;
                                                }

                                                $product_rs = Database::search($query);
                                                $product_num = $product_rs->num_rows;

                                                $results_per_page = 10;
                                                $number_of_pages = ceil($product_num / $results_per_page);

                                                $page_results = ($pageno - 1) * $results_per_page;
                                                $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                                $selected_num = $selected_rs->num_rows;

                                                for ($x = 0; $x < $selected_num; $x++) {
                                                    $selected_data = $selected_rs->fetch_assoc();

                                                    $profile_image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "' ");
                                                    $profile_image_data = $profile_image_rs->fetch_assoc();
                                                ?>

                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"><?php echo $selected_data["id"]; ?></th>
                                                            <td><img onclick="viewProductModal('<?php echo $selected_data['id']; ?>');" src="<?php echo $profile_image_data["code"]; ?>" style="height: 80px;"></td>
                                                            <td><?php echo $selected_data["title"]; ?></td>
                                                            <td><?php echo $selected_data["price"]; ?></td>
                                                            <td><?php echo $selected_data["qty"]; ?></td>
                                                            <td><?php echo $selected_data["datetime_added"]; ?></td>
                                                            <td>
                                                                <?php

                                                                if ($selected_data["status_id"] == 1) {
                                                                ?>
                                                                    <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                                                                <?php

                                                                }

                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    <!-- modal -->
                                                    <div class="modal" tabindex="-1" id="viewProductModal<?php echo $selected_data['id']; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title fw-bold text-success"><?php echo $selected_data["title"]; ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="offset-4 col-4">
                                                                        <img src="<?php echo $profile_image_data["code"]; ?>" class="img-fluid" style="height: 150px;">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                                                        <span class="fs-5">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                                                        <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                                                        <span class="fs-5"><?php echo $selected_data["qty"]; ?> Products left </span><br />
                                                                        <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                                                        <span class="fs-5">Perera</span><br />
                                                                        <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                                                        <span class="fs-5"><?php echo $selected_data["description"]; ?> </span>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- modal -->

                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>

                                    <!--  -->
                                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagination-lg justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <?php

                                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                                    if ($x == $pageno) {
                                                ?>
                                                        <li class="page-item active">
                                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                        </li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                        </li>
                                                <?php
                                                    }
                                                }

                                                ?>

                                                <li class="page-item">
                                                    <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!--  -->


                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <h3 class="text-black-50 fw-bold">Manage Categories</h3>
                    </div>

                    <div class="col-12 mb-3 mt-3 mb-5">
                        <div class="row gap-1 justify-content-center">

                            <?php
                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                    <div class="card border-5 border-top ">
                                        <div class="card-body" style="background-color: #FFD6FF;">
                                            <h3 class=" text-center"><?php echo $category_data["name"]; ?></h3>
                                            <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 addca"  onclick="addNewCategory();">
                                <div class="card border-5 border-top ">
                                    <div class="card-body" style="background-color: #9967E0;">
                                        <h3 class="text-center">Add new Category &nbsp;<i class="bi bi-plus-lg fw-bold text-dark"></i></h3>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- modal 2 -->
                    <div class="modal" tabindex="-1" id="addCategoryModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <label class="form-label">New Category Name : </label>
                                        <input type="text" class="form-control" id="n">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <label class="form-label">Enter Your Email : </label>
                                        <input type="text" class="form-control" id="e">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="verifyCategory();">Save New Category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal 2 -->

                    <!-- modal 3 -->
                    <div class="modal" tabindex="-1" id="addCategoryVerificationModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Verification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 mt-3 mb-3">
                                        <label class="form-label">Enter Your Verification Code</label>
                                        <input type="text" class="form-control" id="txt">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="saveCategory();">Verify & Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal 3 -->

                </div>
            </div>
            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
</body>

</html>