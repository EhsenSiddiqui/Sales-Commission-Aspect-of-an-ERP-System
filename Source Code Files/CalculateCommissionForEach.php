<?php


require('connection.php');
if(isset($_GET['ID'])){

$signal = $_GET['ID'];

if($signal == 1){

    
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
//QuerySuccess($resultsFromPlan);

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
header('Location: CEO.php');

 }
 
 else{
   echo "The status was not updated because of this error ----> ". mysqli_error($conn);
 }
}



else if($signal == 0){

    $sql_query = "UPDATE `status` SET `STATUS` = '0' WHERE `status`.`STATUS_ID` = 2";
    $QuerySuccessfullyExecuted = mysqli_query($conn, $sql_query);
    
    if($QuerySuccessfullyExecuted){
     // echo "Status updated successfully for rejection from CEO";
     header('Location: CEO.php');
    // $page = $_SERVER['PHP_SELF'];
    //   $sec = "2";
    //   header("Refresh: $sec; url=$page");
    }
    else{
      echo "The status was not updated because of this error ----> ". mysqli_error($conn);
    }
}

}






?>