<?php
    include("template/home_header_logo.php");
    include("template/home_header_messages.php");
    include("template/home_header_search.php");

    include("template/users.php");

    $my_id=$_SESSION['my_id'];

?>
<div class="send_msg">

<?php
    if(isset($_SESSION['email'])){

        $receiver=$_GET['receiver'];
        $receiver_query="select * from users where user_id=$receiver";
        $receiver_run=mysqli_query($con, $receiver_query);
        $receiver_row=mysqli_fetch_array($receiver_run);
        $receiver_name=$receiver_row['name'];
        $receiver_img=$receiver_row['image'];
        $receiver_institute=$receiver_row['institute'];


    echo '
        
           

        <!-- add post starts -->
        <div class="msgform flex">
            <div class="back">
                <a href="all_users.php"><i class="fas fa-chevron-left"></i></a>
            </div> 
            
            
            <div class="to_rec flex">
                <div class="rec_img">
                    <a href="user_profile.php?user_id='.$receiver.'">
                        <img src="users/'.$receiver_img.'" alt="">
                    </a>
                </div>
                <div class="rec_name">
                    <h2><a href="user_profile.php?user_id='.$receiver.'">'.$receiver_name.'</a></h2>
                    <p>'.$receiver_institute.'</p>
                </div>
            </div>
            

            <form action="send_messages.php?receiver='.$receiver.'" method="post">

               
                <br>
                <input type="text" name="msg-sub" placeholder="Subject" required>
                <br>
                <textarea name="msg-desc" id="desc-post" cols="30" rows="15" placeholder="Write here..."></textarea>
                <br>
                
                <button type="submit" name="submit" >Send Message</button>

            </form>
            
            <div class="add-post-res">
            ';

            if(isset($_POST['submit'])){

                $msg_sub=addslashes($_POST['msg-sub']);
                $msg_desc=addslashes($_POST['msg-desc']);

                $msg_query="insert into messages (sender, receiver, msg_sub, msg_desc, msg_date) values ($my_id, $receiver, '$msg_sub', '$msg_desc', NOW())";
                
                $msg_run=mysqli_query($con, $msg_query);

                if($msg_run){
                    echo"msg sended";
                    echo'
                    <script type="text/javascript">location.href = "messages.php?sent";</script>
                    ';
                }
                else{
                    echo "something went wrong, please try again!!";
                }

            }
    echo'
            </div>    
        </div>
        <!-- add post ends -->
        
    ';
    }
    else{
        header("Location: loginform.php");
    }
?>

</div>

