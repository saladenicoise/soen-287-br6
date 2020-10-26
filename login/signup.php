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
    <title>Sign-Up</title>
    <script src="/js/signup.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf8pNkZAAAAAKemZhCtJS5RGbXu-1cYGbmNCker"></script>
    <script src="/js/googleRecaptcha.js"></script>
</head>

<?php
if(!$statusSet) : ?>
<body>
<?php else : ?>
    <body onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
    <form name="signupForm" method="POST" action="signupScript.php">
        <h1>Sign-Up Page</h1>
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
            <tr>
                <td><label>Confirm Password: </label></td>
                <td><input id="reConfirmPassword" TYPE='password' Name='reConfirmPassword' maxlength="16" required oninput="checkPassword()"></td>
            </tr>
        </table>
        <p id="message"></p>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <button id="submit" type="submit">Submit</button>
        <button type="reset">Reset</button>
        <br>
        <a href="login.html">Login</a>
    </form>
</body>

</html>