<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menuStyle.css">
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <title>Menu</title>
    <script src="menu.js" async></script></head>
    <body>
        <?php include("../navBar/navBar.php")?>

        <nav>
            <a href="cart.php">Cart <span class="MainPageCart">0</span></a>
        </nav>

        <button style="background-color: red; color: white; padding: 15px; width: 50%;" onclick="location.href='./menuTest.php'">Goto new menu (Temporary)</button>
        <div class="container">
            <div class="Menu_dishes">
                <img src="fish_dish.jpg" alt="Fish Dish" width=50%>
                <h3 class="dishName">Fish Dish</h3>
                <table>
                    <tr>
                        <th>Size</th>
                        <th>Price</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Familty Size</td>
                        <td>$31</td>
                        <td><a class="add-cart family" href="#">add to cart</a></td>
                    </tr>
                    <tr>
                        <td>Couple Size</td>
                        <td>$21</td>
                        <td><a class="add-cart couple" href="#">add to cart</a></td>
                    </tr>
                    <tr>
                        <td>Single Size</td>
                        <td>$12.5</td>
                        <td><a class="add-cart single" href="#">add to cart</a></td>
                    </tr>
                    <tr>
                        <td>Adult Portion</td>
                        <td>$9.50</td>
                        <td><a class="add-cart adult" href="#">add to cart</a></td>
                    </tr>
                    <tr>
                        <td>Kids Size</td>
                        <td>$5.50</td>
                        <td><a class="add-cart kids" href="#">add to cart</a></td>
                    </tr>
                    <tr>
                        <td>Gluten Free</td>
                        <td>$3.50</td>
                        <td><a class="add-cart gfree" href="#">add to cart</a></td>
                    </tr>
                  
                </table>
            <div></div>
        </div>   
        </div>
    </body>
</html>