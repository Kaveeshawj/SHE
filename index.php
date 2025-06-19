<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>She</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resources/she-logos_black.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body class="mainbody">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12 left-section">
                <div class="branding text-center">
                    <img src="resources/she-logos_black.png" alt="She Cosmetics Logo" class="logo img-fluid">
                    <h2>100% Sri Lankan</h2>
                    <p>Value local products...</p>
                </div>
                <div class="product-image text-center">
                    <img src="resources/cosmetics.jpg" alt="Cosmetics Products" class="img-fluid">
                </div>
                <div class="social-login text-center mt-3">
                    <p>&copy; 2022 she.lk || All Rights Reserved</p>
                </div>
            </div>
            <div class="col-md-6 col-12 right-section d-flex flex-column justify-content-center">
                <h2>Join the world of <span>Beauty</span></h2>

                <!-- signup -->
                <div id="signUpBox">
                    <p class="title2">Create New Account</p>
                    

                    <div class="col-12 d-none pb-2" id="msgdiv">
                            <div class="alert alert-dark" role="alert" style="background-color: #F64C4C; color: black;" id="alertdiv">
                                <i class="bi bi-exclamation-circle-fill" id="msg"></i>
                            </div>
                        </div>

                    <div class="row g-2">
                        <div class="col-md-6 col-12">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" id="f">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="l">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="e">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="p">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="m">
                        </div>
                        <div class="col-md-6 col-12 pb-4">
                            <label class="form-label">Gender</label>
                            <select class="form-control" id="g">
                                <?php
                                $rs = Database::search("SELECT * FROM `gender`");
                                $n = $rs->num_rows;
                                for ($x = 0; $x < $n; $x++) {
                                    $d = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>



                        <div class="col-12 col-lg-6 d-grid">
                            <button class="neon-pink-btn" onclick="signup();">Sign Up</button>
                        </div>
                        <div class="col-12 col-lg-6 d-grid">
                            <button class="btn btn-dark" onclick="changeView();">Already have an account? Sign In</button>
                        </div>
                    </div>
                </div>
                <!-- signup -->

                <!-- signin -->

                <div class="col-12 d-none" id="signInBox">
                    <div class="row g-2">
                        <p class="title2 pt-5 pb-5">Sign In</p>

                        <div class="col-12 d-none pb-2" id="msgdiv2">
                            <div class="alert alert-dark" role="alert" style="background-color: #F64C4C; color: black;" id="alertdiv2">
                                <i class="bi bi-exclamation-circle-fill" id="msg2"></i>
                            </div>
                        </div>

                        <?php
                        $email = "";
                        $password = "";

                        if (isset($_COOKIE["email"])) {
                            $email = $_COOKIE["email"];
                        }

                        if (isset($_COOKIE["password"])) {
                            $password = $_COOKIE["password"];
                        }
                        ?>

                        <div class="col-12 pb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email2" value="<?php echo $email; ?>" />
                        </div>

                        <div class="col-12 pb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="password2" value="<?php echo $password; ?>" />
                        </div>

                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberme">
                                <label class="form-check-label">Remember Me</label>
                            </div>
                        </div>

                        <div class="col-6 text-end">
                            <a href="#" class="link-primary" onclick="forgotpassword();">Forgot Password</a>
                        </div>

                        <div class="col-12 col-lg-6 d-grid pt-3">
                            <button class="btn btn-dark" onclick="signin();">Sign In</button>
                        </div>

                        <div class="col-12 col-lg-6 pt-3 d-grid">
                            <button class="neon-pink-btn" onclick="changeView();">New to she? Join Now</button>
                        </div>
                    </div>
                </div>

                <!-- signin -->

                <!-- modal -->

                <div class="modal" tabindex="-1" id="forgotpasswordmodel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reset Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">

                                        <div class="col-6">
                                            <label class="form-label">New Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="npi">
                                                <button class="btn btn-outline-secondary" type="button" onclick="showPassword();" id="npb"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Re-type Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="rnp">
                                                <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Verification code</label>
                                            <input type="text" class="form-control" id="vc">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->

            </div>
        </div>
    </div>



    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>