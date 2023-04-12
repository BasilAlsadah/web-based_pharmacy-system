<?php session_start(); ?>
<?php include('connect_to_our_database.php'); ?>
<?php include('header.php'); ?>
<html>
<head>
<title>this is for testing purpose</title>   
<style>
    body{
        background-color: #E1FFFF;
    }    
    
</style>
<link rel="stylesheet" href="styles.css">
</head>
<body>   

<!--ADDING THE MAIN DIV-->
<div class="big-div">
<!--ADDING DIV FOR DIV TITLE-->
<div class="header-for-the-div">
<?php 
    print("<label class='div-label-style'>Available Products for ( <span class='div-label-span-style'>");
    echo $_GET['category-btn'];
    print(" </span>)</label>");
?>
</div>    
<!--ADDING DIV FOR PRODUCT DISPLAY-->
<div class="products-display-div">
<!--HERE WE WILL START PHP-->
    <?php
    switch($_GET['category-btn']){
        case 'vitamin-category':
            $my_query="SELECT * FROM products where category='Vitamins'";
            break;
        case 'daily-essentials-category':
            $my_query="SELECT * FROM products where category='daily-essentials'";
            break;
            
        case 'medication-category':
            $my_query="SELECT * FROM products where category='medications'";
            break;
            
        default:
            echo "you should choose a category first";
    }
            $result=mysqli_query($connection,$my_query);
            while($row=mysqli_fetch_array($result)){
            $pr_name=$row['NAME'];
            $pr_price=$row['SELLING_PRICE'];
            $pr_description=$row['description'];  
            $pr_id=$row['Product_ID']; 
                
            print("<div class='products-cards'>
                    <div class='product-img'>
                        <img src='data:image;base64,");
                        echo base64_encode($row['real_img']);
                        print (" ' alt='this is image place'>
                            <form method='GET' action='product_detail_page.php'><button name='product_id' value='$pr_id' class='card-btn'>Show Details</button></form>
                    </div>
                    <div class='product-info'>
                        <h2 class='product-name'>
                        ");
                echo $pr_name;
                print("</h2>
                        <p class='product-des'>
                        ");
                echo $pr_description;
                print("
                    </p>
                    <span class='product-price'>
                    ");
                    echo $pr_price;
                    print("
                    SAR </span>
                    </div>
                    </div>
                    ");            
            } 
                ?> 
    </div>
    <?php
    
    
    ?>

<footer>
<?php include('footer.php'); ?>    
</footer>
</body>

</html>