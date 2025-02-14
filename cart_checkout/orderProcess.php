<?php
session_start();

if(!empty($_POST['fullname'])&&!empty($_POST['email'])&&!empty($_POST['address'])&&!empty($_POST['city'])&&!empty($_POST['state'])&&!empty($_POST['zip'])){
    $continueProcess=true;
}

$emailAddr="";
$fullName="";

if(isset($_POST['placeOrder'])&&isset($continueProcess)){



    require('../configure.php');
    $servername = DB_SERVER;
    $username = DB_USER;
    $password = DB_PASS;
    $dbname = DB_NAME;

    $userID = $_SESSION['username'];

    $fullName=$_POST['fullname'];
    $emailAddr=$_POST['email'];
    $address=$_POST['address'];
    $cityName=$_POST['city'];
    $_state=$_POST['state'];
    $postalCode=$_POST['zip'];

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }




    $total = 0;
    $totalItems = 0;


    //calculate totals to submit into orders
    foreach($_SESSION["cart"] as $key =>$value){
        $itemQuantity=$value["productNum"];
        $priceNum=substr($value["productPrice"],1);
        $total=$total+$priceNum*$itemQuantity;
        $totalItems = $totalItems + $itemQuantity;
    }

        //put the order in the table 
        $stmt = $conn->prepare("INSERT INTO `ordertable` (username, totalItems, totalCost) VALUES (?, ?, ?)");
        $stmt->bind_param('sid', $userID,$totalItems,$total); 
        $stmt->execute(); //Executes the query


    // get the last Order # from the DB
    $query = "SELECT * FROM `ordertable` ORDER BY Order_ID DESC LIMIT 1";

    $order_ID = 0;

    if ($result = $conn->query($query)) {

        $row = $result->fetch_assoc();
        $order_ID = $row["Order_ID"];

    }

    //insert every individual item with the proper order number
    foreach($_SESSION["cart"] as $key =>$value){
        

        $itemName=$value["productName"];
        $itemSize=$value["productSize"];
        $itemQuantity=$value["productNum"];
        $priceNum=substr($value["productPrice"],1);
        
    
        //put each order item in the table 
        $stmt = $conn->prepare("INSERT INTO `orderitemtable` (Order_ID,productName,cost,username,product_size,quantity) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param('isdssi', $order_ID, $itemName,$priceNum,$userID,$itemSize,$itemQuantity); 
        $stmt->execute(); //Executes the query
            
    
    }
    
    $stmt->close();
}


$_SESSION["fullName"]=$fullName;
$_SESSION["email"]=$emailAddr;


header("Location:Congratulations.php");
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
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
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
$mail->setFrom('bens51035@gmail.com', 'Maison De Chef Team');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to email and name
$mail->addAddress($emailAddr);
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
if(!empty($_SESSION["cart"])){
    $total=0;
    $body='<table><tr><th>Dish</th><th>Size</th><th>Quantity</th></tr>';
     
foreach($_SESSION["cart"] as $key =>$value){
    $itemName=$value["productName"];
    $itemSize=$value["productSize"];
    $itemQuantity=$value["productNum"];
    $priceNum=substr($value["productPrice"],1);
    $total=$total+$priceNum*$itemQuantity;
$body .= '<tr><td>'.$itemName.'</td><td>'.$itemSize.'</td><td>'.$itemQuantity.'</td></tr>';
}
$body .= '<tr><td></td><td>SubTotal</td><td>'.$total.'</td></tr>';
}
$mail->Body = 'Dear'.$fullName.',<br/><br/>We have received your order! And will get down to it as soon as possible!<br/><br/>Here is your order summary:<br/><br/>'.$body.'</table><br/><br/>Best regards,<br/>James Mitchell';
                           
//You may add plain text version using AltBody
//$mail->AltBody = "This is the plain text version of the email content";
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message was sent Successfully!';
}


exit();
?>