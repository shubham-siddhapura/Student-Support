
<?php



    if(!isset($_SESSION['email'])){
        header("Location: loginform.php");
        exit();
    }

    echo'
    
        <!-- content starts -->
        <div class="content flex">
        
            <!-- all users starts -->
            <div class="all-users flex">
                
                <div class="user-search">
                    <form action="all_users.php" method="get">
                        <input type="text" name="user-search-name" placeholder="find friend...">
                        <button type="submit" name="user-search-btn"><i class="fas fa-search"></i></button>
                    </form>
                </div>
    ';

    

    if(isset($_GET['user-search-btn'])){
        
        $user_search=$_GET['user-search-name'];
        
        $all_query="select * from users where name like '%$user_search%'";
        $run_all=mysqli_query($con, $all_query);
        if($run_all){
            while($all_row=mysqli_fetch_array($run_all)){
                $user_name=$all_row['name'];
                $id=$all_row['user_id'];
                $bio=$all_row['bio'];
                $user_image=$all_row['image'];
                if($user_id!=$id){
                   
                    echo'
                        
                            <!-- user starts -->
                            <div class="user flex">
                                <a href="user_profile.php?user_id='.$id.'">
                                    <div class="img_name_profile flex">
                                    
                                        <div class="profile_img">
                                            <img src="users/'.$user_image.'" alt="">    
                                        </div>
                        
                                        <div class="profile-name-message">
                                            <h2>'.$user_name.'</h2>
                                            <p>'.$bio.'</p>
                                        </div>
                                    
                                    </div>
                                </a>
                                <div class="send_msg_btn">
                                    <a href="send_messages.php?receiver='.$id.'">
                                        <i class="fas fa-comment-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- user ends -->
                        </a>
                    
                    ';
                }
            }
    
        }
        else{
            echo 'Something went wrong, please try again!!';
        }
    }
    else{
        $all_query="select * from users";
        $run_all=mysqli_query($con, $all_query);
        if($run_all){
            while($all_row=mysqli_fetch_array($run_all)){
                $user_name=$all_row['name'];
                $id=$all_row['user_id'];
                $bio=$all_row['bio'];
                $user_image=$all_row['image'];
                if($user_id!=$id){
                   
                    echo'
                        
                            <!-- user starts -->
                            <div class="user flex">
                                <a href="user_profile.php?user_id='.$id.'">
                                    <div class="img_name_profile flex">
                                    
                                        <div class="profile_img">
                                            <img src="users/'.$user_image.'" alt="">    
                                        </div>
                        
                                        <div class="profile-name-message">
                                            <h2>'.$user_name.'</h2>
                                            <p>'.$bio.'</p>
                                        </div>
                                    
                                    </div>
                                </a>
                                <div class="send_msg_btn">
                                    <a href="send_messages.php?receiver='.$id.'">
                                        <i class="fas fa-comment-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- user ends -->
                        </a>
                    
                    ';
                }
            }
    
        }
        else{
            echo 'Something went wrong, please try again!!';
        }
    }

?>

    
        
    </div>
    <!-- all users ends -->
