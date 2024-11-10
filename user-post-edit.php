<?php include_once('header.php'); ?>
<?php 

if($user_role == 'admin'){
    include_once('nav-admin.php');
}else{
    include_once('nav-user.php');
}

?>
<?php 

if(!isset($user_id)){
    header('location: logout.php');
}


$edit_id = $_GET['edit_id'];


$select = $db->query("SELECT * FROM posts WHERE id = '$edit_id'");
if(!$select->num_rows){
    header('location: user-posts.php');
}
$fetch = $select->fetch_assoc();


$title    = $fetch['title'];
$old_file     = $fetch['file'];
$old_fileType = strtolower(pathinfo($old_file, PATHINFO_EXTENSION));
if(in_array($old_fileType, ['jpg', 'png', 'jpeg', 'gif'])){
    $type = 'image';
} elseif(in_array($old_fileType, ['mp4', 'avi', 'mov'])){
    $type = 'video';
} else {
    $type = 'unknown';
}
$post     = $fetch['post'];
$tags     = $fetch['tags'];
$date     = $fetch['date'];
$location = $fetch['location'];




?>
<body style="background-image: url('img/bj.webp'); background-position: center; background-repeat: no-repeat; background-size: cover;">

<div class="container">


<h1 class="text-center mt-5 text-center fw-semibold mb-5">Update Your Post</h1>


    <div class="row">
   
        <div class="col-lg-4">
                    <div class="post p-3 border-3 rounded-5 mb-5 shadow ">
                            <?php if($type == 'image'): ?>
                                <img src="img/<?php echo $old_file ?>" class="rounded-top-5 w-100" style="object-fit:cover;">
                            <?php elseif($type == 'video'): ?>
                                <video class="rounded-top-5 w-100" style="object-fit:cover;" controls>
                                    <source src="img/<?php echo $old_file ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                            <h5 class="fw-bold mt-3"><?php echo $title ?></h5>
                            <p><?php echo $post ?></p>
                            <div>

                              

                            <span class="badge bg-dark text-white fw-semibold  border text-dark p-2"><?php echo $tags ?></span>
                            <span class="badge bg-dark text-white fw-semibold  border text-dark p-2"><?php echo $location ?></span>
                            <span class="badge bg-dark text-white fw-semibold  border text-dark p-2"><?php echo $date ?></span>

                            </div>
                        </div>
        </div>

        <div class="col-lg-8">
            
            <div class="card  border-dark border-2  bg-success-subtle shadow">
                <div class="card-body">
                    <h5 class="card-title text-center  mb-3">Edit Post Details</h5>

                    <form action="" method="post" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <input type="text" name="title" value="<?php echo $title ?>" class="form-control bg-light  border-dark border-1 rounded p-3" placeholder="Title">
                            </div>
                            <div class="mb-3">
                                <input type="file" name="file" class="form-control bg-light  border-dark border-1 rounded p-3" accept=".jpg, .png, .jpeg, .gif, .mp4, .avi, .mov">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control bg-light  border-dark border-1 rounded p-3" name="post" id="post" rows="5" placeholder="Type Something"><?php echo $post ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="tags" value="<?php echo $tags ?>" class="form-control bg-light  border-dark border-1 rounded p-3" placeholder="Tags">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="location" value="<?php echo $location ?>" class="form-control bg-light  border-dark border-1 rounded p-3" placeholder="Location">
                            </div>
                            <div class="mb-3">
                                <input type="date" name="date" value="<?php echo $date ?>" class="form-control bg-light  border-dark border-1 rounded p-3" placeholder="Date" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="mb-0 text-center">
    <button type="submit" name="update_post" class="btn btn-info fw-semibold border px-5">Update Post</button>
</div>

                        </form>
                        <?php 
                        
                        if(isset($_POST['update_post'])){

                            $title    = $_POST['title'];
                            $file     = $_FILES['file']['name'];
                            $temp     = $_FILES['file']['tmp_name'];
                            $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            if(in_array($fileType, ['jpg', 'png', 'jpeg', 'gif'])){
                                $type = 'image';
                            } elseif(in_array($fileType, ['mp4', 'avi', 'mov'])){
                                $type = 'video';
                            } else {
                                $type = 'unknown';
                            }
                            $post     = $_POST['post'];
                            $tags     = $_POST['tags'];
                            $date     = $_POST['date'];
                            $location = $_POST['location'];

                            if(empty($file)){
                                $file = $old_file;
                            } else {
                                move_uploaded_file($temp, 'img/'.$file);
                            }

                            $update = $db->query("UPDATE posts SET title = '$title', file = '$file', post = '$post', tags = '$tags', date = '$date', location = '$location' WHERE id = '$edit_id'");

                            if($update){
                                echo '<div class="alert alert-success mb-0 mt-3">Post Updated</div>';
                                header("refresh:1;url=user-post-edit.php?edit_id=$edit_id");
                            } else {
                                echo '<div class="alert alert-danger mb-0 mt-3">Failed to Update Post</div>';
                            }
                            
                           
                            

                        }
                        
                        
                        ?>


                </div>
            </div>
        </div>
    </div>
</div>







<?php include_once('footer.php'); ?>