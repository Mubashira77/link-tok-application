<?php 

include_once('db.php');


  $post_id = $_POST['post_id'];
  
  $sql = $db->query("SELECT * FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'");
  if($sql->num_rows > 0){
    $sql_1 = $db->query("DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'");
    if($sql_1){
      echo "unliked";
    }else{
      echo "error";
    }
  }else{
    $sql_2 = $db->query("INSERT INTO likes (post_id, user_id) VALUES ('$post_id', '$user_id')");
    if($sql_2){
      echo "liked";
    }else{
      echo "error";
    }
  }




?>