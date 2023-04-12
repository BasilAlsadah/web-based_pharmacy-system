<?php session_start(); ?>
<html>  
<?php include('connect_to_our_database.php'); ?>
<head>
<title>Cart page</title>    
<?php include('header.php'); ?>
<style>
    body{
        background-color: #E1FFFF;
    }
    th{
        text-align: left;
        padding: 5px;
        background-color: #144272;
        font-weight: normal;
        color: white;
    }
    td{
        padding: 10px 5px;
    }
    td input{
        width: 40px;
        height: 30px;
        padding: 5px;
    }
    td a{
        color: red;
        font-size: 12px;
    }
    td img{
        width: 80px;
        height: 80px;
        margin-right: 10px; 
    }
    td:last-child{
        text-align: right;
    }
    th:last-child{
        text-align: right;
    }
    .empty-cart{
        font-size: 80px;
        opacity: 0.4;
        position: absolute;
        top:120px;
        left: 180px;
        z-index: 1;
    }
    .checkout-button{
        position: relative;
        bottom: 0px;
        left: 40px;
        width: 200px;
        height: 35px;
        border-style: hidden;
        border-radius: 20px;
        transition: 300ms;
    }
    .checkout-button:hover{
        background-color: #144272;
        color: white;
    }
    .remove-button{
        border-style: hidden;
        color: red;
        font-size: 11px;
    }
    .update-btn{
        border-style: hidden;
        color: red;
        font-size: 11px;
    }
    .update-item{
        width: 55px;
    }
    /**/
    @page {
  size: A4;
  margin: 0;
}

body {
  font-family: Arial, sans-serif;
  font-size: 12pt;
}

.header-cart {
  text-align: center;
  font-weight: bold;
  font-size: 16pt;
  padding-top: 10pt;
}

.shopping-cart-div {
  padding: 10pt;
}

.cart-table {
  width: 100%;
  border-collapse: collapse;
}

.cart-table th,
.cart-table td {
  border: 1px solid black;
  padding: 5pt;
}

.cart-info {
  display: flex;
}

.cart-info img {
  height: 50pt;
  width: 50pt;
  margin-right: 10pt;
}

.total-price {
  padding-top: 10pt;
  text-align: right;
}

.total-price td {
  padding-right: 10pt;
}
    .payment-div{
    position: absolute;
    width: 280px;
    height: 150px;
    right: 45px;
    }
    .card-number-input{
        width: 280px;
        margin: 2px;
    }
    .card-name-input{
        width: 280px;
        margin: 2px;
    }   
    .exp-month-input{
        width: 35px;
        margin: 2px;
    }
    .card-cvv-input{
        width: 35px;
        margin: 2px;
    }
    .exp-year-input{
        width: 35px;
        margin: 2px;
    }
    
    
    
    
</style> 

<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="header-cart">
<label>Shopping Cart</label>    
</div>
<div class="shopping-cart-div">
<table class="cart-table">
<tr>
    <th>Product</th>
    <th>Quantity</th>
    <th>Total</th>

</tr>

    <tbody>
    <?php
          
    //CHECKING IF THERE IS SOMETHING IN THE CART    
      if(isset($_SESSION['cart'])){
          foreach($_SESSION['cart'] as $value){
              
            //SELECTING JUST FOR TAKING THE IMG FROM DATABASE  
            $sql="SELECT * FROM products where NAME='".$value['p_name']."';";
        
            $result=mysqli_query($connection,$sql);
            while($row=mysqli_fetch_array($result)){
                
            echo " 
        <form method='POST' action='item_action.php'> 
         <tr>
            <td>
                <div class='cart-info'>
                <img src='data:image;base64,";
                echo base64_encode($row['real_img']);
                echo"
                ' alt='img place'>
                <div>
                <p>$value[p_name]</p>
                <small>$value[p_price] SAR <input type='hidden' value='$value[p_price]' class='iprice'></small>
                <button class='remove-button' name='remove-item'>Remove</button>
                <button class='remove-button' name='update-item'>Update</button>
            </div>
        </div>
    </td>
    <td><input type='number' value='$value[p_quantity]' onchange='subtotal()' class='update-item' min='1' name='update-quantity'></td> 
    <td class='itotal'> </td>
    
</tr>
<input type='hidden' name='item' value='$value[p_name]'>
<input type='hidden' name='pro_price' value='$value[p_price]'>
</form>         
              ";
            }
          }
      }  
      else{
          echo "<p class='empty-cart'>The Cart Is Empty</p>";
      }
        
    ?>
    
    </tbody>  
    
</table>

