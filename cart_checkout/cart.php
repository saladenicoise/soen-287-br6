<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>shopping cart</title>
        <link rel="stylesheet" href="cart_checkout.css">
        <link rel="stylesheet" href="../navBar/navBarStyles.css">
    </head>
    <body>
        <?php include("../navBar/navBar.php")?>
        
        <div class="dishes-container">
            <div class="dish-headers">
                <h5 class="dishSize">SIZE</h5>
                <h5 class="dishPrice">PRICE</h5>
                <h5 class="dishQuantity">QUANTITY</h5>
                <h5 class="dishTotal">TOTAL</h5>
            </div>
            <div class="dishes">
           
            </div>
        </div>
        
            <a href="checkOutPage.php" id="checkOut"><strong>Proceed to Checkout</strong></a><br/>
       
                <a href="menu.php" id="mainPage"><strong>Continue Shopping</strong></a>
        
           
    <script src="menu.js"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    </body>

</html>