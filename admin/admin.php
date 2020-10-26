<?php
session_start();
if (isset($_SESSION["login"]) && $_SESSION["login"] != '') { // Checks if Session is up(user has logged in)
    $statusSet = isset($_GET['stat']);
    $statusVal = "";
    if($statusSet) {
        $statusVal = $_GET['stat'];
    }
}else{
    header('Location: /login/login.html');
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
    <button onclick="toggle('menuAdd')">Show Menu Add</button>
    <button onclick="toggle('customAdd')">Show Custom Add</button>
    <hr>
    <p id='statusBox'></p>
    <div id="menuOfferings" style="display: none;">
        <fieldset>
            <legend>Menu Offerings</legend>
            <!--put php code to get menu offerings-->
            <hr>
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
                        <td><input class="center" type="checkbox" id="customOptions" name="customOptions" value="true" onclick="disableSame('customOptionsHidden')"></td>
                        <td><input class="center" id='customOptionsHidden' type='hidden' value='false' name='customOptions'></td>
                        <td><input class="center" type="checkbox" id="vegetarian" name="vegetarian" value="true" onclick="disableSame('vegetarianHidden')"></td>
                        <td><input class="center" id='vegetarianHidden' type='hidden' value='false' name='vegetarian'></td>
                        <td><input class="center" type="checkbox" id="glutenFree" name="glutenFree" value="true" onclick="disableSame('glutenFreeHidden')"></td>
                        <td><input class="center" id='glutenFreeHidden' type='hidden' value='false' name='glutenFree'></td>
                    </tr>
                </table>
                <button type="submit">Add to Menu</button>
                <button type="reset">Clear Form</button>
            </form>
        </fieldset>
    </div>

    <div id="menuAdd" style="display: none;">
        <p>Menu Add</p>
    </div>

    <div id="customAdd" style="display: none;">
        <p>Custom Add</p>
    </div>
</body>

</html>