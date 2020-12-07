<?php 
$servername = "localhost";
$username = "dev";
$password = "dev";
$dbname = "menu";
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();

  if(isset($_POST['remove'])){
      $key_to_remove=$_POST['index_to_remove'];
      
      if(count($_SESSION["cart"])<=1){
          unset($_SESSION["cart"]);
      }else{
          unset($_SESSION["cart"][$key_to_remove]);
          sort($_SESSION["cart"]);
      }
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>shopping cart</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="cart_checkout.css">
        <link rel="stylesheet" href="../navBar/navBarStyles.css">
    </head>
    <body>
        <?php include("../navBar/navBar.php");?>
         
        <div class="cartTable">
  
          <form action="" method="post"> 
                <table class="cartTable">
                    <tr>
                        <th>ITEM</th>
                        <th>SIZE</th>
                        <th>QUANTITY</th>
                        <th>PRICE</th>
                        <th>TOTAL</th>
                        <th></th>
                    </tr>
                  <?php  
                        if(!empty($_SESSION["cart"])){
                            $total=0;
                            $index=0;
                            foreach($_SESSION["cart"] as $key =>$value){
                    ?>
                        <tr>
                            <td><?php echo $value["productName"];?></td>
                            <input type="hidden" name="cartItemName" value="<?php echo $value["productName"];?>"/>
                            <td><?php echo $value["productSize"];?></td>
                            <input type="hidden" name="cartItemSize" value="<?php echo $value["productSize"];?>"/>
                            <td><?php echo $value["productNum"];?></td>
                            <input type="hidden" name="cartItemNum" value="<?php echo $value["productPrice"];?>"/>
                            <td><?php echo $value["productPrice"];?></td>
                            <td>$<?php 
                                $priceNum=substr($value["productPrice"],1);
                                $itemTotal=$priceNum*$value["productNum"];
                                echo $itemTotal;
                                ?></td>
                    
                            <td><input type="submit" name="remove" id="removeBt" value="remove"/></td>
                            <input type="hidden" name="index_to_remove" value="<?php echo $index; ?>"/input>
                            <?php $index++; ?>
                        </tr>

                    <?php
                            $priceNum=substr($value["productPrice"],1);
                                $total=$total+$itemTotal;
                          
                            }

                    ?>
                    <tr>
                        <td id="cartSubTotal" colspan="5">SUB TOTAL</td>
                        <td id="subTotalVal">$ <?php echo $total;?></td>
                    </tr>
                    <?php 
                        }
            ?>


                </table>
            </form>
           
        </div>
        <br/><br/>
            <a href="checkOutPage.php" id="checkOut"><strong>Process to Check out</strong></a><br/>
       
                <a href="shop.php" id="mainPage"><strong>Continue Shopping</strong></a>
    </body>

</html>