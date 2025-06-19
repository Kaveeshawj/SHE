<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$size = $_POST["s"]; 
$title = $_POST["t"];
$color = $_POST["col"];
$qty = $_POST["qty"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];
$cost = $_POST["cost"];



if($category == "0"){
    echo("Please select a Category");
}else if($size == "0"){
    echo("Please select a Size");
}else if(empty($title)){
    echo("Please enter a Title");
}else if($color == "0"){
        echo("Please select a Colour");
}else if(empty($qty)){
    echo("Please select a Quantity");
}else if($qty == "0" | $qty == "e" | $qty < 0){
    echo("Invalid Input for Quantity");
}else if(empty($cost)){
    echo("Please Enter the Price");
}else if(!is_numeric($cost)){
    echo("Invalid Input for Cost");
}else if(empty($dwc)){
    echo("Please Enter the delivery fee for colombo");
}else if(!is_numeric($dwc)){
    echo("Invalid Input for delivery fee for colombo");
}else if(empty($doc)){
    echo("Please Enter the delivery fee out of colombo");
}else if(!is_numeric($doc)){
    echo("Invalid Input for delivery fee out of colombo");
}else if(empty($desc)){
    echo("Please Enter the description");
}else{

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz); 
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product`
    (`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivert_fee_other`,`category_id`,
    `colour_id`,`status_id`,`user_email`,`size_id`) VALUES
    ('".$cost."','".$qty."','".$desc."','".$title."','".$date."','".$dwc."','".$doc."','".$category."',
    '".$color."','".$status."','".$email."','".$size."') ");

    echo("Product saved successfully");

    $product_di = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if($length <= 3 && $length > 0){

        $allowed_img_extensions = array("image/jpg","image/jpeg","image/png","image/svg+xml","image/webp");

        for($x = 0;$x < $length; $x++){
            if(isset($_FILES["image".$x])){

                $image_file = $_FILES["image".$x];
                $file_extension = $image_file["type"];

                if(in_array($file_extension,$allowed_img_extensions)){

                    $new_image_extension; 

                    if($file_extension == "image/jpg" ){
                        $new_image_extension = ".jpg";
                    }else if($file_extension =="image/jpeg"){
                        $new_image_extension = ".jpeg";
                    }else if($file_extension =="image/png"){
                        $new_image_extension = ".png";
                    }else if($file_extension =="image/svg+xml"){
                        $new_image_extension = ".svg";
                    }else if($file_extension == "image/webp"){
                        $new_image_extension = ".webp";
                    }

                    $file_name = "resources//products_img//".$title."_".$x."_".uniqid().$new_image_extension;
                    move_uploaded_file($image_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images` (`code`,`product_id`)VALUES ('".$file_name."','".$product_di."') ");

                }else{
                    echo("Invalid image type");
                }

            }
        }

        echo("Product Image Saved Successfully");

    }else{
        echo("Invalid image count");
    }

}



?>