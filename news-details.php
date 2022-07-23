<?php 
session_start();
include('includes/config.php');
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
 $_SESSION['token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['submit']))
 {
 
    if (!empty($_POST['csrftoken'])) {
        if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) 
        {
          $name=$_POST['name'];
          $email=$_POST['email'];
          $comment=$_POST['comment'];
          $postid=intval($_GET['nid']);
          $st1='0';
          $query=mysqli_query($con,"insert into comments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
          if($query):
            echo "<script>alert('comment successfully submit. Comment will be display after admin review ');</script>";
            unset($_SESSION['token']);
          else :
          echo "<script>alert('Something went wrong. Please try again.');</script>";  

          endif;

          }
    }
 }
  $postid=intval($_GET['nid']);

    $sql = "SELECT viewCounter FROM posts WHERE id = '$postid'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $visits = $row["viewCounter"];
            $sql = "UPDATE posts SET viewCounter = $visits+1 WHERE id ='$postid'";
        $con->query($sql);

        }
      } else {
        echo "no results";
    }
    

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Portal</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    

  </head>
  <body>
   <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">

      <div class="row" style="margin-top: 9%">

              <!-- Blog Entries Column -->
        <div class="col-md-8">
        
                <!-- Blog Post -->
          <?php
          $pid=intval($_GET['nid']);
          $currenturl="http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
          $query=mysqli_query($con,"select posts.PostTitle as posttitle,posts.PostImage,category.CategoryName as category,category.id as cid,subcategory.Subcategory as subcategory,posts.PostDetails as postdetails,posts.PostingDate as postingdate,posts.PostUrl as url,posts.postedBy,posts.lastUpdatedBy,posts.UpdationDate from posts left join category on category.id=posts.CategoryId left join  subcategory on  subcategory.SubCategoryId=posts.SubCategoryId where posts.id='$pid'");
          while ($row=mysqli_fetch_array($query)) {
          ?>

                <div class="card mb-4">
            
                  <div class="card-body">
                    <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>

                    <a class="badge bg-secondary text-decoration-none link-light"  style="color:#fff"><?php echo htmlentities($row['subcategory']);?></a>


                    <p>
                      
                    <b>Posted by </b> <?php echo htmlentities($row['postedBy']);?> on </b><?php echo htmlentities($row['postingdate']);?> |
                    <?php if($row['lastUpdatedBy']!=''):?>
                    <b>Last Updated by </b> <?php echo htmlentities($row['lastUpdatedBy']);?> on </b><?php echo htmlentities($row['UpdationDate']);?></p>
                    <?php endif;?>
                            <b>Visits:</b> <?php print $visits; ?>
                          
                          <hr />

                    <img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
        
                    <p class="card-text"><?php $pt=$row['postdetails'];
                    echo (substr($pt,0));?></p>
                  
                  </div>
                  <div class="card-footer text-muted">
                  
                
                  </div>
              </div>
          <?php } ?>

        </div>

        <?php include('includes/sidebar.php');?>
      </div>
    
      <div class="row" style="margin-top: 2%">
          <div class="col-md-8">
                  <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form name="Comment" method="post">
                            <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']);?>"/>
                            <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter your fullname" required>
                            </div>

                            <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter your Valid email" required>
                            </div>


                              <div class="form-group">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                  </div>


              <?php 
              $sts=1;
              $query=mysqli_query($con,"select name,comment,postingDate from  comments where postId='$pid' and status='$sts'");
              while ($row=mysqli_fetch_array($query)) {
              ?>
                        <div class="media mb-4">
                          <img class="d-flex mr-3 rounded-circle" src="admin/assets/images/you_commented.png" alt="">
                          <div class="media-body">
                            <h5 class="mt-0"><?php echo htmlentities($row['name']);?> <br />
                                <span style="font-size:11px;"><b>at</b> <?php echo htmlentities($row['postingDate']);?></span>
                            </h5>
                        
                            <?php echo htmlentities($row['comment']);?>            
                          </div>
                        </div>
              <?php } ?>

            </div>
      </div>
    </div>

      <?php include('includes/footer.php');?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
