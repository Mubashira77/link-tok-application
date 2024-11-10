<?php
include_once('db.php');


if(!isset($_SESSION['id'])) {
    echo "Unauthorized access.";
    exit;
}




if(isset($_POST['video_id'])) {
    $user_id = $_SESSION['id'];
    $video_id = $_POST['video_id'];

    // Check if the user already watched this video
    $check_query = $db->query("SELECT * FROM watched_videos WHERE user_id = '$user_id' AND video_id = '$video_id'");
    if($check_query->num_rows == 0){ // User hasn't watched the video yet
        // Insert the watched video into the database
        $insert_query = $db->query("INSERT INTO watched_videos (user_id, video_id) VALUES ('$user_id', '$video_id')");
        if($insert_query){
            echo "success";
        }else{
            echo "Error marking video as watched.";
        }
    }else{
        echo "You've already watched this video.";
    }
} else {
    echo "Video ID not provided.";
}
?>
