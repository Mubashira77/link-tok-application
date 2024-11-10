

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



$data = $db->query("SELECT * FROM users WHERE id = '$user_id'");
$user = $data->fetch_assoc();

if ($data->num_rows == 0) {
    header('location: logout.php');
} else {
    $old_image = $user['image'];
    $username = $user['username'];
    $email = $user['email'];
    $address = $user['address']; 
    $number = $user['number'];
    $password = $user['password'];
 // Initialize the $address variable
}

?>

<body style="background-image: url('img/ko.jpeg'); background-position: center; background-repeat: no-repeat; background-size: cover;">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 rounded-5 bg-warning-subtle border border-dark border-4">
                <h2 class="text-center"><?php echo $username ?>'s Profile</h2>
                <div class="card-body">
            

                    <?php 
                    if (isset($_POST['update-btn'])) {
                        $image = $_FILES['image']['name'];
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $address = $_POST['address'];
                        $password = $_POST['password'];
                       
                        $number = $_POST['number'];

                        if ($image == '' || empty($image)) {
                            $image = $old_image;
                        } else {
                            $temp = $_FILES['image']['tmp_name'];
                            move_uploaded_file($temp, 'img/'.$image);
                        }

                        $update_query = "UPDATE users SET username = '$username', email = '$email', password = '$password', address = '$address', number = '$number', image = '$image' WHERE id = '$user_id'";
                        $update_result = $db->query($update_query);

                        if ($update_result) {
                            echo "<div class='alert alert-success'>User has been updated successfully</div>";
                        } else {
                            echo "<div class='alert alert-danger'>User has not been updated</div>";
                        }
                    }
                    ?>

                    <form method="post" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="file" name="image" class="form-control fw-semibold text-black" id="floatingInputimage" title="Upload Your Profile Image">
                            <label for="floatingInputimage" class="form-label text-black fw-semibold">Upload Your Profile Image</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" class="form-control" id="floatingInputUsername" placeholder="name@example.com">
                            <label for="floatingInputUsername" class="form-label text-black fw-semibold">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput" class="form-label text-black fw-semibold">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword" class="form-label text-black fw-semibold">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" class="form-control" id="floatingAddress" placeholder="Address">
                            <label for="floatingAddress" class="form-label text-black fw-semibold">Address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="number" value="<?php echo htmlspecialchars($number); ?>" class="form-control" id="floatingNumber" placeholder="number">
                            <label for="floatingNumber" class="form-label text-black fw-semibold">Contact Number</label>
                        </div>
                        <div class="d-flex justify-content-center mb-0">
    <button class="btn btn-success btn-lg fs-5 fw-semibold w-75" name="update-btn" type="submit">Update</button>
</div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>
