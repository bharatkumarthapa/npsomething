<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
if( $_GET['disid'])
{
	$id=intval($_GET['disid']);
	$query=mysqli_query($con,"update comments set status='0' where id='$id'");
	$msg="Comment unapprove ";
}
// Code for restore
if($_GET['appid'])
{
	$id=intval($_GET['appid']);
	$query=mysqli_query($con,"update comments set status='1' where id='$id'");
	$msg="Comment approved";
}

// Code for deletion
if($_GET['action']=='del' && $_GET['rid'])
{
	$id=intval($_GET['rid']);
	$query=mysqli_query($con,"delete from  comments  where id='$id'");
	$delmsg="Comment deleted forever";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Manage Categories</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">
            <?php include('includes/topheader.php');?>
            <?php include('includes/leftsidebar.php');?>
            
            <div class="content-page">

                <div class="content">
                    <div class="container">

                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Manage Unapproved Comments</h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                       


                        <div class="row">
                            <div class="col-sm-6">  
                        
                                <?php if($msg){ ?>
                                <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                </div>
                                <?php } ?>

                                <?php if($delmsg){ ?>
                                <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($delmsg);?>
                                </div>
                                <?php } ?>


                            </div>
                                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="demo-box m-t-20">

                                                <div class="table-responsive">
                                                    <table class="table table-colored table-centered table-inverse m-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Name</th>
                                                                <th>Email Id</th>
                                                                <th width="250">Comment</th>
                                                                <th>Status</th>
                                                                <th>Post / News</th>
                                                                <th>Posting Date</th>
                                                                <th width="121">Action</th>
                                                            </tr>
                                                        </thead>
                                                        
                                                        <tbody>
                                                            <?php 
                                                            $query=mysqli_query($con,"Select comments.id,  comments.name,comments.email,comments.postingDate,comments.comment,posts.id as postid,posts.PostTitle from  comments join posts on posts.id=comments.postId where comments.status=0");
                                                            $cnt=1;
                                                            while($row=mysqli_fetch_array($query))
                                                            {
                                                            ?>

                                                            <tr>
                                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                                    <td><?php echo htmlentities($row['name']);?></td>
                                                                    <td><?php echo htmlentities($row['email']);?></td>
                                                                    <td><?php echo htmlentities($row['comment']);?></td>
                                                                    <td><?php $st=$row['status'];
                                                                    if($st=='0'):
                                                                    echo "Waiting for approval";
                                                                    else:
                                                                    echo "Approved";
                                                                    endif;
                                                                    ?></td>


                                                                    <td><a href="edit-post.php?pid=<?php echo htmlentities($row['postid']);?>"><?php echo htmlentities($row['PostTitle']);?></a> </td>
                                                                    <td><?php echo htmlentities($row['postingDate']);?></td>
                                                                    <td>
                                                                    <?php if($st=='0'):?>
                                                                    <a href="unapprove-comment.php?disid=<?php echo htmlentities($row['id']);?>" title="Disapprove this comment">disapprove</a> 
                                                                    <?php else :?>                                                    <a href="unapprove-comment.php?appid=<?php echo htmlentities($row['id']);?>" title="Approve this comment">approve</a> 
                                                                    <?php endif;?>

                                                                    &nbsp;<a href="unapprove-comment.php?rid=<?php echo htmlentities($row['id']);?>&&action=del"class="btn-danger">delete</a> </td>
                                                                </tr>
                                                                <?php
                                                                    $cnt++;
                                                                    } ?>
                                                        </tbody>
                                                                    
                                                    </table>
                                                </div>

                                            </div>

                                        </div>           
                                    </div>
                                                        
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="demo-box m-t-20">
                                                <div class="m-b-30">


                                                </div>
                                            </div>

                                        </div>		
                                    </div>                  

                        </div> 

                    </div> <
                    <?php include('includes/footer.php');?>
                </div>
            </div>

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
<?php } ?>
