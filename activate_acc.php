<?php
    session_start();

    include("include/connection.php");

    if(isset($_GET['ver_code'])){
        $ver_code=$_GET['ver_code'];

        $update_query="update users set status='verified' where ver_code='$ver_code'";
        $execute=mysqli_query($con, $update_query);

        if($execute){
            header("location: loginform.php");
            $_SESSION['msg']="account verified successfully";
        }
        else{
            header("location: signup.php");
            $_SESSION['msg']="account is not verified";
        }
    }

?>