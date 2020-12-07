<?php
function createGrid($txtFile, $imageDirectory)
{
            $itemFile = $txtFile;
            $itemDescriptions = Array();

            $directory = $imageDirectory;
            $images = scandir($directory);

            if(file_exists($itemFile))
            {
                $file = fopen($itemFile, "r");
                
                while(($line = fgets($file)) !== false)
                {
                    $tempArr = explode(" ", $line);
                    array_push($itemDescriptions, $tempArr);
                }
            }

            for($i = 2; $i < count($images); $i ++)
            {

                $tempPrice = trim(array_pop($itemDescriptions[$i - 2]));
                $tempDescription = implode(" ", $itemDescriptions[$i - 2]);

                if($imageDirectory == "mains_images")
                {   
                    $src = "mains_images/" . $images[$i];
                }
                else
                {
                    $src = "sides_images/" . $images[$i];
                }

                print "

                <div class = \"mainDishItem\">
                    <img width = \"180px\" src = $src>
                    <h4>$tempDescription</h4>
                    <p>$$tempPrice</p>
                </div>
                
                ";
            }
}
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
    <div class="buffetMessageDiv">
        <h1>Buffet Options</h1>
        <p>There can be a minimum required order for some options. Feel free to contact us directly if you might want<br>something different, we will assist you in any way that we can</p>
        <br><p>Re-heating can and should be done in your oven at 350-F for about 35 - 45 minutes</p>
    </div><br>
    
    
    <h2>Main Portions</h2><br>
    
    <div class="mainDishContainer">
        <?php
            createGrid("buffet_main_items.txt", "mains_images");
        ?>
    </div>

    <h2>Side Portions</h2><br>
    <div class="mainDishContainer">
        <?php
            createGrid("buffet_side_items.txt", "sides_images");
        ?>
    </div>

</body>

</html>