<?php

$verified = 0;
    //Google ReCaptcha Code
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
        // Build POST request:
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = '6Lf8pNkZAAAAAKyaVxvVn4K0ZkLQh3oENiiao4-7';
        $recaptcha_response = $_POST['recaptcha_response'];
    
        // Make and decode POST request:
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);

        // Take action based on the score returned:
        if ($recaptcha->score >= 0.5) {
            $verified = 1;
        }
    
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
header_remove(); 
    $uname = "";
    $pword = "";
    $errorMessage = "";
    $isAdmin = 0;
    $dbEmail = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require('./configure.php'); 
        $servername = DB_SERVER;
        $username = DB_USER;
        $password = DB_PASS;
        $dbname = DB_NAME;

        $uname = test_input($_POST['username']);
        $pword = $_POST['password'];
        $email = test_input($_POST['email']);
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if($conn) {
            $SQL = $conn->prepare("SELECT * FROM `UserAccounts` WHERE email=?");
            $SQL->bind_param('s', $email);
            $SQL->execute();
            $SQL->store_result();
            $result = $SQL->num_rows;
            $SQL->close();
            if ($result > 0) {//Email already exists
                header('Location: /login/signup.php?stat=signupE');
                exit();
            } else {
                $SQL = $conn->prepare("SELECT * FROM `UserAccounts` WHERE username=?");
                $SQL->bind_param('s', $uname);
                $SQL->execute();
                $SQL->store_result();
                $result = $SQL->num_rows;
                $SQL->close();
                if ($result > 0) {//User already exists
                    header('Location: /login/signup.php?stat=signupU');
                    exit();
                }
                $phash = password_hash($pword, PASSWORD_BCRYPT, ['cost' => 12]);
                $SQL = $conn->prepare("INSERT INTO `UserAccounts` (username, password, isAdmin, email) VALUES (?, ?, ?, ?)");
			    if (!$SQL) {
                    $errorMessage = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
			    }else{
                    if($uname == "soen287Dev") {
                        $isAdmin = 1;
                    }
                    $resetToken = "";
                    $SQL->bind_param('ssis', $uname, $phash, $isAdmin, $email);              
                    if($verified == 1) {            
                        $SQL->execute();
                    }else{
                        header('Location: /login/signup.php?stat=singupG');
                    }
                    $SQL->close();
                    $conn->close();
                    header('Location: /login/login.php');
		 	    }
            }
        } else {
            header('Location: /login/signup.php?stat=singupD');
        }
    }
?>