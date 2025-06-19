<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/she-logos_black.png" />
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Roboto', sans-serif;
        }

        .header-container {
            background: linear-gradient(90deg, #FFB3C6, #FFDFD3);
            color: #333;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb-container {
            font-size: 0.9rem;
            color: #555;
            margin-top: 0.5rem;
            /* Adjust spacing below the title */
        }

        .form-control {
            border: 2px solid #FFB3C6;
            /* Default border color */
            background-color: #FFF8F9;
            /* Light pink background */
            transition: all 0.3s ease-in-out;
            /* Smooth transition for hover and focus */
        }

        .borderp {
            border: 2px solid #FFB3C6;
            background-color: #FFF8F9;
            transition: all 0.3s ease-in-out;
        }

        .borderp:focus {
            border-color: #FF6F91;
            box-shadow: 0 0 5px rgba(255, 111, 145, 0.5);
            /* Glow effect */
            outline: none;
            /* Removes default browser focus outline */
        }

        .borderp:hover {
            border-color: #FF8BA5;
            /* Slightly darker pink on hover */
            background-color: #FFEBF2;
            /* Lighter pink on hover */
        }

        .form-control:focus {
            border-color: #FF6F91;
            box-shadow: 0 0 5px rgba(255, 111, 145, 0.5);
            /* Glow effect */
            outline: none;
            /* Removes default browser focus outline */
        }

        .form-control:hover {
            border-color: #FF8BA5;
            /* Slightly darker pink on hover */
            background-color: #FFEBF2;
            /* Lighter pink on hover */
        }


        .form-section {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 30px;
        }

        .form-label {
            color: #495057;
            font-size: 16px;
            font-weight: 600;
        }

        .form-select {
            border: 2px solid #FFB3C6;
            background-color: #FFF8F9;
        }

        .form-select:focus {
            border-color: #FF6F91;
            box-shadow: 0 0 5px rgba(255, 111, 145, 0.5);
        }

        .btn-primary,
        .btn-success {
            background: linear-gradient(90deg, #FF6F91, #FF8BA5);
            border: none;
        }

        .btn-primary:hover,
        .btn-success:hover {
            background: linear-gradient(90deg, #FF4977, #FF748B);
        }

        .input-group-text {
            background-color: #FF6F91;
            color: #fff;
        }

        .image-uploader {
            cursor: pointer;
            text-align: center;
            border: 2px dashed #FFB3C6;
            padding: 10px;
            border-radius: 10px;
            background-color: #FFF8F9;
            transition: all 0.3s ease-in-out;
        }

        .image-uploader:hover {
            background-color: #FFEBF2;
            border-color: #FF6F91;
        }

        .image-preview {
            border-radius: 5px;
            overflow: hidden;
            background-color: #fff;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #FFB3C6;
        }

        .image-preview img {
            max-height: 200px;
            object-fit: cover;
        }

        .header-container h1 {
            font-size: 2.5rem;
            font-weight: bold;
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

        /* Toggler button styles */
        .navbar-toggler {
            border: none;
            background-color: #ff66a3;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            /* Arrange children vertically */
            align-items: center;
            /* Center children horizontally */
            justify-content: center;
            /* Center children vertically */
            gap: 5px;
            /* Add spacing between lines */
        }


        .navbar-toggler span {
            display: block;
            width: 25px;
            height: 3px;
            margin-bottom: 5px;
            background-color: black;
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

        .header-container {
            background-color: #f8f9fa;
            /* Light background for visibility */
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require "connection.php"; ?>

            <div class="header-container d-flex align-items-center justify-content-between py-4 mb-4">
                <!-- Navbar toggler button -->
                <button class="navbar-toggler col-lg-1 col-2 d-flex justify-content-start" onclick="toggleNavbar()">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="col-lg-10 col-8 text-center">
                    <h1 class="fw-bold text-uppercase m-0">Add Products</h1>
                    <div class="breadcrumb-container mt-2">
                        <p class="m-0">
                            <a href="home.php" class="text-decoration-none">Home</a>
                            <span class="mx-2">-</span>
                            Add Products
                        </p>
                    </div>
                </div>

                <div class="col-lg-1 col-2"></div>
                <!--  -->


                <div class="col-12 ">
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

                <!--  -->

            </div>


            <div class="col-12 d-flex justify-content-center">
                <div class="col-12 col-lg-10 p-4 form-section">
                    <div class="row">
                        <!-- Product Category -->
                        <div class="col-12 col-lg-6 mb-4">
                            <label for="category" class="form-label">Select Product Category</label>
                            <select class="form-select" id="category">
                                <option value="0">Select Category</option>
                                <?php
                                $category_rs = Database::search("SELECT * FROM category");
                                while ($category_data = $category_rs->fetch_assoc()) {
                                    echo "<option value='{$category_data["id"]}'>{$category_data["name"]}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Product Size -->
                        <div class="col-12 col-lg-6 mb-4">
                            <label for="size" class="form-label">Select Size</label>
                            <select class="form-select" id="size">
                                <option value="0">Select Size</option>
                                <?php
                                $size_rs = Database::search("SELECT * FROM size");
                                while ($size_data = $size_rs->fetch_assoc()) {
                                    echo "<option value='{$size_data["id"]}'>{$size_data["name"]}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Product Title -->
                        <div class="col-12 mb-4">
                            <label for="title" class="form-label">Add a Title to Your Product</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter product title">
                        </div>

                        <!-- Product Color and Quantity -->
                        <div class="col-12 col-lg-6 mb-4">
                            <label for="clr" class="form-label">Select Product Colour</label>
                            <select class="form-select" id="clr">
                                <option value="0">Select Colour</option>
                                <?php
                                $clr_rs = Database::search("SELECT * FROM colour");
                                while ($clr_data = $clr_rs->fetch_assoc()) {
                                    echo "<option value='{$clr_data["id"]}'>{$clr_data["name"]}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6 mb-4">
                            <label for="qty" class="form-label">Product Quantity</label>
                            <input type="number" class="form-control" id="qty" min="0" value="0">
                        </div>

                        <!-- Product Price -->

                        <div class="col-12 col-lg-4 mb-4">
                            <label for="cost" class="form-label">Cost Per Item (Rs.)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="cost" placeholder="Enter price">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>


                        <div class="col-12 col-lg-4 mb-4">
                            <label for="cost" class="form-label">Delivery Free Within Colombo (Rs.)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="dwc" placeholder="Enter price">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 mb-4">
                            <label for="cost" class="form-label">Delivery Free Out Of The Colombo (Rs.)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="doc" placeholder="Enter price">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>

                        <!-- Product Images -->
                        <!-- Product Images -->
                        <div class="col-12 mb-4">
                            <label class="form-label">Add Product Images</label>
                            <input
                                type="file"
                                id="imageuploader"
                                class="form-control"
                                multiple
                                accept="image/*"
                                onchange="changeProductImage();"
                                style="cursor: pointer;" />
                            <small class="text-muted">Drag & drop or click to upload images (Max 3 images).</small>
                        </div>

                        <div class="col-12 offset-lg-3 col-lg-6">
                            <div class="row">
                                <div class="col-4 borderp rounded">
                                    <img src="resources/addImg.svg" class="img-fluid" style="width: 300px; height: 300px;" id="i0" />
                                </div>
                                <div class="col-4 borderp rounded">
                                    <img src="resources/addImg.svg" class="img-fluid" style="width: 300px; height: 300px;" id="i1" />
                                </div>
                                <div class="col-4 borderp rounded">
                                    <img src="resources/addImg.svg" class="img-fluid" style="width: 300px; height: 300px;" id="i2" />
                                </div>
                            </div>
                        </div>



                        <div class="col-12 mb-4">
                            <label for="desc" class="form-label">Product Description</label>
                            <textarea class="form-control" id="desc" rows="4" placeholder="Describe your product"></textarea>
                        </div>


                        <!-- Submit Button -->
                        <div class="col-12 text-center">
                            <button class="btn btn-success" onclick="addProduct();">Save Product</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php require "footer.php"; ?>
        </div>
    </div>

    <script src="script.js"></script>

    <script>
        function toggleNavbar() {
            const navbar = document.getElementById('mainNavbar');
            navbar.classList.toggle('navbar-open');
            navbar.classList.toggle('block');
        }
    </script>

</body>

</html>