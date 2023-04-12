<html>
<head>
<link rel="icon" href="medicineresized.png" type="image/icon type">
<style>
.cart-icon:hover {
box-shadow: 0px 0px 10px 2px #000000;
cursor: pointer;
}
    nav ul li{
        display: inline;
        padding: 8px 12px 8px 12px;
        
    }
    nav ul li a{
        text-decoration: none;
        color: #000;
        color: rgba(0, 0, 0, 0.5);
    }
    nav ul li a:hover{
        color:black;
        text-decoration: underline;
    }

</style>
<link rel="stylesheet" href="styles.css">
    <!-- header css found at line 450 in styles.css file-->
</head>
<body>
<!--START WITH HEADER-->
<header class="my-header-style">
<!--ADDING THE LOGO-->
<a href="index.php">
<img src="medicineresized.png" class="my-logo-style">
<!--ADDING LABEL WITH LOGO-->
<label class="logo-label-style">Pharmacy System</label>
</a>
<!--ADDING NAVIGATION BAR-->
<div class="nav-class-div">
<nav>
<ul>
    <li><a href="index.php">Home page</a></li>
    <li><a href="contact_us.php">Contact us</a></li>  
    <li><a href="#">About us</a></li>
    <li><a href="administrator_page.php">Admin page</a></li>
    <?php
    include('index_check_login.php');
    if(isset($_SESSION["uname"]))
    {
        echo "<form method='POST' action='logout_validate.php'><input type='submit' class='logout-button' value='Log out'></form>";
    }
    else
    {
        echo "<li><a href='Login.php'>login</a></li>";
        echo "<li><a href='signup.php'>Signup</a></li>";
    }
    ?>
    <!--<li><a href="Login.php">login</a></li>
    <li><a href="signup.php">Signup</a></li>-->
</ul>    
</nav>    
</div>
<!--ADDING REGISTER BUTTON AND CART-->
<div class="right-div">
<!--<button class="login-button">Log in</button> --> 
<a href="cart.php"><img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png" class="cart-icon"></a>
<label class="cart-label">my cart</label>
</div>
</header>    
    
</body>
</html>