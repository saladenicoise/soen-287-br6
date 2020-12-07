<?php 
$servername = "localhost";
$username = "dev";
$password = "dev";
$dbname = "menu";
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();

if(isset($_POST["addToCart"])){
   $size_price=$_POST["sizeSelection"];
        $stopPos=strpos($size_price,"$");
        $sizeName=substr($size_price,0,$stopPos-1);
        $priceCor=substr($size_price,$stopPos);
   
    if(isset($_SESSION["cart"])){
        $added=false;
        $item_array_name=array_column($_SESSION["cart"],"productName");
        if(in_array($_POST["pname"],$item_array_name)){
                
            
            foreach($_SESSION["cart"] as $x=>&$item){
                
                foreach($item as $info=>&$infoDetail){
                        if($infoDetail==$_POST["pname"]){
                            $sameFood=$_SESSION["cart"][$x];
                            foreach($sameFood as $key=>&$value){
                                $numIncrease=false;
                                if($value==$sizeName){
                                   $numIncrease=true;
                                    $added=true;
                             $_SESSION["cart"][$x]["productNum"]+=1;      
                                    
                                }
                            }
                            
                        }
                    }
                }
            if($numIncrease==false&&$added==false){
                                $count=count($_SESSION["cart"]);
                                $itemnum=1;
                                $item_array=array(
                                    'productName'=>$_POST['pname'],
                                    'productPrice'=>$priceCor,
                                    'productSize'=>$sizeName,
                                    'productNum'=>1
                                    );
                                $_SESSION["cart"][$count]=$item_array;
                            }
            
        }else{
            $count=count($_SESSION["cart"]);
            
            $item_array=array(
            'productName'=>$_POST['pname'],
            'productPrice'=>$priceCor,
            'productSize'=>$sizeName,
            'productNum'=>1
            );
            $_SESSION["cart"][$count]=$item_array;
        }
    }else{
    $itemnum=1;    
    
        $item_array=array(
        'productName'=>$_POST['pname'],
        'productPrice'=>$priceCor,
        'productSize'=>$sizeName,
        'productNum'=>1
        
        );
        $_SESSION["cart"][0]=$item_array;
    }
}


//session_destroy();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <title>Menu</title>
</head>

<body>
     <?php include("../navBar/navBar.php");?>
<button style="background-color: red; color: white; padding: 15px; width: 50%;" onclick="location.href='./menu.php'">Goto old menu (Temporary)</button>
    <div class="menu-grid-container">
        <?php
            /*Our query, essentially what we want to display and show, in this case we want * (everything) from Menu*/
            $query = "SELECT * FROM `Menu`";
            /*If we can query the database and we get 1 or more rows back, then proceed*/
            if ($result = $conn->query($query)) {

                /* fetch associative array for every row 
                format: $row["columnName"]
                */
                while ($row = $result->fetch_assoc()) {
        ?>
        <?php
            //$priceNum=substr($value["productPrice"],2);
            $dishSizes=array('Single Size'=>$row["cost"],'Family Size'=>$row["cost"]*4,'Couple Size'=>$row["cost"]*2,'Kid Size'=>$row["cost"]/2);  
                    
        ?>
        <form method="post" action="">
            <div class="menu-grid-item">
                <div class="menu-item">
                    <img src="../productPictures/<?php echo $row["imagePath"];?>">
                    <p><?php echo $row["productName"]?></p>
                    <p class="extra"><?php echo ($row["isVeg"] == 0) ? "" : "Vegetarian";?></p>
                    <p class="extra"><?php echo ($row["isGf"] == 0) ? "" : "Gluten Free";?></p>
                    <p>$<?php echo $row["cost"]?></p>
                    <select name="sizeSelection">
                        <?php 
                            foreach($dishSizes as $sizeName=>$price){
                                echo "<option>$sizeName $$price</option>";
                            }
                            ?>
                    </select>
                    <input type="hidden" name="pname" value="<?php echo $row["productName"]; ?>"/>
                    <input type="hidden" class="extra" value="<?php echo ($row["isVeg"] == 0) ? "" : "Vegetarian";?>"/>
                    <input type="hidden" class="extra" value="<?php echo ($row["isGf"] == 0) ? "" : "Gluten Free";?>"/>
                    <input type="hidden" name="price" value="$ <?php echo $row["cost"]; ?>"/>
                    <?php if(!(is_null($row["customId"]))) : ?>
                    <button class="menu-button" id="custom" name="custom" onclick="doCustomization(<?php echo $row['customId'] ?>)">Customize Order</button>
                    <?php endif;?>
                    <br>
                    <input type="submit" class="menu-button" id="addCart" name="addToCart" value="Add To Cart"/>
                </div>
            </div>
            </form>
        <?php 
            }
            /* free result set */
                $result->free();
            }
            /*Close DB connection */
            $conn->close();
        ?>
    </div>
</body>

</html>