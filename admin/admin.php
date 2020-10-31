<?php
header_remove();
session_start();
if (isset($_SESSION["login"]) && (isset($_SESSION["admin"]))) { // Checks if Session is up(user has logged in)
    $statusSet = isset($_GET['stat']);
    $statusVal = "";
    if($statusSet) {
        $statusVal = $_GET['stat'];
    }
}else{
    header('Location: /regular.php?stat=notA');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Admin Page</title>
    <script src="/js/toggle.js"></script>
    <script src="/js/disableSame.js"></script>
    <script src="/js/printStat.js"></script>
</head>
<?php
if(!$statusSet) : ?>
<body>
<?php else : ?>
    <body onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
    <button onclick="toggle('menuOfferings')">Show Menu Offerings</button>
    <button onclick="toggle('customAdd')">Show Custom Add</button>
    <hr>
    <p id='statusBox'></p>
    <div id="menuOfferings" style="display: none;">
        <fieldset>
            <legend>Menu Offerings</legend>
            <table border="1">
                    <tr>
                        <td><label>Item Name </label></td>
                        <td><label>Price </label></td>
                        <td><label>Vegetarian</td>
                        <td><label>Gluten Free</label></td>
                        <td><label>Custom ID</label></td>
                    </tr>
                    <tr>
            <?php
                $servername = "localhost";
                $username = "id15127505_soen287dev";
                $password = "{42m6ad#Ib[gr_vI";
                $dbname = "id15127505_soen287database";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                //No need for prepared statements since no input
                $query = "SELECT * FROM `Menu`";

                if ($result = $conn->query($query)) {

                    /* fetch associative array */
                    while ($row = $result->fetch_assoc()) {
            ?>
                <td><p><?php echo $row["productName"]?></p></td>
                <td><p><?php echo $row["cost"]?></p></td>
                <td><p><?php echo ($row["isVeg"] == 1)? "Yes" : "No"?></p></td>
                <td><p><?php echo ($row["isGf"] == 1)? "Yes" : "No" ?></p></td>
                <td><p><?php echo (is_null($row["customId"])) ? "None" : $row["customId"]?></p></td>
            <?php }

                    /* free result set */
                    $result->free();
                }
                $conn->close();
            ?>
            </tr>
            </table>
            <fieldset>
                <legend>Add Menu Item</legend>
            <form name="menuOfferingsAdd" method="POST" action="menuOfferAdd.php">
                <table>
                    <tr>
                        <td><label>Item Name: </label></td>
                        <td><label>Price: </label></td>
                        <td><label>Customization Options</td>
                        <td><label>Vegetarian</label></td>
                        <td><label>Gluten Free</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" id="itemName" name="itemName" placeholder="Item Name" required></td>
                        <td><input type="number" id="itemCost" name="itemCost" placeholder="Item Cost" required></td>
                        <td><input class="center" type="checkbox" id="customOptions" name="customOptions" value="true"></td>
                        <td><input class="center" type="checkbox" id="vegetarian" name="vegetarian" value="true" ></td>
                        <td><input class="center" type="checkbox" id="glutenFree" name="glutenFree" value="true" ></td>
                    </tr>
                </table>
                <button type="submit">Add to Menu</button>
                <button type="reset">Clear Form</button>
            </form>
            </fieldset>
            <fieldset>
                <legend>Edit Menu Item</legend>
            <form name="editMenuOffering" method="POST" action="editMenuOffer.php">
            <table>
                    <tr>
                        <td><label>Item Name: </label></td>
                        <td><label>Price: </label></td>
                        <td><label>Customization Id (Leave empty if none)</td>
                        <td><label>Vegetarian</label></td>
                        <td><label>Gluten Free</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" id="itemName" name="itemName" placeholder="Item Name" required></td>
                        <td><input type="number" id="itemCost" name="itemCost" placeholder="Item Cost" required></td>
                        <td><input class="center" type="text" name="customId" id="customId" placeholder="Custom Id"></td>
                        <td><input class="center" type="checkbox" id="vegetarian" name="vegetarian" value="true"></td>
                        <td><input class="center" type="checkbox" id="glutenFree" name="glutenFree" value="true"></td>
                    </tr>
                </table>
                <button type="submit">Edit Item</button>
                <button type="reset">Clear Form</button>
            </form>
            </fieldset>
            <fieldset>
                <legend>Delete Items</legend>
                <form name="deleteMenuOffering" method="POST" action="deleteMenuOffer.php">
                    <table>
                        <tr>
                            <td><label>Item Name: </label></td>
                        </tr>
                        <tr>
                            <td><input class="center" id="itemName" name="itemName" placeholder="Item Name" required></td>
                        </tr>
                    </table>
                    <button type="submit">Delete Item</button>
                    <button type="reset">Clear Form</button>
                </form>
            </fieldset>
        </fieldset>
    </div>

    <div id="customAdd" style="display: none;">
        <fieldset>
            <legend>Custom Options Offerings</legend>
            <table border="1">
                    <tr>
                        <td><label>Custom ID</label></td>
                        <td><label>Option 1</td>
                        <td><label>Option 2</td>
                        <td><label>Option 3</td>
                        <td><label>Option 4</td>
                        <td><label>Option 5</td>
                        <td><label>Option 6</td>
                    </tr>
                    <tr>
            <?php
                $servername = "localhost";
                $username = "id15127505_soen287dev";
                $password = "{42m6ad#Ib[gr_vI";
                $dbname = "id15127505_soen287database";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                //No need for prepared statements since no input
                $query = "SELECT * FROM `CustomizationOptions`";
                if ($result = $conn->query($query)) {

                    /* fetch associative array */
                    while ($row = $result->fetch_assoc()) {
            ?>
                <td><p><?php echo $row["customId"]?></p></td>
                <td><p><?php echo (is_null($row["customId"])) ? "None" : $row["customId"]?></p></td>
                <td><p><?php echo (is_null($row["customOption1"])) ? "None" : $row["customOption1"]?></p></td>
                <td><p><?php echo (is_null($row["customOption2"])) ? "None" : $row["customOption2"]?></p></td>
                <td><p><?php echo (is_null($row["customOption3"])) ? "None" : $row["customOption3"]?></p></td>
                <td><p><?php echo (is_null($row["customOption4"])) ? "None" : $row["customOption4"]?></p></td>
                <td><p><?php echo (is_null($row["customOption5"])) ? "None" : $row["customOption5"]?></p></td>
                <td><p><?php echo (is_null($row["customOption6"])) ? "None" : $row["customOption6"]?></p></td>
            <?php }

                    /* free result set */
                    $result->free();
                }
                $conn->close();
            ?>
            </tr>
            </table>
            <fieldset>
                <legend>Add Custom Option</legend>
                <form name="customOptionAdd" method="POST" action="customOptionAdd.php">
                    <table>
                        <tr>
                            <td><label>Custom ID:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="customId" id="customId" placeholder="Custom ID" required></td>
                        </tr>
                        <tr>
                            <td><label>Custom Option 1:</label></td>
                            <td><label>Custom Option 2:</label></td>
                            <td><label>Custom Option 3:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="customOption1" id="customOption1" placeholder="Option 1" required></td>
                            <td><input type="text" name="customOption2" id="customOption2" placeholder="Option 2" required></td>
                            <td><input type="text" name="customOption3" id="customOption3" placeholder="Option 3" required></td>
                        </tr>
                        <tr>
                            <td><label>Custom Option 4:</label></td>
                            <td><label>Custom Option 5:</label></td>
                            <td><label>Custom Option 6:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="customOption4" id="customOption4" placeholder="Option 4" required></td>
                            <td><input type="text" name="customOption5" id="customOption5" placeholder="Option 5" required></td>
                            <td><input type="text" name="customOption6" id="customOption6" placeholder="Option 6" required></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </fieldset>
    </div>
</body>

</html>