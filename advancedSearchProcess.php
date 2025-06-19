<?php

require "connection.php";

$search_txt = $_POST["t"];
$size = $_POST["size"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["to"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if($sort == 0){

    if($color != 0 && $status == 0){
        $query .= "WHERE `colour_id`='".$color."'";
        $status = 1;
    }else if($color != 0 && $status != 0){
        $query .= "AND `colour_id`='".$color."'";
    }

    if($size != 0 && $status == 0){
        $query .= "WHERE `size_id`='".$size."'";
        $status = 1;
    }else if($size != 0 && $status != 0){
        $query .= "AND `size_id`='".$size."'";
    }

    if(!empty($price_from) && empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` >= '".$price_from."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` >= '".$price_from."'";
        }
    }else if(empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` <= '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` <= '".$price_to."'";
        }
    }else if(!empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` BETWEEN '".$price_from."' AND '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` BETWEEN '".$price_from."' AND '".$price_to."'";
        }
    }
    
}else if($sort == 1){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` ASC";
        $status = 1;
    }
}else if($sort == 2){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` DESC";
        $status = 1;
    }
}else if($sort == 3){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` ASC";
        $status = 1;
    }
}else if($sort == 4){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` DESC";
        $status = 1;
    }
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

<?php

if ($_POST["page"] != "0") {

    $pageno = $_POST["page"];
} else {

    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 8;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

while ($results_data = $results_rs->fetch_assoc()) {

?>

<div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

<?php

$image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $results_data["id"] . "'");
$image_data = $image_rs->fetch_assoc();

?>

<img src="<?php echo $image_data["code"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
<div class="card-body ms-0 m-0 text-center">
    <h5 class="card-title fs-6 fw-bold"><?php echo $results_data["title"]; ?> </h5> <br />
    <span class="card-text text-primary">Rs. <?php echo $results_data["price"]; ?> .00</span> <br />

    <?php

    if ($results_data["qty"] > 0) {

    ?>

        <span class="card-text text-warning fw-bold">In Stock</span> <br />
        <span class="card-text text-success fw-bold"><?php echo $results_data["qty"]; ?> Items Available</span><br /><br />
        <button class="col-12 btn btn-success">Buy Now</button>
        <button class="col-12 btn btn-danger mt-2">Add to Cart</button>

    <?php

    } else {

    ?>

        <span class="card-text text-danger fw-bold">Out of Stock</span> <br />
        <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br />
        <button class="col-12 btn btn-success disabled">Buy Now</button>
        <button class="col-12 btn btn-danger mt-2 disabled">Add to Cart</button>

    <?php

    }

    ?>

    <button class="col-12 btn btn-outline-light mt-2 border border-info"><i class="bi bi-heart-fill text-danger fs-5"></i></button>
</div>
</div>

<?php
}

?>

</div>
    </div>


<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    </div>