        <div class="left side-menu bg-dark">
            <div class="sidebar-inner slimscrollleft">

                    
                <div id="sidebar-menu" class="text-white">
                    <ul>
                        	<br>
                            <br>

                        <!-- <li class="has_sub">
                            <a href="dashboard.php" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                         
                        </li> -->
                        <?php if($_SESSION['utype']=='1'):?>
                                    
                        <?php endif;?>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"> <span> Category </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                	<li><a href="add-category.php">Add Category</a></li>
                                    <li><a href="manage-categories.php">Manage Category</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"> <span>Sub Category </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="add-subcategory.php">Add Sub Category</a></li>
                                    <li><a href="manage-subcategories.php">Manage Sub Category</a></li>
                                </ul>
                            </li>               
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"> <span> Posts (News) </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="add-post.php">Add Posts</a></li>
                                    <li><a href="manage-posts.php">Manage Posts</a></li>
                                     <li><a href="trash-posts.php">Trash Posts</a></li>
                                </ul>
                            </li>  
                     

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"> <span> Pages </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="aboutus.php">About us</a></li>
                                    <li><a href="contactus.php">Contact us</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"> <span> Comments </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                  <li><a href="unapprove-comment.php">Waiting for Approval </a></li>
                                    <li><a href="manage-comments.php">Approved Comments</a></li>
                                </ul>
                            </li>   

                    </ul>
                </div>
                    
                    <div class="clearfix"></div>

                    <div class="help-box">
                        <h5 class="text-muted m-t-0">For Help..</h5>
                        <p class=""><span class="text-custom">Email:</span> <br/> sms.b@gmail.com</p>
                    </div>

            </div>
                

         </div>