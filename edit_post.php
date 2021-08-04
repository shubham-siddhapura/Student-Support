<?php
    include("template/home_header_logo.php");
    include("template/home_header_home.php");
    include("template/home_header_search.php");
    include("template/profile_side_home.php");

?>
    <!-- main tag starts -->
    <div class="main flex">
        
        <?php
        
        // single post function
    if(isset($_GET['post_id'])){
        $post_id=$_GET['post_id'];
        $query="select * from posts where post_id='$post_id'";
        $run=mysqli_query($con, $query);
        $row=mysqli_fetch_array($run);
        $post_title=$row['post_title'];
        $post_content=$row['post_content'];
        $post_date=$row['post_date'];
        $user_id=$row['user_id'];

        $user_query="select * from users where user_id='$user_id'";
        $run_user=mysqli_query($con, $user_query);

        $user_row=mysqli_fetch_array($run_user);

        $user_name=$user_row['name'];
        $user_image=$user_row['image'];
        $institute=$user_row['institute'];

        echo '
            <div class="edit-post-heading">
            <h2>Edit Post</h2>
            </div>
            <!-- edit post starts -->
            <div class="add-post flex">

                <form action="" method="post">

                    <input type="text" name="title-post" placeholder="Add Title" value="'.$post_title.'" required>
                    <br>
                    <textarea name="desc-post" id="desc-post" cols="30" rows="5" placeholder="Write here..." >'.$post_content.'</textarea>
                    <br>
                    <select name="topic" id="topic">
                        <option value="all">Select Topic</option>
                        ';
                        getTopics();
                        
            echo'    
                </select>
                
                <button type="submit" name="submit" >Edit Post</button>

            </form>
            
            <div class="edit-post-res">
            </div>
        </div>
            ';

            if(isset($_POST['submit'])){
                
                $post_title=addslashes($_POST['title-post']);
                $post_desc=addslashes($_POST['desc-post']);
    
                $query="update posts set post_title='$post_title',post_content='$post_desc', edited='yes', edited_time=NOW() where post_id=$post_id";
    
                $run=mysqli_query($con, $query);
                if($run){
                    echo "Edited successfully!!";
                    echo'
                    <script type="text/javascript">location.href = "single.php?post_id='.$post_id.'";</script>
                    ';
                }
                else{
                    echo "something went wrong";
                    echo mysqli_error($con);
                }
            }

        if(isset($_SESSION['email'])){
            
            $com_email = $_SESSION['email'];
            $com_query="select * from users where email='$com_email'";
            $com_run=mysqli_query($con, $com_query);
            $com_row=mysqli_fetch_array($com_run);

            echo'
                
                <div class="comment-form">

                <form action="" method="post">

                    <textarea name="comment" id="comment" cols="30" rows="10" placeholder="write a comment..."></textarea>
                    
                    <button type="submit" name="post_comment" value="comment">comment</button>

                </form>

                </div>
            ';

            if(isset($_POST['post_comment'])){

                $comment=addslashes($_POST['comment']);
                $com_user=$com_row['user_id'];
                $com_name=$com_row['name'];
                $com_institute=$com_row['institute'];

                // for finding and not adding duplicate value
                $duplicate="select * from comments where comment='$comment' and user_id='$com_user' and post_id='$post_id'";
                $run_duplicate=mysqli_query($con, $duplicate);
                $row_duplicate=mysqli_num_rows($run_duplicate);

                
                if($row_duplicate==0){

                    // insert comments query
                    $insert_com="insert into comments(post_id, user_id, comment, author, institute, com_date, author_email) values('$post_id', '$com_user', '$comment', '$com_name', '$com_institute', NOW(), '$com_email')";
                    
                    $insert_run=mysqli_query($con, $insert_com);

                    if($insert_run){
                        echo'
                            <h3>Thank you for your contribution!!</h3>
                        ';
                    }
                    else{
                        echo mysqli_error($con);
                    }
                }
            }

        }

        include("functions/comments.php");
    }

?>

        

    </div>
    <!-- main tag ends -->

</div>
<!-- content ends -->

<!-- div starts -->
<div class="footer">

</div>
<!-- div ends -->

</body>
</html>