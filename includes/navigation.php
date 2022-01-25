   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
           
           
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms">CMS Front</a>
            </div>
            
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php if(isLoggedIn()): ?>


                        <li>
                            <a href="/cms/admin/profile">Profile</a>
                        </li>

                        <li>
                            <a href="/cms/includes/logout">Logout</a>
                        </li>


                    <?php else: ?>


                        <li>
                            <a href="/cms/login">Login</a>
                        </li>
                        <li>
                        <a href="/cms/registration">Registration</a>
                        </li>


                    <?php endif; ?>




                                 
                    
                                  
                    
    <?php 

    if(isset($_SESSION['user_role'])) {

            if(isset($_GET['p_id'])) {
        
                $the_post_id = $_GET['p_id'];
                $the_user_id = $_SESSION['user_id'];   

                $query = "SELECT post_user_id FROM posts WHERE post_id = '$the_post_id' ";
                $user_id = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($user_id);
                $post_user_id = $row['post_user_id'];

                if($post_user_id == $the_user_id){
        
                echo "<li><a href='/cms/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
            }
        
        }
  
    }
    
    ?>

           
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
