<?php
 session_start();
 include("../connectdb.php");
    $id=$_POST['id'];
    $name = $_POST['name'];  
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
        if($name !="" && $email != "" && $password != "" && $cpassword !=""){
            if($password == $cpassword){
                $sql = "UPDATE users SET name='$name', email='$email', password='$password', confirm_password='$cpassword',modified_date=now() WHERE id=$id"; 
                mysqli_query($conn, $sql);
                header("location: user-show.php"); 
            }
            else if($password != $cpassword){
                $errormessage="Please type same Password";
            }
        }
        else if($name =="" && $email != "" && $password != "" && $cpassword !=""){
            $errormessage="Please type user name";
        }
        else if($name !="" && $email == "" && $password != "" && $cpassword !=""){
            $errormessage="Please type Email Address";
        }
        else if($name !="" && $email != "" && $password == "" && $cpassword !=""){
            $errormessage="Please type Password";
        }
        else if($name !="" && $email != "" && $password != "" && $cpassword ==""){
            $errormessage="Please type Confirm Password";
        }
        else{
            $errormessage="Please type valid Name ,Email and Password";
        }   
?>