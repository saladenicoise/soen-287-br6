<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function generate_reset_token() {
        $string = base64_encode(random_bytes(32));
        $string = str_replace('+', "", $string);
        return $string;
    }

    $verified = 0;
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

    $fEmail = "";
    $uname = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $servername = "localhost";
        $username = "dev";
        $password = "dev";
        $dbname = "soen287final";

        $fEmail = test_input($_POST['email']);
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Check if User exists
        $stmt = $conn->prepare("SELECT username FROM `UserAccounts` WHERE email=?");
        $stmt->bind_param('s', $fEmail);
        $stmt->execute(); //Executes the query
        $stmt->store_result(); //Stores the results of the query
        $stmt->bind_result($uname);
        $stmt->fetch(); //Actually fetches the data to place in bind_result
        $result = $stmt->num_rows; //Get the result of the query, the rows which return true aka 1 row where the uname was the same as the given username
        if($result != 1) { //User does not exist
            header('Location: /login/forgotPass.php?stat=fPassF');
            exit();
        }else{//User exists, we can proceed
            $stmt = $conn->prepare("UPDATE `UserAccounts` set resetToken=?, resetTimer=? WHERE email=?");
            $resetToken = generate_reset_token();
            $requestTime = $_SERVER['REQUEST_TIME'];
            $stmt->bind_param('sis', $resetToken, $requestTime, $fEmail);
            if($verified == 1) {//Pass Captcha
                $stmt->execute();
                $url = "\"localhost/login/resetPass.php?token=" . $resetToken . "\" ";
                //Send Email:
                //Host doesnt allow for emails without paying, so we pretend it works
                $mailMessage = "
                <html>
                    <head>
                        <title>Password Reset Request</title>
                    </head>
                    <body>
                        <h2>Hello " . $uname . "</h2>
                        <p>If you are receiving this message, it is because someone has requested a password reset for your username!</p>
                        <p>To resest your password follow this link: <a href=" . $url . "target=\"_blank\">link</a></p>
                        <p>If you did not request this password reset, please ignore this email</p>
                        </br>
                        <p>The link will no longer work after 30 minutes</p>
                        <p>Sincerely, the sentient server</p>
                    </body>
                </html>
                ";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $to = $fEmail;
                $subject = "Password Request";
                mail($to,$subject,$mailMessage,$headers);
                echo "Email with reset link has been sent, please check your email! </br> You may close this tab";
            }else{
                header('Location: /login/forgotPass.php?stat=fPassG');
            }
            $stmt->close();
            $conn->close();
        }
    }
?>