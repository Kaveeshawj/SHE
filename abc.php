<button class="navbar-toggler" onclick="toggleNavbar()">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <div class="col-12">
        <div class="row">
            <div class="col-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    <div class="collapse navbar-collapse d-none" id="mainNavbar">
                        

                    <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block mt-2">

                <div class="dropdown">
                    <a class="btn shadow-none d-flex text-dark align-items-center justify-content-between  text-white w-100" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="height: 70px; margin-top: -1px; padding: 0 30px; background-color: #EFD5D0;">
                        <h4 class="m-0 text-center text-dark">Categories</h4>
                        <i class="bi bi-caret-down-fill text-dark"></i>
                    </a>

                    <ul class="dropdown-menu collapse  navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                        <div class="navbar-nav w-1000 ">

                            <li><a class="dropdown-item" href="dresses.php">Dresses</a></li>
                            <li><a class="dropdown-item" href="slippers.php">Slippers</a></li>
                            <li><a class="dropdown-item" href="jeweleries.php">Jeweleries</a></li>
                            <li><a class="dropdown-item" href="scrunchie.php">Scrunchies</a></li>
                            <li><a class="dropdown-item" href="#">Resin items</a></li>
                            <li><a class="dropdown-item" href="#">Dream catchers</a></li>
                            <li><a class="dropdown-item" href="cakes.php">Cakes</a></li>
                            <li><a class="dropdown-item" href="#">Beauty products</a></li>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 mt-2">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between offset-0" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="home.php" class="nav-item nav-link active fs-5">Home</a>
                            <a href="shop.php" class="nav-item nav-link fs-5">Shop</a>
                            <div class="nav-item dropdown ms-2">
                                <a href="#" class="nav-link dropdown-toggle  fs-5" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="cart.php" class="dropdown-item fs-5">Shopping Cart</a>
                                    <a href="checkout.php" class="dropdown-item  fs-5">Checkout</a>
                                </div>
                            </div>
                            <div class="nav-item dropdown ms-2">
                                <a href="#" class="nav-link dropdown-toggle  fs-5" data-toggle="dropdown">Profiles</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="myProfile.php" class="dropdown-item fs-5">My Profile</a>
                                    <a href="myProducts.php" class="dropdown-item  fs-5">My Products</a>
                                </div>
                            </div>
                            <a href="detail.php" class="nav-item nav-link  fs-5">Contact</a>
                        </div>

                        <?php

                        if (isset($_SESSION["u"])) {
                            $data = $_SESSION["u"];

                        ?>
                            <div class="navbar-nav ml-auto py-0">
                                <span class="text-lg-start"><b>Welcome </b> <?php echo $data["fname"]; ?>&nbsp; </span> |
                                <span class="text-lg-start fw-bold signout" onclick="signout();">&nbsp; Sign Out</span>
                            </div>

                        <?php

                        } else {

                        ?>
                            <div class="navbar-nav ml-auto py-0">
                                <a href="index.php" class="nav-item nav-link  fs-5">Login</a>
                                <a href="index.php" class="nav-item nav-link  fs-5">Register</a>
                            </div>
                        <?php

                        }

                        ?>

                    </div>
                </nav>

            </div>
        </div>


                    </div>
                </nav>
            </div>
        </div>
    </div>