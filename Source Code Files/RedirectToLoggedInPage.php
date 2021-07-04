<?php
//session_start();
//require('ValidateUser.php');
// function redirect() {

//     $_SESSION['userData'] = $userData;
//         echo "User has been validated.";
//         while($row = $_SESSION['userData'])
//         {
//             if(row['USER_TYPE_ID'] == "SD_TM"){
//               header('Location: SD_TM.php');
//             }
//             else if (row['USER_TYPE_ID'] == "CEO"){
//                 header('Location: CEO.php');
//             }
//             else if (row['USER_TYPE_ID'] == "SALES_HOD"){
//                 header('Location: SALES_HOD.php');
//             }
//             else if(row['USER_TYPE_ID'] == "PAY_MGR"){
//                 header('Location: PAY_MGR.php');
//             }
//             else if(row['USER_TYPE_ID'] == "SALES_REP"){
//                 header('Location: SALES_REP.php');
//             }

//         }
// }

function redirect($userData) {

   // $_SESSION['userData'] = $userData;
        echo "User has been validated from redirect func.";
        while($row = $userData)
        {
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

        }
}


?>

