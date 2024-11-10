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
            <img src="img/logo.jpg" style="width: 150px;" alt="logo">
        </div>


   
        <div class="d-flex flex-wrap align-items-center justify-content-between">
    <ul class="navbar-nav flex-row me-auto mb-2 mb-lg-0 justify-content-center"> <!-- Added justify-content-center -->
        <li class="nav-item me-3">
            <a class="nav-link text-white fw-semibold" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item  me-3">
            <a class="nav-link text-white fw-semibold" aria-current="page" href="user-posts.php">My Posts</a>
        </li>
        <li class="nav-item   me-3">
            <a class="nav-link text-white fw-semibold" aria-current="page" href="user-connections.php">My Connections</a>
        </li>
        <li class="nav-item   me-3">
            <a class="nav-link text-white fw-semibold" aria-current="page" href="index.php">Front</a>
        </li> 

        <li class="nav-item   me-3">
            <a class="nav-link text-white fw-semibold" aria-current="page" href="setting.php">Setting</a>
        </li> 

        <li class="nav-item  me-3">
            <a class="nav-link text-white fw-semibold" aria-current="page" href="logout.php">Logout</a>
        </li>
    </ul>
</div>


        <img src="img/<?php echo $image ?>" class="img-fluid rounded-circle me-3" width="50" height="50">
      </ul>

    </div>
  </div>
</nav>

