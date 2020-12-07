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

        <div class="cateringMenuContainer">
            <div class="cateringCategoriesContainer">
                    
                            <span class="cateringCategory" onclick="displayMenu(this.id)" id="appetizers">Appetizers Bar</span>
                            <span class="cateringCategory" onclick="displayMenu(this.id)" id="platters">Platters</span>
                            <span class="cateringCategory" onclick="displayMenu(this.id)" id="pastas">Pastas</span>
                            <span class="cateringCategory" onclick="displayMenu(this.id)" id="salads">Gourmet Salads</span>
                            <span class="cateringCategory" onclick="displayMenu(this.id)" id="desserts">Dessert Jars</span>
                            <span class="cateringCategory" onclick="displayMenu(this.id)" id="buffet">Buffet</span>
                            <span class="cateringCategory" onclick="displayMenu(this.id)" id="grboards">Grazing Boards</span>
                        
                    <hr class="cateringHr">
            </div>

            <div id="infoDiv">

            </div>
            <div id="dessertDiv" class="cateringSlectionContainer">
                <?php include("desserts.php")?>
            </div>
            <div id="pastasDiv" class="cateringSlectionContainer">
                <?php include("pastas.php")?>
            </div>
            <div id="plattersDiv" class="cateringSlectionContainer">
                <?php include("platters.php")?>
            </div>
            <div id="appetizersDiv" class="cateringSlectionContainer">
                <?php include("appetizers.php")?>
            </div>
            <div id="saladsDiv" class="cateringSlectionContainer">
                <?php include("salads.php")?>
            </div>
            <div id="buffetDiv" class="cateringSlectionContainer">
                <?php include("buffet.php")?>
            </div>
            <div id="grboardsDiv" class="cateringSlectionContainer">
                <?php include("grazing_boards.php")?>
            </div>
        </div>
        <br><br>
        
        
        <?php include("../footer/footer.php")?>
    </body>

</html>