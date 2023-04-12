<html> 
<head>
<title>Product Detail</title>
<?php include('header.php'); ?>
<?php include('connect_to_our_database.php'); ?>
<style>
   body{
        background-color: #E1FFFF;
    } 
    .head-label{
        
        position: relative;
        margin: 0 auto;
        width: 925px;
        height: 40px;
        font-size: 24px;
    }
    .red-span{
        color: red;
    }
    .main-div{
        
        position: relative;
        margin: 0 auto;
        width: 925px;
        height: 450px;
    }
    .img-detail{
        
        position: absolute;
        top: 10px;
        left: 15px;
        height: 150px;
        width: 300px;
    }
    .product-name-detail{
        
        position: absolute;
        width: 280px;
        height: 50px;
        top:35px;
        left: 390px;
        font-size: 24px;
        font-style: italic;
    }
    .price-detail{
        
        position: absolute;
        width: 200px;
        height: 50px;
        top:250px;
        left: 390px;
        font-size: 20px;
        font-style: italic;
        opacity: 0.8;
    }
    .des-detail{
        
        position: absolute;
        width: 320px;
        height: 100px;
        top:115px;
        left: 390px;
        font-size: 20px;
        font-style: italic;
        opacity: 0.8;
    }
    .quantity-counter{
       
        position: absolute;
        width: 320px;
        height: 100px;
        top:315px;
        left: 390px;
    }
    .my-counter{
        position: absolute;
        left: 70px;
        width: 55px;
    }
    .add-to-cart-button{
        position: absolute;
        top:50px;
        left: 50px;
        width: 230px;
        height: 35px;
        border-style: hidden;
        border-radius: 20px;
        transition: 220ms;
    }
    .add-to-cart-button:hover{
        background-color: #144272;
        color: white;
    }
    .category-detail{
       
        position: absolute;
        width: 200px;
        height: 30px;
        top:90px;
        left: 390px;
        font-size: 15px;
        font-style: italic;
        opacity: 0.8;
    }
    .not-found-p{
        font-size: 28px;
        opacity: 0.7;
        text-align: center;
    }
</style>        
<script>
function showAlert(message) {
    alert(message);
}

<?php 
if(isset($_GET["add"])) {
    if ($_GET["add"] == "success") {
        echo 'showAlert("Product Added To Cart Successfully");';
    } else if ($_GET["add"] == "failed") {
        echo 'showAlert("Product Could Not Be Added To Cart. Please Try Again.");';
    } else if ($_GET["add"] == "quantity_zero") {
        echo 'showAlert("Quantity Cannot Be Zero");';
    } else if ($_GET["add"] == "over_quantity") {
        echo 'showAlert("Requested Quantity Is Not Available");';
    }
      else if($_GET["add"]=="not_loged_in"){
        echo 'showAlert("You Should Log in First");';
    }
}
?>
</script>    
</head>
<body>
<?php
    
    //GETTING PRODUT ID OR GETTING PRODUCT NAME FROM THE SEARCH BAR
    $getting_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
    $product_name = isset($_GET['product_name']) ? $_GET['product_name'] : null;
    
    if ($getting_id) {
        $sql="SELECT * FROM products where Product_ID=$getting_id";
    } else if ($product_name) {
        $sql="SELECT * FROM products WHERE NAME LIKE '%$product_name%'";
    }
    
    $result = mysqli_query($connection, $sql);
    //IF A PRODUCT IS EXIST SO PRINT ALL INFORMATION
    if($row=mysqli_fetch_array($result)){
            $pr_name=$row['NAME'];
            $pr_price=$row['SELLING_PRICE'];
            $pr_category=$row['category'];
            $pr_description=$row['description'];  
            $pr_id=$row['Product_ID'];
        
            print("
            <!--ADDING DIV FOR THE PAGE LABEL-->
            <div class='head-label'>
            <label>Detail about (<span class='red-span'>");
            echo $pr_name;
        
        print("</span>)</label></div>
            <!--ADDING MAIN DIV-->
            <div class='main-div'>
            <!--ADDING DIV FOR IMG-->
            <div class='img-detail'>
            <img src='data:image;base64,");
            echo base64_encode($row['real_img']);
            print("' alt='This is img place'>    
            </div>
            <!--ADDING DIV FOR product NAME-->
            <div class='product-name-detail'>
            <label>Product Name : ");
            echo $pr_name;
            print("
            </label>    
            </div>
            <!--ADDING DIV FOR PRICE-->
            <div class='price-detail'>
            <label>Price : ");
            echo $pr_price;
            print("
            SAR</label>    
    
            </div>
            <div class='category-detail'>
            <label>Category : ");
            echo $pr_category;
            print("
            </label>    
            </div>
            <div class='des-detail'>
            <label>");
            echo $pr_description;
            print("
            </label>    
            </div>
            <div class='quantity-counter'>
            <form method='POST' action='add_to_cart.php'>
            <label>Quantity</label>
            <input type='number' value='1' class='my-counter' name='quantity'> 
            <button class='add-to-cart-button' name='add-to-cart-button'>Add to cart</button>
            <input type='hidden' name='product_name' value='$pr_name'>
            <input type='hidden' name='product_price' value='$pr_price'>
            
            </form>    
            </div>
            </div> 
            ");
            if(isset($_GET["add"])){
            if($_GET["add"]=="success"){
                echo'<script>Product Added To Cart Successfully</script>';
            }
            else if($_GET["add"]=="fail")
            {
                echo '<script>alert("Sorry, the requested quantity is not available.");</script>';
            }
            else if($_GET["add"]=="wrong_input")
            {
                echo '<script>alert("Quantity must be a number and greater than zero.");</script>';
            }
            else if($_GET["add"]=="not_found")
            {
                echo '<script>alert("Item not found in warehouse.");</script>';
            }
            else if($_GET["add"]=="not_available")
            {
                echo '<script>alert("Sorry, the quantity in the warehouse is lower than requested.");</script>';
            }
        
    }
        
        
    }
    else{
        //IF PRODUCT NOT FOUND SO PRINT 'ITEM NOT FOUND
        echo "<p class='not-found-p'>Item Not Found</p>";
    }
?>
    


<footer>
<?php include('footer.php'); ?>    
    
</footer>

</body>

</html>