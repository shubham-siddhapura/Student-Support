<?php

    include("include/connection.php");
    include("functions/functions.php");
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <script src="https://kit.fontawesome.com/017e226bc3.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="styles/home-style.css">

    <link rel="stylesheet" href="styles/user_profile.css">

    <link rel="stylesheet" href="styles/edit_profile.css">

    <link rel="stylesheet" href="styles/users.css">

    <link rel="stylesheet" href="styles/send_msg.css">

    <link rel="stylesheet" href="styles/messages.css">

    <link rel="stylesheet" href="styles/single_msg.css">

    <style>
        a:active{
            color:red;
        }
    </style>

</head>
<body>
    
    <!-- header starts -->
    <div class="header">

        <div class="nav">
            <div class="logo">
                <img src="image/SS-logos_white.png" alt="">
            </div>
            <div class="logo-two">
                <?php

                    if(isset($_SESSION['email'])){
                        $email=$_SESSION['email'];

                        $query="select * from users where email='$email'";
                        $result=mysqli_query($con, $query);
                        $array=mysqli_fetch_array($result);
                        $user_id=$array['user_id'];
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
                        $pwd=$array['pwd'];              

                        echo '
                        <a href="javascript:void(0);" onclick="dropdown()">
                            <img src="users/'.$image.'" alt="" style="border-radius:50%; margin-top=0;"></a>
                        <ul id="dropdown-menu">
                            <li><a href="user_profile.php?user_id='.$user_id.'">Your Profile</a></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                        ';
                    
                    }
                    else{
                        echo '
                        <a href="javascript:void(0);" onclick="dropdown()"><img src="image/ss-logo-2.png" alt=""></a>
                            <ul id="dropdown-menu">
                                <li><a href="signup.php">Sign Up</a></li>
                                <li><a href="loginform.php">Log In</a></li>
                            </ul>
                        ';
                    }
                ?>
                
                <script>
                    function dropdown() {
                        var x = document.getElementById("dropdown-menu");
                        if (x.style.display === "block") {
                            x.style.display = "none";
                        } else {
                            x.style.display = "block";
                        }
                    }
                </script>
                
            </div>