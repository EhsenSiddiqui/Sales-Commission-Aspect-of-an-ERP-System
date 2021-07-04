<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

require('connection.php');
if(isset($_GET['pay'])){
$id = $_GET['pay'];
$query = "UPDATE `payments` SET `DATE` = SYSDATE(), `Paid` = '1' WHERE `payments`.`TRANSACTION_ID` = $id";
$result = mysqli_query($conn, $query);

$CommissionAmountQuery = "SELECT `AMOUNT` FROM `payments` WHERE `payments`.`TRANSACTION_ID` = $id";
$AmountResult = mysqli_query($conn, $CommissionAmountQuery);
$CommissionAmountRow = mysqli_fetch_assoc($AmountResult);

//Extracting the User ID of salesperson and then using it to 

$extractEmailQuery="SELECT `EMAIL` FROM `users` WHERE USER_ID = (SELECT `EMP_ID` FROM `payments` WHERE TRANSACTION_ID = $id)";
$EmailResult = mysqli_query($conn, $extractEmailQuery);

$row = mysqli_fetch_assoc($EmailResult);
$Amount = $CommissionAmountRow['AMOUNT'];
$To = $row['EMAIL'];
$From = "From: erp.project.ahsan.18076@gmail.com";
$Subject = "Confirmation Email For Commission Payment";
$Body = "You have received a total commission of $".$Amount.". This email confirms the payment of this amount to you. \n\n Thank you.";

//$success = mail($To, $Subject, $Body, $From);


//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'erp.project.ahsan.18076@gmail.com';                     //SMTP username
    $mail->Password   = 'ERP_Project_2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('erp.project.ahsan.18076@gmail.com');
    $mail->addAddress($To);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    // $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = $Body;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    header('Location: PAY_MGR.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}






// if($success){
// header("location: PAY_MGR.php");
// }
// else{
//     $errorMessage = error_get_last()['message'];
//     echo $errorMessage;
// }
}

?>