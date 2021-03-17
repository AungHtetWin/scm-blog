<?php
 session_start();
 include("connectdb.php");
    $email = "";
    $password = "";
     if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if(isset($_POST['password'])){
       $password = $_POST['password'];
    }
    $errormessage="";
    if(isset($_POST['submit'])){   
        $result = mysqli_query($conn, "SELECT * FROM users"); 
         while($row = mysqli_fetch_assoc($result)): 
            if($email == $row['email'] && $password == $row['password']) {
                $_SESSION['auth'] = true;
                $_SESSION['userid'] = $row['id'];
            }
            else if($email != $row['email'] && $password == $row['password']) {
                $errormessage="Incorrect Email Address";
            }
            else if($email == $row['email'] && $password != $row['password']) {
                $errormessage="Incorrect Password";
            }
            else{
                $errormessage="Invalid Email Address and Password";
            }
         endwhile;
    }    
 $auth = isset($_SESSION['auth']);
?>
<!doctype html>
<html>
<head>
 <title>Login Page</title>
</head> 
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<body>
 <?php if($auth) { 
    header("location: post.php");
  } else { ?>
  <div class="container col-md-3 p-3 mt-5">
    <?php if($errormessage !="") { ?>
     <div class="alert alert-danger text-center" role="alert">
       <?php echo $errormessage ?>
     </div>
     <?php } ?> 
    <form action="index.php" method="post">
        <div class="form-group mt-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control form-control-sm col-12" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control form-control-sm col-12" name="password" id="password">
        </div>
        <a href="register.php">Register Here?</a>
       <button class="btn mt-3 btn-lg btn-primary btn-block" type="submit" name="submit" id="submit">Login</button>
    </form>
  </div>
 <?php } ?>
</body>
</html> 
