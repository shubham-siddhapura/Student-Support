<?php

include("include/connection.php");
//get post id via link
$get_id=$_GET['post_id'];

$com_query="select * from comments where post_id='$get_id' order by 1 desc";

$comments=mysqli_query($con, $com_query);

while($row=mysqli_fetch_array($comments)){
    
    $comment_id=$row['com_id'];
    $com = $row['comment'];
    $author=$row['author'];
    $author_id = $row['user_id'];
    $institute = $row['institute'];
    $date = $row['com_date'];
    $author_email=$row['author_email'];

    $query="select * from users where email='$author_email'";
    $run_query=mysqli_query($con, $query);
    $row_user=mysqli_fetch_array($run_query);
    $image=$row_user["image"];

    echo'

    <!-- comments starts -->
    <div class="comments">

        <div class="comment flex">
            
            <!-- heading post starts -->
            <div class="heading-post flex">

                <div class="profile-name-post flex">
                    <div class="post-profile">
                        <a href="user_profile.php?user_id='.$author_id.'">
                            <img src="users/'.$image.'" alt="">
                        </a>
                    </div>

                    <div class="name-institute"> 
                        <a href="user_profile.php?user_id='.$author_id.'">
                            <h3>'.$author.'</h3>
                        </a>
                        '.$com.'
                    </div>
                </div>    
            </div>
            <!-- heading post ends -->
            
            <div class="date-time-edit-dlt flex">
                Commented on '.$date.'
            ';
                if(isset($_SESSION['email']) && $author_email==$_SESSION['email']){
                    echo'
                        <div class="edit-delete">

                            <a href="edit_comment.php?com_id='.$comment_id.'&post_id='.$get_id.'" id="edit">
                                <i class="far fa-edit"></i>
                            </a>

                        
                            <a href="delete_post.php?com_id='.$comment_id.'&p_id='.$get_id.'" id="delete" onclick="return confirm(\'Are you sure to delete your comment?\')">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </div>                    
                        
                    ';
                }

            echo'
            </div>
        </div>

    </div>
    <!-- posts ends -->

    
    ';

}

?>