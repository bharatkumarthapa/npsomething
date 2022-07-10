<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
if($_GET['action']=='del' && $_GET['scid'])
{
	$id=intval($_GET['scid']);
	$query=mysqli_query($con,"update  subcategory set Is_Active='0' where SubCategoryId='$id'");
	$msg="Category deleted ";
}
// Code for restore
if($_GET['resid'])
{
	$id=intval($_GET['resid']);
	$query=mysqli_query($con,"update  subcategory set Is_Active='1' where SubCategoryId='$id'");
	$msg="Category restored successfully";
}

// Code for Forever deletionparmdel
if($_GET['action']=='perdel' && $_GET['scid'])
{
	$id=intval($_GET['scid']);
	$query=mysqli_query($con,"delete from   subcategory  where SubCategoryId='$id'");
	$delmsg="Category deleted forever";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Manage SubCategories</title>
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

            <!-- Top Bar Start -->
<?php include('includes/topheader.php');?>

            <!-- ========== Left Sidebar Start ========== -->
<?php include('includes/leftsidebar.php');?>
            
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Manage SubCategories</h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->


<div class="row">
<div class="col-sm-6">  
 
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<?php if($delmsg){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh snap!</strong> <?php echo htmlentities($delmsg);?></div>
<?php } ?>


</div>
                                 
                                 

                                    <div class="row">
										<div class="col-md-12">
											<div class="demo-box m-t-20">
<div class="m-b-30">
<a href="add-subcategory.php">
<button id="addToTable" class="btn btn-success waves-effect waves-light">Add</button>
</a>
 </div>

												<div class="table-responsive">
                                                    <table class="table table-colored table-centered table-inverse m-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Category</th>
                                                                <th>Sub Category</th>
                                                                <th>Description</th>
                                                          
                                                                <th>Posting Date</th>
                                                                  <th>Last updation Date</th>
                                                                  <th width="95">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php 
$query=mysqli_query($con,"Select category.CategoryName as catname,subcategory.Subcategory as subcatname,subcategory.SubCatDescription as SubCatDescription,subcategory.PostingDate as subcatpostingdate,subcategory.UpdationDate as subcatupdationdate,subcategory.SubCategoryId as subcatid from subcategory join category on subcategory.CategoryId=category.id where subcategory.Is_Active=1");
$cnt=1;
$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
?>
<tr>

<td colspan="7" align="center"><h3 style="color:red">No record found</h3></td>
<tr>
<?php 
} else {

while($row=mysqli_fetch_array($query))
{
?>


 <tr>
<th scope="row"><?php echo htmlentities($cnt);?></th>
<td><?php echo htmlentities($row['catname']);?></td>
<td><?php echo htmlentities($row['subcatname']);?></td>
<td><?php echo htmlentities($row['SubCatDescription']);?></td>
<td><?php echo htmlentities($row['subcatpostingdate']);?></td>
<td><?php echo htmlentities($row['subcatupdationdate']);?></td>
<td><a href="edit-subcategory.php?scid=<?php echo htmlentities($row['subcatid']);?>">edit</a> 
	&nbsp;<a href="manage-subcategories.php?scid=<?php echo htmlentities($row['subcatid']);?>&&action=del"class="btn-danger">delete</a> </td>
</tr>
<?php
$cnt++;
 }} ?>
</tbody>
                                                  
                                                    </table>
                                                </div>


											</div>

										</div>

							
									</div>
                                    <!--- end row -->


                                    
<div class="row">
<div class="col-md-12">
<div class="demo-box m-t-20">
<div class="m-b-30">

 <h4> Deleted SubCategories</h4>

 </div>

<div class="table-responsive">
   <table class="table m-0 table-colored-bordered table-bordered-success">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Category</th>
                                                                <th>Sub Category</th>
                                                                <th>Description</th>
                                                          
                                                                <th>Posting Date</th>
                                                                  <th>Last updation Date</th>
                                                                  <th width="95">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php 
$query=mysqli_query($con,"Select category.CategoryName as catname,subcategory.Subcategory as subcatname,subcategory.SubCatDescription as SubCatDescription,subcategory.PostingDate as subcatpostingdate,subcategory.UpdationDate as subcatupdationdate,subcategory.SubCategoryId as subcatid from subcategory join category on subcategory.CategoryId=category.id where subcategory.Is_Active=0");
$cnt=1;
$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
?>
<tr>

<td colspan="7" align="center"><h3 style="color:red">No record found</h3></td>
<tr>
<?php 
} else {

while($row=mysqli_fetch_array($query))
{
?>

 <tr>
<th scope="row"><?php echo htmlentities($cnt);?></th>
<td><?php echo htmlentities($row['catname']);?></td>
<td><?php echo htmlentities($row['subcatname']);?></td>
<td><?php echo htmlentities($row['SubCatDescription']);?></td>
<td><?php echo htmlentities($row['subcatpostingdate']);?></td>
<td><?php echo htmlentities($row['subcatupdationdate']);?></td>
<td><a href="manage-subcategories.php?resid=<?php echo htmlentities($row['subcatid']);?>">restore</a>
    &nbsp;<a href="manage-subcategories.php?scid=<?php echo htmlentities($row['subcatid']);?>&&action=perdel" class="btn-danger">delete</a> </td>
</tr>
<?php
$cnt++;
 } }?>
</tbody>
                                                  
                                                    </table>
                                                </div>



                                                
											</div>

										</div>

							
									</div>                  
                                  




                    </div> <!-- container -->

                </div> <!-- content -->
<?php include('includes/footer.php');?>
            </div>

        </div>
        <!-- END wrapper -->



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