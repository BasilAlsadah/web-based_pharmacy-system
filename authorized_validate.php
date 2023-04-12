<?php

    session_start();
    
    if(isset($_SESSION['authorized'])){
        
        if($_SESSION['authorized']==false){
            echo '<script type="text/javascript">';
            echo ' alert("You Are Not Authorized!")';  //not showing an alert box.
            echo '</script>';
            echo "<p style='font-size:24px;'>Unathorized Access!</p>";
            exit();
        }
        
        
    }
    else if(!isset($_SESSION['authorized'])){
            echo '<script type="text/javascript">';
            echo ' alert("You Are Not Authorized!")';  //not showing an alert box.
            echo '</script>';
            echo "<p style='font-size:24px;'>Unathorized Access!</p>";
            exit();
    }



?>