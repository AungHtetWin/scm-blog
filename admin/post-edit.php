<?php
 include("../connectdb.php"); 
 $id = $_GET['id'];
 $result = mysqli_query($conn, "SELECT * FROM posts WHERE id = $id"); 
 $row = mysqli_fetch_assoc($result); 

 $post_title="";
 $post_body="";
 $img="";
 if(isset($_POST['submit'])){
    $post_id= $_POST['id'];
    $post_title = $_POST['post-title']; 
    $post_body = $_POST['post-detail']; 
    $img= $_POST['image'];
    $img = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    if($img) {
     move_uploaded_file($tmp, "../images/$img");
    }
    $sql = "UPDATE posts SET title='$post_title', body='$post_body',image='$img',
    modified_date=now() WHERE id = $post_id"; 
    mysqli_query($conn, $sql); 
    header("location: index.php"); 
 }
?>
<!doctype html>
<html>
<head>
 <title>Edit Post</title>
</head>  
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
  <div class="container col-md-4 p-3 mt-5">
     <h2>Edit Post</h2>
    <form  method="post" enctype="multipart/form-data"> 
     <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <div class="form-group mt-3">
            <label for="post-title">Post Title</label>
            <input type="text" class="form-control form-control-sm col-12" name="post-title" id="post-title" value="<?php echo $row['title'] ?>">
        </div>
        <div class="form-group">
            <label for="photo">Choose a Photo</label> 
            <input type="file" name="photo" id="photo" value="<?php echo $row['image'] ?>"> 
        </div>
        <div class="form-group mt-3">
            <label for="post-detail">Post Details</label>
            <textarea class="form-control" rows="6" name="post-detail" id="post-detail"><?php echo $row['body'] ?></textarea>
        </div>
       <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="submit">Edit Post</button>
    </form>
  </div>
</body>
</html> 