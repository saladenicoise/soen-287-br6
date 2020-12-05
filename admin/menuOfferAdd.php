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
    $category = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        /*See about setting up environment variables
        */
        $servername = "localhost";
        $username = "dev";
        $password = "dev";
        $dbname = "soen287final";
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
        $category = test_input($_POST['category']);
        $sub_category = test_input($_POST['sub-category']);


        /*Picture Handling*/
        $pictureDir = "../productPictures/";
        $pictureFile = $pictureDir . basename($_FILES["picUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($pictureFile,PATHINFO_EXTENSION));
        $upload = 1;

        /* Check if file already exists*/
        if (file_exists($pictureFile)) {
            echo "Sorry, file already exists.";
            $upload = 0;
        }
  
        /* Check file size*/
        if ($_FILES["picUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $upload = 0;
        }

        if($upload == 0) {
            echo "Error: File not uploaded!";
            exit();
        }else{
            if(move_uploaded_file($_FILES["picUpload"]["tmp_name"], $pictureFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["picUpload"]["name"])) . "has been uploaded!";
                $filePath = $_FILES["picUpload"]["name"];
            }else{
                echo "Error: File not uploaded";
                exit();
            }
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
            $stmt = $conn->prepare("INSERT INTO `Menu` (productName, cost, isVeg, isGF, customId, category, subcategory, imagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sdiissss', $productName, $productPrice, $vegetarian, $glutenFree, $customId, $category, $sub_category, $filePath);
            $res = $stmt->execute();
            $stmt->close();
            $conn->close();
            if($res) {
                header('Location: /admin/admin.php?stat=addS');
            }else{
                echo "^ Error Occured ^";
                exit();
            }
        }

    }
?>