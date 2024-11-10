
<?php include_once('db.php'); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Link Tok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body class="">
  <section class="vh-100   bg-secondary-subtle">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5  border border-0  ">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                <!-- Your logo/image with height and width set -->
                <img src="img/logo.jpg" class="img-fluid mt-2 md-4 mx-auto d-block" alt="Logo" style="height: 100px; width: 300px;">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-0">Sign up</p>


                <?php 
                
                if(isset($_POST['register-btn'])){

                    $username= $_POST['username'];
                    $email= $_POST['email'];
                    $password = $_POST['password'];
                    $address  = $_POST['address'];
                    $number   = $_POST['number'];

                    $check_query = "SELECT * FROM users WHERE email = '$email'";
                    $check_result = $db->query($check_query);

                    if ($check_result->num_rows==0) {
                        $insert_query = "INSERT INTO  users(username, email, password, address , number, role, status) VALUES ('$username', '$email', '$password', '$address', '$number', 'user', 'pending')";
                        $insert_result = $db->query($insert_query);

                        if ($insert_result) {
                            echo "<div class='alert alert-success'>User has been registered successfully</div>";
                        } else {
                            echo "<div class='alert alert-danger'>User has not been registered</div>";
                        }
                    } else {
                        echo "<div class='alert alert-warning'>Email is already taken</div>";
                    }
                    


                }
                
                ?>
                    
                    <form method="post">

                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label for="floatingInputUsername"  class="fw-semibold  fs-5">Username:</label>             
    <input type="text" name="username" class="form-control  border border-2  border border-primary" id="floatingInputUsername" placeholder="Username" required>
 
  </div>
  </div>


  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label for="floatingInput" class="fw-semibold  fs-5">Email address:</label>               
    <input type="email" name="email" class="form-control    border border-2  border border-primary" id="floatingInput" placeholder="name@example.com" required>
  
  </div>
  </div>

  
  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label for="floatingPassword" class="fw-semibold   fs-5 ">Password:</label>                
    <input type="password" name="password" class="form-control    border border-2  border border-primary" id="floatingPassword" placeholder="Password" required>

  </div>
  </div>

  <div class="d-flex flex-row align-items-center mb-4">
    <i class="fas fa-map-marker-alt fa-lg me-3 fa-fw"></i>
    <div data-mdb-input-init class="form-outline flex-fill mb-0">
        <label for="floatingAddress" class="fw-semibold fs-5">Address:</label>
        <input type="text" name="address" class="form-control border border-2 border-primary" id="floatingAddress" placeholder="Address" required>
    </div>
</div>


  <div class="d-flex flex-row align-items-center mb-4">
    <i class="fas fa-phone fa-lg me-3 fa-fw"></i> <!-- Changed envelope icon to phone icon -->
    <div data-mdb-input-init class="form-outline flex-fill mb-0">
        <label for="floatingNumber"  class="fw-semibold   fs-5">Contact Number:</label> <!-- Changed label text -->
        <input type="tel" name="number" class="form-control    border border-2  border border-primary" id="floatingNumber" placeholder="Contact Number" required> <!-- Changed input type to "tel" and adjusted ID and placeholder -->
    </div>
</div>

<div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2    border border-2  border border-dark" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label  fw-semibold" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                    </div>
                    
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 mt-0">
    <button class="btn btn-warning btn-lg border border-dark  fs-5 fw-semibold" name="register-btn" type="submit">Register</button>
</div>

<p class=" fw-semibold mb-2" style="color: #393f81;">Go Back <a href="index.php" style="color: #393f81;">Home Page ?</a></p>
<p class="mb-5 pb-lg-2  fw-semibold mb-5 " style="color: #393f81;">Already have an account? <a href="login.php" style="color: #393f81;">Login</a></p>

</form>

              </div>

              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

<img src="img/ki.jpg"
  class="img-fluid" alt="Sample image">

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>