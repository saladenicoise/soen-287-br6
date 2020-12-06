<!DOCTYPE html>

<html lang = "en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="catering_main.css">
        <link rel="stylesheet" href="../navBar/navBarStyles.css">
        <link rel = "stylesheet" href = "../footer/footer.css"> 
        <script src="cateringPageFunctionality.js"></script>
        <title>Catering | House of Chef James Mitchell</title>
    </head>

    <body>
        <?php include("../navBar/navBar.php")?>

        <div class="cateringMenuBackground">
            <div class="cateringCategorySelections">
                    <table class="cateringCategoriesTable">
                        <tr>
                            <td class="cateringCategory" onclick="displayMenu(this.id)" id="appetizers">Appetizers Bar</td>
                            <td class="cateringCategory" onclick="displayMenu(this.id)" id="platters">Platters</td>
                            <td class="cateringCategory" onclick="displayMenu(this.id)" id="pastas">Pastas</td>
                            <td class="cateringCategory" onclick="displayMenu(this.id)" id="salads">Gourmet Salads</td>
                            <td class="cateringCategory" onclick="displayMenu(this.id)" id="desserts">Dessert Jars</td>
                            <td class="cateringCategory" onclick="displayMenu(this.id)" id="buffet">Buffet</td>
                            <td class="cateringCategory" onclick="displayMenu(this.id)" id="grboards">Grazing Boards</td>
                        </tr>
                    </table>

                    <hr class="cateringHr">
            </div>

            <div style="display: none" id="dessertDiv" class="cateringSlectionDisplay">
                <?php include("desserts_in_a_jar.php")?>
            </div>
            <div id="pastasDiv" class="cateringSlectionDisplay">
                <?php include("pastas.php")?>
            </div>
            <div id="platterDiv">

            </div>
            <div id="appetizersDiv">

            </div>
            <div id="saladsDiv">

            </div>
            <div id="buffetDiv">

            </div>
            <div id="grboardsDiv">

            </div>

        </div>
        
        
        <?php include("../footer/footer.php")?>
    </body>

</html>