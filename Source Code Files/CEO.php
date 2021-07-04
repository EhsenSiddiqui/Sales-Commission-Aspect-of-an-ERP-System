<?php

session_start();
$DisplayPage = false;
if(isset($_SESSION['USER_TYPE_ID']) && $_SESSION['USER_TYPE_ID'] == 'CEO'){
$DisplayPage=true;
}

require('connection.php');

$DisplayTable = False;

function QuerySuccess($X){
  if(!$X){
    echo "Error executing query";
  }
}
?>


<?php 
if($DisplayPage){
  ?>

<!DOCTYPE html>
<html>
<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
 <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> -->

<title>CEO</title>

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

$query = "SELECT `STATUS` FROM `STATUS` WHERE `STATUS_ID` = '2' OR `STATUS_ID` = '1'"; 
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
  ?> <h1> <b>COMMISSION PLAN FOR QUARTER <?php echo $quarter; ?> </b> </h1> 
         <br> <?php
?>

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Product Category</th>
      <th scope="col">Minimum Amount</th>
      <th scope="col">Maximum Amount</th>
      <th scope="col">Commission Percentage</th>
    </tr>
    </tr>
  </thead>
  <tbody>
  <?php
       $sql = "SELECT * from `Plan`";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
          echo "<tr>
          <th scope='row'>".$row['PRODUCT_CATEGORY']."</th>
          <td>".$row['MIN_AMOUNT']."</td>
          <td>".$row['MAX_AMOUNT']."</td>
          <td>".$row['COMMISSION_PCT']."</td>
        </tr>";
          
       } 
      ?>
    <!--  <button class='delete btn btn-sm btn-primary'> </button> -->
  </tbody>
</table>

      </div>

      <div class="container">
  
       <form action="CEO.php" method="POST" id="buttons"> <!-- removed method = "POST" here because it is not sending data anywhere -->
       <!-- <input type="submit" name="Approve" value="APPROVE" class="btn btn-primary m-1">
       <input type="submit" name="Reject" value="REJECT" class="btn btn-danger m-1"> -->

       <a href="CalculateCommissionForEach.php?ID=1" class="btn btn-primary">Approve</a>
       <a href="CalculateCommissionForEach.php?ID=0" class="btn btn-danger">Reject</a>
       </form>
      </div>     
<?php
}

?>

<?php
if(isset($_POST['Approve'])){
    // echo "Approve button is pressed.";
 
 $sql_query = "UPDATE `status` SET `STATUS` = '1' WHERE `status`.`STATUS_ID` = 2";
 $QuerySuccessfullyExecuted = mysqli_query($conn, $sql_query);
 
 if($QuerySuccessfullyExecuted){
     $DisplayTable=False;
  // echo "Status updated successfully for approval from CEO";
$query = "SELECT SALESPERSON_ID, PRODUCT_CATEGORY, sum(`SALES_AMOUNT`) as SALES FROM `sales` GROUP BY SALESPERSON_ID, PRODUCT_CATEGORY";
$result = mysqli_query($conn, $query);
//QuerySuccess($result);
while($row = mysqli_fetch_assoc($result)){
$NoCommissionValueFoundInPlanTable = True;
$ProductCategory = $row['PRODUCT_CATEGORY'];
$queryForPlan = "SELECT * FROM `plan` WHERE `PRODUCT_CATEGORY` = '$ProductCategory' ";
$resultsFromPlan = mysqli_query($conn, $queryForPlan);
QuerySuccess($resultsFromPlan);

while($planRow = mysqli_fetch_assoc($resultsFromPlan)){
if($row['SALES'] >= $planRow['MIN_AMOUNT'] && $row['SALES'] < $planRow['MAX_AMOUNT']){
$commission_amount = $row['SALES']*$planRow['COMMISSION_PCT'];
$A = $row['SALESPERSON_ID'];
$B = $row['PRODUCT_CATEGORY'];
$C = $row['SALES'];
$D = $planRow['COMMISSION_PCT'];
 $insertQuery = " INSERT INTO `commissions` (`COMMISSION_ID`, `SALESPERSON_ID`,`PRODUCT_CATEGORY`, `TOTAL_SALES`, `COMMISSION_PCT`, `COMMISSION_AMOUNT`) VALUES (NULL,'$A','$B','$C','$D', $commission_amount)";
 // $insertQuery = " INSERT INTO `commissions` (`COMMISSION_ID`, `SALESPERSON_ID`,`PRODUCT_CATEGORY`, `TOTAL_SALES`, `COMMISSION_PCT`, `COMMISSION_AMOUNT`) VALUES (NULL, '$row['SALESPERSON_ID']','$row['PRODUCT_CATEGORY']','$row['SALES']','$planRow['COMMISSION_PCT']', $commission_amount)";
  $insertIntoCommissionTable = mysqli_query($conn, $insertQuery);
  $NoCommissionValueFoundInPlanTable = False;
}
}

if($NoCommissionValueFoundInPlanTable){

 // $insertQuery= "INSERT INTO `commissions` (`COMMISSION_ID`, `SALESPERSON_ID`,`PRODUCT_CATEGORY`, `TOTAL_SALES`, `COMMISSION_PCT`, `COMMISSION_AMOUNT`) VALUES (NULL, '$row['SALESPERSON_ID']','$row['PRODUCT_CATEGORY']','$row['SALES']',0,0) ";
 $A = $row['SALESPERSON_ID'];
 $B = $row['PRODUCT_CATEGORY'];
 $C = $row['SALES'];
 $D = 0;
  $insertQuery = " INSERT INTO `commissions` (`COMMISSION_ID`, `SALESPERSON_ID`,`PRODUCT_CATEGORY`, `TOTAL_SALES`, `COMMISSION_PCT`, `COMMISSION_AMOUNT`) VALUES (NULL,'$A','$B','$C','$D', 0)";
 
 $insertIntoCommissionTable = mysqli_query($conn, $insertQuery);


}

}
//header('Location: CEO.php');

$page = $_SERVER['PHP_SELF'];
       $sec = "2";
       header("Refresh: $sec; url=$page");

 }
 
 else{
   echo "The status was not updated because of this error ----> ". mysqli_error($conn);
 }
 
 }
 else if(isset($_POST['Reject'])){
 
     $sql_query = "UPDATE `status` SET `STATUS` = '0' WHERE `status`.`STATUS_ID` = 2";
     $QuerySuccessfullyExecuted = mysqli_query($conn, $sql_query);
     
     if($QuerySuccessfullyExecuted){
      // echo "Status updated successfully for rejection from CEO";
     // header('Location: CEO.php');
     $page = $_SERVER['PHP_SELF'];
       $sec = "2";
       header("Refresh: $sec; url=$page");
     }
     else{
       echo "The status was not updated because of this error ----> ". mysqli_error($conn);
     }
 
 }
?>

<script type="text/javascript">
$(document).ready(function () {
    $("#buttons").submit(function (e) {
         $("#Approve").attr("disabled", true);
            return true;
        });

    });
</script>

</body>

</html> 

<?php
}
else{
 header('Location: Error.php');
}
?>
