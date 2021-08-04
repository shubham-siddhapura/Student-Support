<?php

include("include/connection.php");

if(isset($_GET['post_id'])){
    
    $post_id=$_GET['post_id'];

    $query="delete from posts where post_id=$post_id";
    
    $run=mysqli_query($con, $query);

    if($run){
        echo"post deleted successfully";
        echo'
            <script type="text/javascript">location.href = "home.php";</script>
        ';
    }
    else {
        echo"something went wrong, please try again!!";
    }

}

if(isset($_GET['com_id'])){
    
    $com_id=$_GET['com_id'];
    $post_id=$_GET['p_id'];

    $query="delete from comments where com_id=$com_id";
    
    $run=mysqli_query($con, $query);

    if($run){
        echo"post deleted successfully";
        echo'
            <script type="text/javascript">location.href = "single.php?post_id='.$post_id.'";</script>
        ';
    }
    else {
        echo"something went wrong, please try again!!";
    }

}

?>