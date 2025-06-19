<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | SHE</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <!-- Favicon -->
    <link rel="icon" href="resources/she-logos_black.png" />

    <!-- Inline CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        .container-fluid {
            padding: 0;
        }

        /* Navbar Styles */
        .navbar-toggler {
            border: none;
            background-color: black;
            color: white;
            font-size: 1.5rem;
            padding: 5px 10px;
            cursor: pointer;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1050;
        }

        .navbar-toggler span {
            display: block;
            width: 25px;
            height: 3px;
            background: black;
            margin: 4px auto;
        }

        .navbar-collapse {
            transition: transform 0.3s ease;
            transform: translateX(-100%);
            background-color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }

        .navbar-open {
            transform: translateX(0);
        }

        .navbar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .navbar-nav .nav-item {
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
        }

        .navbar-nav .nav-link {
            text-decoration: none;
            color: #000;
            font-size: 18px;
        }

        .navbar-nav .nav-link:hover {
            background-color: #f4f4f4;
        }

        .header-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
        }

        .header-links .left-links,
        .header-links .right-links {
            display: flex;
            gap: 15px;
        }

        .header-links .left-links a,
        .header-links .right-links a {
            text-decoration: none;
            color: #000;
            font-size: 16px;
        }

        .header-links .right-links a i {
            font-size: 20px;
        }

        .header-links .left-links a:hover,
        .header-links .right-links a:hover {
            color: #007bff;
        }
    </style>
</head>

<body>
    <?php session_start(); ?>

    <!-- Navbar Toggle Button -->
    <button class="navbar-toggler" onclick="toggleNavbar()">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Header Links -->
    <div class="header-links">
        <div class="left-links">
            <a href="#">FAQs</a>
            <a href="#">Help</a>
            <a href="#">Support</a>
        </div>
        <div class="right-links">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="dresses.php">Dresses</a></li>
            <li class="nav-item"><a class="nav-link" href="slippers.php">Slippers</a></li>
            <li class="nav-item"><a class="nav-link" href="jeweleries.php">Jeweleries</a></li>
            <li class="nav-item"><a class="nav-link" href="scrunchie.php">Scrunchies</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Resin items</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Dream catchers</a></li>
            <li class="nav-item"><a class="nav-link" href="cakes.php">Cakes</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Beauty products</a></li>
        </ul>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>

    <script>
        function toggleNavbar() {
            const navbar = document.getElementById('mainNavbar');
            navbar.classList.toggle('navbar-open');
        }
    </script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
