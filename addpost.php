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


if(!isset($user_id)){
    header('location: logout.php');
    exit;
}
?>
<body class="bg-secondary-subtle">
<section class="vh-100  mt-5">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-md-9 col-lg-6 col-xl-5">
        <a href="logout.php">
  <img src="img/kop.jpg" class="img-fluid w-100   border border-black border border-2" alt="Sample image" style="height: 300px; object-fit: cover;">
</a>

</div>

      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="text" name="title" class="form-control   fw-semibold  bg-light border-2 rounded p-3" placeholder="Title">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="file" class="form-control   fw-semibold bg-light border-2 rounded p-3" accept=".jpg, .png, .jpeg, .gif, .mp4, .avi, .mov">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control  fw-semibold  bg-light border-2 rounded p-3" name="post" id="post" rows="5" placeholder="Type Something"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="tags" class="form-control   fw-semibold   bg-light border-2 rounded p-3" placeholder="Tags">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="location" class="form-control    fw-semibold bg-light border-2 rounded p-3" placeholder="Location">
                    </div>
                    <div class="mb-3">
                        <input type="date" name="date" class="form-control fw-semibold bg-light border-2 rounded p-3" placeholder="Date" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="d-flex justify-content-center mb-0">
    <button type="submit" name="create_post" class="btn btn-primary btn-lg fw-semibold text-black border px-5">Create Post</button>
</div>

                </form>
              </div>
            </div>
          </div>
        
     
   

</section>
<?php
// Include necessary files and establish user authentication

// Check if the form is submitted
if(isset($_POST['create_post'])){
    // Collect form data
    $title = $_POST['title'];
    $file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    // Determine the type of file (image or video)
    if(in_array($fileType, ['jpg', 'png', 'jpeg', 'gif'])){
        $type = 'image';
    } elseif(in_array($fileType, ['mp4', 'avi', 'mov'])){
        $type = 'video';
    } else {
        $type = 'unknown';
    }

    // Other form data
    $post = $_POST['post'];
    $tags = $_POST['tags'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    

    // SQL query to insert the post into the database
    $create_post = $db->query("INSERT INTO posts (title, file, post, tags, date, user_id, type, impression, views, location) 
                               VALUES ('$title', '$file', '$post', '$tags', '$date', '$user_id', '$type', '0', '0', '$location')");

    // Check if the post was successfully inserted
    if($create_post){
        // Move uploaded file to desired directory
        move_uploaded_file($temp, 'img/' . $file);

        // Display success message and redirect after 1 second
        echo "<p class='alert alert-success rounded-5 p-3 mt-3 mb-0'>Post Created Successfully</p>";
        header('refresh: 1; index.php');
        exit; // Exit to prevent further execution
    }
}
?>

