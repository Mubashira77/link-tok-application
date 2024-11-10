<?php 
// Include necessary files and initialize database connection
include_once('header.php');

include_once('db.php');

// Check if a mood is selected
if(isset($_GET['mood'])){
    // Retrieve selected mood
    $mood = $_GET['mood'];
    // Redirect to selectfor.php with the mood parameter
    header("Location: selectfor.php?mood=$mood");
    exit();
}

// If no mood is selected, show a message or default content
?>




<div class="container">
    <div style="display: flex; justify-content: flex-end; gap: 20px;">
        <a href="addreal.php" class="btn btn-warning btn-xl mt-3 mb-5 fs-5 fw-semibold">Add Real</a>

        <a href="index.php" class="btn btn-outline-success btn-xl mt-3 mb-5 fs-5 fw-semibold">Go back</a>
    </div>
</div>



<div class="container">
    <div class="row mt-5">
        <!-- Image Container -->
        <div class="col-md-6">
            <div class="card border-0">
                <img src="img/foryou.jpg" alt="Mood Image" class="img-fluid"  style="width: 500px; height: 300px; float: right; margin-top: 10px; border: 3px solid #000;" >
            </div>
        </div>
        

  
         
        <!-- Form Container -->
        <div class="col-md-6">
            <div class="card ">
                <div class="card-body">
                    <h5 class="card-title text-uppercase mb-3">For You</h5>
                    
                    <form action="" method="get" id="moodForm" onchange="this.submit();">
                        <div class="form-floating mb-3">
                            <select name="mood" class="form-select border-dark border-1" id="floatingSelect" aria-label="Floating label select example">
                                <option value="" disabled selected>Select your mood</option>
                                <option value="Happy">Happy</option>
                                <option value="Sad">Sad</option>
                                <option value="Angry">Angry</option>
                                <option value="Excited">Excited</option>
                                <option value="Bored">Bored</option>
                            </select>
                            <label for="floatingSelect">Choose Your Mood</label>
                        </div>
                        <div class="container">
    <div class="card border-0 mt-0">
        <div class="card-body p-0">
            <h6 class="my-3">Please Choose Mood</h6>
        </div>
    </div>
</div>
                    </form>
                    
                 
                </div>
            </div>
        </div>
    </div>
</div>



                        
                    

<?php include_once('quick-links.php'); ?>