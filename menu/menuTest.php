<?php 
require('../configure.php');
$servername = DB_SERVER;
$username = DB_USER;
$password = DB_PASS;
$dbname = DB_NAME;
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <link rel = "stylesheet" href = "../footer/footer.css">
    <script type="text/javascript" src="main_menu.js"> </script>
    <script src="cateringPageFunctionality.js"></script>

    <title>Menu</title>
</head>

<body>

<?php include("../navBar/navBar.php"); ?>
<br>
 <!--Entree ITEMS --> 
<h1> Entrees </h1>
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
                
                while ($row = $result->fetch_assoc()) {
                    if($row["subcategory"] == "Entree"){
                    
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

        ?>
    </div>


    <!--Main ITEMS --> 
    <h1> Main Dishes </h1>
    <div class="menu-grid-container">
       
    
        <?php   
            /*Our query, essentially what we want to display and show, in this case we want * (everything) from Menu*/
            $query = "SELECT * FROM `menu`";
            /*If we can query the database and we get 1 or more rows back, then proceed*/
            if ($result = $conn->query($query)) {

                /* fetch associative array for every row 
                format: $row["columnName"]
                */
                
                while ($row = $result->fetch_assoc()) {
                    if($row["subcategory"] == "Main"){
                    
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

        ?>
        </div>

    <!--Dessert ITEMS --> 
    <h1> Desserts </h1>
    <div class="menu-grid-container">
       
        <?php   
            /*Our query, essentially what we want to display and show, in this case we want * (everything) from Menu*/
            $query = "SELECT * FROM `menu`";
            /*If we can query the database and we get 1 or more rows back, then proceed*/
            if ($result = $conn->query($query)) {

                /* fetch associative array for every row 
                format: $row["columnName"]
                */
                
                while ($row = $result->fetch_assoc()) {
                    if($row["subcategory"] == "Dessert"){
                    
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

        ?>
        </div>

        <!--New ITEMS --> 
        <h1> Newly Added Items </h1>
    <div class="menu-grid-container">
       
        <?php   
            /*Our query, essentially what we want to display and show, in this case we want * (everything) from Menu*/
            $query = "SELECT * FROM `menu`";
            /*If we can query the database and we get 1 or more rows back, then proceed*/
            if ($result = $conn->query($query)) {

                /* fetch associative array for every row 
                format: $row["columnName"]
                */
                
                while ($row = $result->fetch_assoc()) {
                    if($row["subcategory"] == "New"){
                    
        ?>

        <div class="menu-grid-item">
        <div class = "menu-box">
            <div class="menu-item">
                <div class="clickable"  onclick = <?php echo "\"openModal('" . $row["productName"] . "')\""?>>
                    <img id = "img" src="../images/productPictures/<?php echo $row["imagePath"];?>">
                    <p><?php echo $row["productName"]?></p>
                    <p class="extra"><?php echo ($row["isVeg"] == 0) ? "" : "Vegetarian";?></p>
                    <p class="extra"><?php echo ($row["isGf"] == 0) ? "" : "Gluten Free";?></p>
                    <p>$<?php echo $row["cost"]?>  /1 serving</p>
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

        <?php        
                
            }
        }
            /* free result set */
                $result->free();
            }
            /*Close DB connection */
            $conn->close();
        ?>
    </div>

    <?php include("../footer/footer.php")?>

</body>

</html>