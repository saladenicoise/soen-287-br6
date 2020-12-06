<?php
session_start();
$clientName=$_SESSION["fullName"];
$clientEmail=$_SESSION["email"];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerTemplate/vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
//SMTP::DEBUG_OFF = off 
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server (We will be using GMAIL)
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication
$mail->Username = 'bens51035@gmail.com';
//Password to use for SMTP authentication
$mail->Password = '12345678BEbe!';
//Set who the message is to be sent from
$mail->setFrom('bens51035@gmail.com', 'Mail Tester');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to email and name
$mail->addAddress($clientEmail);
//Name is optional
//$mail->addAddress('recepientid@domain.com');

//You may add CC and BCC
//$mail->addCC("recepient2id@domain.com");
//$mail->addBCC("recepient3id@domain.com");

$mail->isHTML(true);

//You can add attachments. Provide file path and name of the attachments
//$mail->addAttachment("file.txt", "File.txt");        
//Filename is optional
$mail->addAttachment("thankyou.png"); 



//Set the subject line
$mail->Subject = 'Thank you so much for your order!';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->Body = "Dear $clientName,<br/><br/>An account has been successfully created for you with userID \"$userId\".<br/><br/>Best regards,<br/>Gmail Administrator";
//You may add plain text version using AltBody
//$mail->AltBody = "This is the plain text version of the email content";
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message was sent Successfully!';
}

header("Location:Congradulations.php");
exit();
?>