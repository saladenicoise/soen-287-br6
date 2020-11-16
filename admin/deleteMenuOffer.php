<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
        $username = "dev";
        $password = "dev";
        $dbname = "soen287final";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $productName = $_POST['itemName'];
    $stmt = $conn->prepare("SELECT * FROM `Menu` WHERE productName=?");
    $stmt->bind_param('s', $productName); //Binds the parameter $productName to the query
    $stmt->execute(); //Executes the query
    $stmt->store_result(); //Stores the results of the query
    $result = $stmt->num_rows; //Get the result of the query, the rows which return true aka 1 row where the productName is the same
    $stmt->close();
    if($result <= 0) {//Item does not exist
        header('Location: /admin/admin.php?stat=delF');
    }else{
        $stmt = $conn->prepare("DELETE FROM `Menu` WHERE productName=?");
        $stmt->bind_param('s', $productName);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header('Location: /admin/admin.php?stat=delS');
    }
}
?>