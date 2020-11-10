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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "id15127505_soen287dev";
    $password = "{42m6ad#Ib[gr_vI";
    $dbname = "id15127505_soen287database";

    $pword = $_POST['password'];
    $resetToken = $_POST['reset_token'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM `UserAccounts` where resetToken=?");
    $stmt->bind_param("s", $resetToken);
    $stmt->execute();
    $stmt->store_result();
    $result = $stmt->num_rows;
    $stmt->close();
    if($result <= 0) {//Could not find user
        header('Location: /login/resetPass.php?stat=resetPassF');
        exit();
    }else{
        $stmt = $conn->prepare("UPDATE `UserAccounts` SET password=? WHERE resetToken=?"); //Update the user accounts table and set the new password where the reset token matches (we already know it exists from previous check)
        $phash = password_hash($pword, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt->bind_param("ss", $phash, $resetToken);
        if($verified == 1) {            
            $stmt->execute();
        }else{
            header('Location: /login/resetPass.php?stat=resetPassG');
        }
        $stmt->close();
        $conn->close();
        header('Location: /login/login.php?stat=resetPassS');
    }
}
?>