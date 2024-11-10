<?php include_once('db.php'); ?>
<?php
$data = $db->query("SELECT * FROM users WHERE id = '$user_id'");
$user = $data->fetch_assoc();

if ($data->num_rows == 0) {
    header('location: logout.php');
} else {
    $image = $user['image'];
}
?>


<nav class="p-3 mb-3 border-bottom bg-black">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <div class="text-center">
            <img src="img/logo.jpg" style="width: 180px;" alt="logo">
        </div>

        
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <ul class="navbar-nav flex-row me-auto mb-2 mb-lg-0 justify-content-center">
                <li class="nav-item me-3">
                    <a class="nav-link text-white fw-semibold" aria-current="page" href="admin_panel.php">Home</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link text-white fw-semibold" aria-current="page" href="admin_profile.php">Profile</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link text-white fw-semibold" aria-current="page" href="admin_dashboard.php">Dashboard</a>
                </li>
              

                <li class="nav-item me-3">
                    <a class="nav-link text-white fw-semibold" aria-current="page" href="requests.php">Request of Registered Users</a>
                </li>

                
                <li class="nav-item me-3">
                    <a class="nav-link text-white fw-semibold" aria-current="page" href="content.php">Manage Content</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-white fw-semibold" aria-current="page" href="manage-all-members.php">Manage Users</a>
                </li>
              

            </ul>
        </div>

        <div class="dropdown text-end">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" id="dropdownMenuLink"
               data-toggle="dropdown" aria-expanded="false">
                <img src="img/<?php echo $image ?>" class="img-fluid rounded-circle me-3" width="50" height="50">
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="admin_profile.php">Profile</a>
                <a class="dropdown-item" href="setting.php">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- Bootstrap JS (popper.js and bootstrap.js are required for dropdowns) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

