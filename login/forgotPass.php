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
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf8pNkZAAAAAKemZhCtJS5RGbXu-1cYGbmNCker"></script>
    <script src="/js/googleRecaptcha.js"></script>
    <script src="/js/printStat.js"></script>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="login.css?v=1.1">
    <title>Forgot Password</title>
</head>

<?php
if(!$statusSet) : ?>
<body class="login">
<?php else : ?>
    <body class="login" onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
<div class="login-page"> 
    <form name='forgotPassForm' method="POST" action="forgotPassScript.php">
        <h1>Forgot Password</h1>     
        <input type="email" name="email" id='email' placeholder="Email" required>
        <p id="message"></p>
        <p class="status-message" id='statusBox'></p>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
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