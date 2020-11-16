<!DOCTYPE html>

<html lang = "en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="catering_main.css">
        <link rel="stylesheet" href="../navBar/navBarStyles.css">
        <title>Catering | House of Chef James Mitchell</title>
    </head>

    <body>
        <?php include("../navBar/navBar.php")?>

        <span><h1>Our Catering Services</h1></span>
        <h2>
            Our minimum order for catering is $150 before delivery and taxes.<br>
            A minimum of two dozen for the appetizers bar choices is requested.
        </h2>
        <p> <button onclick = "location.href = 'appetizer_bar.php'">The Appetizer Bar</button> </p>
        <p> <button onclick = "location.href = 'platters.php'">Platters</button> </p>
        <p> <button onclick = "location.href = 'pastas.php'">Pastas</button> </p>
        <p> <button onclick = "location.href = 'gourmet_salads.php'">Gourmet Salads</button> </p>
        <p> <button onclick = "location.href = 'desserts_in_a_jar.php'">Desserts In a Jar</button> </p>
        <p> <button onclick = "location.href = 'buffet.php'">Buffet</button> </p>
        <p> <button onclick = "location.href = 'grazing_boards.php'">Grazing Boards</button> </p>
        <br>

        <h3 style = "text-align: center;">
        <span>IMPORTANT:</span><br> 
        We are <span>NOT</span> a tree/nut-free environment!<br> 
        We do process nuts in our kitchen which creates the potential for cross-contact and contamination.<br>
        Customers should be aware when requesting nut-free items and menus.<br> 
        We can accomodate <span>no-nut</span> and we can take every precaution possible,<br> 
        however, it is at the client's discretion and understanding of the above mentioned notation. 
        </h3>
        <?php //include("../footer/footer.php")?>
    </body>

</html>