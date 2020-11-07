<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $servername = "localhost";
        $username = "id15127505_soen287dev";
        $password = "{42m6ad#Ib[gr_vI";
        $dbname = "id15127505_soen287database";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $customId = $_POST['customId'];
        $stmt = $conn->prepare("SELECT * FROM `CustomizationOptions` WHERE customId=?");
        $stmt->bind_param('s', $customId); //Binds the parameter $productName to the query
        $stmt->execute(); //Executes the query
        $stmt->store_result(); //Stores the results of the query
        $result = $stmt->num_rows; //Get the result of the query, the rows which return true aka 1 row where the productName is the same
        $stmt->close();
        if($result <= 0) {//Item does not exist
            header('Location: /admin/admin.php?stat=delCustomF');
        }else{
            $stmt = $conn->prepare("DELETE FROM `CustomizationOptions` WHERE customId=?");
            $stmt->bind_param('s', $customId);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            header('Location: /admin/admin.php?stat=delCustomS');
        }
    }
?>