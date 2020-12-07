<?php

function createGrid() {
    $servername = "localhost";
    $username = "dev";
    $password = "dev";
    $dbname = "soen287final";
    $conn = new mysqli($servername, $username, $password, $dbname);

    /*Our query, essentially what we want to display and show, in this case we want * (everything) from Menu*/
    $query = "SELECT * FROM `menu`";
    /*If we can query the database and we get 1 or more rows back, then proceed*/
    if ($result = $conn->query($query)) {

    /* fetch associative array for every row 
    format: $row["columnName"]
    */
                
    while ($row = $result->fetch_assoc()) {
        if($row["category"] == "Catering" && $row["subcategory"] == "Buffet") {
            //Grid Item
            echo "<div class = \"dishItem clickable\" onclick=\"openModal(\"" . $row["productName"] . "\")\">";
            echo "<img id = \"img\" src=\"../images/productPictures/" . $row["imagePath"] . ">";
            echo "<h4>" . $row["productName"] . "</h4>";
            echo ($row["isVeg"] == 0) ? "" : "Vegetarian";
            echo ($row["isGf"] == 0) ? "" : "Gluten Free";
            echo "<p>$" . $row["cost"] . " | Serves 6</p>";
            echo "</div>";
            //Modal
            echo "<div class = \"modal\" id=\"modal" . $row["productName"] . "\" style=\"display: none;\">";  
            echo "<div class = \"modal-open\" id = \"modal-open\">";
            echo "<button id = \"close\" onclick = 'closeModal(\"modal" . $row["productName"] . "\")'> X </button> <br>";
            echo "<p id = \"name\">" . $row["productName"] . "</p>";
            echo "<p id = \"description\">" . $row["description"] . "</p>";
            if(!(is_null($row["customId"]))) {
                echo "<button class=\"menu-button\" id=\"custom\" name=\"custom\" onclick=\"doCustomization(\"" . $row['customId'] . "\")>Customize Order</button>";
            }
            echo "<button class=\"menu-button\" id=\"addCart\" name=\"addCart\" onclick=\"addToCart(\"" . $row['productName'] . "\")>Add To Cart</button>";
            echo "</div>";
            echo "</div>";
        }
    }
}
}