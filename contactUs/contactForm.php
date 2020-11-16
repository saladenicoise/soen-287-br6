<?php

    const MAX_NAME_LENGTH = 50;
    const MAX_EMAIL_LENGTH = 100;
    const MAX_ADDRESS_LENGTH = 400;
    const MAX_SUBJECT_LENGTH = 50;

     // intialize variables 
     $nameErr = "";
     $emailErr = "";
     $phoneErr = "";
     $addressErr = "";
     $subjectErr = "";
     $messageErr = "";
     $result = "";
     $isError= false;
     

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$contactName = "";
$contactPhone = "";
$contactEmail = "";
$contactAddress = "";
$contactSubject = "";
$contactMsg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Data from form
    $servername = "localhost";
    $username = "id15127505_soen287dev";
    $password = "{42m6ad#Ib[gr_vI";
    $dbname = "id15127505_soen287database";
        
     /*Get all of our data from our form*/

        /*Check if the data is empty and in a valid format for mandatory fields*/

        $contactName = test_input($_POST['name']);
        $contactPhone = test_input($_POST['phone']);
        $contactEmail = test_input($_POST['email']);
        if(isset($_POST['address'])) {
            $contactAddress = test_input($_POST['address']);
        }
        $contactSubject = test_input($_POST['subject']);
        // MESSAGE CHECK
        if(empty($_POST['message'])) {
            $messageErr = "Message is required";
            $isError = true;
        }
        else{
            $contactMsg = test_input($_POST['message']);  
        }
        
        
    if (!$isError)    {
    /*MySQL for connection */
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //send the data to the DB
    $stmt = $conn->prepare("INSERT INTO `ContactForms` (contactName, contactNumber, contactEmail, contactAddress, contactSubject, contactMessage) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssss', $contactName, $contactPhone, $contactEmail, $contactAddress, $contactSubject, $contactMsg);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            
    }
    
}
    
 
?>