<?php

session_start();
require "connection.php";

$email = $_GET["e"];

$rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
$n = $rs->num_rows;

if ($n == 1) {

    $d = $rs->fetch_assoc();
    $_SESSION["msgU"] = $d;
} else {
    echo ("Invalid User");
}

$receiver_mail = $_SESSION["u"]["email"];
$sender_mail = $_SESSION["msgU"]["email"];

// echo($_SESSION["msgU"]["email"]);

$msg_rs = Database::search("SELECT * FROM `msg` WHERE `from`='" . $sender_mail . "' OR `to`='" . $sender_mail . "' ");
$msg_num = $msg_rs->num_rows;

for ($x = 0; $x < $msg_num; $x++) {
    $msg_data = $msg_rs->fetch_assoc();


    if ($msg_data["from"] == $sender_mail && $msg_data["to"] == $receiver_mail) {

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["from"] . "' ");
        $user_data = $user_rs->fetch_assoc();

        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $msg_data["from"] . "' ");
        $img_data = $img_rs->fetch_assoc();

?>

        <!-- sender -->
        <div class="col-md-6 col-lg-7 col-xl-8 ">

            <div class="pt-3 pe-3" style="position: relative;">

                <div class="d-flex flex-row justify-content-start">

                    <?php
                    if (isset($img_data["path"])) {

                    ?>
                        <img src="<?php echo $img_data["path"]; ?>" style="width: 45px; height: 100%;">
                    <?php

                    } else {

                    ?>
                        <img src="resources/403024_avatar_boy_male_user_young_icon.svg" style="width: 45px; height: 100%;">
                    <?php

                    }
                    ?>

                    <div>
                        <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;"><?php echo $msg_data["msg"]; ?></p>
                        <p class="small ms-3 mb-3 rounded-3 text-muted float-end"><?php echo $msg_data["date"]; ?></p>
                        <p class="invisible" id="rmail"><?php echo $msg_data["from"]; ?></p>
                    </div>
                </div>

            </div>

        </div>
        <!-- sender -->

    <?php

    } else  if ($msg_data["to"] == $sender_mail && $msg_data["from"] == $receiver_mail) {
        Database::iud("UPDATE `msg` SET `status`='1'");

    ?>

        <!-- receiver -->
        <div class="pt-3 pe-3" style="position: relative;">

            <?php

            $image_rs2 = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $receiver_mail . "'");

            $image_data2 = $image_rs2->fetch_assoc();

            ?>


            <div class="d-flex flex-row justify-content-end">
                <div>
                    <p id="para" class="small p-2 me-3 mb-1 rounded-3 " style="background-color: pink;color: black;"><?php echo $msg_data["msg"]; ?></p>
                    <p class="small me-3 mb-3 rounded-3 text-muted"><?php echo $msg_data["date"]; ?></p>
                </div>

                <?php
                if (isset($image_data2["path"])) {

                ?>
                    <img src="<?php echo $image_data2["path"]; ?>" alt="avatar 1" style="width: 45px; height: 100%;">
                <?php

                } else {

                ?>
                    <img src="resources/403024_avatar_boy_male_user_young_icon.svg" alt="avatar 1" style="width: 45px; height: 100%;">
                <?php

                }
                ?>

                <!-- <img src="resources/user.svg" alt="avatar 1" style="width: 45px; height: 100%;"> -->
            </div>

        </div>


        <!-- receiver -->

<?php

    }
}


?>