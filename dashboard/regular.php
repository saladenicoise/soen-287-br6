<!-- added styling -->
<?PHP
header_remove();
error_reporting(0);
session_start();
$servername = 'localhost';
$username = 'dev';
$password = 'dev';
$dbname = 'soen287final';
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
        <title>Dashboard</title>
        <script src="/js/printStat.js"></script>
        <link rel="stylesheet" href="dashboard.css?v=1.1">
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    </head>

    <nav>
        <ul>
        <a href='/admin/admin.php#menu'><li>Admin</li></a>
            <a href='/mainPage/mainPage.php'><li>Main Menu</li></a>
            <a href="/login/logoutScript.php"><li class="right"><i class="iconify" data-icon="mdi:logout" data-inline="true"></i>Logout</li></a>
        </ul>
    </nav>

    <?php
    if(!$statusSet) : ?>
        <body>
    <?php else : ?>
        <body onload="printStatus('<?php echo $statusVal;?>')">
            <?php endif; ?>
                <div class="center fadeIn">
                    <div class="item">
                        <h1>Welcome 
                        <span id = "welcome"> 
                            <?php echo $_SESSION["username"];?>
                        </span>
                        </h1>
                    </div>
                    <div class="item">
                        <p id='statusBox'></p>
                    </div>
                    <div class="item">
                        <h2>Previous Orders</h2>
                    </div>
                    <div class="item">
                        <table>
                            <thead>
                                <th>Order ID</th>
                                <th>Number of Items</th>
                                <th>Total Cost</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $conn = new mysqli($servername, $username, $password, $dbname);

                                        $userID = $_SESSION["username"];
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        //No need for prepared statements since no input
                                        $query = "SELECT * FROM `ordertable` WHERE username='$userID'";

                                        if ($result = $conn->query($query)) {

                                            /* fetch associative array */
                                            while ($row = $result->fetch_assoc()) {

                                        ?>
                                        <td><p><?php echo $row["Order_ID"]?></p></td>
                                        <td><p><?php echo $row["totalItems"]?></p></td>
                                        <td><p>$<?php echo $row["totalCost"]?></p></td>
                                        </tr>
                                        <?php }

                                /* free result set */
                                $result->free();
                            }
                            $conn->close();
                        ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- order details -->
                    <br><br><br><br>
                    
                    <div class="item1">
                        <form class="form" name="orderID" method="POST" action="">
                        <h2 class = "info"> Order Details</h2>
                            
                            <label>Enter your Order ID:  <input name="ID" required> </input> <button id = "getInfobtn" name="post" value="orderDetails" type="submit">Get Details</button>
                        </form>
                        <br><br>
                    </div>
                    
                    <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["post"] == "orderDetails") {


                            require('../configure.php');
                            $servername = DB_SERVER;
                            $username = DB_USER;
                            $password = DB_PASS;
                            $dbname = DB_NAME;

                            $orderID = $_POST["ID"];
                            $userID = $_SESSION["username"];

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            $query = "SELECT * FROM `orderitemtable` WHERE username='$userID' AND Order_ID='$orderID'";

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            
                             //No need for prepared statements since no input
                             $query = "SELECT * FROM `orderitemtable` WHERE username='$userID' AND Order_ID='$orderID'";

                             if ($result = $conn->query($query)) {
                        
                                //create the table
 
                                print "<table>";
                                print "<thead>";
                                print "<th>Order ItemID</th>";
                                print "<th>Product Name</th>";
                                print "<th>Cost</th>";
                                print "<th>Size</th>";
                                print "<th>Quantity</th>";
                                print "</thead>";
                                print "<tbody>";
                                print "<tr>";

                                while ($row = $result->fetch_assoc()) {

                                if($row["isVeg"] == 1)
                                {
                                    $isVeg = "Yes";
                                }
                                else {
                                    $isVeg = "No";
                                }

                                if($row["isGf"] == 1)
                                {
                                    $isGf= "Yes";
                                }
                                else {
                                    $isGf = "No";
                                }


                                print "<td><p>".$row["Order_Item_ID"]."</p></td>";
                                print "<td><p>".$row["productName"]."</p></td>";
                                print "<td><p>$". $row["cost"] . "</p></td>";
                                print "<td><p>".$row["product_size"]."</p></td>";
                                print "<td><p>".$row["quantity"]."</p></td>";
                            
                                print "</tr>";
                                }
                                $result->free();
                                print "</tbody>";
                                print "</table>";
                            
                                
                            }
                            $conn->close();
                        }

                    ?>
                </div>
                <div class="fadeIn">
                <div class="item">
                    <h2>Bookings</h2>
                </div>
                <div class="item">
                    <table>
                            <thead>
                                <th>Booking ID</th>
                                <th>Creation Date</th>
                                <th>Due Date</th>
                                <th>Reminder</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $conn = new mysqli($servername, $username, $password, $dbname);

                                        $userID = $_SESSION["username"];
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        //No need for prepared statements since no input
                                        $query = "SELECT * FROM `bookings` WHERE username='$userID'";

                                        if ($result = $conn->query($query)) {

                                            /* fetch associative array */
                                            while ($row = $result->fetch_assoc()) {

                                        ?>
                                        <td><p><?php echo $row["Book_ID"]?></p></td>
                                        <td><p><?php echo $row["creation_date"]?></p></td>
                                        <td><p><?php echo $row["due_date"]?></p></td>
                                        <td><p><?php echo $row["reminder_date"]?></p></td>
                                        <td>
                                            <form class="del" action="" method="post">
                                                <input type="hidden" value=<?php echo "\"" . $row["Book_ID"] . "\""?> name="delete" id="delete">
                                                <button name="post" value="removeBook" class="delButton" type="submit"><i class="iconify icon:mdi:trash-can-outline icon-inline:false"></i> </button>
                                            </form>
                                        </td>
                                </tr>
                                        <?php }

                                /* free result set */
                                $result->free();
                            }
                            $conn->close();
                        ?>
                            </tbody>
                        </table>
                </div>

                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["post"] == "removeBook") {
                    require('../configure.php');
                    $servername = DB_SERVER;
                    $username = DB_USER;
                    $password = DB_PASS;
                    $dbname = DB_NAME;
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $ID = $_POST['delete'];
                    $stmt = $conn->prepare("DELETE FROM `bookings` WHERE Book_ID=?");
                    $stmt->bind_param('i', $ID); //Binds the parameter $ID of the form to the query
                    $stmt->execute(); //Executes the query
                    $stmt->close();

                    echo("<meta http-equiv='refresh' content='0'>");
                }
                ?>

                <br><br>

                <div class="item1">    
                    <h2 class = "info">Adding Bookings</h2>
                </div>  
                <form method="POST" action="">
                    <div class="item1">    
                        <label>Due DateTime:  <br>
                        <input id = "date" name="datetime" type="datetime-local" required> </input> <br> 
                        <label>Reminder DateTime: <br>
                        <input id = "date" name="remind" type="datetime-local" required> </input>
                        <br> <br>
                        <button  class = "addbtn" name="post" value="addbtn" type="submit">+</button>
                    <br><br>
                    </div>
                </form>
                <?php
                 use PHPMailer\PHPMailer\PHPMailer;
                 use PHPMailer\PHPMailer\SMTP;

                 if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["post"] == "addbtn") {
                    
                    require('../configure.php');
                    $servername = DB_SERVER;
                    $username = DB_USER;
                    $password = DB_PASS;
                    $dbname = DB_NAME;

                    $userID = $_SESSION['username'];
                    $due_date = $_POST['datetime'];
                    $reminder_date = $_POST['remind'];

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }


                    $stmt = $conn->prepare("INSERT INTO `bookings` (username, due_date, reminder_date) VALUES (?, ?, ?)");
                    $stmt->bind_param('sss', $userID,  $due_date, $reminder_date); 
                    $stmt->execute(); //Executes the query
                    $stmt->close();

                    
                    echo("<meta http-equiv='refresh' content='0'>");


                   //get the email address of the user
                    $conn = new mysqli($servername, $username, $password, $dbname);

                                        $userID = $_SESSION["username"];

                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        //No need for prepared statements since no input
                                        $query = "SELECT * FROM `useraccounts` WHERE username='$userID'";

                                        if ($result = $conn->query($query)) {

                                            $row = $result->fetch_assoc();

                                            $email = $row['email'];

                                            //SMTP needs accurate times, and the PHP time zone MUST be set
                                            //This should be done in your php.ini, but this is how to do it if you don't have access to that
                                            date_default_timezone_set('Etc/UTC');

                                            require '../cart_checkout/PHPMailerTemplate/vendor/autoload.php';

                                            //Create a new PHPMailer instance
                                            $mail = new PHPMailer;
                                            //Tell PHPMailer to use SMTP
                                            $mail->isSMTP();
                                            //Enable SMTP debugging
                                            //SMTP::DEBUG_OFF = off 
                                            //SMTP::DEBUG_CLIENT = client messages
                                            //SMTP::DEBUG_SERVER = client and server messages
                                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                            //Set the hostname of the mail server (We will be using GMAIL)
                                            $mail->Host = 'smtp.gmail.com';
                                            //Set the SMTP port number - likely to be 25, 465 or 587
                                            $mail->Port = 587;
                                            //Whether to use SMTP authentication
                                            $mail->SMTPAuth = true;

                                            //Username to use for SMTP authentication
                                            $mail->Username = 'bens51035@gmail.com';
                                            //Password to use for SMTP authentication
                                            $mail->Password = '12345678BEbe!';
                                            //Set who the message is to be sent from
                                            $mail->setFrom('bens51035@gmail.com', 'Maison De Chef Team');
                                            //Set an alternative reply-to address
                                            //$mail->addReplyTo('replyto@example.com', 'First Last');
                                            //Set who the message is to be sent to email and name
                                            $mail->addAddress($email);
                                            //Name is optional
                                            //$mail->addAddress('recepientid@domain.com');

                                            //You may add CC and BCC
                                            //$mail->addCC("recepient2id@domain.com");
                                            //$mail->addBCC("recepient3id@domain.com");

                                            $mail->isHTML(true);

                                            //Set the subject line
                                            $mail->Subject = 'Your booking for catering';
                                            //Read an HTML message body from an external file, convert referenced images to embedded,
                                            //convert HTML into a basic plain-text alternative body
                                            $mailContent = "<h1>Dear ". $userID . "</h1>" . 
                                                            "<p>You have set a catering booking for ". $due_date . "</p>".
                                                            "<p>You have set a reminder for ". $reminder_date . " please mark it in your calendar </p>" .
                                                            "<p>Best Regards,</p>" .  "<p>Gmail Admin</p>";
                                            $mail->Body = $mailContent;
                                            
                                            //You may add plain text version using AltBody
                                            //$mail->AltBody = "This is the plain text version of the email content";
                                            //send the message, check for errors
                                            if (!$mail->send()) {
                                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                                            } else {
                                                echo 'Message was sent Successfully!';
                                            }


                                            exit();
                                        }
                                        
                }
                ?>
                </div>
        </body>
    </html>

    