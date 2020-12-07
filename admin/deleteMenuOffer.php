<?php
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

    $productID = $_POST['productID'];
    $stmt = $conn->prepare("SELECT * FROM `menu` WHERE productID=?");
    $stmt->bind_param('s', $productID); //Binds the parameter $productName to the query
    $stmt->execute(); //Executes the query
    $stmt->store_result(); //Stores the results of the query
    $result = $stmt->num_rows; //Get the result of the query, the rows which return true aka 1 row where the productName is the same
    $stmt->close();
    if($result <= 0) {//Item does not exist
        header('Location: /admin/admin.php?stat=delF#menu');
    }else{
        $stmt = $conn->prepare("DELETE FROM `menu` WHERE productID=?");
        $stmt->bind_param('s', $productID);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header('Location: /admin/admin.php?stat=delS#menu');
    }
}
?>