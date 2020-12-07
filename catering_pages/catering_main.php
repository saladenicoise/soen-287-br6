<!DOCTYPE html>

<html lang = "en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="catering_main.css">
        <link rel="stylesheet" href="../navBar/navBarStyles.css">
        <link rel = "stylesheet" href = "../footer/footer.css"> 
        <title>Catering | House of Chef James Mitchell</title>
    </head>

    <body>
        <?php include("../navBar/navBar.php")?>

        <script>
            function displayMenu(id) {
                this.dessert = document.getElementById("dessertDiv");
                this.pasta = document.getElementById("pastasDiv");
                this.platters = document.getElementById("plattersDiv");
                this.appet = document.getElementById("appetizersDiv");
                this.salad = document.getElementById("saladsDiv");
                this.buffet = document.getElementById("buffetDiv");
                this.grb = document.getElementById("grboardsDiv");
                if(id == "dessert") {
                    this.dessert.style.display = "block";
                    this.pasta.style.display = "none";
                    this.platters.style.display = "none";
                    this.appet.style.display = "none";
                    this.salad.style.display = "none";
                    this.buffet.style.display = "none";
                    this.grb.style.display = "none";
                }
                if(id == "pasta") {
                    this.dessert.style.display = "none";
                    this.pasta.style.display = "block";
                    this.platters.style.display = "none";
                    this.appet.style.display = "none";
                    this.salad.style.display = "none";
                    this.buffet.style.display = "none";
                    this.grb.style.display = "none";
                }
                if(id == "platters") {
                    this.dessert.style.display = "none";
                    this.pasta.style.display = "none";
                    this.platters.style.display = "block";
                    this.appet.style.display = "none";
                    this.salad.style.display = "none";
                    this.buffet.style.display = "none";
                    this.grb.style.display = "none";
                }
                if(id == "appet") {
                    this.dessert.style.display = "none";
                    this.pasta.style.display = "none";
                    this.platters.style.display = "none";
                    this.appet.style.display = "block";
                    this.salad.style.display = "none";
                    this.buffet.style.display = "none";
                    this.grb.style.display = "none";
                }
                if(id == "salad") {
                    this.dessert.style.display = "none";
                    this.pasta.style.display = "none";
                    this.platters.style.display = "none";
                    this.appet.style.display = "none";
                    this.salad.style.display = "block";
                    this.buffet.style.display = "none";
                    this.grb.style.display = "none";
                }
                if(id == "buffet") {
                    this.dessert.style.display = "none";
                    this.pasta.style.display = "none";
                    this.platters.style.display = "none";
                    this.appet.style.display = "none";
                    this.salad.style.display = "none";
                    this.buffet.style.display = "block";
                    this.grb.style.display = "none";
                }
                if(id == "grb") {
                    this.dessert.style.display = "none";
                    this.pasta.style.display = "none";
                    this.platters.style.display = "none";
                    this.appet.style.display = "none";
                    this.salad.style.display = "none";
                    this.buffet.style.display = "none";
                    this.grb.style.display = "block";
                }
            }
        </script>

        <div class="cateringMenuContainer">
            <div class="cateringCategoriesContainer">
                    
                            <span class="cateringCategory" onclick="displayMenu('appet')" id="appetizers">Appetizers Bar</span>
                            <span class="cateringCategory" onclick="displayMenu('platters')" id="platters">Platters</span>
                            <span class="cateringCategory" onclick="displayMenu('pasta')" id="pastas">Pastas</span>
                            <span class="cateringCategory" onclick="displayMenu('salad')" id="salads">Gourmet Salads</span>
                            <span class="cateringCategory" onclick="displayMenu('dessert')" id="desserts">Dessert Jars</span>
                            <span class="cateringCategory" onclick="displayMenu('buffet')" id="buffet">Buffet</span>
                            <span class="cateringCategory" onclick="displayMenu('grb')" id="grboards">Grazing Boards</span>
                        
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