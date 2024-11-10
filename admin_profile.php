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
 


}

?>
<body style="background-image: url('img/kj.jpeg'); background-position: center;">
    <!-- Your content here -->
</body>

    

<div class="container-fluid d-flex justify-content-center align-items-center mt-5">
    <div class="card">
        <div class="upper">
            <img src="https://i.imgur.com/Qtrsrk5.jpg" class="img-fluid"  width="600px">
        </div>
        <div class="user text-center" style="margin-top: 10px;">
    <div class="profile">
        <img src="img/<?php echo $image ?>" class="rounded-circle" width="150">
    </div>
</div>
<div class="profile-info text-center">
    <h3 class="fw-bold"><?php echo $username; ?></h3>
    <p class="fw-bold">Email: <?php echo $email; ?></p>
    <p class="fw-bold">Phone Number: <?php echo $number; ?></p>
</div>

        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>
