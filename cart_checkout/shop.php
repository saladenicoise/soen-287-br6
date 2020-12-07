<?php 
$servername = "localhost";
$username = "dev";
$password = "dev";
$dbname = "soen287final";
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();

if(isset($_POST["addCart"])){
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
    <link rel="stylesheet" href="../menu/test.css?v=1.1">
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <script src="modal.js"></script>
    <title>Menu</title>
</head>

<body>
     <?php include("../navBar/navBar.php");?>
    <h1> New Items </h1>
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
                    if($row["category"] == "Shop" && $row["subcategory"] == "New"){
        ?>
        <?php
            //$priceNum=substr($value["productPrice"],2);
            $dishSizes=array('Single Size'=>$row["cost"],'Family Size'=>$row["cost"]*4,'Couple Size'=>$row["cost"]*2,'Kid Size'=>$row["cost"]/2);  
                    
        ?>
        <div class="menu-grid-item">
            <div class = "menu-box">
            <form method="post" action="shop.php">
                <div class="menu-item"  onclick = <?php echo "\"openModal('" . $row["productName"] . "')\""?>>
                        <div class="clickable">
                            <img id = "img" src="../images/productPictures/<?php echo $row["imagePath"];?>">
                            <p><?php echo $row["productName"]?></p>
                            <p class="extra"><?php echo ($row["isVeg"] == 0) ? "" : "Vegetarian";?></p>
                            <p class="extra"><?php echo ($row["isGf"] == 0) ? "" : "Gluten Free";?></p>
                            <p>$<?php echo $row["cost"]?> /1 serving</p>
                        </div>
                    </div>
                    <div class = "modal" id =<?php echo "\"modal" . $row["productName"] . "\"" ?>>
                            <div class = "modal-open" id = "modal-open">
                                <button id = "close" onclick = 'closeModal(<?php echo "\"modal" . $row["productName"] . "\"" ?>)'> X </button> <br>
                                <p id = "name"><?php echo $row["productName"]?></p>
                                <p id = "description"><?php echo $row["description"]?></p>
                                <select name="sizeSelection">
                                <?php 
                                    foreach($dishSizes as $sizeName=>$price){
                                        echo "<option>$sizeName $$price</option>";
                                    }
                                ?>
                            </select>
                                <input type="hidden" name="pname" id="pname" value="<?php echo $row["productName"]?>">
                                <?php if(!(is_null($row["customId"]))) : ?>
                                <button class="menu-button" id="custom" name="custom" onclick="doCustomization(<?php echo $row['customId'] ?>)">Customize Order</button>
                                <?php endif;?>
                                <button class="menu-button" id="addCart" name="addCart" type="submit">Add To Cart</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <?php 
            }
        }
            /* free result set */
                $result->free();
            }
        ?>
    </div>
    <h1> Entree </h1>
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
                    if($row["category"] == "Shop" && $row["subcategory"] == "Entree"){
        ?>
        <?php
            //$priceNum=substr($value["productPrice"],2);
            $dishSizes=array('Single Size'=>$row["cost"],'Family Size'=>$row["cost"]*4,'Couple Size'=>$row["cost"]*2,'Kid Size'=>$row["cost"]/2);  
                    
        ?>
        <div class="menu-grid-item">
        <div class = "menu-box">
            <form method="post" action="shop.php">
                <div class="menu-item"  onclick = <?php echo "\"openModal('" . $row["productName"] . "')\""?>>
                        <div class="clickable">
                            <img id = "img" src="../images/productPictures/<?php echo $row["imagePath"];?>">
                            <p><?php echo $row["productName"]?></p>
                            <p class="extra"><?php echo ($row["isVeg"] == 0) ? "" : "Vegetarian";?></p>
                            <p class="extra"><?php echo ($row["isGf"] == 0) ? "" : "Gluten Free";?></p>
                            <p>$<?php echo $row["cost"]?> /1 serving</p>
                        </div>
                        <div class = "modal" id =<?php echo "\"modal" . $row["productName"] . "\"" ?>>
                            <div class = "modal-open" id = "modal-open">
                                <button id = "close" onclick = 'closeModal(<?php echo "\"modal" . $row["productName"] . "\"" ?>)'> X </button> <br>
                                <p id = "name"><?php echo $row["productName"]?></p>
                                <p id = "description"><?php echo $row["description"]?></p>
                                <input type="hidden" name="pname" id="pname" value="<?php echo $row["productName"]?>">
                                <select name="sizeSelection">
                                <?php 
                                    foreach($dishSizes as $sizeName=>$price){
                                        echo "<option>$sizeName $$price</option>";
                                    }
                                ?>
                            </select>
                                <?php if(!(is_null($row["customId"]))) : ?>
                                <button class="menu-button" id="custom" name="custom" onclick="doCustomization(<?php echo $row['customId'] ?>)">Customize Order</button>
                                <?php endif;?>
                                <button class="menu-button" id="addCart" name="addCart" type="submit">Add To Cart</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php 
            }
        }
            /* free result set */
                $result->free();
            }
        ?>
    </div>
    <h1> Main Dishes </h1>
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
                    if($row["category"] == "Shop" && $row["subcategory"] == "Main"){
        ?>
        <?php
            //$priceNum=substr($value["productPrice"],2);
            $dishSizes=array('Single Size'=>$row["cost"],'Family Size'=>$row["cost"]*4,'Couple Size'=>$row["cost"]*2,'Kid Size'=>$row["cost"]/2);  
                    
        ?>
        <div class="menu-grid-item">
        <div class = "menu-box">
            <form method="post" action="shop.php">
                <div class="menu-item"  onclick = <?php echo "\"openModal('" . $row["productName"] . "')\""?>>
                        <div class="clickable">
                            <img id = "img" src="../images/productPictures/<?php echo $row["imagePath"];?>">
                            <p><?php echo $row["productName"]?></p>
                            <p class="extra"><?php echo ($row["isVeg"] == 0) ? "" : "Vegetarian";?></p>
                            <p class="extra"><?php echo ($row["isGf"] == 0) ? "" : "Gluten Free";?></p>
                            <p>$<?php echo $row["cost"]?> /1 serving</p>
                        </div>
                        <div class = "modal" id =<?php echo "\"modal" . $row["productName"] . "\"" ?>>
                            <div class = "modal-open" id = "modal-open">
                                <button id = "close" onclick = 'closeModal(<?php echo "\"modal" . $row["productName"] . "\"" ?>)'> X </button> <br>
                                <p id = "name"><?php echo $row["productName"]?></p>
                                <p id = "description"><?php echo $row["description"]?></p>
                                <input type="hidden" name="pname" id="pname" value="<?php echo $row["productName"]?>">
                                <select name="sizeSelection">
                                <?php 
                                    foreach($dishSizes as $sizeName=>$price){
                                        echo "<option>$sizeName $$price</option>";
                                    }
                                ?>
                            </select>
                                <?php if(!(is_null($row["customId"]))) : ?>
                                <button class="menu-button" id="custom" name="custom" onclick="doCustomization(<?php echo $row['customId'] ?>)">Customize Order</button>
                                <?php endif;?>
                                <button class="menu-button" id="addCart" name="addCart" type="submit">Add To Cart</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php 
            }
        }
            /* free result set */
                $result->free();
            }
        ?>
    </div>
    <h1> Desserts </h1>
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
                    if($row["category"] == "Shop" && $row["subcategory"] == "Dessert"){
        ?>
        <?php
            //$priceNum=substr($value["productPrice"],2);
            $dishSizes=array('Single Size'=>$row["cost"],'Family Size'=>$row["cost"]*4,'Couple Size'=>$row["cost"]*2,'Kid Size'=>$row["cost"]/2);  
                    
        ?>
        <div class="menu-grid-item">
        <div class = "menu-box">
            <form method="post" action="shop.php">
                <div class="menu-item"  onclick = <?php echo "\"openModal('" . $row["productName"] . "')\""?>>
                        <div class="clickable">
                            <img id = "img" src="../images/productPictures/<?php echo $row["imagePath"];?>">
                            <p><?php echo $row["productName"]?></p>
                            <p class="extra"><?php echo ($row["isVeg"] == 0) ? "" : "Vegetarian";?></p>
                            <p class="extra"><?php echo ($row["isGf"] == 0) ? "" : "Gluten Free";?></p>
                            <p>$<?php echo $row["cost"]?> /1 serving</p>
                        </div>
                        <div class = "modal" id =<?php echo "\"modal" . $row["productName"] . "\"" ?>>
                            <div class = "modal-open" id = "modal-open">
                                <button id = "close" onclick = 'closeModal(<?php echo "\"modal" . $row["productName"] . "\"" ?>)'> X </button> <br>
                                <p id = "name"><?php echo $row["productName"]?></p>
                                <p id = "description"><?php echo $row["description"]?></p>
                                <input type="hidden" name="pname" id="pname" value="<?php echo $row["productName"]?>">
                                <select name="sizeSelection">
                                <?php 
                                    foreach($dishSizes as $sizeName=>$price){
                                        echo "<option>$sizeName $$price</option>";
                                    }
                                ?>
                                </select>
                                <?php if(!(is_null($row["customId"]))) : ?>
                                <button class="menu-button" id="custom" name="custom" onclick="doCustomization(<?php echo $row['customId'] ?>)">Customize Order</button>
                                <?php endif;?>
                                <button class="menu-button" id="addCart" name="addCart" type="submit">Add To Cart</button>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php 
            }
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