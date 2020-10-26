<?PHP
header_remove(); 
session_start();
if (isset($_SESSION["login"])) { // Checks if Session is up(user has logged in)
    $statusSet = isset($_GET['stat']);
    $statusVal = "";
    if($statusSet) {
        $statusVal = $_GET['stat'];
    }
}else{
    header('Location: /login/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged In!</title>
    <script src="/js/printStat.js"></script>
    <link rel="stylesheet" href="/style.css">
</head>

<?php
if(!$statusSet) : ?>
<body>
<?php else : ?>
    <body onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
    <h1>You are here if you are logged in!</h1>
    <p id='statusBox'></p>
    <button onclick="location.href='/admin/admin.php'">Goto Admin Page (Only authorised users!)</button>
    <form action="/login/logoutScript.php">
        <button type="submit">Log Out</button>
    </form>
</body>

</html>