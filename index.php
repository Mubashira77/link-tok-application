<?php
include_once('header.php'); 
include_once('nav.php');

// Assuming session_start() is called before this point

// Assuming $db is your database connection

?>

<body class="bg-secondary-subtle">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6">
                <h4 class="text-info">Revolutionizing Short Video Sharing</h4>
                <div class="spacer-10"></div>
                <h3>Welcome to Link-Tok</h3>
                <p class="lead">Embark on a journey of creativity with Link-Tok, your go-to platform for short video sharing. With over 25 years of combined technical excellence, we bring you a seamless experience in video creation, sharing, and connection.</p>
                <a class="btn btn-success text-warning fw-semibold" href="login.php">Join Link-Tok</a>
            </div>

            <div class="col-lg-6">
                <img src="img/pic.webp" class="img-fluid border border-5" alt="">
            </div>
        </div>
    </div>

    <?php 
    include_once('quick-links.php');
    ?>

    <div class="container mt-5">
        <h1 class="card-title text-center mb-3 mt-5 alert alert-dark bg-dark text-white rounded-5" style="text-align: center;">All Posts Of Users</h1>

        <?php 
                      $today = date('Y-m-d');


                    if(isset($_GET['popular'])){

                        $posts = $db->query("SELECT * FROM posts WHERE DATE(date) <= '$today' AND status = '1' ORDER BY impression DESC ");

                    }elseif(isset($_GET['trending'])){
                        $posts = $db->query("SELECT * FROM posts WHERE DATE(date) <= '$today' AND status = '1' ORDER BY views DESC ");

                    }elseif(isset($_POST['search'])){
                        $key_search = $_POST['search'];
                       //%$key_search%  iska mtlb jo b humna search kiya uska agay pichy kuch b ha pr ussa laao
                        $posts = $db->query("SELECT * FROM posts WHERE DATE(date) <= '$today' 
                        AND (title LIKE '%$key_search%'
                        OR tags LIKE '%$key_search%'
                         OR location LIKE '%$key_search%') ");
                    }else{
                        $posts = $db->query("SELECT * FROM posts WHERE DATE(date) <= '$today' AND status = '1' ORDER BY id DESC ");
                    }


                   
                 
                
                    

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
            $real_owner      = $post['user_id'];
            $share_user_id   = $post['share_user_id'];
            $is_share        = $post['is_share'];

            // Fetch user details
            $user = $db->query("SELECT * FROM users WHERE id = '$post_user_id' ");
            $user = $user->fetch_assoc();
            $user_name = $user['username'];
            $user_image = $user['image'];

            // Update impressions
            $impressions = $post_impression + 1;
            $update_impressions = $db->query("UPDATE posts SET impression = '$impressions' WHERE id = '$post_id' ");

            // Initialize $shared_from
            $shared_from = '';

            // Check if it's a shared post
            if($is_share == 'yes'){
                $share_user = $db->query("SELECT * FROM users WHERE id = '$share_user_id' ");
                $share_user = $share_user->fetch_assoc();
                $share_user_name = $share_user['username'];
                $share_user_image = $share_user['image'];
                $shared_from = "<span class='me-3'><img src='img/$share_user_image' class='rounded-circle' style='width: 40px; height: 40px; object-fit: cover;'> <b class='me-3'>$share_user_name</b> shared this from </span>";
            }
            ?>

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="post p-3  border-3  border border-dark rounded-5 mb-5 shadow bg-danger-subtle">
                        <?php if ($post_type == 'image'): ?>
                            <img src="img/<?php echo $post_file ?>" class="rounded-4    border-2  border border-dark shadow"    style="width: 500px; height: 400px;">
                        <?php elseif ($post_type == 'video'): ?>
                            <video class="rounded-5 w-100 border-5" style="width: 500px; height: 500px;object-fit: cover;" controls>
                                <source src="img/<?php echo $post_file ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php endif; ?>

                        <div class="user-details mt-3">
                            <?php echo $shared_from; ?>
                            <img src="img/<?php echo $user_image; ?>" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            <span class="fw-bold"><?php echo $user_name; ?> <?php if ($is_share == 'yes') { echo '(Owner of this post)'; } ?> </span> 
                        </div>

                        <p class="fw-semibold">Post Title: <?php echo $post_title ?></p>
                        <p class="fw-semibold">Post: <?php echo $post_post ?></p>

                        <span class="badge bg-light border border-dark border-1 text-dark p-2"><?php echo $post_tags ?></span>
                        <span class="badge bg-light border border-dark border-1 text-dark p-2"><?php echo $post_location ?></span>
                        <span class="badge bg-light border border-dark border-1 text-dark p-2"><?php echo $post_date ?></span>

                    </div>
                </div>

                <div class="col-lg-4 mt-5">
                    <div class="d-flex flex-column align-items-center">
                        <?php if (isset($_SESSION['id'])): ?>
                            <button class="btn btn-lg px-5 rounded-start-5 w-100 btn-info fw-semibold mt-5 border-2 mb-3 like-btn" data-post-id="<?php echo $post_id; ?>"> &#x1F44D; Like (<span id="like-count-<?php echo $post_id; ?>">
                                <?php 
                                $like_query = $db->query("SELECT COUNT(*) as like_count FROM likes WHERE post_id = '$post_id'");
                                $like_result = $like_query->fetch_assoc();
                                echo $like_result['like_count'];
                                ?>
                                </span>)</button>

                            <a href="view-post.php?post_id=<?php echo $post_id; ?>" class="btn btn-lg w-100 px-5 rounded-5 btn-dark fw-semibold border-2 mb-3"> &#x1F4AC; Comment</a>

                            <button class="btn btn-lg w-100 px-5 rounded-5 btn-warning border-2 share-btn" data-post-id="<?php echo $post_id; ?>" onclick="sharePost(this)"> <i class="fas fa-share-alt"></i> Share </button>

                        <?php else: ?>
                            <button class="btn btn-lg px-5 rounded--5 w-100 btn-info fw-semibold mt-5 border-2 mb-3" onclick="return alert('Please login first');"> &#x1F44D; Like (<span id="like-count-<?php echo $post_id; ?>">
                                <?php 
                                $like_query = $db->query("SELECT COUNT(*) as like_count FROM likes WHERE post_id = '$post_id'");
                                $like_result = $like_query->fetch_assoc();
                                echo $like_result['like_count'];
                                ?>
                                </span>)</button>

                            <a href="view-post.php?post_id=<?php echo $post_id; ?>" class="btn btn-lg w-100 px-5 rounded btn-dark border-2 fw-semibold mb-3"> &#x1F4AC; Comment</a>

                            <a onclick="return alert('Please login first');" class="btn btn-lg w-100 px-5 rounded-5 btn-warning fw-semibold border-2"> <i class="fas fa-share-alt"></i> Share</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php } // End of while loop ?>
    </div>

    <?php 
    include_once('footer.php'); 
    ?>

    <script>
        $(document).ready(function(){// fumction of jquery we can used when doucment is fully load after we we run it 
            $('.like-btn').click(function(){
                var post_id = $(this).data('post-id');
                $.ajax({  
                    url: 'like_post.php',
                    type: 'post',
                    data: {post_id: post_id},
                    success: function(data){
                        if(data == 'liked'){
                            $('#like-count-' + post_id).text(parseInt($('#like-count-' + post_id).text()) + 1);
                        } else if(data == 'unliked'){
                            $('#like-count-' + post_id).text(parseInt($('#like-count-' + post_id).text()) - 1);
                        }
                    }
                });
            });
        });

        function sharePost(button) {
            var postId = button.getAttribute('data-post-id');
            button.disabled = true; // Disable the button to prevent multiple clicks
            
            $.ajax({
                url: 'share-post.php',
                type: 'POST',
                data: {post_id: postId},
                success: function(response) {
                    alert('Post shared successfully!');
                    button.disabled = false; // Re-enable the button after successful share
                },
                error: function() {
                    alert('Error sharing post.');
                    button.disabled = false; // Re-enable the button if there was an error
                }
            });
        }
    </script>
</body>
</html>
