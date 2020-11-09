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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Data from form
    $servername = "localhost";
    $username = "id15127505_soen287dev";
    $password = "{42m6ad#Ib[gr_vI";
    $dbname = "id15127505_soen287database";
        
     /*Get all of our data from our form*/

        /*Check if the data is empty and in a valid format for mandatory fields*/

        // NAME CHECK
        if(empty($_POST['name'])) {
            $nameErr = "Name is required";
        }
        else{
            // check if the name is too large for the DB
            if(strlen($_POST['name']) > MAX_NAME_LENGTH)
            {
                $nameErr = "Name is too long, must be less than " . MAX_NAME_LENGTH . " characters";
            }else {
                $contactName = test_input($_POST['name']);
            }
            
        }

        // PHONE CHECK
        if(empty($_POST['phone'])) {
            $phoneErr = "Phone Number is required";
        }
        else{
            // check phone number format
            if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST['phone'])) {
                $phoneErr = "Invalid phone number format";
            }
            else{
                $contactPhone = test_input($_POST['phone']);
            }
        }

        // EMAIL CHECK
        if(empty($_POST['email'])) {
            $emailErr = "Email is required";
        }
        else{
            // check if the email is too large for the DB
            if(strlen($_POST['email']) > MAX_EMAIL_LENGTH){
                $emailErr = "Email is too long. choost one that is less than " . MAX_EMAIL_LENGTH . " characters";
            }
            // check email format (included in PHP)
            elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
            else {
                $contactEmail = test_input($_POST['email']);
            }
            
        }

        // ADDRESS CHECK
        // address is not an empty field, so it doesnt matter if its empty
         if(!empty($_POST['address']))
         {
             //must check if it is too large for the DB if it isnt empty
            if(strlen($_POST['email']) > MAX_ADDRESS_LENGTH){
                $emailErr = "Address is too long. choost one that is less than " . MAX_ADDRESS_LENGTH . " characters";
            }else
            {
                $contactAddress = test_input($_POST['address']);
            }
         }else{
            $contactAddress = "";
         }

        // SUBJECT CHECK
        if(empty($_POST['subject'])) {
            $subjectErr = "Subject is required";
        }
        else{
            // check if the subject is too large for the DB
            if(strlen($_POST['subject']) > MAX_SUBJECT_LENGTH)
            {
                $subjectErr = "Subject is too long. choost one that is less than " . MAX_SUBJECT_LENGTH . " characters";
            } else {
                $contactSubject = test_input($_POST['subject']);
            }
        }

        // MESSAGE CHECK
        if(empty($_POST['message'])) {
            $messageErr = "Message is required";
        }
        else{
                $contactMsg = test_input($_POST['message']);
                $result = "Form Submitted";   
        }
    
    
       

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
    

    
 
?>