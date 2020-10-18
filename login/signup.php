<?php
header_remove(); 
    $uname = "";
    $pword = "";
    $errorMessage = "";
    $isAdmin = 0;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $servername = "localhost";
        $username = "id15127505_soen287dev";
        $password = "{42m6ad#Ib[gr_vI";
        $dbname = "id15127505_soen287database";

        $uname = $_POST['username'];
        $pword = $_POST['password'];
    
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if($conn) {
            $SQL = $conn->prepare("SELECT * FROM `UserAccounts` WHERE username=?");
            $SQL->bind_param('s', $uname);
            $SQL->execute();
            $SQL->store_result();
            $result = $SQL->num_rows;
            $SQL->close();
            if ($result > 0) {
                $errorMessage = "<b>Username already taken</b>";
            } else {
                $phash = password_hash($pword, PASSWORD_DEFAULT);
                $SQL = $conn->prepare("INSERT INTO `UserAccounts` (username, password, isAdmin) VALUES (?, ?, ?)");
			    if (!$SQL) {
                    $errorMessage = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
			    }else{
                    if($uname == "soen287Dev") {
                        $isAdmin = 1;
                    }
                    $SQL->bind_param('ssi', $uname, $phash, $isAdmin);              
                    $SQL->execute();
                    $SQL->close();
			        $conn->close();
		 	    }
            }
        } else {
            $errorMessage = "Database Not Found";
        }
    }
?>