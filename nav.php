
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark bg-black fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <!-- Logo -->
      <div class="text-center">
        <img src="img/logo.jpg" style="width: 180px;" alt="logo">
      </div>

      <!-- Navigation links and buttons -->
      <div class="d-flex align-items-center">
        <div class="me-4">
          <a href="login.php" class="btn btn-outline-light fw-semibold me-2">Login</a>
          <a href="register.php" class="btn btn-warning fw-semibold">Register</a>
          <a href="admin_login.php" class="btn btn-warning fw-semibold">Admin</a>
        </div>
        
        <!-- Offcanvas toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>

    <!-- Offcanvas menu -->
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" aria-current="page" href="index.php">
              <?php 
              if(isset($user_id)){
                echo "Welcome! " . $login_username;
              } else {
                echo "Home";
              }
              ?>
            </a>
          </li>

          <!-- Dropdown -->
          <li class="nav-item dropstart">
            <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu">
              <?php 
              if(isset($_SESSION['id'])){
                ?>
                <li><a class="dropdown-item fw-semibold text-dark" href="dashboard.php">Dashboard</a></li>
                <li><a class="dropdown-item fw-semibold text-dark" href="setting.php">Setting</a></li>
                <li><a class="dropdown-item fw-semibold text-dark" href="logout.php">Logout</a></li>
                <li><hr class="dropdown-divider"></li>
                <?php
              } else {
                ?>
                <li><a class="dropdown-item fw-semibold text-dark" href="login.php">Sign In</a></li>
                <li><a class="dropdown-item fw-semibold text-dark" href="register.php">Create Account</a></li>
                <?php
              }
              ?>
            </ul>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container mt-5 pt-5">
    <!-- Your page content here -->
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
