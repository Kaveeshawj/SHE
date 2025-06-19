<?php
session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin | sms</title>
    
    <link rel="icon" href="resources/she-logos_black.png" />

</head>

<body>


    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <img src="resources/she-logos_black.png" style="height: 60px;">
            </div>
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-align-left"></i>
            </a>
            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="nav user-menu">

                <li class="nav-item dropdown has-arrow">

                    <?php
                    $img = Database::search("SELECT * FROM `admin` INNER JOIN `profile_image` ON profile_image.user_email=admin.email 
                WHERE `email`='" . $_SESSION["au"]["email"] . "'");

                    $image_data = $img->fetch_assoc();
                    ?>


                    <?php

                    if (empty($image_data["path"])) {
                    ?>
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img"><img class="rounded-circle" src="resources/boy.png" width="31" alt="Ryan Taylor"></span>
                        </a>
                    <?php
                    } else {
                    ?>
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img"><img class="rounded-circle" src="<?php echo $image_data["path"]; ?>" width="31" alt="Ryan Taylor"></span>
                        </a>
                    <?php
                    }

                    ?>

                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div>
                                <?php

                                if (empty($image_data["path"])) {
                                ?>
                                    <img src="resources/boy.png" style="height: 50px;" alt="">
                                <?php
                                } else {
                                ?>

                                    <img src="<?php echo $image_data["path"]; ?>" style="height: 50px;" alt="">
                                <?php
                                }

                                ?>
                            </div>
                            <div class="user-text">
                                <h6><?php echo $_SESSION["au"]["fname"] ; ?></h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="adminProfile.php">My Profile</a>
                        <a class="dropdown-item" href="#">Inbox</a>
                        <button class="dropdown-item" onclick="signouta();">Logout</button>
                    </div>
                </li>
            </ul>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>
                        <li class=" active">
                            <a href="adminPannel.php" style="text-decoration: none;" class="fw-bold"><i class="bi bi-speedometer2"></i> <span> Dashboard</span> </a>
                            
                        </li>
                        <li >
                            <a href="manageusers.php" style="text-decoration: none;"><i class="bi bi-people-fill"></i> <span> Manage Users</span> </a>
                            
                        </li>
                        <li>
                            <a href="manageProducts.php" style="text-decoration: none;"><i class="bi bi-bag-fill"></i> <span> Manage Products</span> <span class=""></span></a>
                            
                        </li>
                        
                        <li class="menu-title">
                            <span>Management</span>
                        </li>
                        <li class="">
                            <a href="#" style="text-decoration: none;"><i class="fas fa-file-invoice-dollar" style="text-decoration: none;"></i> <span> Accounts</span> <span class=""></span></a>
                            <ul>
                                <li><a href="fees-collections.html">Fees Collection</a></li>
                                <li><a href="expenses.html">Expenses</a></li>
                                <li><a href="salary.html">Salary</a></li>
                                <li><a href="add-fees-collection.html">Add Fees</a></li>
                                <li><a href="add-expenses.html">Add Expenses</a></li>
                                <li><a href="add-salary.html">Add Salary</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="library.html" style="text-decoration: none;"><i class="fas fa-book"></i> <span>Library</span></a>
                        </li>
                        <li class="menu-title" style="text-decoration: none;">
                            <span>Pages</span>
                        </li>
                        <li class="">
                            <a href="#" style="text-decoration: none;"><i class="fas fa-shield-alt"></i> <span> Authentication </span> <span class=""></span></a>
                            <ul>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="forgot-password.html">Forgot Password</a></li>
                                <li><a href="error-404.html">Error Page</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="blank-page.html" style="text-decoration: none;"><i class="fas fa-file"></i> <span>Blank Page</span></a>
                        </li>
                        <li class="menu-title">
                            <span>Others</span>
                        </li>
                        
                        <li class="menu-title">
                            <span>UI Interface</span>
                        </li>
                        <li>
                            <a href="components.html" style="text-decoration: none;"><i class="fas fa-vector-square"></i> <span>Components</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#" style="text-decoration: none;"><i class="fas fa-columns"></i> <span> Forms </span> <span class=""></span></a>
                            <ul>
                                <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                                <li><a href="form-input-groups.html">Input Groups </a></li>
                                <li><a href="form-horizontal.html">Horizontal Form </a></li>
                                <li><a href="form-vertical.html"> Vertical Form </a></li>
                                <li><a href="form-mask.html"> Form Mask </a></li>
                                <li><a href="form-validation.html"> Form Validation </a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="#" style="text-decoration: none;"><i class="fas fa-table"></i> <span> Tables </span> <span class=""></span></a>
                            <ul>
                                <li><a href="tables-basic.html">Basic Tables </a></li>
                                <li><a href="data-tables.html">Data Table </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);" style="text-decoration: none;"><i class="fas fa-code"></i> <span>Multi Level</span> <span class=""></span></a>
                            <ul>
                                <li class="submenu">
                                    <a href="javascript:void(0);"> <span>Level 1</span> <span class=""></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"> <span> Level 2</span> <span class=""></span></a>
                                            <ul>
                                                <li><a href="javascript:void(0);">Level 3</a></li>
                                                <li><a href="javascript:void(0);">Level 3</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"> <span>Level 1</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</body>

</html>

<?php

} else {
    echo ("You are not a valid user");
}

?>