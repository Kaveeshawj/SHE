<?php
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users | admin | SHE</title>
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
                                    <h1>Manage All Users</h1>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="offset-lg-3 offset-0 col-12 col-lg-6 mb-3">
                                            <div class="row">
                                                <div class="col-9">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-3 d-grid">
                                                    <button class="btn btn-primary">Search User</button>
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
                                                        <th scope="col" class="fs-4">Profile Image</th>
                                                        <th scope="col" class="fs-4">Username</th>
                                                        <th scope="col" class="fs-4">Email</th>
                                                        <th scope="col" class="fs-4">Mobile</th>
                                                        <th scope="col" class="fs-4">Registered Date</th>
                                                        <th scope="col" class="fs-4">EDIT</th>
                                                    </tr>
                                                </thead>

                                                <?php

                                                $query = "SELECT * FROM `user`";
                                                $pageno;

                                                if (isset($_GET["page"])) {
                                                    $pageno = $_GET["page"];
                                                } else {
                                                    $pageno = 1;
                                                }

                                                $user_rs = Database::search($query);
                                                $user_num = $user_rs->num_rows;

                                                $results_per_page = 10;
                                                $number_of_pages = ceil($user_num / $results_per_page);

                                                $page_results = ($pageno - 1) * $results_per_page;
                                                $selected_rs =  Database::search($query);

                                                $selected_num = $selected_rs->num_rows;

                                                for ($x = 0; $x < $selected_num; $x++) {
                                                    $selected_data = $selected_rs->fetch_assoc();

                                                    $profile_image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $selected_data["email"] . "' ");
                                                    $profile_image_data = $profile_image_rs->fetch_assoc();
                                                ?>

                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"><?php echo $x + 1; ?></th>
                                                            <td><img onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');" src="<?php echo $profile_image_data["path"]; ?>" style="height: 50px;"></td>
                                                            <td><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></td>
                                                            <td><?php echo $selected_data["email"]; ?></td>
                                                            <td><?php echo $selected_data["mobile"]; ?></td>
                                                            <td><?php echo $selected_data["joined_date"]; ?></td>
                                                            <td>
                                                                <?php

                                                                if ($selected_data["status"] == 1) {
                                                                ?>
                                                                    <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="userBlock('<?php echo $selected_data['email']; ?>');">Block</button>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="userBlock('<?php echo $selected_data['email']; ?>');">Unblock</button>
                                                                <?php

                                                                }

                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    <!-- modal -->
                                                    <div class="modal" tabindex="-1" id="userMsgModal<?php echo $selected_data['email']; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title fw-bold text-center text-success"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <?php
                                                                $msg_rs = Database::search("SELECT DISTINCT `subject`,`message`,`date_time` FROM `chat` WHERE `from`='" . $selected_data["email"] . "'");
                                                                ?>

                                                                <?php
                                                                $msg_num = $msg_rs->num_rows;

                                                                for ($y = 0; $y < $msg_num; $y++) {
                                                                    $msg_data = $msg_rs->fetch_assoc();

                                                                ?>

                                                                    <div class="modal-body">
                                                                        <div class="offset-4 col-4">
                                                                            <h4 class="text-decoration-underline"><?php echo $msg_data["subject"] ?></h4><br />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span class="fs-5 fw-bold">Message :</span>&nbsp;
                                                                            <span class="fs-5"><?php echo $msg_data["message"]; ?></span><br /><br />
                                                                            <span class="fs-5 text-end"><?php echo $msg_data["date_time"]; ?></span><br />

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                            </div>
                                                        <?php
                                                                }
                                                        ?>
                                                        </div>
                                                    </div>


                                                    <!-- modal -->

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