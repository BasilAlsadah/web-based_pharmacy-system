<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $fullname=$_POST['name'];
    $password=$_POST['password']; //MEYBE WE DONT NEED TO USE THIS ITS USELESS
    
    include_once('connect_to_our_database.php');
    include_once('functions.php');
    
    //IF THERE IS ANY FIELD IS EMPTY    
    //if(empty($fullname)||empty($_POST['password'])){
    //    header("location: ../webproject/login.php?error=emptyinput");
    //    exit();
    //}
    
    $customer_sql="SELECT * FROM customers WHERE Customer_Name='$fullname' AND PASS_WORD='".$_POST['password']."' ;";
    $admin_sql="SELECT * FROM admin_login WHERE Admin_SSN='$fullname' AND password='".$_POST['password']."' ;";
    if(mysqli_query($connection,$customer_sql)){
        
        //CHECK THE CUSTOMER TABLE IF USERNAME AND PASSWORD IS HERE
        $customer_result=mysqli_query($connection,$customer_sql);
        while($row=mysqli_fetch_array($customer_result)){
            
            //WHEN CUSTOMER FOUND SO WE WILL START THE SESSION
            
            session_start();
            $_SESSION['uname']=$row['Customer_Name'];
            $_SESSION['authorized']=false;
            $_SESSION['loged_in']=true;
            
           header("location: ../webproject/index.php?login=customer_success");
            exit();
        }
        
        
        //IF NO CUSTOMER FOUND WE WILL CHECK FOR ADMIN TABLE
        $admin_result=mysqli_query($connection,$admin_sql);
        while($row=mysqli_fetch_array($admin_result)){
            //WHEN ADMIN IS FOUND SO WE WILL START THE SESSION
            session_start();
            $_SESSION['uname']=$row['Admin_SSN'];
            $_SESSION['authorized']=true;
            $_SESSION['loged_in']=true;
            
            header("location: ../webproject/index.php?login=admin_success");
            exit();
        }
        //IF NO USER FOUND THEN ERROR
        header("location: ../webproject/login.php?error=not_found");    
        exit();
    }
    else{
        
    }
}
    
    
    ?>