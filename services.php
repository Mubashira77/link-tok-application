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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Services - Link-Tok</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
            
    <div class="container mt-5  mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <h1>Admin Services</h1>
                <p>As an admin of Link-Tok, you have access to the following services:</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="img/lof.jpeg" class="card-img-top" alt="Service Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Manage User Accounts</h5>
                        <p class="card-text">Effortlessly manage user accounts with our intuitive admin panel.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="img/p4.jpg" class="card-img-top" alt="Service Image 2">
                    <div class="card-body">
                        <h5 class="card-title">View Reports and Analytics</h5>
                        <p class="card-text">Gain insights into user activity and engagement with comprehensive reports and analytics.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="img/p6.jpg" class="card-img-top" alt="Service Image 3">
                    <div class="card-body">
                        <h5 class="card-title">Monitor and Moderate Content</h5>
                        <p class="card-text">Easily monitor and moderate content to ensure a safe and enjoyable experience for all users.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card">
                    <img src="img/p8.jpg" class="card-img-top" alt="Service Image 4">
                    <div class="card-body">
                        <h5 class="card-title">Access to Admin Dashboard</h5>
                        <p class="card-text">Access the powerful admin dashboard to efficiently manage all aspects of the platform.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="img/p10.jpg" class="card-img-top" alt="Service Image 5">
                    <div class="card-body">
                        <h5 class="card-title">Block Users or Content</h5>
                        <p class="card-text">Quickly block users or content that violates community guidelines or terms of service.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
