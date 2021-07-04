<?php
require('connection.php');

if(isset($_POST["set-qtr-btn"])){

$quarter = $_POST['quarter'];
$q = "UPDATE `quarter` SET `QUARTER` = '$quarter' WHERE `quarter`.`ID` = 1"; 

$result = mysqli_query($conn, $q);

header('Location: SD_TM.php');

}


?>