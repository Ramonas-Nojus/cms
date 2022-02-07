       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms/">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

              <!--   <li><a href="">Users Online: <?php //echo users_online(); ?></a></li> -->

                <li><a href="">Users Online: <span class="usersonline"></span></a></li>

               <li><a href="/cms/">HOME SITE</a></li>
               
               
               
    
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
                           
                           
                           
                            <a href="/cms/admin/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/cms/includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
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
                        <a href="/cms/admin/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i>Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="/cms/admin/posts"><i class="fa fa-fw fa-wrench"></i> View All Posts</a>
                            </li> <?php } ?>
                            <li>
                                <a href="/cms/admin/add_post"><i class="fa fa-fw fa-wrench"></i>Add Posts</a>
                            </li>
                            <?php if(is_admin()){ ?>
                        </ul>
                    </li>
                    <li>
                        <a href="/cms/admin/categories"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li> 

                    <?php } ?>
                   
                    <li class="">
                        <a href="/cms/admin/comments"><i class="fa fa-fw fa-file"></i> Comments</a>
                    </li>
                    
                    <?php if(is_admin()){ ?>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="/cms/admin/users">View All Users</a>
                            </li>
                            <li>
                                <a href="/cms/admin/add_user">Add User</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="/cms/admin/profile"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li>
                    <li>
                        <a href="/cms/admin/my_posts"><i class="fa fa-fw fa-file"></i> My posts</a>
                    <li>
                        <a href="/cms/admin/notifications.php"><i class="fa fa-fw fa-bell"></i> Notifications</a>
                    </li>
                    <li>
                        <a href="/cms/admin/friends.php"><i class="fa fa-fw fa-user"></i> My friends</a>
                    </li>
                    
                    
                </ul>
            </div>
            
            
            
            <!-- /.navbar-collapse -->
        </nav>
        