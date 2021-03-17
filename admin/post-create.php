<?php
 session_start();
 include("../connectdb.php");
    $post_title="";
    $post_body = "";
    $errormessage="";
    if(isset($_POST['submit'])){ 
        $post_title = $_POST['post-title'];  
        $post_body = $_POST['post-detail'];
        if($post_title !="" && $post_body != "" ){
            $sql = "INSERT INTO posts (title, body ,created_date, modified_date) 
            VALUES ('$post_title', '$post_body', now() ,now())";
            mysqli_query($conn, $sql);
            header("location: index.php"); 
        }
        else if($post_title !="" && $post_body == ""){
            $errormessage="Please type post details.";
        }
        else if($post_title =="" && $post_body != ""){
            $errormessage="Please type post title.";
        }
        else{
            $errormessage="Please type post title and details.";
        }
    }    
?>
<!doctype html>
<html>
<head>
 <title>Create Post </title>
</head> 
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
  <div class="container col-md-4 p-3 mt-5">
       <?php if($errormessage !="") { ?>
            <div class="alert alert-danger text-center" role="alert">
            <?php echo $errormessage ?>
            </div>
        <?php } ?> 
     <h2>Create New Post</h2>
    <form action="post-create.php" method="post">
        <div class="form-group mt-3">
            <label for="post-title">Post Title</label>
            <input type="text" class="form-control form-control-sm col-12" name="post-title" id="post-title">
        </div>
        <div class="form-group mt-3">
            <label for="post-detail">Post Details</label>
            <textarea class="form-control" rows="6" name="post-detail" id="post-detail"></textarea>
        </div>
       <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="submit">Create Post</button>
    </form>
  </div>
</body>
</html> 
