<?php

require('connection.php');

$q1 = "TRUNCATE TABLE `plan`";
$q2 = "TRUNCATE TABLE `commissions`";
$q3 = "DELETE FROM `payments` WHERE `PAYMENT_TYPE` = 'C'";
$q4 = "UPDATE `status` SET `status`.`STATUS` = NULL";
$q5 = "UPDATE `quarter` SET `QUARTER` = NULL WHERE `quarter`.`ID` = 1";
mysqli_query($conn, $q1);
mysqli_query($conn, $q2);
mysqli_query($conn, $q3);
mysqli_query($conn, $q4);
mysqli_query($conn, $q5);

header("location: SD_TM.php");

?>