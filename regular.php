<?PHP
header_remove(); 
session_start();
if (isset($_SESSION["login"])) { // Checks if Session is up(user has logged in)
}else{
    header('Location: /login/login.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged In!</title>
</head>

<body>
    <h1>You are here if you are logged in!</h1>
    <form action="/login/logout.php">
        <button type="submit">Log Out</button>
    </form>
</body>

</html>