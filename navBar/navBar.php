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
    $replaceLogin = 0;
    if(isset($_SESSION['login'])) {
        $replaceLogin = 1;
    }
?>

<div>
<ul class="navi">
    <li class="navBar"><a class="navbarElement" href="../mainPage/mainPage.php">Main Menu</a></li>
    <li class="navBar"><a class="navbarElement" href="../menu/menu.php">Shop</a></li>
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
    <li class="navBar" style="float: right;"><a class="navbarElement" href="../menu/cart.php">Cart</a></li>
</ul>
</div>