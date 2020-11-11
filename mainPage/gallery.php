<?php

function GetImages(){
    // directory of images
    $dir = "../images/foodImages/*.*";

    //retrieve all images and put them into an array
    $images = glob($dir);

    //randomize the order
    shuffle($images);
    
    //return the array
    return json_encode($images);
}

?>