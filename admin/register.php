<?php
 session_start();
 include("../connectdb.php");
    $name="";
    $email = "";
    $password = "";
    $cpassword = "";
    $errormessage="";
    if(isset($_POST['submit'])){ 
        $name = $_POST['name'];  
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if($name !="" && $email != "" && $password != "" && $cpassword !=""){
            if($password == $cpassword){
                $sql = "INSERT INTO users (name, email, password, confirm_password ,created_date, modified_date) 
                VALUES ('$name', '$email', '$password', '$cpassword' ,now(), now())";
                mysqli_query($conn, $sql);
                header("location: login.php"); 
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
    }    
?>
<!doctype html>
<html>
<head>
 <title>Register Page</title>
</head> 
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
  <div class="container col-md-3 p-3 mt-5">
    <?php if($errormessage !="") { ?>
     <div class="alert alert-danger text-center" role="alert">
       <?php echo $errormessage ?>
     </div>
     <?php } ?> 
     
    <form action="register.php" method="post">
        <div class="form-group mt-3">
            <label for="name">User Name</label>
            <input type="text" class="form-control form-control-sm col-12" name="name" id="name">
        </div>
        <div class="form-group mt-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control form-control-sm col-12" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control form-control-sm col-12" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control form-control-sm col-12" name="cpassword" id="cpassword">
        </div>
       <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="submit">Resigter</button>
    </form>
  </div>
</body>
</html> 
