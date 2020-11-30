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
    <link rel="stylesheet" href="login.css">
    <script src="/js/signup.js"></script>
    <script src="/js/printStat.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf8pNkZAAAAAKemZhCtJS5RGbXu-1cYGbmNCker"></script>
    <script src="/js/googleRecaptcha.js"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</head>

<?php
if(!$statusSet) : ?>
<body class="login">
<?php else : ?>
    <body class="login" onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
<div class="login-page"> 
    <form name="resetPasswordForm" method="POST" action="resetPassScript.php">
        <h1>Reset Password</h1>
        <input id="password" TYPE='password' Name='password' maxlength="16" required placeholder="Password">
        <a class="password-toggle" onclick="togglePass(); toggleDisp();"><span id="eyeIconSlash" style="display: none;" class="iconify icon:fa-eye-slash icon-inline:false"></span><span id="eyeIcon" class="iconify icon:fa-eye icon-inline:false"></span></a>    
        <input id="reConfirmPassword" TYPE='password' Name='reConfirmPassword' maxlength="16" required oninput="checkPassword()" placeholder="Confirm">
        <p id="message"></p>
        <p id='statusBox'></p>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <input type="hidden" name="reset_token" id="reset_token" value="<?php echo $resetToken ?>">
        <button class="sub-button" id="submit" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        <a class="link" href="login.php">Login</a>
        <br>
        <a class="link" href="signup.php">Signup</a>
        <br>
        <a class="link" href="/mainPage/mainPage.php">Main Page</a>
    </form>
</div>
</body>

</html>