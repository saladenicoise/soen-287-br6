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

    $ID = $_POST['delete'];
    $stmt = $conn->prepare("DELETE FROM `contactforms` WHERE Form_ID=?");
    $stmt->bind_param('i', $ID); //Binds the parameter $ID of the form to the query
    $stmt->execute(); //Executes the query
    $stmt->close();

    header('Location: /admin/admin.php?stat=delMessageS#contactUs');
}

?>