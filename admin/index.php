<?php
 session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
if(isset($_POST['login']))
  {
 
    // Getting username/ email and password
     $uname=$_POST['username'];
    $password=md5($_POST['password']);
    // Fetch data from database on the basis of username/email and password
$sql =mysqli_query($con,"SELECT AdminUserName,AdminEmailId,AdminPassword,userType FROM admin WHERE (AdminUserName='$uname' && AdminPassword='$password')");
 $num=mysqli_fetch_array($sql);
if($num>0)
{

$_SESSION['login']=$_POST['username'];
$_SESSION['utype']=$num['userType'];
    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
  }else{
echo "<script>alert('Invalid Details');</script>";
  }
 
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="News Portal.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="icon" href="assets/images/logo.png">
        <meta name="author" content="smscvs.exe">


        <!-- App title -->
        <title>Admin login</title>

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

    </head>
    
    <body class="bg-transparent">

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box bg-success">
                                    <h2 class="text">
                                       
                                    <a class="bg-success text-white" href="index.php"><b><span>NEWS<span>PORTAL</span></span></b>
                                    <br> <p>Admin Login</p>
                                    </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <br>
                                <div class="account-content">
                                    <form class="form-horizontal" method="post">
                                        <div class="col-xs-12">
                                        <input type="text" class="form-control" type="text" name="username" required placeholder="Username or email">
                                        
                                        </div>
                                        <br><br><br><br>
                                        <div class="col-xs-12">
                                        <input type="password" class="form-control" name="password" required placeholder="Password">
                                        
                                        </div>
                                        <br><br><br>
                                        <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                        </div>

                                        <br>
                                        

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login">Log In</button>
                                            </div>
                                        </div>
                                    
                                    </form>
                                    <a href="../index.php"><i class="mdi mdi-home"></i> Back Home</a>

                                </div>
                            </div>
                            <!-- end card-box-->
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
          <!-- END HOME -->

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