<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

</head>

<body>

    <?php session_start(); ?>

    <div class="container-fluid">
        <div class="row bg-white py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center" style="font-size: 20px;">
                    <a class="text-dark fs-5" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark fs-5" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark fs-5" href="">Support</a>
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
        <div class="row align-items-center pb-2" style="background-color: pink;">
            <div class="col-lg-3 d-none d-lg-block mt-0">
                <a href="" class="text-decoration-none">
                    <div class="logo p-0" style="height: 100px;"></div>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="bi bi-search text-dark fw-bold"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 d-flex flex-row-reverse">
                <a href="watchlist.php" class="btn border">
                    <i class="bi bi-suit-heart-fill fs-3"></i>
                </a>
                <a href="cart.php" class="btn border">
                    <i class="bi bi-cart-fill fs-3"></i>
                </a>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>


</body>

</html>