<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style.css">
    <title> House of Chef James Mitchell </title>
    <script type="text/javascript" src="contactUs.js"></script>
    <?php include "../contactUs/contactForm.php"; ?>
</head>

<body>
    <!-- // nav bar goes here // -->

    <h1 class="contactUsHeader">
        We would love to here from you
    </h1>
    <br>

    <!-- TODO: store forms in the DB -->
    <div class="formSection">
        <table>
            <tr>
                <td>
                    
                    <form class="contactForm" id="contactForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <p class="error"> * = mandatory fields </p>

                        <br>

                        <input class="formText" type="text" id="name" name="name" placeholder="Name"> <span class="error">* <?php echo $nameErr;?></span>
                        
                        <br><br>

                        <input class="formText" type="text" id="phone" name="phone" maxlength="12" placeholder="Phone Number (xxx-xxx-xxxx)"> <span class="error">* <?php echo $phoneErr;?></span>
                        
                        <br><br>

                        <input class="formText" type="text" id="email" name="email" placeholder="Email (example@hotmail.com)"> <span class="error">* <?php echo $emailErr;?></span>
                        
                        <br><br>

                        <input class="formText" type="text" id="address" name="address" placeholder="Address">
                        
                        <br><br>

                        <input class="formText" type="text" id="subject" name="subject" placeholder="Subject"> <span class="error">* <?php echo $subjectErr;?></span>
                        
                        <br><br>
                        
                        <textarea class="formTextArea" id="message" name="message" placeholder="Message (Allergies, etc)"></textarea> <span class="error">* <?php echo $messageErr;?></span>
                        
                        <br><br>

                        <span class="result"> <?php echo $result;?></span>
                        
                        <input type="submit" value="Submit" class="submitButton">

                        <button type="reset"class="clearButton">Clear</button>
                    </form>
                </td>
                <td>
                    <p class="formLabel1 "> We are here to answer all your questions </p>
                    <br>
                    <hr class="labelDivider ">
                    <br>
                    <p class="formLabel2 ">We want to take the time again to thank you for visiting us at our online home</p>
                </td>
            </tr>
        </table>
    </div>

    <!-- All Location Info for the Business-->
    <div class="locationInfo ">
        <table class="mainReviewTable ">
            <tr>
                <td>
                    <!-- location of the business from google maps -->

                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4713.08608792001!2d-74.09537151169121!3d45.38074314688996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc418db34dc295933!2sHouse%20of%20Chef%20James%20Mitchell%20inc.%20%7C%20House%20of%20Junior%20Chefs!5e0!3m2!1sen!2sca!4v1603919048973!5m2!1sen!2sca "
                        width="400 " height="300 " frameborder="0 " style="border:0; " allowfullscreen=" " aria-hidden="false " tabindex="0 "></iframe>

                </td>

                <td>
                    <!-- Address Table so that the picture lines up and everythign looks nice-->
                    <table class="addressTable ">
                        <tr>
                            <td>
                                <h2> Address:</h2>
                                <p> 1061 rue de la paix,<br> St.Lazare, Quebec <br>J7T 2A8, Canada </p>
                                <br> Give us a call at 514.941.5483
                            </td>
                            <td class="mailImage ">
                                <img src="../images/general/mail.png " width="200 " height="200 ">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p> For any written requests,
                                    <br> please reach us at
                                    <a href="mailto:orders@chefjamesmitchell.com ">orders@chefjamesmitchell.com </a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>



</body>

</html>