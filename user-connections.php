<?php 
include_once('header.php');
include_once('db.php');

// Redirect user if $user_id is not set
if(!isset($user_id)){
    header('location: logout.php');
    exit; // Stop further execution
}

// Determine navigation based on user role
if($user_role == 'admin'){
    include_once('nav-admin.php');
} else {
    include_once('nav-user.php');
}

?>


<body style="background-image: url('img/jo.webp'); background-position: center  background-repeat: no-repeat; background-size: cover;">
<h1 class="card-title text-center mb-3 mt-5" style="text-align: center;">Information of Connected User</h1>

<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-8">
        <?php 
                            
      $sql = $db->query("SELECT * FROM connections WHERE user_id = '$user_id' OR connection_id = '$user_id'");
if($sql->num_rows){
    $i = 0;
    while($row = $sql->fetch_assoc()) {
        $i++;
        $id = $row['id'];
        $connection_user_id = ($row['user_id'] == $user_id) ? $row['connection_id'] : $row['user_id'];
        $status = $row['status'];

        $sql1 = $db->query("SELECT * FROM users WHERE id = '$connection_user_id'");
        $row1 = $sql1->fetch_assoc();

        $name = $row1['username'];
        $image = $row1['image'];
        $email = $row1['email'];
       

        ?>

                    <div class="card mb-4">
                        <div class="card-body  bg-info-subtle border-5  border border-danger-subtle">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                         
                                    <img src="img/<?php echo $image;?>" class="rounded-circle" width="150" height="150" style="object-fit: cover;" alt="User Profile Image">
                                </div>
                                <div class="col-md-9">
                          
                                    <div class="mb-3">
                                        <p class="fw-semibold mb-1">User Name:</p>
                                        <p class="text-black"><?php echo $name; ?></p>
                                    </div>
                                    <div class="mb-3">
                                        <p class="fw-semibold mb-1">Email:</p>
                                        <p class="text-black"><?php echo $email; ?></p>
                                    </div>
                                    
                                    <a href="?delete=<?php echo $id; ?>" class="btn btn-sm btn-danger  fw-semibold float-right">Disconnect / Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else {
                ?>
                <div class="card">
                    <div class="card-body text-center">
                        <p class="text-muted">No Connections Found</p>
                    </div>
                </div>
                <?php
            }
            ?>


<?php 
                    
                    if(isset($_GET['delete'])){
                        $delete_id = $_GET['delete'];
                        $db->query("DELETE FROM connections WHERE id = '$delete_id'");
                        header('location: user-connections.php');
                    }
                    
                    ?>

        </div>
    </div>

</div>

<?php 
include_once('footer.php');
?>
