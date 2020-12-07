<?php
 $servername = "localhost";
 $username = "dev";
 $password = "dev";
 $dbname = "soen287final";
 $conn = new mysqli($servername, $username, $password, $dbname);
?>



<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="main_menu.js"></script>
    <title>Buffet | House of Chef James Mitchell</title>
</head>

<body>
    <!-- Top of each page should have one of these divs, it contains a short description of the items and is applicable, their price(s) -->
    <div class="MessageDiv">
        <h1>Buffet Options</h1>
        <p class="dont">There can be a minimum required order for some options. Feel free to contact us directly if you might want<br>something different, we will assist you in any way that we can</p>
        <br><p class="dont">Re-heating can and should be done in your oven at 350-F for about 35 - 45 minutes</p>
    </div><br>
    
    <!-- If page has multiple main sections (refer to website) use another message div to seperate the sections-->
    <div class="MessageDiv">
        <h2>Main Choices</h2><hr class="cateringItemsHr"><br>
    </div>
    
    <!--START COPY-->
    <div class="menu-grid-container">
        <!--MAIN MENU ITEMS --> 
        <?php
            /*Our query, essentially what we want to display and show, in this case we want * (everything) from Menu*/
            $query = "SELECT * FROM `menu`";
            /*If we can query the database and we get 1 or more rows back, then proceed*/
            if ($result = $conn->query($query)) {

                /* fetch associative array for every row 
                format: $row["columnName"]
                */
                //Change subcategory to either:
                /*
                Appetizers
                Platters
                Pastas
                Salads
                Desserts
                Buffet
                Grazing
                */
                while ($row = $result->fetch_assoc()) {
                    if($row["category"] == "Catering" && $row["subcategory"] == "Buffet"){
        ?>

        <div class="menu-grid-item">
        <div class = "menu-box">
            <div class="menu-item">
                <div class="clickable"  onclick = <?php echo "\"openModal('" . $row["productName"] . "')\""?>>
                    <img id = "img" src="../images/productPictures/<?php echo $row["imagePath"];?>">
                    <p><?php echo $row["productName"]?></p>
                    <p class="extra"><?php echo ($row["isVeg"] == 0) ? "" : "Vegetarian";?></p>
                    <p class="extra"><?php echo ($row["isGf"] == 0) ? "" : "Gluten Free";?></p>
                    <p>$<?php echo $row["cost"]?> /1 serving</p>
                </div>
                <div class = "modal" id =<?php echo "\"modal" . $row["productName"] . "\"" ?>>
                    <div class = "modal-open" id = "modal-open">
                         <button id = "close" onclick = 'closeModal(<?php echo "\"modal" . $row["productName"] . "\"" ?>)'> X </button> <br>
                         <p id = "name"><?php echo $row["productName"]?></p>
                         <p id = "description"><?php echo $row["description"]?></p>
                        <?php if(!(is_null($row["customId"]))) : ?>
                        <button class="menu-button" id="custom" name="custom" onclick="doCustomization(<?php echo $row['customId'] ?>)">Customize Order</button>
                        <?php endif;?>
                        <button class="menu-button" id="addCart" name="addCart" onclick="addToCart(<?php echo $row['productName'] ?>)">Add To Cart</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <?php
                    }
                }
            }
        ?>
    </div>
    <!--END COPY-->
</body>

</html>