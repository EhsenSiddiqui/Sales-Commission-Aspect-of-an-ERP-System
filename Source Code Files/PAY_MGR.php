<?php
session_start();
$DisplayPage = false;
if(isset($_SESSION['USER_TYPE_ID']) && $_SESSION['USER_TYPE_ID'] == 'PAY_MGR'){
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

if($row['STATUS'] == 1 && $row1['STATUS']==1){
    $DisplayTable = True;
}

if($DisplayTable){
?>

<div class="container my-4">

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Transaction ID</th>
      <th scope="col">Employee ID</th>
      <th scope="col">Payment Type</th>
      <th scope="col">Date</th>
      <th scope="col">Amount</th>
      <th scope="col">Action</th>

    </tr>
    </tr>
  </thead>
  <tbody>
  <?php

$retrievePayments = "SELECT * FROM `payments`";
$result = mysqli_query($conn, $retrievePayments); 
      while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
      <td> <?php echo $row['TRANSACTION_ID']; ?> </td>
      <td> <?php echo $row['EMP_ID']; ?> </td>
      <td> <?php echo $row['PAYMENT_TYPE']; ?> </td>
      <td> <?php echo $row['DATE']; ?> </td>
      <td> <?php echo $row['AMOUNT']; ?> </td>
      <td> 
      <?php
      if($row['Paid'] == 0){
      ?> <a href="ProcessPayment.php?pay=<?php echo $row['TRANSACTION_ID']; ?>" class="btn btn-info">Pay</a> <?php
      }
      else{
       ?>  <button type="button" class="btn btn-danger" disabled>Paid</button> <?php
      }

      ?>
      </td>
      </tr>
      <?php endwhile; ?>
    <!--  <button class='delete btn btn-sm btn-primary'> </button> -->
  </tbody>
</table>

      </div>

<?php
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
