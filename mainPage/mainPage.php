<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <link rel = "stylesheet" href = "../footer/footer.css">
    <title> House of Chef James Mitchell </title>
    <?php include "../mainPage/gallery.php"; ?>
    <script type="text/javascript" src="gallery.js" charset="utf-8"></script>
</head>

<body class="mainPageBody">
    <!-- Navigation Bar -->
    <?php include("../navBar/navBar.php")?>
    <div class="headerSection" >
        <span class="textHeaders">
            <p class="mainHeader"> House of Chef James Mitchell </p>
            <div class="divider"> </div>
            <p class="mainSubHeader"> Your Culinary Journey Begins Here </p>
        </span>
    </div>
    

    <div class="Meals">
        <div class="meals">
            <h2 class="mealsHeader"> Perfection is the Expectation</h2>
            <hr class="textdivider">
            <div id="slideshow">
                <script>
                    // get all the images from the folder with PHP
                    var images = <?php echo GetImages(); ?>;

                    //make a slideshow from the images
                    createSlideshow(images);

                    //auto-scroll the slideshow
                    autoScroll();
                </script>
            </div>
        </div>
        <div class="text">
            <h2> Previous Succeses </h2>
            <hr class="textdivider">
            <p class="textreview">"[...]The food was delicious and the service and communication was extremely professional[...]"</p>
            <br><br>
            <p class="textreview">"The most amazing appetizer put together. Just delicious. You guys are the best!! You create food that brings people together and everyone loves it.[...]"</p>
            <br><br>
            <p class="textreview">"The seared tuna we had last week was amazing! The spices were a perfect blend and the sides were so complimentary! The whole family really enjoyed it!"</p>
            <br><br>
            <p class="textreview">"If I could give them 15 stars I would"</p>
            <br><br>
            <p class="textreview">"Amazing food at a great price."</p>
            <br><br>
            <p class="textreview">"We just had our daughter's baptism catered by Chef James Mitchell. The food was beyond amazing and exceeding our expectations[...]"</p>
            <br><br>

        </div>
    </div>



    <div class="meetSection">

        <h2 class="meetHeader"> Meet the Team </h2>
        <table class="staffTable">
            <tr>
                <td>
                    <a class="userLink" href="https://www.linkedin.com/in/james-mitchell-b60b99115/?originalSubdomain=ca">
                        <div class="UserBox">
                            <div class="ImageContainer">
                                <image src="../images/staffPictures/jamesMitchell.png" alt="James Mitchell">
                            </div>
                            <div class="InfoContainer">
                                <label> Chef James Mitchell </label>
                                <br><br>
                                <label> Co-Founder & Executive Chef,
                                Culinary Instructor </label>
                            </div>
                        </div>
                    </a>
                </td>
                <td>
                    <a class="userLink" href="https://www.linkedin.com/in/danai-mitchell-6baba026/?originalSubdomain=ca">
                        <div class="UserBox">
                            <div class="ImageContainer">
                                <image src="../images/staffPictures/Danai.png" alt="Danai Alexopoulos-Mitchell">
                            </div>
                            <div class="InfoContainer">
                                <label> Danai Alexopoulos-Mitchell </label>
                                <br><br>
                                <label> CEO & Co-Founder
                                Events Coordination/Planning
                                Director  & Instructor | House of Junior Chefs </label>
                            </div>
                        </div>
                    </a>
                </td>
            </tr>
        </table>
    </div>
    

</body>

<?php include("../footer/footer.php")?>

</html>