    <!-- content starts -->
    <div class="content flex">

        <!-- profile side starts -->
        <div class="profile-side flex">
            <!-- php for profile side data -->
            <?php
                if(isset($_SESSION['email'])){
                    
                    echo '

                        <div class="profile-pic">
                            <a href="user_profile.php?user_id='.$user_id.'">
                                <img src="users/'.$image.'" alt="">
                            </a>
                        
                        </div>
            
                        <div class="username">
                            <a href="user_profile.php?user_id='.$user_id.'">
                                <h2>'.$name.'</h2>
                            </a>
                        </div>
            
                        <div class="bio">
                            <p id="bio-p">'.$bio.'</p>
                        </div>
            
                        <div class="user-details">
                            
                            <p> <span>institute:</span> <span id="institute">'.$institute.'</span></p>
                            <p> <span>gender:</span> <span id="gender">'.$gender.'</span></p>
                            <p> <span>status:</span> <span id="status">'.$status.'</span></p>
                            <p> <span>reg. date:</span> <span id="reg_date">'.$reg_date.'</span></p>
                            <p> <span>last login:</span> <span id="last_login">'.$lastlogin.'</span></p>
            
                        </div>
                        
                        
                        <div class="logout">
                            <a href="logout.php?user_id='.$user_id.'">
                                Log Out <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </div>
            
                        <div class="edit-profile">
                            <a href="edit_profile.php?user_id='.$user_id.'">
                                <i class="fas fa-user-edit"></i>
                            </a>
                        </div>    

                    ';

                    
                }
                else{
                    echo '

                        <div class="login-heading">
                            <h2>Welcome back!</h2>
                            <p>Sign into your account for continue</p>
                        </div>

                        <div class="login-form">
                            <form action="" method="post">
                                <input type="text" name="email" placeholder="e-mail" required>
                                <input type="password" name="pwd" placeholder="password" required>
                                <button type="submit" name="login">Let me in</button>
                            </form>
                        </div>
                        <div class="signup-link" style="text-align:center; color:#385A64; margin-top:0.5rem;">
                            <p>Don'."'".'t have an account?&nbsp;<a href="signup.php">Sign-Up Now</a></p>
                        </div>
                        
                    ';
                    include("login.php");
                }
                
            ?>
            

        </div> 
        <!-- profile side ends -->

