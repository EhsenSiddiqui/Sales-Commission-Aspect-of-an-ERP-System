

<?php
session_start();
$DisplayPage = false;
if(isset($_SESSION['USER_TYPE_ID']) && $_SESSION['USER_TYPE_ID'] == 'SD_TM'){
$DisplayPage=true;
}
//INSERT INTO `categories` (`PRODUCT_CATEGORY`, `DESCRIPTION`) VALUES ('A', 'This is product category \'A\'.');
$insert = false;
$NotInsert = false;
$DisplayForm = true;
$DisplayRequestButton = true;

$ErrorOnQtrNotSet=false;
//Connect to the Database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "Sales_Commission";

require('connection.php');
//Create a connection 

//$conn = mysqli_connect($servername, $username, $password, $database);

//Die if connection was not successful 
if(!$conn){
  die("Sorry we failed to connect: ". mysqli_connect_error());
}

$quarterQuery = "SELECT * FROM `quarter` WHERE `ID` = 1 ";
  $res = mysqli_query($conn, $quarterQuery);
  $row = mysqli_fetch_assoc($res);
  $qtr = $row['QUARTER'];
  if($qtr == NULL){
$QuarterNotSet=true;
  }
else{
  $QuarterNotSet=false;
}




$QueryToCheckRequestStatus = "SELECT * FROM `status` WHERE `status`.`STATUS_ID` = 1";
$CurrentStatus = mysqli_query($conn, $QueryToCheckRequestStatus);
$row=mysqli_fetch_assoc($CurrentStatus);
$RequestSent = $row['STATUS'] == 1;
if($RequestSent){
  $DisplayForm = False;
}

/*
This code was just to check if we are able to obtained current status from the database
if($CurrentStatus){
  $row=mysqli_fetch_assoc($CurrentStatus);
  echo "The current status is: ".$row['STATUS']; 
  
}
else{
  echo "The current status could not be obtained because of this error ----> ". mysqli_error($conn);
}
*/

if(isset($_POST['btn-req'])){
  
  $quarterQuery = "SELECT * FROM `quarter` WHERE `ID` = 1 ";
  $res = mysqli_query($conn, $quarterQuery);
  $row = mysqli_fetch_assoc($res);
  $qtr = $row['QUARTER'];

 if($qtr!=NULL){
$QuarterNotSet=False;
$DisplayForm = False;
//$value = true;
//$id = 1;
$sql_query = "UPDATE `status` SET `STATUS` = '1' WHERE `status`.`STATUS_ID` = 1";
$QuerySuccessfullyExecuted = mysqli_query($conn, $sql_query);

if($QuerySuccessfullyExecuted){
  echo "Status updated successfully";
}
else{
  echo "The status was not updated because of this error ----> ". mysqli_error($conn);
}

}

else{
 // $QuarterNotSet=True;
 $ErrorOnQtrNotSet=true;
 // echo "You have not set the quarter yet.";
}

}

if(isset($_POST['enter-btn'])) {
  if(isset($_POST["Product-Category"]) && isset($_POST["Min_Amount"]) && isset($_POST["Max_Amount"]) && isset($_POST["commission-pct"])){
$Product_Category = $_POST["Product-Category"];
$Min_Amount = $_POST["Min_Amount"];
$Max_Amount = $_POST["Max_Amount"];
$Commission_Pct = $_POST["commission-pct"];

$sql = "INSERT INTO `plan` (`PRODUCT_CATEGORY`,`MIN_AMOUNT`,`MAX_AMOUNT`,`COMMISSION_PCT`) VALUES ('$Product_Category', '$Min_Amount', '$Max_Amount', '$Commission_Pct')";
$result = mysqli_query($conn, $sql);
if($result){
 $insert = True;
}
else{
  $NotInsert = True;
 // echo "The record was not inserted because of this error ----> ". mysqli_error($conn);
}

 }

 else{
$NotInsert=True;
 }

} //End of if statement that was to check if submit button of the form was pressed to insert record into the database
?>

