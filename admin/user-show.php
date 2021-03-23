<?php
 session_start();
 include("../connectdb.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Post | Uer Lists</title>
  <link rel="stylesheet" href="../css/style.css">
  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap core JavaScript -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  
  
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

       <!-- User List -->
       <div class="col-md-4">
            <!-- User List Widget -->
            <div class="card my-4">
                <h5 class="card-header">User Lists</h5>
                <div class="card-body">
                    <div class="row">
                    <div class="col-lg-12">
                        <ul>
                        <?php 
                            $ulist = mysqli_query($conn, "SELECT id,name FROM users"); 
                            while($urow = mysqli_fetch_assoc($ulist)): 
                        ?>
                            <li class="mb-3">
                                <a href="user-show.php?id=<?php echo $urow['id']?>" class="user_name"><?php echo $urow['name'] ?></a>
                            </li>
                        <?php endwhile; ?>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
            <a href="register.php" class="ml-4">[ Create User ]</a>
        </div>
        <!--user details Column -->
        <div class="col-md-8">
         
            <form action="user-edit.php" method="post" enctype="multipart/form-data">
                <?php 
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                }
                else{
                    $id=1;
                }
                $user_result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id"); 
                while($row = mysqli_fetch_assoc($user_result)): 
                ?>
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>"> 
                    <div class="form-group mt-3">
                        <label for="name">User Name</label>
                        <input type="text" class="form-control form-control-sm col-12" name="name" id="name" value="<?php echo $row['name'] ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control form-control-sm col-12" name="email" id="email" value="<?php echo $row['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-sm col-12" name="password" id="password" value="<?php echo $row['password'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control form-control-sm col-12" name="cpassword" id="cpassword" value="<?php echo $row['confirm_password'] ?>">
                    </div>
                    <div class="form-group">
                        <img src="../images/<?php echo $row['image'] ?>" alt="" height="150"><br>
                        <label for="photo">Choose a Photo</label> 
                        <input type="file" name="photo" id="photo"> 
                    </div>
                    <div class="form-group">
                        <label for="roleid">Role ID</label>
                        <input type="text" class="form-control form-control-sm col-12" name="roleid" id="roleid" value="<?php echo $row['role_id'] ?>">
                    </div>
                    
                     <button class="btn btn-lg btn-primary btn-block mb-3" type="submit" name="submit" id="submit">Edit User</button>  
                <?php endwhile; ?>
            </form>  
          
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
