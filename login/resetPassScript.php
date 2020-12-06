<?php
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

$pword = "";
$resetToken = "";
$time = null;
$timeLimit = 60*30; //30 Minutes
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../configure.php');
    $servername = DB_SERVER;
    $username = DB_USER;
    $password = DB_PASS;
    $dbname = DB_NAME;

    $user = "";
    $pword = $_POST['password'];
    $resetToken = $_POST['reset_token'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT username FROM `UserAccounts` where resetToken=?");
    $stmt->bind_param("s", $resetToken);
    $stmt->execute();
    $stmt->store_result();
    $stmt->fetch(); //Actually fetches the data to place in bind_result
    $result = $stmt->num_rows;
    $stmt->close();
    if($result <= 0) {//Could not find user
        header('Location: /login/resetPass.php?stat=resetPassF');
        exit();
    }else{
        $stmt = $conn->prepare("SELECT resetTimer FROM `UserAccounts` WHERE resetToken=?");
        $stmt->bind_param("s", $resetToken);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($time);
        $stmt->fetch(); //Actually fetches the data to place in bind_result
        $stmt->close();
        if(!($time <= $timeLimit + time())) {//Checks if it is within the time limit (30 mins)
            //Past time limit
            $conn->close();
            header('Location: /login/forgotPass.php?stat=resetPassT');
        }
        $stmt = $conn->prepare("UPDATE `UserAccounts` SET password=? WHERE resetToken=?"); //Update the user accounts table and set the new password where the reset token matches (we already know it exists from previous check)
        $phash = password_hash($pword, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt->bind_param("ss", $phash, $resetToken);
        if($verified == 1) {            
            $stmt->execute();
            $stmt->close();
            $stmt = $conn->prepare("UPDATE `UserAccounts` SET resetToken = NULL WHERE username=?");//Reset token to null
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $stmt->close();
        }else{
            header('Location: /login/resetPass.php?stat=resetPassG');
        }
        $conn->close();
        header('Location: /login/login.php?stat=resetPassS');
    }
}
?>