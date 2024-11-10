


<?php 
// Include necessary files and initialize database connection
include_once('header.php');

include_once('db.php');
?>

<div class="container">
    <div class="row mt-5">
    <body class="bg-secondary-subtle">
    <div class="container">
    <div style="display: flex; justify-content: flex-end; gap: 20px;">


        <a href="stories.php" class="btn btn-success fw-bold  btn-xl mt-3 mb-5 fs-5 fw-semibold">Go back</a>
    </div>
</div>
        
    <?php 

$login_id = $_SESSION['id'];

if(isset($_GET['share'])){


    $story_share_id = $_GET['share'];
    $sql = $db->query("SELECT * FROM stories WHERE id = '$story_share_id'");
   if($sql->num_rows){
    $row_1 = $sql->fetch_assoc();
    $title_1 = $row_1['title'];
    $video_1 = $row_1['video'];

    $sql1 = $db->query("INSERT INTO stories (user_id, title, video) VALUES ('$login_id', '$title_1', '$video_1')");
    if($sql1){
        echo "<script>alert('Story has been Shared')</script>";
        header('refresh: 0 storiesview.php');
    }else{
        echo "<script>alert('ERROR')</script>";
        header('refresh: 0 storiesview.php');
    }
   }

}

?>


<?php 
                    
                    if(isset($_POST['upload'])){


                        $video = $_FILES['video']['name'];
                        $tmp = $_FILES['video']['tmp_name'];

                        $title = $_POST['title'];

                        // check video size and if size is bigger then 2mb then show message else insert
                        $size = $_FILES['video']['size'];
                        if($size > 30097152){
                            echo "<div class='alert alert-danger'>Video size is too large</div>";
                        }else{

                            $ext = pathinfo($video, PATHINFO_EXTENSION);
                            $video = time().rand(1000, 9999).".".$ext;

                            move_uploaded_file($tmp, "videos/".$video);




                            $sql = $db->query("INSERT INTO stories (user_id, title, video) VALUES ('$login_id', '$title', '$video')");

                            if($sql){
                                echo "<h2 class='alert alert-datext-center text-black  mt-2'> Uploaded Stories</h2>";
                            }else{
                                echo "<div class='alert alert-danger'>Story Not Uploaded</div>";
                            }

                        }


                        
                    }
                    
                    ?>


                    <h1  class="card-title  my-3   fw-bold display-5 text-center">My Stories</h1>



                        <?php 
                        
                        $sql = $db->query("SELECT * FROM stories WHERE user_id = '$login_id'");
                        if($sql->num_rows){
                            while($row = $sql->fetch_assoc()){

                                $id        = $row['id'];
                                $title     = $row['title'];
                                $video     = $row['video'];
                                $member_id = $row['user_id'];

                                $sql1 = $db->query("SELECT * FROM users WHERE id = '$member_id'");
                                $row1 = $sql1->fetch_assoc();

                                $user_name = $row1['username'];
                                $user_image = $row1['image'];
                                

                                ?>
                              <div class="card  bg-black mb-4"  style="margin-left: 20px;">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            
            <img src="img/<?php echo $user_image; ?>" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;" alt="User Image">
            <span class="fw-bold   text-white"> <?php echo $user_name; ?></span>
        </div>
        <div class="mb-3">
            <video src="videos/<?php echo $video; ?>" controls style="width:75"   class="mb-3"></video>
        </div>
        <h5 class="card-title fw-bold text-white  mb-3">Tittle:  <?php echo $title; ?></h5>
        <div>
            <a href="storiesview.php?share=<?php echo $id; ?>" class="btn bg-warning fw-bold text-white border w-100 rounded-5">Share Story</a>
        </div>
    </div>
</div>

                                <?php
                            }
                        }else{
                            ?>
                            <div class="card  border-dark  border-1   bg-success-subtle rounded  mb-3">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold  border-dark  border-1 my-3">No Stories</h5>
                                </div>
                            </div>
                            <?php


                        }

                        
                        
                        ?>
   


   <h4 class="card-title b fw-bold  my-3">Stories of My Connections</h4>

   <?php 
   

    $sql = $db->query("SELECT * FROM connections WHERE (user_id = '$login_id' OR connection_id = '$login_id') AND status = 'approve'");

    if($sql->num_rows){
        while($row = $sql->fetch_assoc()){

            $connection_id = $row['connection_id'];
            $user_id = $row['user_id'];

            if($connection_id == $login_id){
                $sql1 = $db->query("SELECT * FROM stories WHERE user_id = '$user_id'");
            }else{
                $sql1 = $db->query("SELECT * FROM stories WHERE user_id = '$connection_id'");
            }

            while($row1 = $sql1->fetch_assoc()){

                $id = $row1['id'];
                $title = $row1['title'];
                $video = $row1['video'];
                $member_id = $row1['user_id'];

                $sql2 = $db->query("SELECT * FROM users WHERE id = '$member_id'");
                $row2 = $sql2->fetch_assoc();

                $user_name = $row2['username'];
                $user_image = $row2['image'];

                ?>
                <div class="card  rounded bg-black mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <img src="img/<?php echo $user_image; ?>" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                    <span class="fw-bold   text-white"><?php echo $user_name; ?></span>
                                </div>
                                <video src="videos/<?php echo $video; ?>" controls width="100%"></video>
                                <h5 class="card-title text-bold text-white  my-3">Tittle:  <?php echo $title; ?></h5>

                                <div>
                                    <a href="storiesview.php?share=<?php echo $id; ?>" class="btn bg-warning fw-bold border w-100 rounded-5">Share Story</a>
                                </div>

                            </div>
                        </div>
                <?php

            }

        }
    }else{
        ?>
        <div class="card  border-dark  border-1   bg-success-subtle  rounded  mb-3">
            <div class="card-body">
                <h5 class="card-title  fw-bold my-3">No Connection</h5>
            </div>
        </div>
        <?php
    }



   
   
   ?>



                    
                    


                </div>
            </div>

        </div>
        
    </div>
</div>


