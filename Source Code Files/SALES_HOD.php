<?php
session_start();
$DisplayPage = false;
if(isset($_SESSION['USER_TYPE_ID']) && $_SESSION['USER_TYPE_ID'] == 'SALES_HOD'){
$DisplayPage=true;
}
$DisplayTable = false;
require('connection.php');

?>

<?php 
if($DisplayPage){
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->


 <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
<meta charset="utf-8">
<title> Sales Dept Head </title>
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><b>SALES COMMISSION</b></a>
    </div>
   
    <ul class="nav navbar-nav navbar-right">
      <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
      <!-- <li><a href="#" id="Log-out"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
           -->
      
      
      <li>

      <a href="DestroySession.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
      <!-- <form action = "DestroySession.php" method="POST">
          
      <button id="Logout"><span class="glyphicon glyphicon-log-out"></span> Logout</button>
      
      </form> -->
      </li>

    </ul>
  </div>
</nav> 




<?php

$query = "SELECT `STATUS` FROM `STATUS` WHERE `STATUS_ID` = '2' OR `STATUS_ID` = '3'"; 
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$row1 = mysqli_fetch_assoc($result);
// echo $row['STATUS'];
// echo $row1['STATUS'];

if($row['STATUS'] == 1 && $row1['STATUS']==NULL){
    $DisplayTable = True;
}

if($DisplayTable){
?>

<div class="container my-4">

<?php
$q = "SELECT * FROM `quarter` WHERE `ID` = 1 ";
  $r = mysqli_query($conn, $q);
  $row = mysqli_fetch_assoc($r);
  $quarter = $row['QUARTER'];
  ?> <h1> <b>CALCULATED COMMISSIONS QUARTER <?php echo $quarter; ?> </b> </h1> 
         <br> <?php
?>



<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Commission ID</th>
      <th scope="col">Salesperson ID</th>
      <th scope="col">Product Category</th>
      <th scope="col">Total Sales Amount</th>
      <th scope="col">Commission Percentage</th>
      <th scope="col">Commission Amount</th>

    </tr>
    </tr>
  </thead>
  <tbody>
  <?php
       $sql = "SELECT * from `commissions`";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
          echo "<tr>
          <th scope='row'>".$row['COMMISSION_ID']."</th>
          <td>".$row['SALESPERSON_ID']."</td>
          <td>".$row['PRODUCT_CATEGORY']."</td>
          <td>".$row['TOTAL_SALES']."</td>
          <td>".$row['COMMISSION_PCT']."</td>
          <td>".$row['COMMISSION_AMOUNT']."</td>
        </tr>";
          
       } 
      ?>
    <!--  <button class='delete btn btn-sm btn-primary'> </button> -->
  </tbody>
</table>

      </div>

      <div class="container">
  
       <form action="SALES_HOD.php" method="POST" id="buttons"> <!-- removed method = "POST" here because it is not sending data anywhere -->
       <input type="submit" name="Approve" value="APPROVE" class="btn btn-primary m-1">
       <input type="submit" name="Reject" value="REJECT" class="btn btn-danger m-1">
       </form>
      </div>     
<?php
}

?>

<?php
if(isset($_POST['Approve'])){
    // echo "Approve button is pressed.";
 
 $sql_query = "UPDATE `status` SET `STATUS` = '1' WHERE `status`.`STATUS_ID` = 3";
 $QuerySuccessfullyExecuted = mysqli_query($conn, $sql_query);
 
 if($QuerySuccessfullyExecuted){
    $DisplayTable=False;
  // echo "Status updated successfully for approval from CEO";
//$query = "SELECT SALESPERSON_ID, PRODUCT_CATEGORY, sum(`SALES_AMOUNT`) as SALES FROM `sales` GROUP BY SALESPERSON_ID, PRODUCT_CATEGORY";
$query = "SELECT `SALESPERSON_ID`,SUM(`COMMISSION_AMOUNT`) as `Amount` FROM `commissions` GROUP BY `SALESPERSON_ID`";
$result = mysqli_query($conn, $query);
//QuerySuccess($result);
while($row = mysqli_fetch_assoc($result)){
    //Insert the record 
    $A = $row['SALESPERSON_ID'];
    $B = "C";
    $C = $row['Amount'];
    if($C > 0){
$InsertQuery = " INSERT INTO `payments` (`EMP_ID`, `PAYMENT_TYPE`,`AMOUNT`) VALUES ('$A','$B','$C')";
$InsertResult = mysqli_query($conn, $InsertQuery);
    }
}
header('Location: SALES_HOD.php');
 }
 
 else{
   echo "The status was not updated because of this error ----> ". mysqli_error($conn);
 }
 
 }
 else if(isset($_POST['Reject'])){
 
     $sql_query = "UPDATE `status` SET `STATUS` = '0' WHERE `status`.`STATUS_ID` = 3";
     $QuerySuccessfullyExecuted = mysqli_query($conn, $sql_query);
     
     if($QuerySuccessfullyExecuted){
       echo "Status updated successfully for rejection from Sales HOD";
       $page = $_SERVER['PHP_SELF'];
       $sec = "2";
       header("Refresh: $sec; url=$page");
     }
     else{
       echo "The status was not updated because of this error ----> ". mysqli_error($conn);
     }
 
 }
?>






</body>

</html> 
<?php
}
else{
 header('Location: Error.php');
}
?>
