<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | SHE</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/she-logos_black.png" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php require "header.php"; ?>

            <!-- Page Header Start -->
            <div class="container-fluid mb-5" style="background-color: #FFB3C6;">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                    <h1 class="font-weight-semi-bold text-uppercase mb-3">Contact Us</h1>
                    <div class="d-inline-flex">
                        <p class="m-0"><a href="home.php">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Contact</p>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->

            <?php

            require "connection.php";

            if (isset($_SESSION["u"])) {

                $email  = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");

                $data = $details_rs->fetch_assoc();
            ?>



                <!-- Contact Start -->
                <div class="container-fluid pt-2">
                    <div class="text-center mb-5">
                        <h2>Contact For Any Queries</h2>
                    </div>
                    <div class="row px-xl-5">
                        <div class="col-lg-7 mb-5">
                            <div class="contact-form">
                                <div id="success"></div>
                                <form >
                                    <div class="control-group">
                                        <input type="text" class="form-control" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" value="<?php echo $data["fname"]; ?>" id="name" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <input type="email" class="form-control" readonly value="<?php echo $data["email"]; ?>" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <textarea class="form-control" rows="6" id="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary py-2 px-4" onclick="sendMessage();">Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-5">
                            <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                            <p>Justo sed diam ut sed amet duo amet lorem amet stet sea ipsum, sed duo amet et. Est elitr dolor elitr erat sit sit. Dolor diam et erat clita ipsum justo sed.</p>
                            <div class="d-flex flex-column mb-3">
                                <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                                <p class="mb-2"><i class="bi bi-geo-alt-fill text-primary"></i> Flower Street,Matara,Sri Lanka</p>
                                <p class="mb-2"><i class="bi bi-envelope-fill text-primary mr-3"></i> info@she.com</p>
                                <p class="mb-2"><i class="bi bi-telephone-fill text-primary mr-3"></i> +94 345 67890</p>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="font-weight-semi-bold mb-3">Store 2</h5>
                                <p class="mb-2"><i class="bi bi-geo-alt-fill text-primary"></i> Flower Street,Matara,Sri Lanka</p>
                                <p class="mb-2"><i class="bi bi-envelope-fill text-primary mr-3"></i> info@she2.com</p>
                                <p class="mb-2"><i class="bi bi-telephone-fill text-primary mr-3"></i> +94 345 67890</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contact End -->

            <?php

            } else {
                header("Location:http://localhost/SHE/home.php");
            }

            ?>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>