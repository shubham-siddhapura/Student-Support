<?php

    if(!isset($_SESSION)){
        session_start();
    }
    

    include("include/connection.php");

    if(isset($_POST['login'])){

        $email=mysqli_real_escape_string($con, $_POST['email']);
        $pwd=mysqli_real_escape_string($con, $_POST['pwd']);
        
        $query="select * from users where email='$email' and pwd='$pwd' and status='verified'";
        $execute=mysqli_query($con, $query);
        $row=mysqli_num_rows($execute);
        if($row==1){
            $result=mysqli_fetch_array($execute);
            $user_id=$result['user_id'];
            $_SESSION['email']=$email;
            $_SESSION['my_id']=$user_id;
            $status_query="update users set last_login='Active Now' where user_id=$user_id";
            $run_query=mysqli_query($con, $status_query);
            if($run_query){
                echo "<script>window.open('home.php','_self')</script>";
            }
            else{
                echo mysqli_error($con);
            }
            
        }
        else{
            echo "<script>alert('incorrect details, try again!!')</script>";
        }

    }

?>