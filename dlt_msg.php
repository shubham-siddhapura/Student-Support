<?php

    include("include/connection.php");

    $msg_id=$_GET['msg_id'];
    if(isset($_GET['sent'])){
        $query="update messages set sent_dlt='yes' where msg_id=$msg_id";
        $run=mysqli_query($con, $query);
        
        $slt_query="select * from messages where msg_id=$msg_id";
        $slt_run=mysqli_query($con, $slt_query);
        $row=mysqli_fetch_array($slt_run);
        $receive_dlt=$row['receive_dlt'];
        if($receive_dlt=='yes'){
            $dlt_query="delete messages where msg_id=$msg_id";
            $dlt_run=mysqli_query($con, $dlt_query);
            if($dlt_run){
                header("Location: messages.php?sent");
            }
        }
        else{
            header("Location: messages.php?sent");
        }
    }
    else{
        $query="update messages set receive_dlt='yes' where msg_id=$msg_id";
        $run=mysqli_query($con, $query);
        
        $slt_query="select * from messages where msg_id=$msg_id";
        $slt_run=mysqli_query($con, $slt_query);
        $row=mysqli_fetch_array($slt_run);
        $sent_dlt=$row['sent_dlt'];
        if($sent_dlt=='yes'){
            $dlt_query="delete messages where msg_id=$msg_id";
            $dlt_run=mysqli_query($con, $dlt_query);
            if($dlt_run){
                header("Location: messages.php?inbox");
            }
        }
        else{
            header("Location: messages.php?inbox");
        }
    }


?>