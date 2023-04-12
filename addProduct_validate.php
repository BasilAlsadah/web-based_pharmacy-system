<?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nameOfproduct=$_POST['product_name'];
        $comp_name=$_POST['company_name'];
        $pr_category=$_POST['category'];
        $pr_barcode=$_POST['barcode'];
        $selling_price=$_POST['price'];
        $pro_date=$_POST['pro_date'];
        $ex_date=$_POST['ex_date'];
        $pr_quantity=$_POST['quantity'];
        $pr_desc=$_POST['desc'];
        //$pr_img=$_POST['filename'];
        //GETTING THE IMG
        $pr_img_temp=addslashes(file_get_contents($_FILES['filename']['tmp_name']));
            
        include_once('connect_to_our_database.php');
        include_once('functions.php');
        
        $sql="INSERT INTO products VALUES('$nameOfproduct','$comp_name','$pr_category','$pr_barcode','','$selling_price','$pro_date','$ex_date','$pr_quantity','$pr_img_temp','$pr_desc');";
        
   
            
        if(mysqli_query($connection,$sql))
    {;
        header("location: ../webproject/administrator_page.php?error=none");
        exit();
    }
    else{
        echo "error";
    }
        }


?>