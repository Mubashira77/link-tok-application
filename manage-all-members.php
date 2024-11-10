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
<body style="background-image: url('img/lx.webp'); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <!-- Your content here -->
</body>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center mt-5  mb-5 display-5  fw-semibold">List of All Registered User</h1>
            <div class="card border-0 shadow-lg     bg-transparent">
            <div class="card-body   md-4">

                   

                    <?php 
                    if(isset($_GET['delete'])){
                        $delete_id = $_GET['delete'];
                        $delete_query = "DELETE FROM users WHERE id = '$delete_id' ";
                        $delete_result = $db->query($delete_query);
                        if($delete_result){
                            echo "<div class='alert alert-success'>User has been deleted</div>";
                            header('refresh: 1 manage-all-members.php');
                        }else{
                            echo "<div class='alert alert-danger'>User has not been deleted</div>";
                            header('refresh: 1 manage-all-members.php');
                        }
                    }

                    if(isset($_GET['deactive'])){
                        $deactive_id = $_GET['deactive'];
                        $deactive_query = "UPDATE users SET status = 'deactive' WHERE id = '$deactive_id' ";
                        $deactive_result = $db->query($deactive_query);
                        if($deactive_result){
                            echo "<div class='alert alert-success'>User has been de-activated</div>";
                            header('refresh: 1 manage-all-members.php');
                        }else{
                            echo "<div class='alert alert-danger'>User has not been de-activated</div>";
                            header('refresh: 1 manage-all-members.php');
                        }
                    }

                    if(isset($_GET['active'])){
                        $active_id = $_GET['active'];
                        $active_query = "UPDATE users SET status = 'active' WHERE id = '$active_id' ";
                        $active_result = $db->query($active_query);
                        if($active_result){
                            echo "<div class='alert alert-success'>User has been activated</div>";
                            header('refresh: 1 manage-all-members.php');
                        }else{
                            echo "<div class='alert alert-danger'>User has not been activated</div>";
                            header('refresh: 1 manage-all-members.php');
                        }
                    }
                    
                    ?>

                    <div class="row">
                        <?php 
                        $requests = $db->query("SELECT * FROM users WHERE role = 'user' AND status != 'pending' ");
                        if($requests->num_rows > 0){
                            while($request = $requests->fetch_assoc()){
                                $id = $request['id'];
                                $image = $request['image'];
                                $username = $request['username'];
                                $email    = $request['email'];
                                $number   = $request['number'];
                                $password = $request['password'];
                                $address = $request['address'];
                                $status   = $request['status'];
                            ?>

                            <div class="col-lg-4 mb-4 ">
                            <div class="card border-3 border-dark bg-danger-subtle">
                                    <img src="img/<?php echo $image; ?>" class="card-img-top"  style="height: 200px; width: 340px;" alt="User Image">
                                    <div class="card-body fw-semibold ">
                                        <p class="card-title">Name:  <?php echo $username; ?></p>
                                        <p class="card-text">Email:  <?php echo $email; ?></p>
                                        <p class="card-text"> Number:  <?php echo $number; ?></p>
                                        <p class="card-text">Password:  <?php echo $password; ?></p>
                                        <p class="card-text">Address:  <?php echo $address; ?></p>
                                        <p class="card-text ">Status:  <small><?php echo ucfirst($status); ?></small></p>
                                        <a href="manage-edit-members.php?edit=<?php echo $id; ?>" class="btn btn-warning btn-sm  fw-semibold">Edit</a>
                                        <a href="manage-all-members.php?delete=<?php echo $id; ?>" class="btn btn-dark btn-sm  fw-semibold">Delete</a>
                                        <?php if($status == 'deactive'): ?>
                                            <a href="manage-all-members.php?active=<?php echo $id; ?>" class="btn btn-success btn-sm  fw-semibold">Activate</a>
                                        <?php else: ?>
                                            <a href="manage-all-members.php?deactive=<?php echo $id; ?>" class="btn btn-danger btn-sm  fw-semibold">De-Activate</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                            }
                        }else{
                            echo "<div class='col-lg-12'><p>No requests found</p></div>";
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>
