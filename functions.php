<?php

function emptyInputSignup($fullname, $email, $phoneNumber, $Gender, $password, $re_password)
{
    
    $result=false;
    
    if(empty($fullname) || empty($email) || empty($phoneNumber) || empty($Gender))
    {
        $result=true;
    }
    return $result;
}


function invalidEmail($email)
{
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}



function passwordMatch()
{
    $result;
    if($_POST['password'] !== $_POST['re_password'])
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}


function createUser($connection, $fullname, $email, $phoneNumber, $Gender, $password)
{
    $sql = "INSERT INTO customers (Customer_Name, Email, PHONE, Gender, PASS_WORD) VALUES (?, ? ,? ,? ,?);";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../webproject/signup.php?error=stmtfailed");
        exit();
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "sssss", $fullname, $email, $phoneNumber, $Gender, $_POST['password']);
    mysqli_stmt_execute($stmt);   
    mysqli_stmt_close($stmt);
    //echo "<script>";
    //echo "window.alert('Account has created successfully')";
    //echo "</script>";
    header("location: ../webproject/login.php?error=none");
    exit();
}

function usernameExists($connection, $fullname, $email)
{
    $sql = "SELECT * FROM customers WHERE Customer_Name = ? OR Email = ?;";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../webproject/signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $fullname, $email);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);
    
    if($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    
    mysqli_stmt_close($stmt);
}


function emptyInputLogin($fullname,$password)
{
    $password=$_POST['password'];
    $result=false;
    
    if(  empty($fullname) || empty($password)) // || empty($password)
    {
        $result=true;
    }
    return $result;
}


function loginUser($connection, $username, $password)
{
    
    if ($usernameExists == false)
    {
        header("location: ../webproject/login.php?error=wronglogin"); //error happens here
        exit();
    }
    
    $passwordHashed = $usernameExists["PASS_WORD"];
    $checkPassword = passwword_verify($passowrd, $passwordHashed);
    
    if ($checkPassword === false)
    {
        header("location: ../webproject/login.php?error=wrongloginforpassword");
        exit();
    }
    else if($checkPassword === true)
    {
        session_start();
        $_SESSION["customer_ID"]= $usernameExists["Customer_ID"];
        $_SESSION["customer_Name"]= $usernameExists["Customer_Name"];
        header("location: ../webproject/index.php?");
        exit();
    }
    
}


//  NEW START FOR THE LOGIN 
    function logout(){
        session_destroy();
        
        header("Location:../webproject/index.php?");
        
        
    }