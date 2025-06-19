<?php

session_start();
require "connection.php";

$text = $_POST["t"];

$sender = $_SESSION["u"]["email"];
$receiver = $_SESSION["msgU"]["email"];


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s"); 

Database::iud("INSERT INTO `msg`(`msg`,`date`,`status`,`from`,`to`) VALUES
('".$text."','".$date."','0','".$sender."','".$receiver."')");

echo("success");
?>