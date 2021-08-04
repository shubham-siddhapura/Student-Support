<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Support | SignUp</title>

    <link rel="stylesheet" href="styles/style.css">

</head>
<body>
    <!-- nav tag starts -->
    <div class="nav flex">
        
        <!-- logo starts -->
        <div class="logo">
            <a href="home.php" id="logo1"><img src="image/SS-logos_white.png" alt=""></a>
            <a href="home.php" id="logo2"><img src="image/ss-logo-2.png" alt=""></a>
        </div>
        <!-- logo ends -->
    </div>
    <!-- nav tag ends -->

    
    <!-- main container starts -->
    <div class="main-container flex">

        <!-- main tag starts -->
        <div class="main flex">

            <!-- signup img starts -->
            <div class="signup-img">
                <img src="image/signup-communication.jpg" alt="">
            </div>
            <!-- signup img ends -->

            <!-- signup starts -->

            <div id="login" class="login flex">
                <div class="heading">
                    <h2>Welcome back!</h2>
                    <p>Sign into your account for continue</p>
                </div>
                <div>
                    <?php
                        echo $_SESSION['msg'];
                    ?>
                </div>
                <div class="login-form2">
                    <form action="" method="post">
                        <input type="text" name="email" placeholder="e-mail" required>
                        <br>
                        <input type="password" name="pwd" placeholder="password" required>
                        <br>
                        <button type="submit" name="login">Let me in</button>
                    </form>
                </div>
                <div class="signup-link" style="text-align:center; color:#385A64; margin-top:0.5rem;">
                    <p>Don't have an account?&nbsp;<a href="signup.php">Sign-Up Now</a></p>
                </div>

                <?php
                    include("login.php");
                ?>
            </div>
        
        </div>
        <!-- main tag ends -->

    </div>
    <!-- main container ends -->

<?php

    include("template/footer.php");

?>