<?php
//Get the reset token from the URL and use hidden input to pass it to script
$resetTokenSet = isset($_GET['token']);
$resetToken = "";
$statusSet = isset($_GET['stat']);
$statusVal = "";
if($resetTokenSet) {
    $resetToken = $_GET['token'];
}

if($statusSet) {
    $statusVal = $_GET['stat'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="/style.css">
    <script src="/js/signup.js"></script>
    <script src="/js/printStat.js"></script>
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf8pNkZAAAAAKemZhCtJS5RGbXu-1cYGbmNCker"></script>
    <script src="/js/googleRecaptcha.js"></script>
</head>

<?php
if(!$statusSet) : ?>
<body>
<?php else : ?>
    <body onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
<?php include("../navBar/navBar.php")?>
<p id='statusBox'></p>
    <form name="resetPasswordForm" method="POST" action="resetPassScript.php">
        <table>
            <tr>
                <td><label>New Password: </label></td>
                <td><input id="password" TYPE='password' Name='password' maxlength="16" required></td>
            </tr>
            <tr>
                <td><label>Confirm New Password: </label></td>
                <td><input id="reConfirmPassword" TYPE='password' Name='reConfirmPassword' maxlength="16" required oninput="checkPassword()"></td>
            </tr>
        </table>
        <p id="message"></p>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <input type="hidden" name="reset_token" id="reset_token" value="<?php echo $resetToken ?>">
        <button id="submit" type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>
    <a href="login.php">Login</a>
    <a href="signup.php">Signup</a>
</body>

</html>