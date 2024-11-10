<!doctype html>
<?php include_once('db.php'); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Link Tok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body class="">
    <!-- Section: Design Block -->
    <section class="text-center">
      <!-- Background image -->
      <div class="p-5 bg-image" style="
        background-image: url('img/ML.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 300px;
      "></div>
    

      <div class="card mx-4 mx-md-auto shadow-5" style=" margin-top:-100px;  max-width: 600px; /* Limiting maximum width */ ">
        <div class="card-body py-3 px-3 md-3   bg-warning ">

          <div class="text-center">
            <img src="img/logo.jpg" style="width: 185px;" alt="logo">
          </div>

          <div class="row d-flex justify-content-center">
            <div class="col-lg-10"> <!-- Adjusting width to 10 columns -->
              <h2 class="fw-bold mb-5   mt-4">Login Here</h2>
              
              <?php
              if(isset($_POST['login-btn'])){

                    
$email    = $_POST['email'];
$password = $_POST['password'];

$check_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
$check_result = $db->query($check_query);
$rows = $check_result->num_rows;
$data = $check_result->fetch_assoc();

if ($rows == 0) {
    echo "<div class='alert alert-danger'>Invalid email or password</div>";
} elseif($rows == 1 AND $data['status'] == 'active') {

    $_SESSION['id']   = $data['id'];
    $_SESSION['role'] = $data['role'];

    header('location: dashboard.php');

}elseif($rows == 1 AND $data['status'] == 'pending') {
    echo "<div class='alert alert-warning'>Please wait for Admin Approval</div>";
  
}else{

    echo '<script>alert("Your Account is Currently De-Activated.");</script>';
}



}

?>

<form method="post">
                    <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput"   class="fw-semibold">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword"   class="fw-semibold">Password</label>
                    </div>


                <!-- Submit button -->
                <div class="pt-1 mb-4">
                  <button class="btn btn-dark btn-lg " name="login-btn" type="submit">Login</button>
                </div>
              </form>

             
              <p  class="fw-semibold text-black fs-5">Don't have an account? <a href="register.php"   class="fw-semibold fs-5  text-black">Register here</a></p>
              <p class=" fw-semibold mb-2">Go Back   <a href="index.php"   class="fw-semibold  text-primary">Home Page ?</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