<?php
if($DisplayPage){
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> -->




 <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 



    <title>Sales Team Member</title>
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
     if($insert){
     ?> <div class="alert alert-success" role="alert">
      Entry made successfully!
    </div> <?php
      } 
      else if ($NotInsert){
        ?> <div class="alert alert-danger" role="alert">
      Entry could not be made. 
    </div> <?php
      }

      if($ErrorOnQtrNotSet){
        
        ?> <div class="alert alert-danger" role="alert">
      You have not set the quarter yet.
    </div> <?php
      }
      ?>

      


<!-- <div class="form-group col-md-2">

<form>
  <label for="quarters">Select quarter:</label>
  <select name="quarters" id="quarters" class="form-control">
  <option disabled selected> <b> ---- </b> </option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
  <br><br>
  <input type="submit" class="btn btn-primary" value="Set">
</form>
</div> -->
      
<!-- Division for the form starts from here -->
 

      <div class="container" >
      <?php
      if($DisplayForm){
        ?>
        <h1 style="text-align:center"><b> CREATE A COMMISSION PLAN </b></h1>

<!-- Set quarter form starts from here --->
<?php
if($QuarterNotSet){
  ?>
<div class="form-group col-md-2">
<form action="SetQuarter.php" method="POST">
  <label for="quarter">Select quarter:</label>
  <select name="quarter" id="quarter" class="form-control">
  <option disabled selected> <b> ---- </b> </option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
  <br>
  <input type="submit" class="btn btn-primary" value="Set" name="set-qtr-btn">
</form>

</div>
<br><br><br><br><br><br><br><br>
<?php
}
?>
        <!-- Entry form starts from here -->
        <form action="/login/SD_TM.php" method="POST">
            <div class="form-row">
              
              <div class="form-group col-md-4">
                <label for="Product-Category"> <b>Product Category</b></label>
                <select id="Product-Category" class="form-control" name="Product-Category">
                  <option disabled selected> <b> Select a product category </b> </option>
                  <?php
                   $sql = "SELECT PRODUCT_CATEGORY from `categories`";

                   $result = mysqli_query($conn, $sql);
                   while($row = mysqli_fetch_assoc($result)){
                    echo "<option value='". $row['PRODUCT_CATEGORY'] ."'>" .$row['PRODUCT_CATEGORY'] ."</option>";  // displaying data in option menu
                   }
                  
                  ?>
                </select>

                <label for="Min_Amount"> <b>Minimum Sales Amount</b> </label>
                <input type="number" step="0.01" min="0" class="form-control" id="Min_Amount" name="Min_Amount">

                <label for="Max_Amount"> <b> Maximum Sales Amount </b> </label>
                <input type="number" step="0.01" min="0" class="form-control" id="Max_Amount" name="Max_Amount">

                <label for="commission-pct"> <b> Commission Percentage </b> </label>
                <input type="number" step="0.01" max="0.5" class="form-control" id="commission-pct" name="commission-pct">
                <br>
                <button type="submit" class="btn btn-primary" name="enter-btn">Enter</button>
              </div>
              <!-- <div class="form-group col-md-2">
                
                <label for="Min_Amount"> <b>Minimum Sales Amount</b> </label>
                <input type="number" step="0.01" class="form-control" id="Min_Amount" name="Min_Amount">

                <label for="Max_Amount"> <b> Maximum Sales Amount </b> </label>
                <input type="number" step="0.01" class="form-control" id="Max_Amount" name="Max_Amount">

                <label for="commission-pct"> <b> Commission Percentage </b> </label>
                <input type="number" step="0.01" max="0.5" class="form-control" id="commission-pct" name="commission-pct">

              </div> -->
            </div>
            

            <!-- <button type="submit" class="btn btn-primary mt-1" name="enter-btn">Enter</button> -->
          </form> 
          <?php
                  }

        else{

?> 
<table class="table">
<thead>
<tr>
<th scope="col">Stage</th>
<th scope="col">Status</th>
</tr>
</thead>

<tbody>

<?php

$sql = "SELECT * FROM `Status`";
$result = mysqli_query($conn, $sql); 
$row = mysqli_fetch_assoc($result);
$CreateNew=false;
 $count=0;
if($row['STATUS']==1){
  $count++;
}
      while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
      <td> <?php echo $row['DESCRIPTION']; ?> </td>
      <td> 
      <?php
      if($row['STATUS'] == NULL){
      ?> <p>Pending</p> <?php
      }
      else if($row['STATUS'] == 1){
      ?> <p> &#9989;</p> <?php
      $count++;
      }
      else{
       ?>  <p> &#10060; </p> <?php
       $CreateNew=True;

      }

      ?>
      </td>
      </tr>
      <?php endwhile; ?>

</tbody>
</table>


<?php
$AllPaymentsMade=true;
$q = "SELECT * FROM `payments`";
$r = mysqli_query($conn, $q);
while($row = mysqli_fetch_assoc($r)){
  if($row['Paid']!=1){
    $AllPaymentsMade=false;
  }
}
if($count==3 || $CreateNew){
  if($count==3 && $AllPaymentsMade){
  ?> <a href="CreateNewPlan.php" class="btn btn-info">Create New Plan</a> <?php
  }
  else if($CreateNew){
    ?> <a href="CreateNewPlan.php" class="btn btn-info">Create New Plan</a> <?php
  }
}
}
         ?>
         <!-- <h1> <b>COMMISSION PLAN</b> </h1>
         <br> -->
      </div>

<!-- Division for the data table starts from here -->
      <div class="container my-4">
<?php 
if(!$DisplayForm){
  $q = "SELECT * FROM `quarter` WHERE `ID` = 1 ";
  $r = mysqli_query($conn, $q);
  $row = mysqli_fetch_assoc($r);
  $quarter = $row['QUARTER'];
  ?> <h1> <b>COMMISSION PLAN FOR QUARTER <?php echo $quarter; ?> </b> </h1> 
         <br> <?php
}

// $i=0;
// while($i  < 5){
// ?> <br> <?php
// $i++;
// }
?>
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Product Category</th>
      <th scope="col">Minimum Amount</th>
      <th scope="col">Maximum Amount</th>
      <th scope="col">Commission Percentage</th>
      <?php
      if($DisplayForm){
     ?> <th scope="col">Action</th> <?php
      }
      ?>
    </tr>
    </tr>
  </thead>
  <tbody>

<?php

$sql = "SELECT * FROM `Plan`";
$result = mysqli_query($conn, $sql); 
      while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
      <td> <?php echo $row['PRODUCT_CATEGORY']; ?> </td>
      <td> <?php echo $row['MIN_AMOUNT']; ?> </td>
      <td> <?php echo $row['MAX_AMOUNT']; ?> </td>
      <td> <?php echo $row['COMMISSION_PCT']; ?> </td>
      <?php
      if($DisplayForm){
      ?> <td> 
      <a href="DeleteEntry.php?delete=<?php echo $row['ID']; ?>" class="btn btn-danger">Delete</a>
      </td> <?php
      }
      ?>
      </tr>
      <?php endwhile; ?>


    <!--  <button class='delete btn btn-sm btn-primary'> </button> -->
  </tbody>
</table>

      </div>

      <div class="container">
  
       <form method='POST'>
       <?php
       if($DisplayForm){
       ?> <input type="submit" name="btn-req" class="btn btn-info" value="Submit for CEO's approval"> <?php
       }
       else{
        ?> <input type="submit" name="btn-req" class="btn btn-danger" value="Submitted for CEO's approval" disabled> <?php
       }
       ?>
       </form>
      </div>

      
<!-- All the code added by me 
      <script
			  src="https://code.jquery.com/jquery-3.6.0.js"
			  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
			  crossorigin="anonymous"></script>


      <script
			  src="https://code.jquery.com/jquery-3.4.1.js"></script>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
-->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
     -->


  <!--  <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> 

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>


     
     <script type="text/javascript">
      $(document).ready( function () {
      $('#myTable').DataTable();
      } );
     </script>
     -->
     
  </body>
</html>
<?php
}
else{
  header('Location: Error.php');
 }
?>
