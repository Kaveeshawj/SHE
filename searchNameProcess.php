<?php


require "connection.php";
session_start();

$txt = $_POST["t"];
$mail = $_SESSION["u"]["email"];


$query = "SELECT * FROM `user`";

if (!empty($txt)) {
    $query .= " WHERE `fname` LIKE '%" . $txt . "%' OR `lname` LIKE '%" . $txt . "%' ";
}

$selected_rs =  Database::search($query);

$selected_num = $selected_rs->num_rows;

for ($x = 0; $x < $selected_num; $x++) { 
    $selected_data = $selected_rs->fetch_assoc();

    $msg_rs = Database::search("SELECT * FROM `msg` WHERE `to` = '" . $mail . "' GROUP BY `from` ORDER BY `date` DESC ");

?>

    <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px" id="userName">
        <ul class="list-unstyled mb-0">

            <?php
            $msg_num = $msg_rs->num_rows;

            if ($msg_num != null) {

                for ($x = 0; $x < $msg_num; $x++) {
                    $msg_data = $msg_rs->fetch_assoc();

                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["from"] . "' ");
                    $user_data = $user_rs->fetch_assoc();

                    $img_rs1 = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $msg_data["from"] . "' ");
                    $img_data1 = $img_rs1->fetch_assoc();

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


<?php
}


?>
</ul>
</div>