<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
session_start();
if(isset($_SESSION['uname'])){
    
    unset($_SESSION['uname']);
    unset($_SESSION['cart']); 
    unset($_SESSION['authorized']);
    unset($_SESSION['loged_in']);
    header("location: ../webproject/login.php?");
 
}

}
?>