<?php 

if($_SERVER["REQUEST_METHOD"]=="POST"){
       
    $product_name=$_POST['item'];
    $product_price=$_POST['pro_price'];
    $product_quantity=$_POST['update-quantity'];
        
    session_start();

    if(isset($_POST['remove-item'])){
        
        foreach($_SESSION['cart'] as $key=>$value){
            if($value['p_name']===$_POST['item']){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart']=array_values($_SESSION['cart']);
                header('location:cart.php');
            }
            
            
        }
    }
    
    
        if(isset($_POST['update-item'])){
        
        foreach($_SESSION['cart'] as $key=>$value){
            
            if($value['p_name']===$_POST['item']){
                
                $_SESSION['cart'][$key]=array('p_name'=>$product_name ,'p_price'=>$product_price ,'p_quantity'=>$product_quantity);
                header('location:cart.php');
        
        
            }
        
        
        }


    }
    
}
?>