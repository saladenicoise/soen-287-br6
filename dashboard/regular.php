<?PHP
header_remove();
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
        <link rel="stylesheet" href="dashboard.css">
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
                <div class="center">
                    <div class="item">
                        <h1>Welcome
                            <?php echo $_SESSION["username"];?>
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
                    <div class="item">
                        <h2>Order Details</h2>
                    </div>
                    <div class="item">
                        <form class="form" name="orderID" method="POST" action="">
                            <label>Please enter your Order ID</label> <input name="ID" required> </input> <button name="post" value="orderDetails" type="submit">Get Order Details</button>
                        </form>
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
                                print "<th>Vegetarian</th>";
                                print "<th>Gluten Free</th>";
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
                                print "<td><p>". $isVeg ."</p></td>";
                                print "<td><p>".$isGf."</p></td>";
                            
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
                                                <button name="post" value="removeBook" class="delButton" type="submit"><i class="iconify icon:mdi:trash-can-outline icon-inline:false"></i></button>
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


                }
                ?>
                <div class="item">
                    <h2>Adding Bookings</h2>
                </div>
                <form method="POST" action="">
                    <div class="item">
                        <label>Due DateTime:</label><input name="datetime" type="datetime-local" required> </input>
                    </div>
                    <div class="item">
                        <label>Reminder DateTime:</label><input name="remind" type="datetime-local" required> </input>
                    </div>
                    <div class="item">
                        <button class="addbtn" name="post" value="addBook" type="submit">+</button>
                    </div>
                </form>
                <?php
                 if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["post"] == "addbtn") {
                    $msg="hello here";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
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


                    $stmt = $conn->prepare("INSERT INTO `bookings` (username, due_date, reminder_date) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param('sss', $userID,  $due_date, $reminder_date); 
                    $stmt->execute(); //Executes the query
                    $stmt->close();


                }
                ?>
        </body>
    </html>

    