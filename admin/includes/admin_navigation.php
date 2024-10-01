       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

              <!--   <li><a href="">Users Online: <?php //echo users_online(); ?></a></li> -->

                <li><a href="">Users Online: <span class="usersonline"></span></a></li>

               <li><a href="/">HOME SITE</a></li>
               
               
               
    
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    
<?php

if(isset($_SESSION['username'])) {

    
    echo $_SESSION['username'];


}


?>
                                    
                    
                    
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                           
                           
                           
                            <a href="/admin/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">

                <?php if(is_admin()){

                 ?>

                    <li>
                        <a href="/admin/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i>Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="/admin/posts"><i class="fa fa-fw fa-wrench"></i> View All Posts</a>
                            </li> <?php } ?>
                            <li>
                                <a href="/admin/add_post"><i class="fa fa-fw fa-wrench"></i>Add Posts</a>
                            </li>
                            <?php if(is_admin()){ ?>
                        </ul>
                    </li>

                    <li>
                            <li>
                                <a href="/admin/videos.php"><i class="fa fa-play"></i> View All Videos</a>
                            </li> <?php } ?>
                            <li>
                                <a href="/admin/videos.php?source=add_video"><i class="fa fa-stop"></i> Add Video</a>
                            </li>
                            <?php if(is_admin()){ ?>
                        
                    </li>
                    <li>
                        <a href="/admin/categories"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li> 

                    <?php } ?>
                   
                    <li class="">
                        <a href="/admin/comments"><i class="fa fa-fw fa-file"></i> Comments</a>
                    </li>
                    
                    <?php if(is_admin()){ ?>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="/admin/users">View All Users</a>
                            </li>
                            <li>
                                <a href="/admin/add_user">Add User</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="">
                        <a href="/admin/reports_table"><i class="glyphicon glyphicon-minus-sign"></i> Reports</a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="/admin/profile"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li>
                    <li>
                        <a href="/admin/my_posts"><i class="fa fa-fw fa-file"></i> My posts</a>
                    <li>
                    <li>
                        <a href="/admin/my_videos"><i class="fa fa-fw fa-file"></i> My videos</a>
                    <li>
                        <a href="/admin/notifications"><i class="fa fa-fw fa-bell"></i> Notifications</a>
                    </li>
                    <li>
                        <a href="/admin/friends"><i class="fa fa-fw fa-user"></i> My friends</a>
                    </li>
                    
                    
                </ul>
            </div>
            
            
            
            <!-- /.navbar-collapse -->
        </nav>
        