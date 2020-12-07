<?php
 $servername = "localhost";
 $username = "dev";
 $password = "dev";
 $dbname = "soen287final";
 $conn = new mysqli($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>

<html lang = "en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Our Platters | House of Chef James Mitchell</title>
    </head>    

    <body>
    <div class="MessageDiv">
        <h1>Platter Options</h1>
    </div><br>

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
                    if($row["category"] == "Catering" && $row["subcategory"] == "Platters"){
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