<?php
 session_start();
 include("../connectdb.php");
 $id = $_GET['id'];
 $userid = $_SESSION['userid'];
 $result= mysqli_query($conn ,"SELECT * FROM users WHERE id=$userid");
 $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Post | Post</title>
  
  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap core JavaScript -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="../css/style.css">
  
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="#">Start Your Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('../images/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Free Blog Style</h1>
            <span class="subheading">A Blog Theme by Louis</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

       <!-- Post List -->
       <div class="col-md-4">
            <!-- Popular Post Widget -->
            <div class="card my-4">
                <h5 class="card-header">Post Lists</h5>
                <div class="card-body">
                    <div class="row">
                    <div class="col-lg-12">
                        <ul>
                        <?php 
                            $post_title = mysqli_query($conn, "SELECT id,title FROM posts"); 
                            while($posttitle = mysqli_fetch_assoc($post_title)): 
                            // $postid= $posttitle['id'];
                        ?>
                            <li class="mb-3">
                                <a href="post-show.php?id=<?php echo $posttitle['id']?>"><?php echo $posttitle['title'] ?></a>
                            </li>
                        <?php endwhile; ?>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Post Content Column -->
        <div class="col-lg-8">
            <?php 
            $post_result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id"); 
            while($postrow = mysqli_fetch_assoc($post_result)): 
            $postid= $postrow['id'];
            ?>
            
                <!-- Title -->
                <h1 class="mt-4">
                   <a href="post-show.php?id=<?php echo $postrow['id']?>" id="clear_underline"><?php echo $postrow['title'] ?></a>
                </h1>

                <!-- Author -->
                <p class="lead">
                    by
                    <a href="#"><?php echo $row['name'] ?> </a>
                </p>
                <hr>
                <!-- Date/Time -->
                <p>Posted on <?php echo $postrow['created_date'] ?></p>
                <hr>

                <!-- Post Content -->
                <p><?php echo $postrow['body'] ?></p>
                <hr> 
            
                <a href="post-edit.php?id=<?php echo $postrow['id'] ?>">[ Edit ]</a>

                <!-- Comments Form -->
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                        </div>
                        <button type="submit" name="submit<?php echo $postid ?>" class="btn btn-primary" id="<?php echo $postid ?>">Submit</button>
                    </form>
                    </div>
                </div>
                <?php 
                    if(isset($_POST['submit'.$postid])){
                        $postcomment= $_POST['comment'];
                        $sql = "INSERT INTO comments (user_id, post_id, body, created_date) 
                        VALUES ('$userid', '$postid', '$postcomment', now())";
                        mysqli_query($conn, $sql); 
                    }
                ?>    
                <?php 
                $commentresult =mysqli_query($conn ,"select c.post_id,c.body,u.name from users u join comments c on u.id=c.user_id join posts p on p.id=c.post_id"); 
                while($commentrow = mysqli_fetch_assoc($commentresult)): 
                ?>
                <?php if($postrow['id'] == $commentrow['post_id']){ ?> 
                    <!-- Single Comment --> 
                    <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"> <?php echo $commentrow['name'] ?> </h5>
                        <?php echo $commentrow['body'] ?>
                    </div>
                    </div> 
                <?php } ?>   
                <?php endwhile; ?>   
            <?php endwhile; ?>    
            <a href="post-create.php"><button class="btn btn-primary mb-3" type="button">Create New Post!</button></a>
        </div>
      
     

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-3 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>
</body>

</html>
