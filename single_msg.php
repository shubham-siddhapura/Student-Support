<?php

include("template/home_header_logo.php");
include("template/home_header_messages.php");
include("template/home_header_search.php");
?>

<?php

    if(!isset($_SESSION['email'])){
        header("Location: loginform.php");
        exit();
    }

    echo'
    
        <!-- content starts -->
        <div class="content flex">
        
            <!-- inbox starts -->
            <div class="inbox-single flex">

                
    ';

    $my_id=$_SESSION['my_id'];

    if(isset($_GET['inbox'])){

        echo '

            <div class="user-search">
                <form action="messages.php" method="get">
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

        $all_query="select * from messages where receiver=$my_id and receive_dlt='no' order by 1 desc";
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
                <form action="messages.php" method="get">
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

        $all_query="select * from messages where sender=$my_id and sent_dlt='no' order by 1 desc";
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

<div class="single_msg flex">

    <?php

        $msg_id=$_GET['msg_id'];

        $msg_query="select * from messages where msg_id=$msg_id";
        $msg_run=mysqli_query($con, $msg_query);
        $msg_row=mysqli_fetch_array($msg_run);

        $date=$msg_row['msg_date'];
        $msg_desc=$msg_row['msg_desc'];
        $msg_sub=$msg_row['msg_sub'];
        $receiver_id=$msg_row['receiver'];
        $sender_id=$msg_row['sender'];

        $read_query="update messages set status='read' where msg_id=$msg_id and receiver=$my_id";
        $run_read=mysqli_query($con, $read_query);

        $sender_query="select * from users where user_id=$sender_id";
        $sender_run=mysqli_query($con, $sender_query);
        if($sender_run){

            $row_sender=mysqli_fetch_array($sender_run);
            $sender=$row_sender['name'];
            $sender_image=$row_sender['image'];
            
            $receiver_query="select * from users where user_id=$receiver_id";
            $receiver_run=mysqli_query($con, $receiver_query);
            $row_receiver=mysqli_fetch_array($receiver_run);

            $receiver=$row_receiver['name'];
            
            if($sender_id==$_SESSION['my_id']){
                echo'
                
                    <div class="back-dlt flex">
                        <div class="back">
                            <a href="messages.php?sent"><i class="fas fa-chevron-left"></i></a>
                        </div>
                        <div class="msg-dlt">
                            <a href="dlt_msg.php?sent&msg_id='.$msg_id.'" id="dlt" onclick="return confirm(\'Are you sure to delete it?\')">
                            <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>                
                ';
            }
            else{
                
                
                echo'
                    <div class="back-dlt flex">
                        <div class="back">
                            <a href="messages.php?inbox"><i class="fas fa-chevron-left"></i></a>
                        </div>
                        <div class="msg-dlt">
                            <a href="dlt_msg.php?receive&msg_id='.$msg_id.'" id="dlt" onclick="return confirm(\'Are you sure to delete it?\')">
                            <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                ';
            }
            

            echo'

                
                <div class="heading_single_msg">
                    <p>'.$msg_sub.'</p>
                </div>

                <div class="sender_details flex">
                    <div class="sender_image">
                        <img src="users/'.$sender_image.'" alt="">
                    </div>
                    <div class="sender_name_info">
                        <h2><a href="user_profile.php?user_id='.$sender_id.'">'.$sender.'</a></h2>
                        <div class="info_msg">

                            <table>
                                <tr>
                                    <td>From</td>
                                    <td><a href="user_profile.php?user_id='.$sender_id.'">'.$sender.'</a></td>
                                </tr>

                                <tr>
                                    <td>To</td>
                                    <td><a href="user_profile.php?user_id='.$receiver_id.'">'.$receiver.'</a></td>
                                </tr>

                                <tr>
                                    <td>Date</td>
                                    <td>'.$date.'</td>
                                </tr>

                            </table>
                        </div>

                    </div>
                </div>

                <div class="reply">

                </div>

                <div class="msg_desc">
                    <p>
                        '.$msg_desc.'
                    </p>
                </div>
                    
            ';
            

        }
        else{
            echo 'Something went wrong, please try again!!';
        }

        
    ?>

    
    

</div>

