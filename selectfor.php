
<?php 
// Include necessary files and initialize database connection
include_once('header.php');

include_once('db.php');



if(isset($_GET['mood'])){
    $mood = $_GET['mood'];
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
        $sql = $db->query("SELECT * FROM reels WHERE mood = '$mood' AND video NOT IN (SELECT video_id FROM watched_videos WHERE user_id = '$user_id')");
    } else {
        $sql = $db->query("SELECT * FROM reels WHERE mood = '$mood'");
    }
    if($sql->num_rows){
        while($row = $sql->fetch_assoc()){
            $title = $row['title'];
            $description = $row['description'];
            $video = $row['video'];
            $user_id = $row['user_id'];
            $sql1 = $db->query("SELECT * FROM users WHERE id = '$user_id'");
            $row1 = $sql1->fetch_assoc();
            $username = $row1['username'];
            $profile = $row1['image'];
            // Check if the user watched this video
            $watched = false;
            if(isset($_SESSION['user_id'])){ // Assuming you're using sessions
                $user_id = $_SESSION['user_id'];
                $watched_sql = $db->query("SELECT * FROM watched_videos WHERE user_id = '$user_id' AND video_id = '$video'");
                if($watched_sql->num_rows){
                    $watched = true;
                }
            }
            ?>
                                
                                <div class="container">
    <div style="display: flex; justify-content: flex-end; gap: 20px;">


        <a href="for-you.php" class="btn btn-warning btn-xl mt-3 mb-5 fs-5 fw-semibold">Go back</a>
    </div>
</div>
<body style="background-image:url('img/op.jpeg'); background-position: center; background-repeat: no-repeat; background-size: cover;">


                                    <div class="row mb-4">
                                    <div class="card-header"  style="margin-left: 350px; ">
            <h2  class="text-white">For-You Vedio</h2>
        </div>
                <div class="col-md-6">
                    <!-- Left container for video -->
                    <div class="card border-5  h-20 w-50" style="margin-left: 300px;">

                        <video src="videos/<?php echo $video; ?>" class="card-img-top  h-50 w-150 " controls></video>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Right container for user details, title, and description -->
                    <div class="card border-5    bg-warning-subtle mx-5  mt-5">
                        <div class="card-body">
                            <!-- User profile information -->
                            <div class="d-flex align-items-center mb-3">
                                <img src="img/<?php echo $profile; ?>" class="rounded-circle me-3" width="70" height="70">
                                <div>
                                    
                                </div>
                            </div>
                            <h5 class="mb-1">Username:  <?php echo $username; ?></h5>
                                    <h5 class="mb-0">Mood:  <?php echo $mood; ?></h5>
                            <!-- Video title -->
                            <h5 class="card-title">Tittle:  <?php echo $title; ?></h5>
                            
                            <!-- Video description -->
                            <h5 class="card-text">Description:  <?php echo $description; ?></h5>
                              
                            <?php if(!$watched): ?>
                                                    <!-- Change the button to a clickable element -->
                                                    <button class="btn btn-primary mt-3 mark-as-watched" data-video="<?php echo $video; ?>">Mark as Watched</button>
                                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        // No reels found message
?>
        <div class="alert alert-info" role="alert">
            No reels found.
        </div>
<?php
    }
} else {
    // If no mood is selected, redirect to main page or show a message
    header("Location: for-you.php");
    exit();
}
?>





<!-- jQuery library (make sure it's included in your HTML) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>





<script>
    // Ajax request to mark video as watched
    $('.mark-as-watched').click(function() {
        var button = $(this); // it can refer to the crrent element click 
        var videoId = button.data('video');
        $.ajax({
            type: 'POST',
            url: 'watched.php',
            data: { video_id: videoId },
            success: function(response) {
                // Update UI or show a message if needed
                console.log(response);        //error debuging 
                if(response === 'success') {
                    // Show a tick icon 
                    button.html('<i class="fas fa-check"></i> Marked');// it can reterive the html content 
                }
            }
        });
    });
</script>
