<?php
include_once('header.php');

// Check if the user is an admin
if ($user_role == 'admin') {
    include_once('nav-admin.php');
} else {
    include_once('nav-user.php');
}

// Redirect to logout if user_id is not set
if (!isset($user_id)) {
    header('location: logout.php');
    exit();
}

// Database connection
include_once('db.php'); // Ensure this script properly sets up the $db connection
?>

<body style="background-image:url('img/oii.webp'); background-position: center; background-repeat: no-repeat; background-size: cover;">

<div class="container">
    <div style="display: flex; justify-content: flex-end;">
        <a href="addpost.php" class="btn btn-warning btn-xl mt-3 mb-5 fs-5 fw-semibold">Add Post</a>
    </div>

    <div class="row">
        <?php 
        $select = $db->query("SELECT * FROM posts WHERE user_id = '$user_id'");
        if ($select->num_rows > 0) {
            while ($row = $select->fetch_assoc()) {
                $title    = htmlspecialchars($row['title']);
                $file     = htmlspecialchars($row['file']);
                $post     = htmlspecialchars($row['post']);
                $tag      = htmlspecialchars($row['tags']);
                $location = htmlspecialchars($row['location']);
                $post_id  = $row['id'];
                ?>

                <div class="col-lg-4 mb-4">
                    <div class="card border-3 border-dark shadow">
                        <?php
                        $file_ext = pathinfo($file, PATHINFO_EXTENSION);
                        if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo "<img src='img/{$file}' class='card-img-top' style='height: 250px; width: 350px;' alt='Post Image'>";
                        } elseif (in_array($file_ext, ['mp4', 'webm', 'ogg'])) {
                            echo "<video class='card-img-top' style='height: 250px; width: 350px;' controls>
                                    <source src='img/{$file}' type='video/{$file_ext}'>
                                    Your browser does not support the video tag.
                                  </video>";
                        } else {
                            echo "<div class='card-img-top'>Unsupported file type.</div>";
                        }
                        ?>
                        <div class="card-body">
                            <h6 class="card-title">Tittle:  <?php echo $title; ?></h6>
                            <h6 class="card-text">Post: <?php echo $post; ?></h6>
                            <h6 class="card-text"><small class="text-black">Tag: <?php echo $tag; ?></small></h6>
                            <h6 class="card-text"><small class="text-black">Location: <?php echo $location; ?></small></p>
                            <a href="user-post-edit.php?edit_id=<?php echo $post_id; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="user-posts.php?remove=<?php echo $post_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>

                <?php 
                    
                    if(isset($_GET['remove'])){
                        $remove_id = $_GET['remove'];
                        $delete = $db->query("DELETE FROM posts WHERE id = '$remove_id' ");
                        if($delete){
                            header('location: user-posts.php');
                        }
                    }
                    
                    ?>   

                <?php
            }
        } else {
            echo "<p>No posts found.</p>";
        }
        ?>
    </div>
</div>

<?php include_once('footer.php'); ?>

</body>
</html>
