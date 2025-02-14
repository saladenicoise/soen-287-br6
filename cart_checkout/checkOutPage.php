<?php 
require('../configure.php');
$servername = DB_SERVER;
$username = DB_USER;
$password = DB_PASS;
$dbname = DB_NAME;
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Check Out</title>
    <link rel="stylesheet" href="cart_checkout.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="">
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="">
        var mymap = null;
    </script>
    <style type="text/css">
        #map {
            height: 400px;
        }
    </style>
</head>

<body>
    <?php include("../navBar/navBar.php")?>
 <form action="orderProcess.php" method="post" onsubmit="return validateInfo()" >   

  
<div id="mainContainer">
   <div id="client_info">
    
        <div id="billing_address">
            <h3>Billing Address</h3>
            <input class="input" type="text" id="fname" name="fullname" placeholder="Name"><br/>

            <input class="input" type="text" id="email" name="email" placeholder="Email (john@example.com)" oninput="validateEmail()"><br/>
            <p id="emailErrorInfo"></p>

            <input class="input" type="text" id="adr" name="address" placeholder="Address"><br/>

            <input class="input" type="text" id="city" name="city" placeholder="City"><br/>

            <div class="row">
                <div class="col-50">

                    <input class="input" type="text" id="state" name="state" placeholder="Province">
                </div>
                <div class="col-50">

                    <input class="input" type="text" id="zip" name="zip" placeholder="Postal Code" oninput="validatePostalCode()">
                    <p id="postalCodeErrorInfo"></p>
                </div>
            </div>
        </div>
    </div>
    <div id="paymentContainer">
            <div id="payment">
                <h3>Payment</h3>

                <input class="input" type="text" id="cname" name="cardname" placeholder="Name on Card"><br/>
                <input class="input" type="text" id="ccnum" name="cardnumber" placeholder="Credit card number" oninput="validateCardNum()"><br/>
                <p id="ccnumErrorInfo"></p>

                <div class="row">
                    <div class="col-50">
                        <input class="smallinput" type="text" id="expmonth" name="expmonth" placeholder="Exp Month" oninput="validateExpMon()">
                        

                        <input class="smallinput" type="text" id="expyear" name="expyear" placeholder="Exp Year" oninput="validateExpYear()">
                        
                    </div>
                    <p id="expMonthErrorInfo"></p>
                    <p id="expYearErrorInfo"></p>
                    <div class="col-50">
                        
                        <input class="input" type="text" id="cvv" name="cvv" placeholder="CVV" oninput="validateCvv()">
                        <p id="cvvErrorInfo"></p>
                    </div>
                </div>
            </div>
    </div>

    <div id="howContainer">
        <div id="howToGet">
                    <h3>How would you like to get it?</h3>
                    <label for="pickup"><input class="radio" type="radio" name="getOrder"/>Pick Up</label>
                    <label for="delivery"><input class="radio" type="radio" name="getOrder" checked="checked"/>Delivery</label>
        </div>
    </div>
</div>
<div id="secondContainer">
    <div class="orderSummary">
    <table class="orderSummaryTable">
                    <tr>
                        <th>ITEM</th>
                        <th>SIZE</th>
                        <th>QUANTITY</th>
                        <th>TOTAL</th>
                       
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
                            
                            <td>$<?php 
                                $priceNum=substr($value["productPrice"],1);
                                $itemTotal=$priceNum*$value["productNum"];
                                echo $itemTotal;
                                ?></td>
                        </tr>

                    <?php
                            $priceNum=substr($value["productPrice"],1);
                                $total=$total+$itemTotal;
                          } ?>
                    <tr>
                        <td id="cartSubTotal" colspan="3">SUB TOTAL</td>
                        <td id="subTotalVal">$ <?php echo $total;?></td>
                    </tr>
                    <?php 
                        }
            ?>
    </table>
        <div id="pay">
                <input id="placeOrder" type="submit" value="Place Order" name="placeOrder" disabled="disabled"/>
        </div> 
