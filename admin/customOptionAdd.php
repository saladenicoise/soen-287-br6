<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $customId = "";
    $customOption1 = "";
    $customOption2 = "";
    $customOption3 = "";
    $customOption4 = "";
    $customOption5 = "";
    $customOption6 = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        /*See about setting up environment variables
        */
        $servername = "localhost";
        $username = "dev";
        $password = "dev";
        $dbname = "soen287final";

        /*Get Data from form*/
        $customId = $_POST['customId'];
        $customOption1 = test_input($_POST['customOption1']);
        $customOption2 = test_input($_POST['customOption2']);
        $customOption3 = test_input($_POST['customOption3']);
        $customOption4 = test_input($_POST['customOption4']);
        $customOption5 = test_input($_POST['customOption5']);
        $customOption6 = test_input($_POST['customOption6']);

        /* MySQL Stuff
        */
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        /*Check if the customization option does exist in table*/
        $stmt = $conn->prepare("SELECT * FROM `Menu` WHERE customId=?");
        $stmt->bind_param('s', $customId);
        $stmt->execute(); //Executes the query
	    $stmt->store_result(); //Stores the results of the query
        $result = $stmt->num_rows;
        if($result == 0) {
            $errorMessage = "<b>Product Does Not exists</b>";
            header('Location: /admin/admin.php?stat=customF1', true);
            exit();
        } 

        /*Add*/
        $stmt = $conn->prepare("SELECT * FROM `CustomizationOptions` WHERE customId=?");
        $stmt->bind_param('s', $customId); //Binds the parameter $customId to the query
	    $stmt->execute(); //Executes the query
	    $stmt->store_result(); //Stores the results of the query
        $result = $stmt->num_rows; //Get the result of the query, the rows which return true aka 1 row where the customId is the same
        $stmt->close();
        if($result > 0) {
            $errorMessage = "<b>Product Already exists</b>";
            header('Location: /admin/admin.php?stat=customF2', true);
        }else{
            $stmt = $conn->prepare("INSERT INTO `CustomizationOptions` (customId, customOption1, customOption2, customOption3, customOption4, customOption5, customOption6) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sssssss', $customId, $customOption1, $customOption2, $customOption3, $customOption4, $customOption5, $customOption6);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            header('Location: /admin/admin.php?stat=customS');
        }
    }
?>