<?php

require "connection.php";

$id = $_GET["id"];

Database::iud("DELETE FROM `images` WHERE `product_id`='".$id."'");
Database::iud("DELETE FROM `product` WHERE `id`='".$id."'");
echo("success");
?>