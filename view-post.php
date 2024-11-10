<?php include_once('header.php'); ?>
<?php include_once('nav.php'); ?>



<div class="container">
    <div class="row mt-5">
        

        



    <body style="background-image: url('img/ghj.jpeg'); background-position: center; background-repeat: no-repeat; background-size: cover;">


        <div class="col-md-6" style="margin-top: 10px;">

            <div class="card border-5  bg-warning-subtle">
                <div class="card-body">
                    
                    <h4 class="card-title fw-bold my-3 text-center">Post Details</h4>
                    

                    <?php 
                    
                    $today = date('Y-m-d');
                    $post_id = $_GET['post_id'];
                    $posts = $db->query("SELECT * FROM posts WHERE id = $post_id; ");

                    while($post = $posts->fetch_assoc()){
                        $post_id         = $post['id'];
                        $post_title      = $post['title'];
                        $post_file       = $post['file'];
                        $post_post       = $post['post'];
                        $post_tags       = $post['tags'];
                        $post_date       = $post['date'];
                        $post_user_id    = $post['user_id'];
                        $post_type       = $post['type'];
                        $post_impression = $post['impression'];
                        $post_views      = $post['views'];
                        $post_location   = $post['location'];

                        $user = $db->query("SELECT * FROM users WHERE id = '$post_user_id' ");
                        $user = $user->fetch_assoc();
                        $user_name = $user['username'];
                        $user_image = $user['image'];

                        // update views
                        $views = $post_views + 1;
                        $update_views = $db->query("UPDATE posts SET views = '$views' WHERE id = '$post_id' ");

                        

                        ?>

                        <div class="post mb-5 ">
                            <?php if($post_type == 'image'): ?>
                                <img src="img/<?php echo $post_file ?>" class="rounded-top-5 w-100" style="object-fit:cover;">
                            <?php elseif($post_type == 'video'): ?>
                                <video class="rounded-top-5 w-100" style="object-fit:cover;" controls>
                                    <source src="img/<?php echo $post_file ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                            <div class="user-details my-3">
                                <div>
                                    <img src="img/<?php echo $user_image; ?>" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                    <span class="fw-bold"><?php echo $user_name; ?></span>
                                </div>
                            </div>

                            <h5 class="text-uppercase mt-3"><?php echo $post_title ?></h5>
                            <p><?php echo $post_post ?></p>
                            

                            <span class="badge bg-black fw-semibold border-2 text-white p-2"><?php echo $post_tags ?></span>
                            <span class="badge bg-black    fw-semibold   border-2  text-white  p-2"><?php echo $post_location ?></span>
                            <span class="badge bg-black    fw-semibold  border-2  text-white  p-2"><?php echo $post_date ?></span>

                        

                            <hr>

                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="fw-bold"><?php echo $post_views; ?></span> views
                                </div>
                                <div>
                                    <span class="fw-bold"><?php echo $post_impression; ?></span> impressions
                                </div>
                                <div>
                                    <span class="fw-bold">
                                        <?php 
                                        
                                        $comments = $db->query("SELECT * FROM comments WHERE post_id = '$post_id' ");
                                        echo $comments->num_rows;
                                        
                                        ?>
                                    </span> Comments
                                </div>
                                <div>
                                    <span class="fw-bold">
                                        <?php 
                                        
                                        $likes = $db->query("SELECT * FROM likes WHERE post_id = '$post_id' ");
                                        echo $likes->num_rows;
                                        
                                        ?>
                                    </span> Likes
                                </div>
                            </div>

                            <hr>
                            <?php 
                            
                            if(isset($user_id)){
                                ?>
                                
                            <form action="" method="post">
                                <div class="mb-3">
                                    <textarea class="form-control bg-light border-3" required placeholder="Enter Your Comment" id="comment" name="comment" rows="2"></textarea>
                                </div>
                                <div class="mb-3">
                                <button type="submit" class="btn btn-info  px-5 border-dark border-1 fw-bold rounded-5">Submit</button>
                                </div>
                            </form>
                            <?php 
                            
                            if(isset($_POST['comment'])){
                                $comment = $db->real_escape_string($_POST['comment']);
                                $insert_comment = $db->query("INSERT INTO comments (post_id, user_id, comment) VALUES ('$post_id', '$user_id', '$comment') ");
                                if($insert_comment){
                                    echo "<script>location.href='view-post.php?post_id=$post_id';</script>";
                                }
                            }
                            
                            ?>
                                <?php
                            }else{
                                ?>
                                <p class='alert alert-dark rounded-5 p-3'>Please login first to <span class="fw-bold">Comment</span></p>
                                <?php
                            }
                            
                            ?>


                            <!-- All Comments  -->
                            <div class="comments">
                                <?php 
                                
                                $comments = $db->query("SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY id DESC ");
                                if($comments->num_rows){
                                    while($comment = $comments->fetch_assoc()){
                                        $comment_id = $comment['id'];
                                        $comment_user_id = $comment['user_id'];
                                        $comment_comment = $comment['comment'];
    
                                        $comment_user = $db->query("SELECT * FROM users WHERE id = '$comment_user_id' ");
                                        $comment_user = $comment_user->fetch_assoc();
                                        $comment_user_name = $comment_user['username'];
                                        $comment_user_image = $comment_user['image'];
    
                                        ?>
    
                                        <div class="comment mb-3">
                                            <div class="user-details">
                                                <div>
                                                    <img src="img/<?php echo $comment_user_image; ?>" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                                    <span class="fw-bold"><?php echo $comment_user_name; ?></span>
                                                </div>
                                            </div>
                                            <p class="ms-5"><?php echo $comment_comment; ?></p>
                                        </div>
    
                                        <?php
                                    }
                                }else{
                                    echo "<p class='alert alert-warning rounded-5'>No Comments Yet</p>";
                                }
                                
                                ?>

                            </div>



                        </div>


                        <div class="comments">

                        </div>



                        <?php
                    }


                    
                    ?>






                </div>
            </div>

        </div>
        

        <?php include_once('quick-links.php'); ?>




    </div>
</div>





<?php include_once('footer.php'); ?>