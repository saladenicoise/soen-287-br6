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
        if($result <= 0) {
            $errorMessage = "<b>Product Does Not Exist</b>";
            header('Location: /admin/admin.php?stat=editCustomF1', true);
            exit();
        } 

        $stmt = $conn->prepare("UPDATE `CustomizationOptions` SET customOption1=?, customOption2=?, customOption3=?, customOption4=?, customOption5=?, customOption6=?");
        $stmt->bind_param('ssssss', $customOption1, $customOption2, $customOption3, $customOption4, $customOption5, $customOption6);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header('Location: /admin/admin.php?stat=editCustomS');
    }
?>