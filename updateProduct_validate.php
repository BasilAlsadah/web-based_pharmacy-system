<?php
        if($_SERVER["REQUEST_METHOD"]=="POST")
    {
            
        $nameOfproduct=$_POST['product_name'];
        $comp_name=$_POST['company_name'];
        $pr_category=$_POST['category'];
        $pr_barcode=$_POST['barcode'];
        $p_ID=$_POST['ID'];
        $selling_price=$_POST['price'];
        $pro_date=$_POST['pro_date'];
        $ex_date=$_POST['ex_date'];
        $pr_quantity=$_POST['quantity'];
        $pr_desc=$_POST['desc'];
        //new things for submiting the img
        $pr_img_temp=addslashes(file_get_contents($_FILES['filename']['tmp_name']));
        
        
        include_once('connect_to_our_database.php');
        include_once('functions.php');
        
        if(isset($_POST['update']))
        {
            $updateQuery ="update products set Name='$nameOfproduct' , company_name='$comp_name', category='$pr_category' , BARCODE='$pr_barcode' , SELLING_PRICE='$selling_price' , PRODUCTION_DATE='$pro_date' , EXPIRATION_DATE='$ex_date' , QUANTITY='$pr_quantity' , real_img='".$pr_img_temp."', description='$pr_desc' WHERE Product_ID=$p_ID ;" ;
                
        
        }
        $result = mysqli_query($connection, $updateQuery);
            
        if($result)
    {
        //echo "<script>";
        //echo "window.alert('product added sucessfully')";
        //echo "</script>";
        header("location: ../webproject/administrator_page.php?error=none");
        exit();
            }
        else
        {
                echo "error";
        }
        mysqli_close($connection);
    }


?>