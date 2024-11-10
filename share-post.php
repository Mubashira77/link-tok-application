<?php 

include_once('db.php');


$post_id = $_POST['post_id'];

if(isset($post_id)){
    $post_id = $_POST['post_id'];
    // get post data
        $posts           = $db->query("SELECT * FROM posts WHERE id = '$post_id'");
        $post            = $posts->fetch_assoc();
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
        $share_user_id   = $_SESSION['id'];


    // insert data
    $insert = $db->query("INSERT INTO posts (title, file, post, tags, date, user_id, type, impression, views, location, is_share, share_user_id) VALUES ('$post_title', '$post_file', '$post_post', '$post_tags', '$post_date', '$real_owner', '$post_type', '$post_impression', '$post_views', '$post_location', 'yes', '$share_user_id') ");

    if($insert){
        echo 'Post shared successfully!';
    }


}






?>