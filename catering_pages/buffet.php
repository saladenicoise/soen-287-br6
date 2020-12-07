<?php
 include "createGrid.php";
?>



<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buffet | House of Chef James Mitchell</title>
</head>

<body>
    <div>


    </div>
    <div>

    </div>
    <!-- Top of each page should have one of these divs, it contains a short description of the items and is applicable, their price(s) -->
    <div class="MessageDiv">
        <h1>Buffet Options</h1>
        <p>There can be a minimum required order for some options. Feel free to contact us directly if you might want<br>something different, we will assist you in any way that we can</p>
        <br><p>Re-heating can and should be done in your oven at 350-F for about 35 - 45 minutes</p>
    </div><br>
    
    <!-- If page has multiple main sections (refer to website) use another message div to seperate the sections-->
    <div class="MessageDiv">
        <h2>Main Choices</h2><hr class="cateringItemsHr"><br>
    </div>
    
    <!-- 
        A div with this class contains the items that will be turned into placecards.
        all that you need to do is call the php function "createGrid" and pass 2 things:
        The name of the txt file and the name of the folder containing the images.
        the function will take care of the directory management, so just pass the name of the
        the txt file and the folder.

        If for reference, go to "createGrid.php" to give the function a loko
    -->
    <div class="dishContainer">
        <?php
            createGrid("buffet_main_items.txt", "buffet_mains_images");
        ?>
    </div>

    <div class="MessageDiv">
    <h2>Side Choices</h2><hr class="cateringItemsHr"><br>
</div>
    <div class="dishContainer">
        <?php
            createGrid("buffet_side_items.txt", "buffet_sides_images");
        ?>
    </div>

</body>

</html>