<?PHP
header_remove();
session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $verified = 0;

//Google ReCaptcha Code
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6Lf8pNkZAAAAAKyaVxvVn4K0ZkLQh3oENiiao4-7';
    $recaptcha_response = $_POST['recaptcha_response'];
    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    // Take action based on the score returned:
    if ($recaptcha->score >= 0.6) {
        $verified = 1;
    }
}

$uname = "";
$pword = "";
$errorMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require('../configure.php'); 
    $servername = DB_SERVER;
    $username = DB_USER;
    $password = DB_PASS;
    $dbname = DB_NAME;

        $uname = test_input($_POST['username']);
        $pword = $_POST['password'];

        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $SQL = $conn->prepare("SELECT * FROM `UserAccounts` WHERE username=?");
        $SQL->bind_param('s', $uname); //Binds the parameter $uname to the query
	    $SQL->execute(); //Executes the query
	    $SQL->store_result(); //Stores the results of the query
        $result = $SQL->num_rows; //Get the result of the query, the rows which return true aka 1 row where the uname was the same as the given username
        $SQL->close();
        if ($result == 1) { //Makes sure the user actually exists
            $stmt = $conn->prepare("SELECT password, isAdmin FROM `UserAccounts` WHERE username=?");
            $stmt->bind_param('s', $uname);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($hash, $isAdmin); //Gets the hash of the password, never the ACTUALL PASSWORD!!!!
            $fetchRes = $stmt->fetch();
            $stmt->close();
            if (password_verify($pword, $hash) && $fetchRes) { //Does the password match the hash of the password
                $_SESSION["login"] = "1";
                $_SESSION["username"] = $uname;
                if($isAdmin === 1) {
                    $_SESSION["admin"] = "1";
                }
                $errorMessage = "You have been logged in!";
                if($verified == 1) {
                    header('Location: /dashboard/regular.php');
                }else{

                    header('Location: /login/login.php?stat=loginG');
                }
                exit();
            }else{
                $errorMessage = "Login FAILED";
                header('Location: /login/login.php?stat=loginF');
                exit();
            }

        }else{
            $errorMessage = "Username or Password is invalid! Please try again!       ";
            header('Location: /login/login.php?stat=loginF');
        }
}
?>