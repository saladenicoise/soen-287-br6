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
                                <th>Item Name</th>
                                <th>Item Price</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $query = "SELECT * FROM `ordertable` WHERE username=" . $_SESSION["username"] . ";";

                            if ($result = $conn->query($query)) {
                                $pname = "";
                                $price = 0;
                                /* fetch associative array */
                                while ($row = $result->fetch_assoc()) {
                                    $stmt = $conn->prepare("SELECT productName, cost FROM `Menu` WHERE productID=?");
                                    $stmt->bind_param('s', $row["Item_ID"]);
                                    $stmt->execute();
                                    $stmt->store_result();
                                    $stmt->bind_result($pname, $price);
                                    $stmt->fetch();
                                    $stmt->close();
                        ?>
                                        <td>
                                            <?php echo $row["Order_ID"]?>
                                        </td>
                                        <td>
                                            <?php echo $pname?>
                                        </td>
                                        <td>
                                            <?php echo $price?>
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
                </div>
                </div>
        </body>
    </html>