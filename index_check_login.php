<?php
//CHECKING IF ANYONE HAS LOGGED IN
if(isset($_SESSION['uname'])){
    //IF THERE IS A USER LOGGED IN SO DISPLAY WELOCME MESSAGE AND LOGOUT BUTTON
    echo "<p class='welcome-after-login'>Welcome<span> ".$_SESSION['uname']." </span></p>";
}










?>