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
    $username = "dev";
    $password = "dev";
    $dbname = "soen287final";
        
     /*Get all of our data from our form*/

        /*Check if the data is empty and in a valid format for mandatory fields*/

        $contactName = test_input($_POST['name']);
        $contactPhone = test_input($_POST['phone']);
        $contactEmail = test_input($_POST['email']);
        if(isset($_POST['address'])) {
            $contactAddress = test_input($_POST['address']);
        }
        $contactSubject = test_input($_POST['subject']);
        $contactMsg = test_input($_POST['message']);  

    /*MySQL for connection */
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //send the data to the DB
    $stmt = $conn->prepare("INSERT INTO `contactforms` (contactName, contactNumber, contactEmail, contactAddress, contactSubject, contactMessage) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssss', $contactName, $contactPhone, $contactEmail, $contactAddress, $contactSubject, $contactMsg);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            
    }
    

    
 
?>