<?php

$productID = 0;
$productName = "";
$productPrice = 0.0;
$vegetarian = 0;
$glutenFree = 0;
$customId = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
        $username = "dev";
        $password = "dev";
        $dbname = "soen287final";

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
    $category = $_POST['category'];
    $sub_category = $_POST['sub-category'];

    $stmt = $conn->prepare("SELECT * FROM `Menu` WHERE productID=?");
    $stmt->bind_param('s', $productID); //Binds the parameter $productName to the query
    $stmt->execute(); //Executes the query
    $stmt->store_result(); //Stores the results of the query
    $result = $stmt->num_rows; //Get the result of the query, the rows which return true aka 1 row where the productName is the same
    $stmt->close();
    if($result <= 0) {//Item does not exist
        header('Location: /admin/admin.php?stat=editF');
    }else{
        $stmt = $conn->prepare("UPDATE `Menu` SET productName=?, cost=?, isVeg=?, isGf=?, customId=?, category=?, subcategory=? WHERE productID=?");
        $stmt->bind_param('sdiissss', $productName, $productPrice, $vegetarian, $glutenFree, $customId, $category, $sub_category, $productID);
        $res = $stmt->execute();
        $stmt->close();
        $conn->close();
        if($res) {
            header('Location: /admin/admin.php?stat=editS');
        }else{
            echo "^ Error Occured ^";
            exit();
        }
    }
}
?>