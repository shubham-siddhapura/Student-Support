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

        <!-- login form starts -->
        <div class="login-form">
            <form action="" method="post">
                <input type="text" name="email" placeholder="e-mail" required>
                <input type="password" name="pwd" placeholder="password" required>
                <button type="submit" name="login">Let me in</button>
            </form>
        </div>
        <!-- login form ends -->

    </div>
    <!-- nav tag ends -->
    <?php
        include("./login.php");
    ?>
