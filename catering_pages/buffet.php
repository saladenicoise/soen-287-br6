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
        <h2>Buffet Options</h2>
        <p>There can be a minimum required order for some options. Feel free to contact us directly if you might want<br>something different, we will assist you in any way that we can</p>
        <br><p>Re-heating can and should be done in your oven at 350-F for about 35 - 45 minutes</p>
    </div><br>
    
    

    <div class="mainDishContainer">
        <?php
            $itemFile = "buffet_main_items.txt";
            $itemDescriptions = Array();

            $directory = "buffet_images";
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

                print "

                <div class = \"mainDishItem\">
                    <img width = \"180px\" src = \"buffet_images/$images[$i]\">
                    <h4>$tempDescription</h4>
                    <p>$$tempPrice</p>
                </div>
                
                ";
            }
        ?>
    </div>
</body>

</html>