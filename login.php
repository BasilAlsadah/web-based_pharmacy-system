<?php
include_once 'header.php';
?>
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

    .eror-message{
        position: absolute;
        top:85px;
        left: 315px;
        color: red;
        font-size: 18px;
    }
.inpu{
        
        width: 250px;
        position: relative;
        margin: 0 auto;
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
</style>
</head>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $fullname=$_POST['name'];
    $password=$_POST['password']; //MEYBE WE DONT NEED TO USE THIS ITS USELESS
    
    include_once('connect_to_our_database.php');
    include_once('functions.php');
    
    //IF THERE IS ANY FIELD IS EMPTY    
    //if(empty($fullname)||empty($_POST['password'])){
    //    header("location: ../webproject/login.php?error=emptyinput");
    //    exit();
    //}
    
    $customer_sql="SELECT * FROM customers WHERE Customer_Name='$fullname' AND PASS_WORD='".$_POST['password']."' ;";
    $admin_sql="SELECT * FROM admin_login WHERE Admin_SSN='$fullname' AND password='".$_POST['password']."' ;";
    if(mysqli_query($connection,$customer_sql)){
        
        //CHECK THE CUSTOMER TABLE IF USERNAME AND PASSWORD IS HERE
        $customer_result=mysqli_query($connection,$customer_sql);
        while($row=mysqli_fetch_array($customer_result)){
            
            //WHEN CUSTOMER FOUND SO WE WILL START THE SESSION
            
            session_start();
            $_SESSION['uname']=$row['Customer_Name'];
            $_SESSION['authorized']=false;
            $_SESSION['loged_in']=true;
            
           header("location: ../webproject/index.php?login=customer_success");
            exit();
        }
        
        
        //IF NO CUSTOMER FOUND WE WILL CHECK FOR ADMIN TABLE
        $admin_result=mysqli_query($connection,$admin_sql);
        while($row=mysqli_fetch_array($admin_result)){
            //WHEN ADMIN IS FOUND SO WE WILL START THE SESSION
            session_start();
            $_SESSION['uname']=$row['Admin_SSN'];
            $_SESSION['authorized']=true;
            $_SESSION['loged_in']=true;
            
            header("location: ../webproject/index.php?login=admin_success");
            exit();
        }
        //IF NO USER FOUND THEN ERROR
        $error_message="Incorrect login information.";
    }
    else{
        
    }
}
?>

<body>
<h2 align="center">Login Form</h2>
<form action = "" method ="post">
    <div class="inpu">
    <input type="text" placeholder="Enter Fullname/Email...." name="name" required>
    <input type="password" placeholder="Enter Password" name="password" required>
   
    <div class="cont"> 
    <button type="submit" name="submit">Login</button> 
    <?php echo "<p class='eror-message'>$error_message</p>"; ?>
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
        //    echo "<p class='eror-message'>You have to fill in all the fields!</p>";
        //}
        if ($_GET["error"] == "not_found")
        {
            echo "<p class='eror-message'>Incorrect login information.</p>";
        }
        else if ($_GET["error"] == "none"){
            echo "<p class='eror-message'>Sign-up was sucessful!</p>";
        }
    }
    
    /*
    if(isset($_GET["error"]))
    {
        if($_GET["error"] == "emptyinput")
        {
            echo "<p>You have to fill in all the fields!</p>";
        }
        else if ($_GET["error"] == "wronglogin")
        {
            echo "<p>Incorrect login information.</p>";
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
    */
  
?>

<footer>
<?php
include_once 'footer.php';
?>
</footer>
</body>