<?php 

require('connection.php');
if(isset($_GET['delete'])){
$id = $_GET['delete'];
$sql = "DELETE FROM `plan` WHERE `plan`.`ID` = $id";
$result = mysqli_query($conn, $sql);

header("location: SD_TM.php");
}


?>