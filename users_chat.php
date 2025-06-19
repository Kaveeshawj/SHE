<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat | SHE</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <link rel="icon" href="resources/she-logos_black.png" />
</head>

<body style="background-color: white;">

    <?php
    require "connection.php";
    session_start();

    $mail = $_SESSION["u"]["email"];
    ?>
    <!-- 
    <div class="col-12 mt-3 mb-4">
        <div class="row">

            <div class="col-12">
                <div class="row">

                    <div class="col-4 bg-body rounded mt-4 mb-4 " style="background-color: black;">
                        <div class="row g-2">
                            <div class="wrapper">

                                <section class="users">
                                    <div class="content">
                                        <div class="col-12">
                                            <div class="row">
                                                <img src="resources/user.svg" style=" height: 50px;width: 50px;">
                                                <div class="details">
                                                    <span>ytuytu</span>
                                                    <p>ryjtyj</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                    <div class="col-8 border-end" style="background-color: #FFFFE0;">
                        <span>wojgowefjth</span>
                    </div>
                </div>

            </div>
        </div>

    </div> -->

    <div class="row align-items-center pb-2" style="background-color: pink;">
        <div class="col-lg-3 d-none d-lg-block mt-0">
            <a href="" class="text-decoration-none">
                <div class="logo p-0" style="height: 100px;"></div>
            </a>
        </div>
        <div class="col-lg-9 col-6">

            <div class="d-flex justify-content-center">
                <div class="row">
                    <h1 class="fw-bold">Chat With Your Loving Ones</h1>
                    <h3 class="offset-1">Send Love Through SHE...</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="container py-5" style="background-color: #FFFFE0;">

        <div class="row">
            <div class="col-md-12">

                <div class="card" id="chat3" style="border-radius: 15px;">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0 chat">

                                <div class="p-3">

                                    <?php

                                    $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $mail . "'");

                                    $image_data = $image_rs->fetch_assoc();

                                    ?>

                                    <div class="mb-3">
                                        <a href="#" class="d-flex justify-content-between" style="text-decoration: none;">

                                            <div class="d-flex flex-row">
                                                <div>
                                                    <img src="<?php echo $image_data["path"]; ?>" alt="Avatar" class="d-flex align-self-center me-3 " style="  border-radius: 50%;" width="60">
                                                    <span class="badge bg-success badge-dot"></span>
                                                </div>
                                                <div class="pt-1 mt-2">
                                                    <h3 class="fw-bold mb-0" style="color: #3F305E;"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"] ?></h3>
                                                </div>
                                            </div>

                                        </a>
                                    </div>
                                    <div class="input-group rounded mb-3">
                                        <input type="search" id="searchName" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                        <span class="input-group-text border-0" onclick="searchName();" id="search-addon">
                                            <div>
                                            <i class="fas fa-search" ></i>
                                            </div>
                                        </span>
                                    </div>

                                    <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px"  id="userName">
                                        <ul class="list-unstyled mb-0">

                                            <?php

                                            $msg_rs = Database::search(" SELECT *
    FROM `msg`
    INNER JOIN (
        SELECT `from`, MAX(`date`) AS `latest_date`
        FROM `msg`
        WHERE `to` = 'kavee@123gmail.com'
        GROUP BY `from`
    ) AS latest_msg
    ON `msg`.`from` = latest_msg.`from` AND `msg`.`date` = latest_msg.`latest_date`
    ORDER BY `msg`.`date` DESC ");

                                            $msg_num = $msg_rs->num_rows;

                                            if ($msg_num != null) {

                                                for ($x = 0; $x < $msg_num; $x++) {
                                                    $msg_data = $msg_rs->fetch_assoc();

                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["from"] . "' ");
                                                    $user_data = $user_rs->fetch_assoc();

                                                    $img_rs1 = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $msg_data["from"] . "' ");
                                                    $img_data1 = $img_rs1->fetch_assoc();

                                                    if ($msg_data["status"] == 0) {
                                            ?>
                                                        <li class="p-2 border-bottom">
                                                            <div onclick="viewMessages('<?php echo $msg_data['from']; ?>');" class="d-flex justify-content-between cont" style="text-decoration: none;">
                                                                <div class="d-flex flex-row">
                                                                    <div>

                                                                        <?php

                                                                        if (isset($img_data1["path"])) {
                                                                        ?>

                                                                            <img src="<?php echo $img_data1["path"]; ?>" alt="avatar" class="d-flex align-self-center me-3" style="  border-radius: 50%;" width="60">

                                                                        <?php

                                                                        } else {
                                                                        ?>

                                                                            <img src="resources/user.svg" alt="avatar" class="d-flex align-self-center me-3" style="  border-radius: 50%;" width="60">

                                                                        <?php

                                                                        }

                                                                        ?>

                                                                        <span class="badge bg-success badge-dot"></span>
                                                                    </div>

                                                                    <div class="pt-1">
                                                                        <p class="fw-bold mb-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></p>
                                                                        <p class="small fw-bold"><?php echo $msg_data["msg"]; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="pt-1">
                                                                    <p class="small text-muted mb-1"><?php echo $msg_data["date"]; ?></p>
                                                                    <!-- <span class="badge bg-danger rounded-pill float-end">3</span> -->
                                                                </div>
                                                            </div>
                                                        </li>

                                                    <?php
                                                    } else {
                                                    ?>

                                                        <li class="p-2 border-bottom">
                                                            <div onclick="viewMessages('<?php echo $msg_data['from']; ?>');" class="d-flex justify-content-between cont" style="text-decoration: none;">
                                                                <div class="d-flex flex-row">
                                                                    <div>

                                                                        <?php

                                                                        if (isset($img_data1["path"])) {
                                                                        ?>

                                                                            <img src="<?php echo $img_data1["path"]; ?>" alt="avatar" class="d-flex align-self-center me-3" style="  border-radius: 50%;" width="60">

                                                                        <?php

                                                                        } else {
                                                                        ?>

                                                                            <img src="resources/user.svg" alt="avatar" class="d-flex align-self-center me-3" style="  border-radius: 50%;" width="60">

                                                                        <?php

                                                                        }

                                                                        ?>

                                                                        <span class="badge bg-success badge-dot"></span>
                                                                    </div>

                                                                    <div class="pt-1">
                                                                        <p class="fw-bold mb-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></p>
                                                                        <p class="small text-muted"><?php echo $msg_data["msg"]; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="pt-1">
                                                                    <p class="small text-muted mb-1"><?php echo $msg_data["date"]; ?></p>
                                                                    <!-- <span class="badge bg-danger rounded-pill float-end">3</span> -->
                                                                </div>
                                                            </div>
                                                        </li>

                                                    <?php
                                                    }

                                                    ?>

                                                <?php

                                                }
                                            } else {
                                                $user = Database::search("SELECT * FROM `user` WHERE `email` not in ('" . $_SESSION["u"]["email"] . "')");

                                                $user_num = $user->num_rows;

                                                for ($y = 0; $y < $user_num; $y++) {
                                                    $user_d = $user->fetch_assoc();

                                                    $img_rs2 = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $user_d["email"] . "' ");
                                                    $img_data2 = $img_rs2->fetch_assoc();

                                                ?>

                                                    <li class="p-2 border-bottom">
                                                        <div class="invisible" id="u_email"><?php echo $user_d["email"]; ?></div>
                                                        <div onclick="viewMessages1('<?php echo $user_d['email'] ?>');" class="cont d-flex justify-content-between " style="text-decoration: none;">
                                                            <div class="d-flex flex-row">
                                                                <div>

                                                                    <?php

                                                                    if (isset($img_data2["path"])) {
                                                                    ?>

                                                                        <img src="<?php echo $img_data2["path"]; ?>" alt="avatar" class="d-flex align-self-center me-3" style="  border-radius: 50%;" width="60">

                                                                    <?php

                                                                    } else {
                                                                    ?>

                                                                        <img src="resources/user.svg" alt="avatar" class="d-flex align-self-center me-3" style="  border-radius: 50%;" width="60">

                                                                    <?php

                                                                    }

                                                                    ?>

                                                                    <span class="badge bg-success badge-dot"></span>
                                                                </div>

                                                                <div class="col-12 pt-3">
                                                                    <h5 class="fw-bold mb-0" style="color: #2F3E46;"><?php echo $user_d["fname"] . " " . $user_d["lname"]; ?></h5>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </li>



                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-7 col-xl-8 " class="messages" id="conversation">

                                <div class="col-12" id="empty" style="background-color: #FAE6E7;">
                                    <div class="row">
                                        <div class="col-12 emptyView"></div>
                                        <div class="col-12 text-center mb-2">
                                            <label class="col-12 form-label fs-1 fw-bold">Spread Love and Make Friends.</label>
                                        </div>
                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-5">
                                            <a href="home.php" class="btn  fs-3 fw-bold" style="background-color: #D14F7B;">Search a friend</a>
                                        </div>
                                    </div>
                                </div>

                                <div id="chat_box" class="pt-3 pe-3 chat1 d-none" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px ;overflow-y: scroll;">
                                    <div id="boxrece" class="d-flex flex-row justify-content-end d-none">
                                        <div>
                                            <p id="para" class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary"></p>
                                            <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
                                        </div>
                                        <img src="resources/user.svg" alt="avatar 1" style="width: 45px; height: 100%;">
                                    </div>
                                </div>

                                <div id="type" class="col-12 row text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2 d-none">
                                    <img class="col-4" src="<?php echo $image_data["path"]; ?>" alt="avatar 3" style="width: 40px; height: 100%;border-radius: 50%;">
                                    <input type="text" class="form-control form-control-lg" id="msg_txt" placeholder="Type message">
                                    <a class="ms-1 text-muted" href="#!"><i class="fas fa-paperclip"></i></a>
                                    <a class="ms-3 text-muted" href="#!"><i class="fas fa-smile"></i></a>
                                    <button class="ms-3 btn" id="send_btn" onclick="send_msg();"><i class="fas fa-paper-plane text-danger"></i></button>
                                </div>

                                <div id="typemsg" class="col-12 row text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2 d-none">
                                    <img class="col-4" src="<?php echo $image_data["path"]; ?>" alt="avatar 3" style="width: 40px; height: 100%;border-radius: 50%;">
                                    <input type="text" class="form-control form-control-lg" id="msg_txt1" placeholder="Type message">
                                    <a class="ms-1 text-muted" href="#!"><i class="fas fa-paperclip"></i></a>
                                    <a class="ms-3 text-muted" href="#!"><i class="fas fa-smile"></i></a>
                                    <button class="ms-3 btn" id="send_btn" onclick="send_msguser();"><i class="fas fa-paper-plane text-danger"></i></button>
                                </div>

                            </div>
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