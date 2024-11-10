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


$data = $db->query("SELECT * FROM users WHERE id = '$user_id' ");
$user = $data->fetch_assoc();

if($data->num_rows == 0){
    header('location: logout.php');
}else{

    $username = $user['username'];
    $email    = $user['email'];
    $number   = $user['number'];
    $password = $user['password'];
    


}




?>

<body style="background-image: url('img/kjs.jpeg'); background-position: center; background-repeat: no-repeat; background-size: cover;">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center mt-5 fw-bold display-5  mb-5">Manage  All Content</h1>
            <div class="card  border-dark bg-warning-subtle border-2 shadow-lg">
                <div class="card-body">

                <?php
                

                if(isset($_GET['deactive'])){
                    $deactive_id = $_GET['deactive'];
                    $deactive_query = "UPDATE posts SET status = '0' WHERE id = '$deactive_id' ";
                    $deactive_result = $db->query($deactive_query);
                    if($deactive_result){
                        echo "<div class='alert alert-success'>Post has been de-activated</div>";
                        header('refresh: 1  content.php');
                    }else{
                        echo "<div class='alert alert-danger'>Post has not been de-activated</div>";
                        header('refresh: 1  content.php');
                    }
                }

                if(isset($_GET['active'])){
                    $active_id = $_GET['active'];
                    $active_query = "UPDATE posts SET status = '1' WHERE id = '$active_id' ";
                    $active_result = $db->query($active_query);
                    if($active_result){
                        echo "<div class='alert alert-success'>Post has been activated</div>";
                        header('refresh: 1  content.php');
                    }else{
                        echo "<div class='alert alert-danger'>Post has not been activated</div>";
                        header('refresh: 1  content.php');
                    }
                }
                
                
                ?>




                <table class="table   table-bordered border-dark  table-warning  mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Title</th>
                                <th>Post</th>
                                <th>Tag</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            

                            $select = $db->query("SELECT * FROM posts");
                            $i = 1;
                            if($select->num_rows){
                                while($row = $select->fetch_assoc()){

                                    $i++;
                                    $title    = $row['title'];
                                    $file     = $row['file'];
                                    $post     = $row['post'];
                                    $tag      = $row['tags'];
                                    $location = $row['location'];
                                    $status = $row['status'];
                                    $person_id = $row['user_id'];
                                    $get_person_details = $db->query("SELECT * FROM users WHERE id = '$person_id' ");
                                    if($get_person_details->num_rows){
                                        $data_a = $get_person_details->fetch_assoc();
                                        $person_name = $data_a['username'];
                                    }else{
                                        $person_name = 'REMOVED';
                                    }
                                    $post_id  = $row['id'];


                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $person_name; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $post; ?></td>
                                        <td><?php echo $tag; ?></td>
                                        <td><?php echo $location; ?></td>
                                        <td><?php echo $status == 0 ? 'Not Active' : 'Active'; ?></td>
                                        <td>
                                            <?php if($status == '0'): ?>
                                                <a href='content.php?active=<?php echo $post_id; ?>' class='btn btn-success btn-sm'>Activate</a>
                                            <?php else: ?>
                                                <a href='content.php?deactive=<?php echo $post_id; ?>' class='btn btn-info btn-sm'>De-Activate</a>
                                            <?php endif; ?>
                                            <a href="user-post-edit.php?edit_id=<?php echo $post_id; ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="content.php?remove=<?php echo $post_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>

                                    <?php


                                }
                            }
                            
                            
                            ?>
                        </tbody>
                    </table>
                    <?php 
                    
                    if(isset($_GET['remove'])){
                        $remove_id = $_GET['remove'];
                        $delete = $db->query("DELETE FROM posts WHERE id = '$remove_id' ");
                        if($delete){
                            header('location:content.php');
                        }
                    }
                    
                    ?>                  

                </div>
            </div>
        </div>
    </div>
</div>







<?php include_once('footer.php'); ?>