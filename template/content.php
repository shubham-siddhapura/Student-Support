
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

            <div class="signup flex">

                <div class="heading">
                    <h1>SIGN UP</h1>
                </div>

                <!-- signup form starts -->
                <div class="signup-form">
                    <form action="" method="POST">
                        <input type="text" name="name" placeholder="Name">
                        <br>
                        <input type="password" name="pwd" placeholder="Password">
                        <br>
                        <input type="text" name="email" placeholder="E-mail: abc@xyz.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                        <br>
                        <input type="text" name="institute" placeholder="Institute">
                        <br>
                    
                        <fieldset required>
                            <legend>Gender:</legend>
                            <input type="radio" name="gender" value="male" checked>
                            <label for="male">Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="gender" value="female">
                            <label for="female">Female</label>
                        </fieldset>
                        <label for="bday">Date of Birth:</label>
                        <br>
                        <input type="date" name="bday" placeholder="Date of Birth">
                        <br>
                        <button type="submit" name="signup">Let me join</button>
                    </form>

                </div>
                <!-- signup form ends -->

                <div class="backend-res">
                    <?php
                        include('insert_user.php');
                        include('login.php');
                    ?>
                </div>

                <div class="signin-link two" style="text-align:center; color:#385A64; margin-top:0.5rem; width:18rem;">
                    <p>Already have an account?&nbsp;<a href="loginform.php">Sign-In Now</a></p>
                </div>
            </div>
            <!-- signup ends -->

        </div>
        <!-- main tag ends -->

    </div>
    <!-- main container ends -->
