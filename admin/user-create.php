<?php
 session_start();
 include("../connectdb.php");
    $name="";
    $email = "";
    $password = "";
    $cpassword = "";
    $rolelid="";
    $errormessage="";
    if(isset($_POST['submit'])){ 
        $name = $_POST['name'];  
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $rolelid = $_POST['roleid'];
        $img = $_FILES['photo']['name'];
        $tmp = $_FILES['photo']['tmp_name'];
        if($img) {
         move_uploaded_file($tmp, "images/$img");
        }  
    
        if($name !="" && $email != "" && $password != "" && $cpassword !="" && $img != ""){
            if($password == $cpassword){
                 $sql = "INSERT INTO users (name, email, password, image, role_id, confirm_password ,created_date, modified_date) 
                 VALUES ('$name', '$email', '$password', '$cpassword' , '$img', '$rolelid',now(), now())";
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
         elseif($name !="" && $email != "" && $password != "" && $cpassword !="" && $img ==""){
            $errormessage="Please upload image ";
         }
         else{
             $errormessage="Please type valid Name ,Email and Password";
         }  
    }    
?>
<!doctype html>
<html>
<head>
 <title>SCM BLOG | User Create Page</title>
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
     
    <form action="user-create.php" method="post" enctype="multipart/form-data">
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
        <div class="form-group">
            <label for="photo">Choose a Photo</label> 
            <input type="file" name="photo" id="photo"> 
        </div>
        <div class="form-group">
            <label for="roleid">Role ID</label>
            <input type="text" class="form-control form-control-sm col-12" name="roleid" id="roleid">
        </div>
       <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="submit">Create User</button>
    </form>
  </div>
</body>
</html> 