</div>
</div>
<div id="thirdContainer">  
<form>   
    
    <div id="mapid" style="width: 600px; height: 400px; position: relative; outline: none;" class="leaflet-container leaflet-touch leaflet-retina leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
       
        <div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(-183.824px, 2.32031px, 0px);">
            <div class="leaflet-pane leaflet-tile-pane">
                <div class="leaflet-layer " style="z-index: 1; opacity: 1;">
                    <div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);">
                        <img alt="" role="presentation" src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/14/4842/5861?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw" class="leaflet-tile leaflet-tile-loaded"
                            style="width: 512px; height: 512px; transform: translate3d(-393px, -155px, 0px); opacity: 1;">
                        <img alt="" role="presentation" src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/14/4843/5861?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw" class="leaflet-tile leaflet-tile-loaded"
                            style="width: 512px; height: 512px; transform: translate3d(119px, -155px, 0px); opacity: 1;">
                        <img alt="" role="presentation" src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/14/4842/5862?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw" class="leaflet-tile leaflet-tile-loaded"
                            style="width: 512px; height: 512px; transform: translate3d(-393px, 357px, 0px); opacity: 1;">
                        <img alt="" role="presentation" src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/14/4843/5862?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw" class="leaflet-tile leaflet-tile-loaded"
                            style="width: 512px; height: 512px; transform: translate3d(119px, 357px, 0px); opacity: 1;">
                        <img alt="" role="presentation" src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/14/4841/5861?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw" class="leaflet-tile leaflet-tile-loaded"
                            style="width: 512px; height: 512px; transform: translate3d(-905px, -155px, 0px); opacity: 1;">
                        <img alt="" role="presentation" src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/14/4844/5861?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw" class="leaflet-tile leaflet-tile-loaded"
                            style="width: 512px; height: 512px; transform: translate3d(631px, -155px, 0px); opacity: 1;">
                        <img alt="" role="presentation" src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/14/4844/5862?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw" class="leaflet-tile leaflet-tile-loaded"
                            style="width: 512px; height: 512px; transform: translate3d(631px, 357px, 0px); opacity: 1;"></div>
                </div>
            </div>
            <div class="leaflet-pane leaflet-shadow-pane"></div>
            <div class="leaflet-pane leaflet-overlay-pane"></div>
            <div class="leaflet-pane leaflet-marker-pane"></div>
            <div class="leaflet-pane leaflet-tooltip-pane"></div>
            <div class="leaflet-pane leaflet-popup-pane"></div>
            <div class="leaflet-proxy leaflet-zoom-animated" style="transform: translate3d(2.47998e+06px, 3.00118e+06px, 0px) scale(16384);"></div>
        </div>
        <div class="leaflet-control-container">
            <div class="leaflet-top leaflet-left">
                <div class="leaflet-control-zoom leaflet-bar leaflet-control">
                    <a class="leaflet-control-zoom-in" href="#" title="Zoom in" role="button" aria-label="Zoom in">+</a>
                    <a class="leaflet-control-zoom-out" href="#" title="Zoom out" role="button" aria-label="Zoom out">−</a></div>
            </div>
            <div class="leaflet-top leaflet-right"></div>
            <div class="leaflet-bottom leaflet-left"></div>
            <div class="leaflet-bottom leaflet-right">
                <div class="leaflet-control-attribution leaflet-control">
                    <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | Map data ©
                    <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors,
                    <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery ©
                    <a href="https://www.mapbox.com/">Mapbox</a></div>
            </div>
        </div>
    </div><br/>
    <fieldset id="input">
        <legend>Search Your Address</legend>
        <form id="coordinate" action="" method="post">
            <input type="text" id="address_input" name="clientAddrr"/><br/><br/>
            
            <input type="button" id="search_button" value="submit" onclick="addr_search()" /><br/><br/>

            <br/>
            <div id="distance"></div><br/>
            <p id="deliveryFeeCal" name="deliveryFee"></p>
        </form>
    
    </fieldset>
    </form>
    <script src="checkoutFunctionality.js"></script>
    <script type="text/javascript">
        //Initialize Map	
        var chefPlaceLat = 45.3823120;
        var chefPlaceLong = -74.0943499;

        //mapid is the id for your div element
        //You can leave the rest as it is
        mymap = L.map('mapid').setView([chefPlaceLat, chefPlaceLong], 14.5);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);


        //CODE TO CHANGE ADDRESS TO LATLONG
        //https://www.w3schools.com/js/js_ajax_http_response.asp
        //https://wiki.openstreetmap.org/wiki/FR:Nominatim
        //There is also the reverse search from lat long to address
        function addr_search() {
            var addr = document.getElementById("address_input").value;
            console.log(addr);
            var xmlhttp = new XMLHttpRequest();
            var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + addr;
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var myArr = JSON.parse(this.responseText);
                    //myArr is an array of the matching addresses 
                    //You can extract the lat long attributes
                    var latTo = myArr[0].lat;
                    var lonTo = myArr[0].lon;


                    //Create markers from the info
                    var from = L.latLng(chefPlaceLat, chefPlaceLong);
                    L.circleMarker(from, {
                        color: "green",
                        radius: 7
                    }).addTo(mymap);
                    L.circle(from, {
                        radius: 1000,
                        color: "green"
                    }).addTo(mymap);
                    var to = L.latLng(latTo, lonTo);
                    L.circleMarker(to, {
                        color: "red",
                        radius: 7
                    }).addTo(mymap);


                    //Use Polyline to draw line on map
                    //https://leafletjs.com/reference-1.7.1.html
                    var latlngs = [from, to];
                    var polyline = L.polyline(latlngs, {
                        color: "red"
                    }).addTo(mymap);

                    //Compute Distance using
                    var dis = (from.distanceTo(to)).toFixed(0) / 1000;
                    var disOutput = document.getElementById("distance");
                    disOutput.innerHTML = "Your distance from our restaurant is " + dis + " km";
                    //compute delivery fee:
                    var deliveryFee;
                    var deliveryFeeMessage=document.getElementById("deliveryFeeCal");
                    if(dis<=5){
                        deliveryFeeMessage.innerHTML="Congradulations! You won't be charge any delivery fee!";
                    }else if(dis>5&&dis<=30){
                        deliveryFee=10;
                        deliveryFeeMessage.innerHTML="Your delivery fee would be $"+deliveryFee+".";
                    }else{
                        deliveryFeeMessage.innerHTML="Sorry! We cannot reach your area.";
                    }
                }
            };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
        
        
    </script>
</div>

</body>

</html>