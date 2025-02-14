<?php

$productID = 0;
$productName = "";
$productPrice = 0.0;
$vegetarian = 0;
$glutenFree = 0;
$customId = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../configure.php');
    $servername = DB_SERVER;
    $username = DB_USER;
    $password = DB_PASS;
    $dbname = DB_NAME;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

     /*Get all of our data from our form
        */
    $productID = $_POST['productID'];
    $productName = $_POST['itemName'];
    $productPrice = $_POST['itemCost'];
    $customId = $_POST['customId'];
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

    $stmt = $conn->prepare("SELECT * FROM `menu` WHERE productID=?");
    $stmt->bind_param('s', $productID); //Binds the parameter $productName to the query
    $stmt->execute(); //Executes the query
    $stmt->store_result(); //Stores the results of the query
    $result = $stmt->num_rows; //Get the result of the query, the rows which return true aka 1 row where the productName is the same
    $stmt->close();
    if($result <= 0) {//Item does not exist
        header('Location: /admin/admin.php?stat=editF#menu');
    }else{
        $stmt = $conn->prepare("UPDATE `menu` SET productName=?, cost=?, isVeg=?, isGf=?, customId=?, category=?, subcategory=?, description=? WHERE productID=?");
        $stmt->bind_param('sdiisssss', $productName, $productPrice, $vegetarian, $glutenFree, $customId, $category, $sub_category, $description, $productID);
        $res = $stmt->execute();
        $stmt->close();
        $conn->close();
        if($res) {
            header('Location: /admin/admin.php?stat=editS#menu');
        }else{
            echo "^ Error Occured ^";
            exit();
        }
    }
}
?>