<div class="total-price">    
<table>
<tr>
    <td>ٍSubbtotal</td>
    <?php
    
    echo "<td id='get-total'></td>";
    
    echo "</tr>";
    echo "<tr><td>Tax</td>
          <td id='getttax'>xs</td>";
    
    ?> 
</tr>    
    
</table> 

</div>
<div class='payment-div'>
<form method="post" action="checkout_validate.php">
<input type="text" class='card-number-input' placeholder="Card Number" required>
<input type="text" class='card-name-input' placeholder="Card Holder Name" required>
<input type="text" class='exp-month-input' placeholder="MM" required>
<input type="text" class='exp-year-input' placeholder="YY" required>
<input type="text" class='card-cvv-input' placeholder="CVV" required>
<input type="submit" value="Check out" class="checkout-button" name = "check-out-button">    
</form>
</div>
</div>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script>
/*
var checkOutButton = document.querySelector('.checkout-button');
checkOutButton.addEventListener('click', function() {
  var doc = new jsPDF();
  var logo = new Image();
  logo.src = 'medicine.png';

  doc.setFillColor(225, 255, 255);
  doc.rect(0, 0, doc.internal.pageSize.width, doc.internal.pageSize.height, 'F');

  doc.setFontType("bold");
  doc.setFontSize(16);
  doc.text('Cart purchases', 10, 40);

  // calculate center of paper
  var center = (doc.internal.pageSize.width / 2) - (20 / 2);
  doc.addImage(logo, 'PNG', center, 10, 20, 20);

  doc.setFontSize(10);

  // loop through all the products in the cart
  var products = document.querySelectorAll('.cart-info p');
  var quantities = document.querySelectorAll('.update-item');
  var totals = document.querySelectorAll('.itotal');
  doc.setDrawColor(0, 0, 0);

  doc.line(10, 50, 200, 50);
  for (var i = 0; i < products.length; i++) {
    var product = products[i].innerText;
    var quantity = quantities[i].value;
    var total = totals[i].innerText;

    // set the text color of "Product:" to black
    doc.setTextColor(0, 0, 0);
    doc.text('Product: ', 10, 20 + (i * 30) + 35);

    // set the text color of product to blue
    doc.setTextColor(73, 77, 77);
    doc.text(product, 26, 20 + (i * 30) + 35);

    // set the text color of "Quantity:" to black
    doc.setTextColor(0, 0, 0);
    doc.text('Quantity: ', 10, 30 + (i * 30) + 35);

    // set the text color of quantity to blue
    doc.setTextColor(73, 77, 77);
    doc.text(quantity, 26, 30 + (i * 30) + 35);

    // set the text color of "Total:" to black
    doc.setTextColor(0, 0, 0);
    doc.text('Total: ', 10, 40 + (i * 30) + 35);

    // set the text color of total to blue
    doc.setTextColor(73, 77, 77);
    doc.text(total, 20, 40 + (i * 30) + 35);
    
    doc.setLineDash([2, 2]);
    doc.line(10, 44 + (i * 30) + 35, 200, 44 + (i * 30) + 35);
  }
  doc.text('', 10, 55);
  doc.save('cart.pdf');
  */
});

</script>
<?php
        if(isset($_GET["purchase"])){
        if($_GET["purchase"]=="success"){
        echo'<script>alert("You Have purchased Items Successfully!")</script>';
        }
        else if($_GET["purchase"]=="empty-cart"){
         echo'<script>alert("Empty! you should place an item")</script>';
        }
        else if($_GET["purchase"]=="out-of-stock"){
            echo'<script>alert("out-of-stock! sorry")</script>';
        }
        
    }
        
?>    
<script>

var sum=0;
var tax_val=0;
    
var iprice=document.getElementsByClassName('iprice');
var iquantity=document.getElementsByClassName('update-item');
var itotal=document.getElementsByClassName('itotal');
var gettotal=document.getElementById('get-total');
var itax=document.getElementById('getttax');
    function subtotal(){
        
        sum=0;
        tax_val=0;
        
        for(i=0;i<iprice.length;i++){

            itotal[i].innerText=(iprice[i].value)*(iquantity[i].value)+" SAR";
            
            sum=sum+(iprice[i].value)*(iquantity[i].value);
            
        }
        //PRINTING TOTAL ORDER PRICE
        gettotal.innerText=sum+" SAR";
        
        //GETTING TOTAL TAX VALUE AND ROUND IT
        tax_val=Math.round(sum*0.15*100)/100;
        
        //PRINTING TAX VALUE
        itax.innerText=tax_val+" SAR";
    }
    
    subtotal();
    
</script>
</body>

<footer>
    
<?php //include('footer.php'); ?>    
</footer>
</html>