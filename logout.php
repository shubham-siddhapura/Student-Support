<?php

    include("include/connection.php");

    session_start();

    $my_id=$_SESSION['my_id'];
    $query="update users set last_login=NOW() where user_id=$my_id";

    $run=mysqli_query($con, $query);

    session_unset();

    session_destroy();

    header("Location:home.php");

?>