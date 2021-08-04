<?php

include("template/home_header_logo.php");
include("template/home_header_home.php");
include("template/home_header_search.php");
    include("template/profile_side_home.php");       

    echo'

        <!-- edit profile starts -->
        <div class="edit-form">
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="personal-details">
                    <h2>Personal Details</h2>

                    <table>
                        <tr>
                            <td><label for="name">Name:</label></td>
                            <td><input type="text" name="name" placeholder="Name" value="'.$name.'" required></td>
                        </tr>
                        <tr>
                            <td><label for="institute">Institute:</label></td>
                            <td><input type="text" name="institute" placeholder="Institute" value="'.$institute.'" required></td>
                        </tr>
                        <tr>
                            <td><label for="gender">Gender:</label></td>
                        ';
                        if($gender="male"){
                            echo'
                                <td><input type="radio" name="gender" value="male" checked>
                                <label for="male">Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value="female">
                                <label for="female">Female</label></td>
                                </tr>
                            ';
                        }
                        else{
                            echo'
                                <td><input type="radio" name="gender" value="male">
                                <label for="male">Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value="female" checked>
                                <label for="female">Female</label></td>
                                </tr>
                            ';
                        }
                    echo'
                        <tr>
                            <td><label for="bday">Date of Birth:</label></td>
                            <td><input type="date" name="bday" placeholder="Date of Birth" value='.$bday.' required></td>
                        </tr>

                        
                    </table>

                </div>
                
                <p>About:</p>
                <textarea name="bio" id="bio" cols="30" rows="4" placeholder="add short description about yourself...">'.$bio.'</textarea>
                <br>
                <hr>
                <div class="social-media">
                    
                    <h2>Social Media</h2>
                    <p>Add your social media account for more connectivity</p>
                    <table>
                        <tr>
                            <td><label for="linkedin"><i class="fab fa-linkedin-in"></i> linkedin profile:</label></td>
                            <td><input type="text" name="linkedin" value="'.$linkedin.'"></td>
                        </tr>
                        <tr>
                            <td><label for="github"><i class="fab fa-github"></i> github profile:</label></td>
                            <td><input type="text" name="github" value="'.$github.'"></td>
                        </tr>
                        <tr>
                            <td><label for="twitter"><i class="fab fa-twitter"></i> twitter profile:</label></td>
                            <td><input type="text" name="twitter" value="'.$twitter.'"></td>
                        </tr>
                        <tr>
                            <td colspan=2><label for="linkedin"><i class="far fa-envelope"></i> Do you want to make your mail address public?</label>
                            ';
                            if($mail=='yes'){
                                echo'
                                <input type="radio" name="mail" value="yes" checked>Yes
                                <input type="radio" name="mail" value="no">No</td>
                                ';
                            }
                            else{
                                echo'
                                <input type="radio" name="mail" value="yes">Yes
                                <input type="radio" name="mail" value="no" checked>No</td>
                                ';
                            }

                        echo'
                            </tr>

                        <tr>
                            <td><label for="pwd">Set Profile Image:</label></td>
                            <td><input type="file" name="profile_img" value="'.$image.'"></td>
                        </tr>
                        
                        <tr>
                            <td><label for="pwd">Remove Profile Image:</label></td>
                            <td><input type="radio" name="remove-profile_img">YES
                            <input type="radio" name="remove-profile_img" checked>NO</td>
                        </tr>

                        <tr>
                            <td><label for="pwd">Password:</label></td>
                            <td><input type="password" name="pwd"></td>
                        </tr>


                    </table>

                </div>

                <br>
                
                <button type="submit" name="edit">Update me</button>
            
            </form>

        </div>
        <!-- edit profile ends -->
        
    
    ';

    if(isset($_POST['edit'])){
        $query="select * from users where user_id='$user_id' and pwd='$pwd' and status='verified'";
        $execute=mysqli_query($con, $query);
        $row=mysqli_num_rows($execute);
        if($row==1){
            $name=mysqli_real_escape_string($con, $_POST['name']);
            $institute=mysqli_real_escape_string($con, $_POST['institute']);
            $gender=mysqli_real_escape_string($con, $_POST['gender']);
            $bday=mysqli_real_escape_string($con, $_POST['bday']);
            $bio=mysqli_real_escape_string($con, $_POST['bio']);
            $linkedin=mysqli_real_escape_string($con, $_POST['linkedin']);
            $github=mysqli_real_escape_string($con, $_POST['github']);
            $twitter=mysqli_real_escape_string($con, $_POST['twitter']);
            $mail=mysqli_real_escape_string($con, $_POST['mail']);
            if($_FILES['profile_img']['name']!=null){
                $profile_img=$_FILES['profile_img']['name'];
                $temp_img=$_FILES['profile_img']['tmp_name'];
                move_uploaded_file($temp_img, "users/$profile_img");
            }
                
            $remove=$_POST['remove-profile_img'];

            if($remove=='yes'){
                $update_query="update users set name='$name', institute='$institute', gender='$gender', bday='$bday', bio='$bio', linkedin='$linkedin', github='$github', twitter='$twitter', mail='$mail', image='default.jpg' where user_id=$user_id";
            
            }
            else if ($_FILES['profile_img']['name']==null) {
                $update_query="update users set name='$name', institute='$institute', gender='$gender', bday='$bday', bio='$bio', linkedin='$linkedin', github='$github', twitter='$twitter', mail='$mail' where user_id=$user_id";
            }
            else{
                $update_query="update users set name='$name', institute='$institute', gender='$gender', bday='$bday', bio='$bio', linkedin='$linkedin', github='$github', twitter='$twitter', mail='$mail', image='$profile_img' where user_id=$user_id";
            }

            

            $update_run=mysqli_query($con, $update_query);

            if($update_run){
                
                echo "<script>window.open('user_profile.php?user_id=$user_id','_self')</script>";
            }

        }
        else{
            echo "<script>alert('incorrect details, try again!!')</script>";
        }

    }

?>

</div>

</div>