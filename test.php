<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

            <?php

            
            echo  LogedInUsersId(); 

            if(UserLikedPost(140)){
                echo " user liked";
            } else { 
                echo " user did not liked";
             }
                
            
        
            ?>
            

         