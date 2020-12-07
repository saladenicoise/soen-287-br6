<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <title> House of Chef James Mitchell </title>
    <link rel = "stylesheet" href = "../footer/footer.css">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <?php include "../contactUs/contactForm.php"; ?>
</head>

<body>
    <?php include("../navBar/navBar.php"); ?>
    


    <!-- TODO: store forms in the DB -->
    <div class="formSection">
        <div class="formContainer">

            <form class="contactForm" id="contactForm" method="POST" action="">
                

                <input class="formText" type="text" id="name" name="name" placeholder="* Name" required> 

                <br><br>

                <input class="formText" type="tel" id="phone" name="phone" maxlength="12" placeholder="* Phone Number (ex. 000-000-0000)" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required> 

                <br><br>

                <input class="formText" type="email" id="email" name="email" placeholder="* Email (example@hotmail.com)" required> 

                <br><br>

                <input class="formText" type="text" id="address" name="address" placeholder="Address">

                <br><br>

                <input class="formText" type="text" id="subject" name="subject" placeholder="* Subject" required> <span class="error">

                <br><br>

                <textarea class="formTextArea" id="message" name="message" placeholder="Message (Allergies, etc)" required></textarea> 

                <br><br>

                <span class="result"> <?php echo $result;?></span>

                <p> mandatory fields *</p>

                <br><br>

                <input type="submit" value="Submit" class="submitButton">

                <button type="reset" class="clearButton">Clear</button>
            </form>
        </div>
        <div class="formHeader">
            <br><br><br><br><br><br><br><br><br><br><br><br>
            <p class="bigText"> We are here to answer all your questions </p>
            <br>
            <hr class="maindivider2">
            <br>
            <p class="smallText">We want to take the time again to thank you for visiting us at our online home</p>
        </div>
    </div>



    <!-- All Location Info for the Business-->
    <div class="locationInfo ">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4713.08608792001!2d-74.09537151169121!3d45.38074314688996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc418db34dc295933!2sHouse%20of%20Chef%20James%20Mitchell%20inc.%20%7C%20House%20of%20Junior%20Chefs!5e0!3m2!1sen!2sca!4v1603919048973!5m2!1sen!2sca "
                        width="400 " height="300 " frameborder="0 " style="border:0; " allowfullscreen=" " aria-hidden="false " tabindex="0 "></iframe>
        </div>
        <div class="addr">
            <h2 class="bigText"> Address:</h2>
            <p class="smallText"> 1061 rue de la paix,<br> St.Lazare, Quebec <br>J7T 2A8, Canada </p>
            <br> <p class="smallText">Give us a call at 514.941.5483</p>
            <p class="smallText"> For any written requests,
                <br> please reach us at
                <a href="mailto:orders@chefjamesmitchell.com ">orders@chefjamesmitchell.com </a>
            </p>
            </div>

    </div>

    <?php include("../footer/footer.php")?>

</body>

</html>