<?php
if (isset($_SESSION["login"]) && $_SESSION["login"] != '') { // Checks if Session is up(user has logged in)
    header('Location: /regular.php');
    exit();
}
$statusSet = isset($_GET['stat']);
$statusVal = "";
if($statusSet) {
    $statusVal = $_GET['stat'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Login</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf8pNkZAAAAAKemZhCtJS5RGbXu-1cYGbmNCker"></script>
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <script src="/js/googleRecaptcha.js"></script>
    <script src="/js/printStat.js"></script>
</head>

<?php
if(!$statusSet) : ?>
<body>
<?php else : ?>
    <body onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
<?php include("../navBar/navBar.php")?>
    <form name="loginForm" method="POST" action="loginScript.php">
        <h1>Login Form</h1>
        <p id='statusBox'></p>
        <table>
            <tr>
                <td><label>Username: </label></td>
                <td><input id="username" TYPE='text' Name='username' maxlength="20" required></td>
            </tr>
            <tr>
                <td><label>Password: </label></td>
                <td><input id="password" TYPE='password' Name='password' maxlength="16" required></td>
            </tr>
        </table>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
        <br>
        <a href="signup.php">Sign-Up</a>
        <a href="forgotPass.php">Forgot Password</a>
    </form>
</body>

</html>