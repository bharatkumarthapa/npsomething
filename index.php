<?php 
session_start();
include('includes/config.php');

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

    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
   <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">
     
      <div class="row" style="margin-top: 8%">


        <div class="col-md-8">
  <?php 
     if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 8;
        $offset = ($pageno-1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM posts";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


      $query=mysqli_query($con,"select posts.id as pid,posts.PostTitle as posttitle,posts.PostImage,category.CategoryName as category,category.id as cid,subcategory.Subcategory as subcategory,posts.PostDetails as postdetails,posts.PostingDate as postingdate,posts.PostUrl as url from posts left join category on category.id=posts.CategoryId left join  subcategory on  subcategory.SubCategoryId=posts.SubCategoryId where posts.Is_Active=1 order by posts.id desc  LIMIT $offset, $no_of_records_per_page");
      while ($row=mysqli_fetch_array($query)) {
      ?>

          <div class="card mb-4">
              <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
                  <div class="card-body">
                    <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                      <p><!--category-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid'])?>" style="color:#fff"><?php echo htmlentities($row['category']);?></a>

                    <a class="badge bg-secondary text-decoration-none link-light"  style="color:#fff"><?php echo htmlentities($row['subcategory']);?></a></p>
            
                    <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn btn-primary">Read More &rarr;</a>
                  </div>
            <div class="card-footer text-muted">
              Posted on <?php echo htmlentities($row['postingdate']);?>
           
            </div>
          </div>
        <?php } ?>
       
        </div>

      <?php include('includes/sidebar.php');?>
      </div>
    

    </div>
  
      <?php include('includes/footer.php');?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 
  </head>
  </body>
</html>
