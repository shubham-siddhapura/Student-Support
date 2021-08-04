<div class="nav-btn">
                <a href="home.php" >
                    <i class="fas fa-home"></i>
                </a>

                <?php
                
                    if(isset($_SESSION['email'])){
                        $msg_query="select * from messages where receiver='$user_id' and status='unread' order by 1 desc";
                        $run_msg=mysqli_query($con, $msg_query);
                        $msg_count=0;
                        if($run_msg){
                            $msg_count=mysqli_num_rows($run_msg);
                        }
                        
                        
                        echo'
                            <a href="messages.php?inbox&user_id='.$user_id.'" class="open">
                                <i class="far fa-comment-alt"></i>('.$msg_count.')
                            </a>
                        ';
                    }
                    
                ?>

                <a href="all_users.php">
                    <i class="fas fa-users"></i>
                </a>
            </div>

            