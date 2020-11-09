<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style.css">
    <title> House of Chef James Mitchell </title>
    <?php include "../mainPage/gallery.php"; ?>
    <script type="text/javascript" src="gallery.js" charset="utf-8"></script>
</head>

<body class="mainPageBody">
    <!-- // nav bar goes here // -->

    <div class="headerSection">
        <span class="textHeaders">
            <p class="mainHeader"> House of Chef James Mitchell </p>
            <div class="divider"> </div>
            <p class="mainSubHeader"> Your Culinary Journey Begins Here </p>
        </span>
    </div>
    <div class="Meals">
                    <div class="meals">
                        <h2 class="mealsHeader"> Check Out some of our previous Meals </h2>
                        <div id="slideshow">
                            <script>  
                                // get all the images from the folder with PHP
                                var images = <?php echo GetImages(); ?>;

                                //make a slideshow from the images
                                createSlideshow(images); 
                            </script>
                        </div>
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

    <div class="giftCertificates">
        <h2 class="giftCardHeader"> Gift Cards </h2>
        <!-- TODO: Make this -->
    </div>

</body>

</html>