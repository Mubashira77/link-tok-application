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

    $image = $user['image'];
    $username = $user['username'];
    $email    = $user['email'];
    $number   = $user['number'];
    $password = $user['password'];


}




?>

?>
<body style="background-image: url('img/kj.jpeg'); background-position: center;">
    <!-- Your content here -->
</body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2>Profile Information</h2>
        </div>
        <div class="card-body text-center">
            <div class="profile">
                <img src="img/<?php echo $image ?>" class="rounded-circle" width="150" alt="Profile Picture">
            </div>
            <div class="profile-info mt-3">
                <h3 class="fw-bold"><?php echo $username; ?></h3>
                <p class="fw-bold">Email: <?php echo $email; ?></p>
                <p class="fw-bold">Phone Number: <?php echo $number; ?></p>
            </div>
        </div>
    </div>
</div>









<?php include_once('footer.php'); ?>