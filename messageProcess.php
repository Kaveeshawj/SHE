<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $name = $_POST["n"];
    $subject = $_POST["s"];
    $message = $_POST["m"];
    $sender = $_SESSION["u"]["email"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `chat`(`subject`,`message`,`date_time`,`from`) VALUES
('" . $subject . "','" . $message . "','" . $date . "','" . $sender . "')");

    echo ("success");
} else {

    echo ("Please login first");
}
