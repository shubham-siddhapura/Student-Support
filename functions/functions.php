<?php


    // get topics from data
    function getTopics(){
        global $con;

        $query="select * from topics";

        $run_query=mysqli_query($con, $query);

        while($row=mysqli_fetch_array($run_query)){
            $topic_id=$row['topic_id'];
            $topic_name=$row['topic_name'];
            echo '
                <option value='.$topic_id.'>'.$topic_name.'</option>
            ';
        }

    }

    // insert posts in database
    function insertPost(){
        if(isset($_POST['submit'])){

            global $con;
            global $user_id;

            $title=addslashes($_POST['title-post']);
            $desc=addslashes($_POST['desc-post']);
            $topic=addslashes($_POST['topic']);

            $duplicate="select * from posts where post_title='$title' and post_content='$desc'";
            $run_duplicate=mysqli_query($con, $duplicate);
            $row_duplicate=mysqli_num_rows($run_duplicate);
            // echo $row_duplicate;

            if($desc==''){
                echo '<h3 style="color:red">Please enter description about your post...</h3>';
            }
            else{
                if($row_duplicate==0){
                    $query="insert into posts (user_id, topic_id, post_title, post_content, post_date) values('$user_id', '$topic', '$title', '$desc', NOW())";

                    $run_query=mysqli_query($con, $query);

                    if($run_query){
                        echo"
                            <h3 style='color:green;'>Posted to timeline, looks great!!!</h3>
                        ";
                        $update="update users set posts='yes' where user_id='$user_id'";
                        $run_query=mysqli_query($con, $update);
                    }
                }
            }
        }
    }

    // function for post display

    function postDisplay(){

        global $con;

        if(isset($_GET['search-btn'])){
            
            $search=$_GET['search'];
            
            $query="select * from posts where post_title like '%$search%' or post_content like '%$search%' order by 1 desc";

        }
        else{
            $query="select * from posts order by 1 desc";
        }
        $run_query=mysqli_query($con, $query);
    
            while($row=mysqli_fetch_array($run_query)){
                $post_id=$row['post_id'];
                $user_id=$row['user_id'];
                $post_title=$row['post_title'];
                $post_content=substr($row['post_content'], 0, 200);
                $post_date=$row['post_date'];
    
                $user_query="select * from users where user_id='$user_id'";
                $run_user=mysqli_query($con, $user_query);
    
                $user_row=mysqli_fetch_array($run_user);
                $user_email=$user_row['email'];
                $user_name=$user_row['name'];
                $user_image=$user_row['image'];
                $institute=$user_row['institute'];
                
                
                echo '
                    <!-- posts starts -->
                    <div class="posts">
    
                        <div class="post flex">
                            
                            <!-- heading post starts -->
                            <div class="heading-post flex">
    
                                <div class="profile-name-post flex">
                                    <div class="post-profile">
                                        <a href="user_profile.php?user_id='.$user_id.'">
                                            <img src="users/'.$user_image.'" alt="">
                                        </a>
                                    </div>
    
                                    <div class="name-institute"> 
                                        <a href="user_profile.php?user_id='.$user_id.'">
                                            <h3>'.$user_name.'</h3>
                                        </a>
                                        '.$institute.'
                                    </div>
                                </div>';
                            if(isset($_SESSION['email']) && $user_email==$_SESSION['email']){
                                echo'
                                <div class="edit-delete flex">
    
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
    
                    </div>
                    <!-- posts ends -->
                ';
            }
        
    }

// single post function
    function singlePost(){

        global $con;
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
            $user_email=$user_row['email'];
            echo '
                <!-- posts starts -->
                <div class="posts">

                    <div class="post flex">
                        
                        <!-- heading post starts -->
                        <div class="heading-post flex">

                            <div class="profile-name-post flex">
                                <div class="post-profile">
                                    <a href="user_profile.php?user_id='.$user_id.'">
                                        <img src="users/'.$user_image.'" alt="">
                                    </a>
                                </div>

                                <div class="name-institute"> 
                                    <a href="user_profile.php?user_id='.$user_id.'">
                                        <h3>'.$user_name.'</h3>
                                    </a>
                                    '.$institute.'
                                </div>
                            </div>';
                            if(isset($_SESSION['email']) && $user_email==$_SESSION['email']){
                                echo'
                                <div class="edit-delete flex">
                                        
                                        <a href="edit_post.php?post_id='.$post_id.'" id="edit">
                                            <i class="far fa-edit"></i>
                                        </a>
    
                                        <a href="delete_post.php?post_id='.$post_id.'" id="dlt" onclick="return confirm(\'Are you sure to delete it?\')">
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
                            <p>'.$post_content.'</p>
                        </div>
                        <!-- content post ends -->

                        
                    </div>

                </div>
                <!-- posts ends -->
            
                <center><h2>Comments</h2></center>
                
            ';

            comments($post_id);    
            
        }

    }

    // comments function
    function comments($post_id){

        global $con;
        if(isset($_SESSION['email'])){
            

            $com_email = $_SESSION['email'];
            $com_query="select * from users where email='$com_email'";
            $com_run=mysqli_query($con, $com_query);
            $com_row=mysqli_fetch_array($com_run);

            if(isset($_GET['com_id'])){

                $com_id=$_GET['com_id'];
                $query="select * from comments where com_id='$com_id'";
                $run=mysqli_query($con, $query);

                if($run){
                    $row=mysqli_fetch_array($run);
                    $comment=$row['comment'];
                    echo'
                        <div class="comment-form">

                        <form action="" method="post">

                            <textarea name="comment" id="comment" cols="30" rows="10" placeholder="write a comment...">'.$comment.'</textarea>
                            
                            <button type="submit" name="submit" value="comment">comment</button>

                        </form>

                        </div>
                    ';

                    if(isset($_POST['submit'])){

                        $comment=addslashes($_POST['comment']);
                        $com_user=$com_row['user_id'];
                        // for finding and not adding duplicate value
                        $duplicate="select * from comments where comment='$comment' and user_id='$com_user' and post_id=$post_id";
                        $run_duplicate=mysqli_query($con, $duplicate);
                        $row_duplicate=mysqli_num_rows($run_duplicate);
    
                        
                        if($row_duplicate==0){
    
                            // edit comments query
                            $edit_com="update comments set comment='$comment', edited='yes', edited_time=NOW() where com_id=$com_id";
                        
                            $edit_run=mysqli_query($con, $edit_com);
    
                            if($edit_run){
                                echo'
                                    <h3>edited successfully!!</h3>
                                    <script type="text/javascript">location.href = "single.php?post_id='.$post_id.'";</script>
                                ';
                            }
                            else{
                                echo mysqli_error($con);
                            }
                        }
                    }

                }
                
            }
            else{
                echo'
                
                    <div class="comment-form">

                    <form action="" method="post">

                        <textarea name="comment" id="comment" cols="30" rows="10" placeholder="write a comment..."></textarea>
                        
                        <button type="submit" name="submit" value="comment">comment</button>

                    </form>

                    </div>
                ';

                if(isset($_POST['submit'])){

                    $comment=addslashes($_POST['comment']);
                    $com_user=$com_row['user_id'];
                    $com_name=$com_row['name'];
                    $com_institute=$com_row['institute'];
                    $com_image=$com_row['image'];
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
            

        }

        include("comments.php");
    }

?>

