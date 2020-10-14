<?php
    $servername = "localhost";
    $username = "id15127505_soen287dev";
    $password = "{42m6ad#Ib[gr_vI";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
?>
