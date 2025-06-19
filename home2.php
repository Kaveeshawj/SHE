<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Product Page</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resources/she-logos_black.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid">
        <!-- Top Bar -->
        <div class="row bg-white py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center" style="font-size: 20px;">
                    <a class="text-dark fs-5 text-decoration-none hp" href="">FAQs</a>
                    <span class="text-muted px-2 ">|</span>
                    <a class="hp text-dark fs-5 text-decoration-none" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="hp text-dark fs-5 text-decoration-none" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right ">
                <div class="d-inline-flex align-items-center position-absolute top-0 end-0 pe-2">
                    <a class="text-dark px-2" href="">
                        <i class="bi bi-facebook fs-4"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="bi bi-twitter fs-4 p-1"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="bi bi-linkedin fs-4"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="bi bi-instagram fs-4"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="bi bi-youtube fs-3 p-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div class="d-flex">
            <div class="sidebar sbar">
                <img src="resources/she-logos_black.png" alt="Logo" class="logo">
                <input type="text" placeholder="Search for products" class="search-bar">
                <nav class="nav-menu">
                    <ul>
                        <li>All products</li>
                        <li>Discounts</li>
                        <li>Gift sets</li>
                        <li>Perfume</li>
                        <li>Hair care</li>
                        <li>Make up</li>
                        <ul>
                            <li>Make-up brushes</li>
                            <li>The Balm Cosmetics</li>
                            <li>Products for brow</li>
                        </ul>
                        <li>About us</li>
                        <li>Shipping & returns</li>
                        <li>Terms & conditions</li>
                    </ul>
                </nav>
            </div>
            <div class="main-content">
                <div class="banner">
                    <!-- Carousel -->
                    <div id="header-carousel" class="carousel slide ca" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="height: 500px;">
                                <img class="img-fluid" src="resources/carousel-1.jpg" alt="Image">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 400px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                        <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" style="height: 500px;">
                                <img class="img-fluid" src="resources/carousel-2.jpg" alt="Image">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 400px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                        <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-prev-icon mb-n2"></span>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-next-icon mb-n2"></span>
                            </div>
                        </a>
                    </div>

                    <!-- Banner Text -->
                    <div class="banner-text">
                        <h1>Glam Up Your Look</h1>
                        <p>Take a beauty break & transform your look with a makeup service from Shapes!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>
