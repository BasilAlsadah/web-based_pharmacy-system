<?php session_start() ; ?>

<?php include_once('connect_to_our_database.php'); ?>
<?php include_once('functions.php'); ?>
<html>
<head>
<title>System Home Page</title>    
<?php include('header.php'); ?>

<style>
    body{
        background-color: #E1FFFF;
    }
    .empty-cookie{
        font-size: 80px;
        opacity: 0.3;
        position: absolute;
        top:35px;
        left: 345px; 
}
</style>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<!--ADDING FIRST DIV FOR THE LABEL-->
<div class="first-div">
<label class="main-label"><span class="span-one">Pharmacy System </span> Your best destination for products</label> 
<!--ADDING MEDICINE ICON-->
<img src="https://cdn-icons-png.flaticon.com/512/2681/2681991.png" class="medicine-class">
<!--A LOREM FILL JUST FOR DESIGN-->
<p class="lorem-fill">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
</p>
</div>
<br>
<!--ADDING SECOND DIV-->
<div class="second-div">
<form method="GET" action="product_detail_page.php">
<!--ADDING SEARCH BAR-->
<input type="text" class="my-search-bar" name="product_name" placeholder="What are you looking for...">    
<!--ADDING SEARCH BUTTON-->
<button class="search-button" type="submit"><img src="https://cdn-icons-png.flaticon.com/512/3031/3031293.png" class="search-icon" ></button>
</form>    
</div>
    
<!--ADDING THIRD DIV-->
<div class="third-div">
<!--THIS FORM IS TO CHOOSE THE GATEGORY-->
<form method="get" name="category_form" action="view_products.php">
    
<!--ADDING DIV FOR CREATING BOX1-->
<div class="box1">
<button class="vitamins-button" value="vitamin-category" name="category-btn"><img src="https://cdn-icons-png.flaticon.com/512/525/525862.png" class="vitamins-icon"></button>  
<label class="vitamins-label">Vitamins</label>
</div>
    
    
<!--ADDING DIV FOR CREATONG BOX2-->
<div class="box2">
<button class="daily-essentials-button" value="daily-essentials-category" name="category-btn"><img src="https://cdn-icons-png.flaticon.com/512/2779/2779344.png" class="daily-essentials-icon"></button>   
<label class="daily-essentials-label">daily-essentials</label>
</div>
    
    
<!--CREATING DIV FOR CREATEING BOX3-->
<div class="box3">
<button class="medication-button" value="medication-category" name="category-btn"><img src="https://cdn-icons-png.flaticon.com/512/883/883407.png" class="medication-icon"></button>
<label class="medication-label">Medication</label>   
</div>
</form>
</div>
<!--FOURTH DIV-->
<div class="fourth-div">
<label class="past-purchase-label">Past Purchases</label>    
    
<div class="shopping-cart-div">
<table class="cart-table">
<tr>
    <th>Product</th>
    <th>Quantity</th>
    <th>Total</th>

</tr>
    <?php
    //COOKIES PRINTING
    $username=$_SESSION["uname"];
    
    $data=$_COOKIE["$username"] ?? [];
    
    $data=!empty($data) ? json_decode($data,true) : [] ;
    
    foreach ($data as $item){
        echo'<tr><td>'.$item['pro_name'].
        '</td><td>'.$item['pro_quantity'].
        '</td><td>'.$item['pro_total'].
        '</td>';
    }
    if(empty($data)){
        echo "<p class='empty-cookie'>Empty</p>";
    }
    
    
    
    
    ?>

    </table></div>

    
</div>
    
<br><br><br><br><br><br>
<footer>
<?php include('footer.php'); ?>
</footer>
</body>
</html>