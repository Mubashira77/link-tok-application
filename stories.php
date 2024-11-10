<?php include_once('header.php'); ?>
<?php include_once('nav.php'); 

?>
<body style="background-image:url('img/lod.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;">


       



<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin-top: 10px;">
            <div class="card        bg-success-subtle">
                <div class="card-body">
                    
                    <h5 class="card-title fw-semibold  my-3">Upload Story</h5>
                    
                    <form action="storiesview.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="fw-semibold mb-3">Upload Story Video</label>
                            <input type="file" name="video" class="form-control  border-dark  border-1 bg-light p-3" accept="video/*">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control  border-dark  border-1  bg-light p-3" placeholder="Title">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Upload" name="upload" class="btn btn-warning  fw-semibold  px-5 rounded-5">
                            <a href="storiesview.php" class="btn btn-outline-dark px-5 rounded-5  btn-sm  fw-semibold">Stories View</a>
                        </div>
                      
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
    <img src="img/sto.jpg" alt="Image" style="width: 500px; height: 300px; float: right; margin-top: 10px; border: 3px solid #000;">
</div>

    </div>
</div>

       
       
        

        <?php include_once('quick-links.php'); ?>







<?php include_once('footer.php'); ?>