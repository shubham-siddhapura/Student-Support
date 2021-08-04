<?php
    include("include/connection.php");
    

    if(isset($_POST['signup'])){
        $name=mysqli_real_escape_string($con, $_POST['name']);
        $pwd=mysqli_real_escape_string($con, $_POST['pwd']);
        $email=mysqli_real_escape_string($con, $_POST['email']);
        $institute=mysqli_real_escape_string($con, $_POST['institute']);
        $gender=mysqli_real_escape_string($con, $_POST['gender']);
        $bday=mysqli_real_escape_string($con, $_POST['bday']);
        $status="unverified";
        $posts="no";
        $ver_code=bin2hex(random_bytes(15));

        $check_email_query="select * from users where email='$email'";
        $execute=mysqli_query($con, $check_email_query);

        $check_raw = mysqli_num_rows($execute);
        if($check_raw==1){
            echo "<script>alert('E-mail is already exist, please try with another!!');</script>";
            exit();
        }

        $insert_query="insert into users (name, pwd, email, institute, gender, bday, image, reg_date, status, ver_code, posts) values('$name', '$pwd', '$email', '$institute', '$gender', '$bday', 'default.jpg', NOW(),'$status', '$ver_code', '$posts')";
        $execute_query=mysqli_query($con, $insert_query);
        if($execute_query){
            echo "hey $name, congratulations!! your registration almost completed, please check your email for verification.";
        }
        else{
            echo "Registration failed, try again!!";
        }
        
        error_reporting(E_ALL|E_STRICT);
        ini_set('display_errors', 1);

        $subject = "Email Verification";
        $body = "Hi $name, Click below link for activate your account
        http://localhost/student_support/activate_acc.php?ver_code=$ver_code";
        $sender_email = "From:Student Support";

        if (mail($email, $subject, $body, $sender_email)) {
            echo "Email successfully sent to $email...";
        } else {
            echo "Email sending failed...";
        }
    
    }

    

?>