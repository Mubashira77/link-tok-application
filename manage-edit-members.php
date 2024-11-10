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

$edit_id = $_GET['edit'];
$data = $db->query("SELECT * FROM users WHERE id = '$edit_id' ");
$user = $data->fetch_assoc();

if($data->num_rows == 0){
    header('location: logout.php');
}else{

    $old_image = $user['image'];
    $username = $user['username'];
    $email    = $user['email'];
    $number   = $user['number'];
    $password = $user['password'];


}




?>


<body style="background-image: url('img/ko.jpeg'); background-position: center; background-repeat: no-repeat; background-size: cover;">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 rounded-5 bg-warning-subtle border border-dark border-4">
                <h2 class="text-center text-black fw-bold">Update User Profile</h2>

                    <?php 
                
                if(isset($_POST['update-btn'])){

                    $image    = $_FILES['image']['name'];
                    $username = $_POST['username'];
                    $email    = $_POST['email'];
                    $password = $_POST['password'];
                    $number   = $_POST['number'];

                    if($image == '' OR empty($image)){
                        $image = $old_image;
                    }else{
                        $temp     = $_FILES['image']['tmp_name'];
                        move_uploaded_file($temp, 'img/'.$image);
                    }


                    $update_query = "UPDATE users SET username = '$username', email = '$email', password = '$password', number = '$number', image = '$image' WHERE id = '$edit_id' ";

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
                    <input type="file" name="image" class="form-control  fw-semibold" id="floatingInputimage" title="Upload Your Profile Image">
                    <label for="floatingInputimage "  class="text-black fw-semibold">Upload Your Profile Image</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" id="floatingInputUsername" placeholder="name@example.com">
                    <label for="floatingInputUsername"  class="text-black fw-semibold">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput"  class="text-black fw-semibold">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="password" name="password" value="<?php echo $password; ?>" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword "  class="text-black fw-semibold">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="number" name="number" value="<?php echo $number; ?>" class="form-control" id="floatingnumber" placeholder="number">
                    <label for="floatingnumber"  class="text-black fw-semibold">Contact Number</label>
                    </div>

                  <div class="pt-1 mb-0">
                    <button class="btn btn-dark btn-lg btn-block   fw-bold" name="update-btn" type="submit">Update</button>
                  </div>

                    </form>
         

                </div>
            </div>
        </div>
    </div>
</div>







<?php include_once('footer.php'); ?>