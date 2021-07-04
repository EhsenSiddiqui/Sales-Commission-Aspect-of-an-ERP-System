<?php
session_start();
require_once('connection.php');
//require('RedirectToLoggedInPage.php');
$message = "";
$role = "";

if(isset($_POST["login-btn"])){
    //Storing values obtained from the form
    $ID = $_POST['ID'];
    $password = $_POST['password']; 

    $query = "SELECT * FROM `users` WHERE `USER_ID` = '$ID' AND `PASSWORD` = '$password'"; //If this query returns a result, means ID and password have already been matched and you don't need to recheck them using if-else blocks

    $queryresult=mysqli_query($conn,$query);

    if(mysqli_num_rows($queryresult) > 0){
        $_SESSION['LoggedIn'] = True;
       
       // $userData = mysqli_fetch_assoc($queryresult);
       // $_SESSION['userData'] = $userData;
        echo "User has been validated.";
        // require_once('RedirectToLoggedInPage.php');
        // redirect($userData);
        while($row = mysqli_fetch_assoc($queryresult))
        {
            $_SESSION['USER_TYPE_ID']=$row['USER_TYPE_ID'];
            $_SESSION['USER_ID']=$row['USER_ID'];
         //   echo "if else header block";
            if($row['USER_TYPE_ID'] == "SD_TM"){
                header('Location: SD_TM.php');
            }
            else if ($row['USER_TYPE_ID'] == "CEO"){
                header('Location: CEO.php');

            }
            else if ($row['USER_TYPE_ID'] == "SALES_HOD"){
                header('Location: SALES_HOD.php');

            }
            else if($row['USER_TYPE_ID'] == "PAY_MGR"){
                header('Location: PAY_MGR.php');

            }
            else if($row['USER_TYPE_ID'] == "SALES_REP"){
                header('Location: SALES_REP.php');

            }
          echo "if else while loop ends";
        }

    }
    else {

        $message = "Invalid ID or password.";
        header("Location: login.php");

    }

}
?>

