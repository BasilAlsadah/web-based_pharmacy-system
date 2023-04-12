<?php
//NORPEK VER
/*
if(isset($_POST["submit"]))
{
    $fullname = $_POST['name'];
    $email = $_POST['email']; 
    $phoneNumber = $_POST['phoneNumber']; 
    $Gender = $_POST['Gender']; 
    $password = $_POST['password']; 
    $re_password = $_POST['re_password']; 
    
    
    require_once 'connect_to_our_database.php';
    require_once 'functions.php';
    
    if(emptyInputSignup($fullname, $email, $phoneNumber, $Gender, $password, $re_password) !== false)
    {
        header("location: ../webproject/signup.php?error=emptyinput");
        exit();
    }
    
    if(invalidFullname($fullname) !== false)
    {
        header("location: ../webproject/signup.php?error=invaildfullname");
        exit();
    }
    
    if(invalidEmail($email) !== false)
    {
        header("location: ../webproject/signup.php?error=invaildemail");
        exit();
    }
    
    if(passwordMatch($password, $re_password) == false)
    {
        header("location: ../webproject/signup.php?error=passwordsdontmatch");
        exit();
    }
    

    if(uidExists($connection, $username, $email) !== false)
    {
        header("location: ../webproject/signup.php?error=usernameistaken");
        exit();
    }
    
    createUser($connection, $fullname, $email, $phoneNumber, $Gender, $password);
    
}
else
{
    header("location: ../webproject/signup.php?error=wtf");
    exit();
}
*/
?>

<?php
//BASIL VER
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $fullname=$_POST['name'];
        $email=$_POST['email'];
        $phoneNumber=$_POST['phoneNumber'];
        $Gender=$_POST['Gender'];
        $password=$_POST['password'];
        $re_password=$_POST['re_password'];
        
        include_once('connect_to_our_database.php');
        include_once('functions.php');
        
        
        //if(emptyInputSignup($fullname, $email, $phoneNumber, $Gender, $password, $re_password) !== false){
        //    header("location: ../webproject/signup.php?error=emptyinput");
        //exit();
        //}
        

        if(invalidEmail($email) !== false)
        {
            header("location: ../webproject/signup.php?error=invaildemail");
            exit();
        }
               
        if(passwordMatch()){
            header("location: ../webproject/signup.php?error=passwordsdontmatch");
        exit();
        }
        


        createUser($connection, $fullname, $email, $phoneNumber, $Gender, $password);
        
    }
    else
    {
        header("location: ../webproject/signup.php?error=connection_failed");
        exit();
    }


?>