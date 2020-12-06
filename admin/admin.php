<?php
header_remove();
session_start();
require('../configure.php');
$servername = DB_SERVER;
$username = DB_USER;
$password = DB_PASS;
$dbname = DB_NAME;
if (isset($_SESSION["login"]) && (isset($_SESSION["admin"]))) { // Checks if Session is up(user has logged in)
    $statusSet = isset($_GET['stat']);
    $statusVal = "";
    if($statusSet) {
        $statusVal = $_GET['stat'];
    }
}else{
    header('Location: ../dashboard/regular.php?stat=notA');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="/js/disableSame.js"></script>
    <script src="/js/printStat.js"></script>
</head>

<nav>
    <a href="#menu">
        <i class="iconify icon:mdi:text-box-plus-outline icon-inline:false"></i>
    </a>
    <a href="#customization">
        <i class="iconify icon:mdi:tag-plus-outline icon-inline:false"></i>
    </a>
    <a href="#contactUs">
        <i class="iconify icon:mdi:email-outline icon-inline:false"></i>
    </a>
    <a onclick="location.href='/dashboard/regular.php'">
        <i class="iconify icon:mdi:account icon-inline:false"></i>
    </a>
</nav>
<?php
    if(!$statusSet) : ?>
<body>
<?php else : ?>
<body onload="printStatus('<?php echo $statusVal;?>')" >
<?php endif; ?>
    <script>
        function toggle(id) {
            this.add = document.getElementById('add');
            this.edit = document.getElementById('edit');
            this.delete = document.getElementById('delete');
            this.cAdd = document.getElementById('cAdd');
            this.cEdit = document.getElementById('cEdit');
            this.cDelete = document.getElementById('cDelete');
            if (id === "add") {
                this.delete.style.visibility = "hidden";
                this.edit.style.visibility = "hidden";
                this.add.style.visibility = "visible";
            }
            if (id === "edit") {
                this.delete.style.visibility = "hidden";
                this.add.style.visibility = "hidden";
                this.edit.style.visibility = "visible";
            }
            if (id === "delete") {
                this.edit.style.visibility = "hidden";
                this.add.style.visibility = "hidden";
                this.delete.style.visibility = "visible";
            }
            if (id === "cAdd") {
                this.cDelete.style.visibility = "hidden";
                this.cEdit.style.visibility = "hidden";
                this.cAdd.style.visibility = "visible";
            }
            if (id === "cEdit") {
                this.cDelete.style.visibility = "hidden";
                this.cAdd.style.visibility = "hidden";
                this.cEdit.style.visibility = "visible";
            }
            if (id === "cDelete") {
                this.cEdit.style.visibility = "hidden";
                this.cAdd.style.visibility = "hidden";
                this.cDelete.style.visibility = "visible";
            }

        }
    </script>
    <div class="admin-container">
        <div class="parent-container" id="menu">
            <div class="fadeIn item">
                <table class="fadeIn">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Item Name </th>
                            <th>Price </th>
                            <th>Vegetarian</th>
                            <th>Gluten Free</th>
                            <th>Custom ID</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
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
                            <td><?php echo $row["productID"]?></td>
                            <td><?php echo $row["productName"]?></td>
                            <td><?php echo $row["cost"]?></td>
                            <td><?php echo ($row["isVeg"] == 1)? "Yes" : "No"?></td>
                            <td><?php echo ($row["isGf"] == 1)? "Yes" : "No" ?></td>
                            <td><?php echo (is_null($row["customId"])) ? "None" : $row["customId"]?></td>
                            <td><?php echo $row["category"]?></td>
                            <td><?php echo $row["subcategory"]?></td>
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
            <div class="fadeIn item">
                <a onclick="toggle('add')" class="option">Add</a>
                <a onclick="toggle('edit')" class="option">Edit</a>
                <a onclick="toggle('delete')" class="option">Delete</a>
            </div>
            <div class="child-parent-container" style="visibility: hidden;">
                <p id='statusBox' class="messageBox"></p>
                <div id="add" class="add fadeIn" style="visibility: visible;">
                    <form class="form" name="menuOfferingsAdd" method="POST" action="menuOfferAdd.php" enctype="multipart/form-data">
                        <h3>Add Menu Item</h3>
                        <input type="text" id="itemName" name="itemName" placeholder="Item Name" required>
                        <input type="number" id="itemCost" name="itemCost" placeholder="Item Cost" required>
                        <p>Customization<input class="center" type="checkbox" id="customOptions" name="customOptions" value="true"></p>
                        <p>Vegetarian<input class="center" type="checkbox" id="vegetarian" name="vegetarian" value="true"></p>
                        <p>Gluten Free<input class="center" type="checkbox" id="glutenFree" name="glutenFree" value="true"></p>
                        <input class="center" type="text" id="category" name="category" placeholder="Category" required>
                        <input class="center" type="text" id="sub-category" name="sub-category" placeholder="Sub-Category" required>
                        <input class="file" type="file" id="picUpload" name="picUpload" required accept="image/*" placeholder="Product Picture">
                        <p>Picture will be resized to 128px x 128px</p>
                        <button type="submit">Add to Menu</button>
                        <button type="reset">Clear Form</button>
                    </form>
                </div>
                <div id="edit" class="edit" style="visibility: hidden;">
                    <form class="form" name="editMenuOffering" method="POST" action="editMenuOffer.php">
                        <h3>Edit Menu Item</h3>
                        <input type="number" id="productID" name="productID" placeholder="Product ID" required>
                        <input type="text" id="itemName" name="itemName" placeholder="Item Name" required>
                        <input type="number" id="itemCost" name="itemCost" placeholder="Item Cost">
                        <input class="center" type="text" name="customId" id="customId" placeholder="Custom Id (Leave empty if none)">
                        <p>Vegatarian<input class="center" type="checkbox" id="vegetarian" name="vegetarian" value="true"></p>
                        <p>Gluten Free<input class="center" type="checkbox" id="glutenFree" name="glutenFree" value="true"></p>
                        <input class="center" type="text" id="category" name="category" placeholder="Category" required>
                        <input class="center" type="text" id="sub-category" name="sub-category" placeholder="Sub-Category" required>
                        <button type="submit">Edit Item</button>
                        <button type="reset">Clear Form</button>
                    </form>
                </div>
                <div id="delete" class="delete" style="visibility: hidden;">
                    <form class="form" name="deleteMenuOffering" method="POST" action="deleteMenuOffer.php">
                        <h3>Delete Menu Item</h3>
                        <input class="center" id="productID" name="productID" placeholder="Product ID" required>
                        <button type="submit">Delete Item</button>
                        <button type="reset">Clear Form</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="parent-container" id="customization">
                <p id='statusBox' class="messageBox"></p>
            <div class="item">
                <table class="fadeIn">
                    <thead>
                        <tr>
                            <th>Custom ID</th>
                            <th>Option 1</th>
                            <th>Option 2</th>
                            <th>Option 3</th>
                            <th>Option 4</th>
                            <th>Option 5</th>
                            <th>Option 6</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
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
                            <td><p><?php echo (is_null($row["customOption1"])) ? "None" : $row["customOption1"]?></p></td>
                            <td><p><?php echo (is_null($row["customOption2"])) ? "None" : $row["customOption2"]?></p></td>
                            <td><p><?php echo (is_null($row["customOption3"])) ? "None" : $row["customOption3"]?></p></td>
                            <td><p><?php echo (is_null($row["customOption4"])) ? "None" : $row["customOption4"]?></p></td>
                            <td><p><?php echo (is_null($row["customOption5"])) ? "None" : $row["customOption5"]?></p></td>
                            <td><p><?php echo (is_null($row["customOption6"])) ? "None" : $row["customOption6"]?></p></td>
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
            <div class="fadeIn item">
                <a onclick="toggle('cAdd')" class="option">Add</a>
                <a onclick="toggle('cEdit')" class="option">Edit</a>
                <a onclick="toggle('cDelete')" class="option">Delete</a>
            </div>
            <div class="child-parent-container" style="visibility: hidden;">
                <div id="cAdd" class="add fadeIn" style="visibility: visible;">
                    <form class="form" name="customOptionAdd" method="POST" action="customOptionAdd.php">
                        <h3>Add Customization Option</h3>
                        <input type="text" name="customId" id="customId" placeholder="Custom ID" required>
                        <input type="text" name="customOption1" id="customOption1" placeholder="Option 1">
                        <input type="text" name="customOption2" id="customOption2" placeholder="Option 2">
                        <input type="text" name="customOption3" id="customOption3" placeholder="Option 3">
                        <input type="text" name="customOption4" id="customOption4" placeholder="Option 4">
                        <input type="text" name="customOption5" id="customOption5" placeholder="Option 5">
                        <input type="text" name="customOption6" id="customOption6" placeholder="Option 6">
                        <button type="submit">Add Customization Options</button>
                        <button type="reset">Clear Form</button>
                    </form>
                </div>
                <div id="cEdit" class="edit" style="visibility: hidden;">
                    <form class="form" name="customOptionAdd" method="POST" action="customOptionAdd.php">
                        <h3>Edit Customization Option</h3>
                        <input type="text" name="customId" id="customId" placeholder="Custom ID" required>
                        <input type="text" name="customOption1" id="customOption1" placeholder="Option 1">
                        <input type="text" name="customOption2" id="customOption2" placeholder="Option 2">
                        <input type="text" name="customOption3" id="customOption3" placeholder="Option 3">
                        <input type="text" name="customOption4" id="customOption4" placeholder="Option 4">
                        <input type="text" name="customOption5" id="customOption5" placeholder="Option 5">
                        <input type="text" name="customOption6" id="customOption6" placeholder="Option 6">
                        <button type="submit">Edit Customization Options</button>
                        <button type="reset">Clear Form</button>
                    </form>
                </div>
                <div id="cDelete" class="delete" style="visibility: hidden;">
                    <form class="form" name="deleteCustom" method="POST" action="deleteCustom.php">
                        <h3>Delete Customization Option</h3>
                        <input type="text" name="customId" id="customId" placeholder="Custom ID" required>
                        <button type="submit">Delete</button>
                        <button type="reset">Clear Form</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="parent-container" id="contactUs">

            <div class="item">
                <table class="fadeIn">
                    <thead>
                        <tr>
                            <th>Form ID</th>
                            <th>Contact Name</th>
                            <th>Phone Number </th>
                            <th>Contact Email</th>
                            <th>Contact Address</th>
                            <th>Contact Subject</th>
                            <th>Contact Message</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            //No need for prepared statements since no input
                            $query = "SELECT * FROM `contactforms`";

                            if ($result = $conn->query($query)) {

                                /* fetch associative array */
                                while ($row = $result->fetch_assoc()) {

                        ?>
                            <td><p><?php echo $row["Form_ID"]?></p></td>
                            <td><p><?php echo $row["contactName"]?></p></td>
                            <td><p><?php echo $row["contactNumber"]?></p></td>
                            <td><p><?php echo $row["contactEmail"]?></p></td>
                            <td><p><?php echo $row["contactAddress"]?></p></td>
                            <td><p><?php echo $row["contactSubject"]?></p></td>
                            <td><p><?php echo $row["contactMessage"]?></p></td>
                            <td>
                                <form class="del" action="deleteMessage.php" method="post">
                                    <input type="hidden" value=<?php echo "\"" . $row["Form_ID"] . "\""?> name="delete" id="delete">
                                    <button class="delButton" type="submit"><i class="iconify icon:mdi:trash-can-outline icon-inline:false"></i></button>
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
        </div>
    </div>
</body>

</html>