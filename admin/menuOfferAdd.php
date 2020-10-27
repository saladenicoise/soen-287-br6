<?php
    function generate_custom_id() {
        $bytes = random_bytes(9);
        $hex = bin2hex($bytes);
        return "_" . $hex;
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $productName = "";
    $productPrice = 0.0;
    $vegetarian = 0;
    $glutenFree = 0;
    $customId = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        /*See about setting up environment variables
        */
        $servername = "localhost";
        $username = "id15127505_soen287dev";
        $password = "{42m6ad#Ib[gr_vI";
        $dbname = "id15127505_soen287database";

        /*Get all of our data from our form
        */
        $productName = test_input($_POST['itemName']);
        $productPrice = $_POST['itemCost'];
        if(isset($_POST['customOptions'])) {
            $customId = generate_custom_id();
            unset($_POST['customOptions']);
        }
        if(isset($_POST['vegetarian'])) {
            $vegetarian = 1;
            unset($_POST['vegetarian']);
        }
        if(isset($_POST['glutenFree'])) {
            $glutenFree = 1;
            unset($_POST['glutenFree']);
        }

        /* MySQL Stuff
        */
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM `Menu` WHERE productName=?");
        $stmt->bind_param('s', $productName); //Binds the parameter $productName to the query
	    $stmt->execute(); //Executes the query
	    $stmt->store_result(); //Stores the results of the query
        $result = $stmt->num_rows; //Get the result of the query, the rows which return true aka 1 row where the productName is the same
        $stmt->close();
        if($result > 0) {
            $errorMessage = "<b>Product already exists</b>";
            header('Location: /admin/admin.php?stat=addF', true);
        }else{
            $stmt = $conn->prepare("INSERT INTO `Menu` (productName, cost, isVeg, isGF, customId) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sdiis', $productName, $productPrice, $vegetarian, $glutenFree, $customId);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            header('Location: /admin/admin.php?stat=addS');
        }

    }
?>