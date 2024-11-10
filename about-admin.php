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
    <title>About Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h1 class="mb-4">About Admin Panel</h1>
                <p>Welcome to the admin panel of Link-Tok! This admin panel allows you to manage various aspects of the Link-Tok social media platform.</p>
                <p>Here are some of the features:</p>
                <ul>
                    <li>Manage user accounts</li>
                    <li>View reports and analytics</li>
                    <li>Monitor and moderate content</li>
                    <li>And much more!</li>
                </ul>
                
            </div>
            <div class="col-md-4 text-center">
                <img src="img/mkl.png" alt="Admin Panel Image" class="img-fluid rounded">
            </div>
        </div>
    </div>
</body>
</html>
