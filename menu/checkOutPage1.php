<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Check Out</title>
    <link rel="stylesheet" href="menuStyle.css">
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

    <div id="orderSummary">
        <div class="dishes-container-Bill">
            <div class="dish-headers-Bill">
                <h5 class="dishSize-Bill">SIZE</h5>
                <h5 class="dishPrice-Bill">PRICE</h5>
                <h5 class="dishQuantity-Bill">QUANTITY</h5>
                <h5 class="dishTotal-Bill">TOTAL</h5>
            </div>
            <div class="dishes-Bill">

            </div>
        </div>

        <script src="menu.js"></script>

    </div>



    <form action="checkOut.php">
        <div id="billing_address">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe"><br/>
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com"><br/>
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street"><br/>
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York"><br/>

            <div class="row">
                <div class="col-50">
                    <label for="state">Province</label>
                    <input type="text" id="state" name="state" placeholder="QC">
                </div>
                <div class="col-50">
                    <label for="zip">Postal Code</label>
                    <input type="text" id="zip" name="zip" placeholder="H3H 2G1">
                </div>
            </div>
            <div id="payment">
                <h3>Payment</h3>

                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="cardname" placeholder="Alice Doe">
                <label for="cnum">Credit card number</label>
                <input type="text" id="ccnum" name="cardnumber" placeholder="0000-0000-0000-0000"><br/>


                <div class="row">
                    <div class="col-50">
                        <label for="expmonth">Exp Month</label>
                        <input type="text" id="expmonth" name="expmonth" placeholder="November">
                        <label for="expyear">Exp Year</label>
                        <input type="text" id="expyear" name="expyear" placeholder="2020">
                    </div>
                    <div class="col-50">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="352">
                    </div>
                </div>
            </div><br/><br/>
            <div id="howToGet">
                <label for="pickup"><input type="checkbox"/>Pick Up</label>
                <label for="delivery"><input type="checkbox"/>Delivery</label>
            </div><br/><br/>
            <div id="pay">
                <input id="placeOrder" type="submit" value="Place Order" />
            </div>


    </form>
    <br/><br/>
    <h3>Find Where We Are:</h3>
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
        <form id="coordinate">
            <input type="text" id="address_input" /><br/><br/>
            <input type="button" id="search_button" value="submit" onclick="addr_search()" /><br/><br/>

            <br/>
            <div id="distance"></div><br/>
        </form>
    </fieldset>
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
                }
            };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
    </script>

</body>

</html>