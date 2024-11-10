<?php include_once('header.php'); ?>
<?php 
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
include_once('db.php');




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
<body style="background-image: url('img/kin.webp'); background-position: center; background-repeat: no-repeat; background-size: cover;">
<div class="container">
    <div class="row">
       
        <!-- Content column -->
        <div class="col-lg-8">
        <h1 class=" text-white fw-bold mb-5   text-center  mt-5">Register User Requests</h1>

            <div class="card border-0 shadow-lg">
            <div class="card-body border border-dark border-3   bg-danger-subtle">

              

                    <?php 
                    
                    if(isset($_GET['approve'])){
                        $approve_id = $_GET['approve'];
                        $approve_query = "UPDATE users SET status = 'active' WHERE id = '$approve_id' ";
                        $approve_result = $db->query($approve_query);
                        if($approve_result){
                            echo "<div class='alert alert-success'>User has been Activated</div>";
                            header('refresh: 1 requests.php');
                        }else{
                            echo "<div class='alert alert-danger'>User has not been Activated</div>";
                            header('refresh: 1 requests.php');
                        }
                    }

                    if(isset($_GET['delete'])){
                        $delete_id = $_GET['delete'];
                        $delete_query = "DELETE FROM users WHERE id = '$delete_id' ";
                        $delete_result = $db->query($delete_query);
                        if($delete_result){
                            echo "<div class='alert alert-success'>User has been deleted</div>";
                            header('refresh: 1 requests.php');
                        }else{
                            echo "<div class='alert alert-danger'>User has not been deleted</div>";
                            header('refresh: 1  requests.php');
                        }
                    }
                    
                    ?>

                    <table class="table table-bordered  border-dark">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Password</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            $requests = $db->query("SELECT * FROM users WHERE role = 'user' AND status = 'pending' ");
                            if($requests->num_rows > 0){
                                while($request = $requests->fetch_assoc()){
                                    $id = $request['id'];
                                    $username = $request['username'];
                                    $email    = $request['email'];
                                    $number   = $request['number'];
                                    $password = $request['password'];
                                    $status   = $request['status'];
                                    
                                    echo "<tr>";
                                    echo "<td>$username</td>";
                                    echo "<td>$email</td>";
                                    echo "<td>$number</td>";
                                    echo "<td>$password</td>";
                                    echo "<td>$status</td>";
                                    echo "<td><a href='requests.php?approve=$id' class='btn btn-warning btn-sm'>Approve</a> <a href='requests.php?delete=$id' class='btn btn-dark btn-sm'>Reject</a></td>";
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td colspan='6'>No requests found</td></tr>";
                            }
                            
                            ?>
                        </tbody>
                    </table>          

                </div>
            </div>
        </div>
    </div>
</div>







<?php include_once('footer.php'); ?>