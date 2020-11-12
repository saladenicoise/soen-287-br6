<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style.css">
    <!-- style sheet not made by us. It is made available to everyone from W3Schools. I only used it for the star ratings in the first table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../navBar/navBarStyles.css">
    <link rel = "stylesheet" href = "../footer/footer.css">
    <title> House of Chef James Mitchell </title>
</head>

<body class="reviewPageBody">
    <?php include("../navBar/navBar.php")?>
   

    <!-- Main Header-->
    <h1 class="mainReviewHeader"> Reviews</h1>



    <!-- Main table with logo anf overall reviews-->
    <table class="mainReviewTable">
        <tr>
            <th>
                <!-- Leave this empty -->
            </th>
            <th>Overall Ratings</th>
        </tr>
        <tr>
            <td>
                <img class="logoReview" src="../images/general/Logo.png" alt="Main Logo">
            </td>
            <td>
                <!-- Nested Table for overall reviews-->
                <table class="reviewTable">
                    <tr>
                        <th class="googleReview"> <a href="https://g.page/houseofchefjamesmitchell?share">Google:</a>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                    </tr>
                    <tr>
                        <td class="facebookReview"> <a href="https://www.facebook.com/houseofchefjamesmitchell/reviews/?ref=page_internal">Facebook:</a>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Second Header-->
    <h1 class="facebookReviewHeader"> Here's what other people had to say!</h1>

    <!-- Table for embedded reviews -->
    <table class="facebookReviewTable">
        <tr class="facebookReviewTable">
            <td>
                <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fmarlene.brown.7543%2Fposts%2F10157657038700737&show_text=true&width=552&height=184&appId" width="552" height="180" style="border:none;overflow:hidden" scrolling="no"
                    frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                <br>

                <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fbrigitte.girard%2Fposts%2F10158930500366980&show_text=true&width=552&height=259&appId" width="552" height="220" style="border:none;overflow:hidden" scrolling="no"
                    frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                <br>

                <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fduckens.montlouis%2Fposts%2F2320918634667954&show_text=true&width=552&height=693&appId" width="552" height="693" style="border:none;overflow:hidden" scrolling="no"
                    frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                <br>

                <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Feloisagarza.ravingcakes%2Fposts%2F1155271247993824&show_text=true&width=552&height=221&appId" width="552" height="221" style="border:none;overflow:hidden" scrolling="no"
                    frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

                <br>
            </td>
        </tr>

    </table>
    <?php include("../footer/footer.php")?>
</body>

</html>