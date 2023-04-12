<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        session_start();
        include_once('connect_to_our_database.php');
        if(!isset($_SESSION['cart'])){
            header("location: ../webproject/cart.php?purchase=empty-cart");
            exit();
        }
        //LOOP ON EVERY ITEM IN THE CART
        foreach($_SESSION['cart'] as $key=>$value){
            
        $sql="SELECT * FROM products WHERE NAME='".$value['p_name']."' ;";
        $result = mysqli_query($connection, $sql);
            
        if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        //GET QUANTITY LEFT FROM THE DATABASE
        $quantity_left = $row['QUANTITY'];
            //CHECKING QUANTITY
            if($value['p_quantity']>$quantity_left){
            header("location: ../webproject/cart.php?purchase=out-of-stock");
            exit();
            }
            else{
                echo "YOU CAN BUY $value[p_name]";
                echo "<br>";
                $cookie_array[]=['pro_name'=>$value["p_name"],
                                'pro_quantity'=>$value["p_quantity"],
                                'pro_total'=>$value["p_price"]*$value["p_quantity"]
                                ];
                
            }
           
    }      
            
}
        print_r($cookie_array);
        $username=$_SESSION['uname'];
        $cookie_name=$_SESSION['uname'];
        $cookie_existing_data=$_COOKIE[$username] ?? [];
        
        if(!empty($cookie_existing_data)){
          $cookie_existing_data=json_decode($cookie_existing_data , true);  
        }
        //ADDING PURCHASES ITEMS
        $cookie_existing_data=array_merge($cookie_existing_data , $cookie_array);
        
        $cookie_existing_data=json_encode($cookie_existing_data);
        
        setcookie($cookie_name, $cookie_existing_data);
        
    }

?>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include_once('connect_to_our_database.php');
  
    foreach($_SESSION['cart'] as $key=>$value){
  $product_name = $value['p_name'];
  $product_price = $value['p_price'];
  $product_quantity = $value['p_quantity'];
    
  $sql = "SELECT QUANTITY FROM products WHERE NAME = '$product_name'";
  $result = mysqli_query($connection, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $quantity_left = $row['QUANTITY'];
  }
  
  if ($quantity_left >= $product_quantity) {
    //UPDATE QUANTITY
     $updated_quantity = $quantity_left - $product_quantity;
    $update_sql = "UPDATE products SET QUANTITY = $updated_quantity WHERE NAME = '$product_name'";
    if (mysqli_query($connection, $update_sql)) {
      // Quantity updated successfully
    } else {
      // Error updating quantity
    }
      
    }
    
    }
    
}
//FINAL STAGE
unset($_SESSION['cart']);
//session_destroy();
 header("location: ../webproject/cart.php?purchase=success");
?>