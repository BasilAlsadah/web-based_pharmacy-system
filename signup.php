<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <title>User Login</title>
<style>
body {font-family: Arial, Helvetica, sans-serif;
 background-color: #E1FFFF;}


input[type=text], input[type=password] {
  width: 95%;
  padding: 8px 16px;
  margin: 10px 0;
  display: inline-block;
  border: 2px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: rgb(100, 147, 255);
  color: white;
  padding: 10px 16px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 30%;

}
.center {
  position: absolute;
  top: 50%;
  width: 100%;
  text-align: center;
  font-size: 18px;
 position: absolute
}
button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: 25%;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 20%;
  border-radius: 0;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.cont{

 text-align: center;
}
    

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

.inpu{
        
        width: 270px;
        position: relative;
        margin: 0 auto;
    }
</style>
</head>




<h2 align="center">Sign-up Form</h2>
<form action = "signup_validate.php" method="POST">
	<div class="inpu">
    <input type="text" placeholder="Enter Fullname...." name="name" required>
    <input type="text" placeholder="Enter Email...." name="email" required>
    <input type="text" placeholder="Enter phone number...." name="phoneNumber" required>
    <input type="text" placeholder="Enter Gender (M or F)...." name="Gender" required>
    <input type="password" placeholder="Enter Password" name="password" required>
    <input type="password" placeholder="Re-enter Password" name="re_password" required>
    <div class="cont"> 
    <button type="submit" name="submit">Sign Up</button> 
	</div>
    </div>
</form>

<?php
  /*
    if(isset($_GET['error'])){
        if($_GET['error'] == "emptyinput"){
            echo "<script>";
            echo "window.alert('Missing Field')";
            echo "</script>";
        }
    }
    
  */

   // needs heavy css
    if(isset($_GET["error"]))
    {
        //if($_GET["error"] == "emptyinput")
        //{
        //    echo "<p>You have to fill in all the fields!</p>";
        //}
        if ($_GET["error"] == "invaildemail")
        {
            echo "<p>Please enter an appropriate email.</p>";
        }
        else if ($_GET["error"] == "passwordsdontmatch")
        {
            echo "<p>Passwords doesn't match!</p>";
        }
        else if ($_GET["error"] == "connection_failed")
        {
            echo "<p>Something went wrong. Please  try again.</p>";
        }
        else if ($_GET["error"] == "none")
        {
            //echo "<p>You have signed up sucessfully!</p>";
            //echo "<script>";
            //echo "window.alert('Account has created successfully')";
            //echo "</script>";
        }
    }

  
?>






<?php
include ('footer.php');
?>

</html>