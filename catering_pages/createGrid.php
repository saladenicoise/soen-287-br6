<?php
function createGrid($txtFile, $imageDirectory)
{
            $itemFile = $txtFile;
            $itemDescriptions = Array();


            $price = false;


            switch($imageDirectory)
                {
                    case("buffet_mains_images"):
                        $src = "cateringImages/buffet_mains_images";
                        $images = scandir($src);
                        $price = true;
                        break;
                    case("buffet_sides_images"):
                        $src = "cateringImages/buffet_sides_images";
                        $images = scandir($src);
                        $price = true;
                        break;
                }


            //Do Not Touch, nothing needs to be added here
            if(file_exists("cateringItemsFiles/" . $itemFile))
            {
                $file = fopen("cateringItemsFiles/" . $itemFile, "r");
                
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

                //Need to have two print statements depending on if the 
                //Price is included or not
                print "

                <div class = \"dishItem\">
                    <img width = \"180px\" src = \"$src/$images[$i]\">
                    <h4>$tempDescription</h4>
                    <p>$$tempPrice Per Portion</p>
                </div>
                ";
            }
}

?>