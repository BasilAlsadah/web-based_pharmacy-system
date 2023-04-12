<?php
session_start();
if(isset($_SESSION['loged_in'])==true){
if (isset($_POST["quantity"])) {
  // Validate the quantity input
  $quantity = $_POST["quantity"];
  if (!is_numeric($quantity) || $quantity <= 0) {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '&add=wrong_input');
    exit();
  } else {
    // Connect to the database and fetch the current quantity
    include_once('connect_to_our_database.php');
    $product_name = $_POST['product_name'];
    $sql = "SELECT QUANTITY FROM products WHERE NAME = '$product_name'";
    $result = mysqli_query($connection, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $current_quantity = $row["QUANTITY"];
    } else {

         header('Location: ' . $_SERVER['HTTP_REFERER'] . '&add=not_found');
      exit();
    }
    
    if ($quantity > $current_quantity) {
      
      header('Location: ' . $_SERVER['HTTP_REFERER'] . '&add=not_available');
      exit();
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include_once('connect_to_our_database.php');
  
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_quantity = $_POST['quantity'];
  
  $sql = "SELECT QUANTITY FROM products WHERE NAME = '$product_name'";
  $result = mysqli_query($connection, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $quantity_left = $row['QUANTITY'];
  }
  
  if ($quantity_left >= $product_quantity) 
  {
    $_SESSION['cart'][] = array(
      'p_name' => $product_name,
      'p_price' => $product_price,
      'p_quantity' => $product_quantity
    );
    
    //$updated_quantity = $quantity_left - $product_quantity;
    //$update_sql = "UPDATE products SET QUANTITY = $updated_quantity WHERE NAME = '$product_name'";
    //if (mysqli_query($connection, $update_sql)) {
      // Quantity updated successfully
    //} else {
      // Error updating quantity
    //}
    
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '&add=success');
    exit;
    } 
    else 
    {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '&add=fail');
        exit;
    }
}
}
else{
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '&add=not_loged_in');
}
session_destroy();