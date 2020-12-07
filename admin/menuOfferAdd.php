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
    $customId = NULL;
    $category = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        /*See about setting up environment variables
        */
        require('../configure.php');
        $servername = DB_SERVER;
        $username = DB_USER;
        $password = DB_PASS;
        $dbname = DB_NAME;
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
        $category = $_POST["category"];
        $sub_category = $_POST["sub-category"];
        $description = $_POST['desc'];


        /*Picture Handling*/
        $pictureDir = "../images/productPictures/";
        $pictureFile = $pictureDir . basename($_FILES["picUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($pictureFile,PATHINFO_EXTENSION));
        $upload = 1;

        /* Check if file already exists*/
        if (file_exists($pictureFile)) {
            header('Location: /admin/admin.php?stat=imgFE#menu');
            exit();
            $upload = 0;
        }
  
        /* Check file size*/
        if ($_FILES["picUpload"]["size"] > 500000) {
            header('Location: /admin/admin.php?stat=imgFS#menu');
            exit();
            $upload = 0;
        }

        if($upload == 0) {
            header('Location: /admin/admin.php?stat=imgF#menu');
            exit();
        }else{
            if(move_uploaded_file($_FILES["picUpload"]["tmp_name"], $pictureFile)) {
                $filePath = $_FILES["picUpload"]["name"];
            }else{
                header('Location: /admin/admin.php?stat=imgF#menu');
                exit();
            }
        }
        /* MySQL Stuff
        */
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM `menu` WHERE productName=?");
        $stmt->bind_param('s', $productName); //Binds the parameter $productName to the query
	    $stmt->execute(); //Executes the query
	    $stmt->store_result(); //Stores the results of the query
        $result = $stmt->num_rows; //Get the result of the query, the rows which return true aka 1 row where the productName is the same
        $stmt->close();
        if($result > 0) {
            $errorMessage = "<b>Product already exists</b>";
            header('Location: /admin/admin.php?stat=addF#menu', true);
        }else{
            $stmt = $conn->prepare("INSERT INTO `menu` (productName, cost, isVeg, isGF, customId, category, subcategory, description, imagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sdiisssss', $productName, $productPrice, $vegetarian, $glutenFree, $customId, $category, $sub_category, $description, $filePath);
            $res = $stmt->execute();
            $stmt->close();
            $conn->close();
            if($res) {
                header('Location: /admin/admin.php?stat=addS#menu');
            }else{
                echo "^ Error Occured ^";
                exit();
            }
        }

    }
?>