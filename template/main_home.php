<!-- main tag starts -->
<div class="main flex">
            
            <?php
                if(isset($_SESSION['email'])){

                    echo '
                        <div class="add-post-heading">
                        <h2>Hey '.$name.', Is there any Query? Let'."'".'s Discuss!!</h2>
                        </div>
                        <!-- add post starts -->
                        <div class="add-post flex">
            
                            <form action="home.php?user_id='.$user_id.'" method="post">
            
                                <input type="text" name="title-post" placeholder="Add Title" required>
                                <br>
                                <textarea name="desc-post" id="desc-post" cols="30" rows="5" placeholder="Write here..."></textarea>
                                <br>
                                <select name="topic" id="topic">
                                    <option value="all">Select Topic</option>
                                    ';
                                    getTopics();
                                    
                            echo'    
                                </select>
                                
                                <button type="submit" name="submit" >Add Post</button>
            
                            </form>
                            
                            <div class="add-post-res">
                            ';

                            insertPost();
                    echo'
                            </div>    
                        </div>
                        <!-- add post ends -->
                        
                    ';
                }
                else{
                    echo '
                        <div class="new-user">
                            <h3>Hey there, Press logo for log-in or sign-up now.</h3>
                        </div>
                    ';
                }
                echo'
                <div class="recent-post">
                    <h2>Recent Posts</h2>
                </div>
                ';
                postDisplay();

            ?>

            

        </div>
        <!-- main tag ends -->

    </div>
    <!-- content ends -->
