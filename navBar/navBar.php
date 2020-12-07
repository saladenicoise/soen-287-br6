<?php
    /**
    * @return bool
    */


    function is_session_started()
    {
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }

    if ( is_session_started() === FALSE ) session_start();
    $totalNumber=0;
    foreach($_SESSION["cart"] as $key=>$value){
    $totalNumber=$totalNumber+$value["productNum"];
}
    $replaceLogin = 0;
    if(isset($_SESSION['login'])) {
        $replaceLogin = 1;
    }
?>

<ul class="navi">
     <!-- <li><a href="null">Shopping Page</a></li>
    <li><a href="null">Menu Page</a></li>
    <li><a href="null">Cooking Classes</aCooking</li> 
    
    <li class="dropdownn">
         <a class="dropMenu" href="../catering_pages/catering_page.php">Catering</a>
        <div>
            <a class="navbarElement" href="../catering_pages/catering_page.php">Catering</a>
            <a class="navbarElement" href="../catering_pages/catering_page.php">Catering</a>
        </div> 
    </li> 
    
    Plan on implementing a drop down for the catering section-->

    <li class="navBar"><a class="navbarElement" href="../mainPage/mainPage.php">Main Menu</a></li>
    <li class="navBar"><a class="navbarElement" href="../menu/menu.php">Shop</a></li>
    <li class="navBar"><a class="navbarElement" href="../weekly_menu/weekly_menu.php">Weekly Menu</a></li>
    <li class="navBar"><a class="navbarElement" href="../catering_pages/catering_main.php">Catering</a></li>
    <li class="navBar"><a class="navbarElement" href="../aboutUs/aboutUs.php">About Us</a></li>
    <li class="navBar"><a class="navbarElement" href="../contactUs/contactUs.php">Contact Us</a></li>
    <li class="navBar"><a class="navbarElement" href="../reviewPage/reviews.php">Reviews</a></li>
    <?php
    if($replaceLogin != 1) : ?>
    <li class="navBar" style="float: right;"><a class="navbarElement" href="../login/login.php">Login</a></li>
    <?php else : ?>
    <li class="navBar" style="float: right;"><a class="navbarElement" href="../dashboard/regular.php">Profile</a></li>
    <?php endif; ?>
    <li class="navBar" style="float: right;"><a class="navbarElement" href="../cart_checkout/cart.php">Cart <span class="MainPageCart"><?php echo $totalNumber; ?></span></a></li>
</ul>
