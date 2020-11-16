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
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <title>Forgot Password</title>
</head>

<?php
if(!$statusSet) : ?>
<body>
<?php else : ?>
    <body onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
<?php include("../navBar/navBar.php")?>
<p id='statusBox'></p>
    <form name='forgotPassForm' method="POST" action="forgotPassScript.php">
        <table>
            <tr>
                <td><label>Email: </label></td>
                <td><input type="email" name="email" id='email' required></td>
            </tr>
        </table>
        <p id="message"></p>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <button id="submit" type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>
    <a href="login.php">Login</a>
    <a href="signup.php">Signup</a>
</body>

</html>