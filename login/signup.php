<?php
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
    <link rel="stylesheet" href="login.css">
    <title>Sign-Up</title>
    <script src="/js/signup.js"></script>
    <script src="/js/printStat.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf8pNkZAAAAAKemZhCtJS5RGbXu-1cYGbmNCker"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="/js/googleRecaptcha.js"></script>
</head>

<?php
if(!$statusSet) : ?>
<body class="login">
<?php else : ?>
    <body class="login" onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
<div class="login-page">   
    <form name="signupForm" method="POST" action="signupScript.php">
        <h1>Sign-Up Page</h1>
        <input id="username" TYPE='text' Name='username' maxlength="20" placeholder="Username" required>
        <input id="email" type="email" name='email' placeholder="Email" required>
        <input class="password" id="password" TYPE='password' Name='password' maxlength="16" placeholder="Password" required>
        <a class="password-toggle" onclick="togglePass(); toggleDisp();"><span id="eyeIconSlash" style="display: none;" class="iconify icon:fa-eye-slash icon-inline:false"></span><span id="eyeIcon" class="iconify icon:fa-eye icon-inline:false"></span></a>    
        <input id="reConfirmPassword" TYPE='password' Name='reConfirmPassword' maxlength="16" placeholder="Confirm" required oninput="checkPassword()">
        <p id="message"></p>
        <p class="status-message" id='statusBox'></p>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <button class="sub-button" id="submit" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        <br>
        <a class="link" href="login.php">Login</a>
        <br>
        <a class="link" href="forgotPass.php">Forgot Password</a>
        <br>
        <a class="link" href="/mainPage/mainPage.php">Main Page</a>
    </form>
</did>
</body>

</html>