<?php

include("template/home_header_logo.php");
include("template/home_header_users.php");
include("template/home_header_search.php");
include("template/users.php");


    if(isset($_GET['user_id'])){
        $user_id=$_GET['user_id'];
        $query="select * from users where user_id='$user_id'";
        $result=mysqli_query($con, $query);
        $array=mysqli_fetch_array($result);
        $user_email=$array['email'];
        $name=$array['name'];
        $institute=$array['institute'];
        $gender=$array['gender'];
        $bday=$array['bday'];
        $image=$array['image'];
        $reg_date=$array['reg_date'];
        $lastlogin=$array['last_login'];
        $status=$array['status'];
        $post=$array['posts'];
        $bio=$array['bio'];
        $linkedin=$array['linkedin'];
        $github=$array['github'];
        $mail=$array['mail'];
        $twitter=$array['twitter'];

        echo'
        
            <div class="user-profile flex">
            <div class="back-msg flex">
                
                
                <div class="back">
                    <a href="all_users.php"><i class="fas fa-chevron-left"></i></a>
                </div>
                <div class="msg-logout">
                    ';
                        if(isset($_SESSION['email'])){
                            
                            if($user_email==$_SESSION['email']){
                                echo'
                                
                                <a href="edit_profile.php?user_id='.$user_id.'">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                &nbsp;
                                <a href="logout.php">Log Out  <i class="fas fa-sign-out-alt"></i></a>
                                
                                ';    
                            }
                            else{
                                echo'<a href="send_messages.php?receiver='.$user_id.'"> <i class="fas fa-comment-alt"></i> Message</a>';
                            }
                        }
        echo'
                </div>
            </div>
                <div class="personal-info flex">
                    <div class="user-image">
                        <img src="users/'.$image.'" alt="">
                    </div>
                    <div class="information">
                        <h1>'.$name.'</h1>
                        <p>'.$bio.'</p>

                        <br>

                        <table>
                            <tr id="institute">
                                <td>Institute:</td>
                                <td>'.$institute.'</td>
                            </tr>
                            <tr id="gender">
                                <td>Gender:</td>
                                <td>'.$gender.'</td>
                            </tr>
                            <tr id="bday">
                                <td>Date of Birth:</td>
                                <td>'.$bday.'</td>
                            </tr>
                            <tr id="reg_date">
                                <td>Member Since:</td>
                                <td>'.$reg_date.'</td>
                            </tr>
                            <tr id="lastseen">
                                <td>last Seen:</td>
                                <td>'.$lastlogin.'</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="social-accounts flex">
                ';
                    if($github!=NULL){
                    
                        echo'
                            <a href="'.$github.'">
                                <i class="fab fa-github"></i>
                            </a>
                        ';
                    }

                    if($linkedin!=NULL){
                    
                        echo'
                            <a href="linkedin.com">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        ';
                    }
                        
                    if($mail!="no"){
                    
                        echo'
                            <a href="mailto:shubham@ss.com">
                                <i class="far fa-envelope"></i>
                            </a>
                        ';
                    }

                    if($twitter!=NULL){
                    
                        echo'
                            <a href="twitter.com">
                                <i class="fab fa-twitter"></i>
                            </a>
                        ';
                    }    
                        
            echo'                        
                </div>

                ';
                $query="select * from posts where user_id=$user_id order by 1 desc";

                $run_query=mysqli_query($con, $query);

                while($row=mysqli_fetch_array($run_query)){
                    $post_id=$row['post_id'];
                    $post_title=$row['post_title'];
                    $post_content=substr($row['post_content'], 0, 200);
                    $post_date=$row['post_date'];
                    
                    
                    echo '
                        <!-- posts starts -->
                        
                            <div class="post flex" style="margin-left:4px;">
                                
                                <!-- heading post starts -->
                                <div class="heading-post flex">

                                    <div class="profile-name-post flex">
                                        <div class="post-profile">
                                            <a href="user_profile.php?user_id='.$user_id.'">
                                                <img src="users/'.$image.'" alt="">
                                            </a>
                                        </div>

                                        <div class="name-institute"> 
                                            <a href="user_profile.php?user_id='.$user_id.'">
                                                <h3>'.$name.'</h3>
                                            </a>
                                            '.$institute.'
                                        </div>
                                    </div>';
                                if(isset($_SESSION['email']) && $user_email==$_SESSION['email']){
                                    echo'
                                    <div class="edit-delete">

                                            <a href="edit_post.php?post_id='.$post_id.'" id="edit">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            
                                            <a href="delete_post.php?post_id='.$post_id.'" 
                                            id="dlt" onclick="return confirm(\'Are you sure to delete it?\')">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                                            
                                    </div>
                                    ';
                                }
                            echo'    
                                </div>
                                <!-- heading post ends -->
                                
                                <div class="tposts"> 
                                        <a href="single.php?post_id='.$post_id.'">'.$post_title.'</a>
                                </div>
                                
                                <div class="date-time-post">
                                    Posted on '.$post_date.'
                                </div>
                                <!-- content post starts -->
                                <div class="content-post">
                                    <p>'.$post_content.'...</p>
                                </div>
                                <!-- content post ends -->

                                <!-- comment-post starts -->
                                <div class="comment-post">
                                    <a href="single.php?post_id='.$post_id.'" id="comment">Comments</a>
                                </div>
                                <!-- comment post ends -->

                            </div>

                        <!-- posts ends -->
                
                <!-- user-prfile ends -->        
                        
                ';
                   
            }
            echo'
            </div>
            <!-- user-prfile ends -->
            ';

    }
    else{
        echo'
            <script type="text/javascript">location.href("home.php");</script>
        ';
    }

include("template/home_footer.php");
