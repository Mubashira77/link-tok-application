<?php
// Include necessary files and initialize database connection
include_once('header.php');
include_once('nav.php');
include_once('db.php');

// Check if form is submitted
if(isset($_POST['add-reel'])){
    // Retrieve form data
    $mood = $_POST['mood'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Process uploaded video file
    $video = $_FILES['video']['name'];
    $video_tmp = $_FILES['video']['tmp_name'];
    
    // Validate video file extension
    $video_ext = pathinfo($video, PATHINFO_EXTENSION);
    $allowed = array('mp4', 'mkv', 'avi', 'mov', 'flv', 'wmv', 'webm');
    
    if(in_array($video_ext, $allowed)){
        $video_name = uniqid() . '.' . $video_ext;
        move_uploaded_file($video_tmp, 'videos/' . $video_name);
        
        // Insert data into database
        $sql = $db->query("INSERT INTO reels (user_id, mood, title, description, video) VALUES ('$user_id', '$mood', '$title', '$description', '$video_name')");
        if($sql){
            echo "<script>alert('Reel has been added')</script>";
            header('Location: for-you.php'); // Redirect to the main page after successful insertion
            exit();
        } else {
            echo "<script>alert('ERROR')</script>";
        }
    } else {
        echo "<script>alert('Invalid Video Format')</script>";
    }
}
?>
<body style="background-image: url('img/kl.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;">
<div class="container mt-5">
    <div class="row">
        <!-- Image -->
        <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="img/mo.png"
          class="img-fluid    border-4 border border-dark" alt="Phone image">
      </div>
        <!-- Form -->
        <div class="col-md-6">
            <h2 class="mb-4  text-white fw-semibold">Add Reel for For You Page</h2>
            <form method="post" enctype="multipart/form-data">
                <!-- Mood select -->
                <div class="form-floating mb-3">
                    <select name="mood" class="form-select   border-1  border border-dark" id="floatingSelect">
                        <option value="" disabled selected>Video with the Mood of</option>
                        <option value="Happy">Happy</option>
                        <option value="Sad">Sad</option>
                        <option value="Angry">Angry</option>
                        <option value="Excited">Excited</option>
                        <option value="Bored">Bored</option>
                    </select>
                    <label for="floatingInput">Video with the Mood of</label>
                </div>
                <!-- Video file input -->
                <div class="form-floating mb-3">
                    <input type="file" name="video" class="form-control   border-1  border border-dark" id="floatingInput" placeholder="Video">
                    <label for="floatingInput">Video</label>
                </div>
                <!-- Title input -->
                <div class="form-floating mb-3">
                    <input type="text" name="title" class="form-control    border-1  border border-dark" id="floatingInput" placeholder="Title">
                    <label for="floatingInput">Title</label>
                </div>
                <!-- Description input -->
                <div class="form-floating mb-3">
                    <input type="text" name="description" class="form-control   border-1  border border-dark" id="floatingInput" placeholder="Description">
                    <label for="floatingInput">Description</label>
                </div>
                <!-- Submit button -->
                <button type="submit" name="add-reel" class="btn btn-info px-5 rounded-5  fw-semibold r">Add Reel</button>
            </form>
        </div>
    </div>
</div>


<?php include_once('footer.php'); ?>
