<?php

    if(!isset($_SESSION['email'])){
        header("Location: loginform.php");
        exit();
    }

    echo'
    
        <!-- content starts -->
        <div class="content flex">
        
            <!-- inbox starts -->
            <div class="inbox flex">

                
    ';

    $my_id=$_SESSION['my_id'];

    if(isset($_GET['inbox'])){

        

        echo '
            <div class="user-search">
                <form action="" method="get">
                    <input type="hidden" name="inbox" value="inbox">
                    <input type="text" name="msg-search" placeholder="find a friend...">
                    <button type="submit" name="msg-search-btn"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="heading_msg flex">
                <div>
                    <h2 style="border-bottom:2px solid gray"><a href="messages.php?inbox">INBOX</a></h2>
                </div>
                <div>
                    <h2 ><a href="messages.php?sent">SENT</a></h2>
                </div>
            </div>
    
        
        ';
        if(isset($_GET['msg-search-btn'])){
            $search=$_GET['msg-search'];
            $all_query="select * from messages where receiver=$my_id and receive_dlt='no' and (msg_sub like '%$search%' or msg_desc like '%$search%') order by 1 desc"; 
        }
        else{
            $all_query="select * from messages where receiver=$my_id and receive_dlt='no' order by 1 desc";
        }
        
        $run_all=mysqli_query($con, $all_query);
        if($run_all){
            while($all_row=mysqli_fetch_array($run_all)){

                $msg_id=$all_row['msg_id'];
                $sender_id=$all_row['sender'];
                $sub=substr($all_row['msg_sub'],0, 45);
                $desc=substr($all_row['msg_desc'],0, 45);
                $date=$all_row['msg_date'];
                $status=$all_row['status'];

                $sender_query="select  * from users where user_id=$sender_id";
                $sender_run=mysqli_query($con, $sender_query);
                $sender_row=mysqli_fetch_array($sender_run);

                $sender=$sender_row['name'];
                $sender_image=$sender_row['image'];
                
                if($status=='unread'){
                    echo'
                    <a href="single_msg.php?msg_id='.$msg_id.'&inbox">
                        <!-- user starts -->
                        <div class="user flex">
            
                            <div class="profile_img">
                                <img src="users/'.$sender_image.'" alt="">    
                            </div>

                            <div class="profile-name-message">
                                <h3 style="font-size:130%;"><strong>'.$sender.'</strong></h3>
                                <p><strong>'.$sub.'...</strong></p>
                                <p><strong>'.$desc.'...</strong></p>
                            </div>
            
                        </div>
                        <!-- user ends -->
                    </a>
                
                ';
                }

                else{
                    echo'
                        <a href="single_msg.php?msg_id='.$msg_id.'&inbox">
                            <!-- user starts -->
                            <div class="user flex">
                
                                <div class="profile_img">
                                    <img src="users/'.$sender_image.'" alt="">    
                                </div>

                                <div class="profile-name-message">
                                    <h3 style="font-size:130%;">'.$sender.'</h3>
                                    <p>'.$sub.'...</p>
                                    <p>'.$desc.'...</p>
                                </div>
                
                            </div>
                            <!-- user ends -->
                        </a>
                    ';  
                }
                
            }
        }
        else{
            echo 'Something went wrong, please try again!!';
        }
    }
    else if(isset($_GET['sent'])){
    
        echo '

            <div class="user-search">
                <form action="" method="get">
                    <input type="hidden" name="sent" value="sent">
                    <input type="text" name="msg-search" placeholder="find a friend...">
                    <button type="submit" name="msg-search-btn"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="heading_msg flex">
                <div>
                    <h2 ><a href="messages.php?inbox">INBOX</a></h2>
                </div>
                <div>
                    <h2 style="border-bottom:2px solid gray;"><a href="messages.php?sent">SENT</a></h2>
                </div>
            </div>
    
        
        ';

        if(isset($_GET['msg-search-btn'])){
            $search=$_GET['msg-search'];
            $all_query="select * from messages where sender=$my_id and sent_dlt='no' and (msg_sub like '%$search%' or msg_desc like '%$search%') order by 1 desc"; 
        }
        else{
            $all_query="select * from messages where sender=$my_id and sent_dlt='no' order by 1 desc";
        }

        $run_all=mysqli_query($con, $all_query);
        if($run_all){
            while($all_row=mysqli_fetch_array($run_all)){

                $msg_id=$all_row['msg_id'];
                $sender_id=$all_row['sender'];
                $sub=substr($all_row['msg_sub'],0,25);
                $desc=substr($all_row['msg_desc'],0, 25);
                $date=$all_row['msg_date'];
                $status=$all_row['status'];

                $sender_query="select  * from users where user_id=$sender_id";
                $sender_run=mysqli_query($con, $sender_query);
                $sender_row=mysqli_fetch_array($sender_run);

                $sender=$sender_row['name'];
                $sender_image=$sender_row['image'];
                
                if($status=='unread'){
                    echo'
                    <a href="single_msg.php?msg_id='.$msg_id.'&sent">
                        <!-- user starts -->
                        <div class="user flex">
            
                            <div class="profile_img">
                                <img src="users/'.$sender_image.'" alt="">    
                            </div>

                            <div class="profile-name-message">
                                <h3 style="font-size:130%;"><strong>'.$sender.'</strong></h3>
                                <p><strong>'.$sub.'...</strong></p>
                                <p><strong>'.$desc.'...</strong></p>
                            </div>
            
                        </div>
                        <!-- user ends -->
                    </a>
                
                ';
                }

                else{
                    echo'
                        <a href="single_msg.php?msg_id='.$msg_id.'&sent">
                            <!-- user starts -->
                            <div class="user flex">
                
                                <div class="profile_img">
                                    <img src="users/'.$sender_image.'" alt="">    
                                </div>

                                <div class="profile-name-message">
                                    <h3 style="font-size:130%;">'.$sender.'</h3>
                                    <p>'.$sub.'...</p>
                                    <p>'.$desc.'...</p>
                                </div>
                
                            </div>
                            <!-- user ends -->
                        </a>
                    ';  
                }
                
            }
        }
        else{
            echo 'Something went wrong, please try again!!';
        }
    }
    
    
    

?>
    <div class="new-msg">
        <a href="all_users.php">
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>

    </div>