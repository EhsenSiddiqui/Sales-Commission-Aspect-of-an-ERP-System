<?php
session_start();
 
//$_SESSION['LoggedIn'] = False;
//include 'RedirectToLoggedInPage.php';
require('connection.php');

if(isset($_SESSION['LoggedIn'])){

 // header('Location: ValidateUser.php');
redirect($_SESSION['USER_TYPE_ID']);

}

function redirect($usertype){

  if($usertype == "SD_TM"){
    header('Location: SD_TM.php');
}
else if ($usertype == "CEO"){
    header('Location: CEO.php');

}
else if ($usertype == "SALES_HOD"){
    header('Location: SALES_HOD.php');

}
else if($usertype == "PAY_MGR"){
    header('Location: PAY_MGR.php');

}
else if($usertype == "SALES_REP"){
    header('Location: SALES_REP.php');

}

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="login1.css">

<!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <!-- <a class="navbar-brand"><b>SALES COMMISSION</b></a> -->
      <h6 class="navbar-brand"><strong> SALES COMMISSION </strong></h6>
    </div>
  </div>
</nav> 




<div class="div-center">


  <div class="content">

  <h4><strong>PLEASE LOG IN</strong></h4> <br>
      <form action = "ValidateUser.php" method="POST" id="form" class="form-signin "> 
      
          

              <label for="ID"> <b>USERNAME</b> </label>
              <input type="text" class="form-control" id="ID" name="ID">

              <label for="password"> <b>PASSWORD</b> </label>
              <input type="password" class="form-control" id="password" name="password">
          
          <button type="submit" class="btn btn-primary mt-2" name="login-btn">LOGIN</button>
        </form>
       
</div>
</div>





  </body>
</html>
