<?php include_once('header.php'); ?>
<?php include_once('nav.php'); ?>


<div class="container">
    <div class="row mt-5">
        

    <body class="bg-danger-subtle">

    <div class="row d-flex align-items-start justify-content-center mt-3"> <!-- Reduced margin top with mt-3 and align-items-start -->
    <div class="col-md-8 col-lg-7 col-xl-6 order-md-2">
        <img src="img/per.jpg" class="img-fluid  mt-2" alt="error"> <!-- Added mt-2 for margin top -->
    </div>



        <div class="col-md-6" style="margin-top: 10px; ">
            

            <div class="card border-0  bg-danger-subtle ">
 
                    <h3 class="card-title text-center fw-semibold my-3">Find Peoples</h3>
                    
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" name="search" class="form-control bg-light  border-dark border-1 p-3" placeholder="Search by name or number">
                        </div>
                    </form>


                    <h5 class="card-title text-center my-3">All Users</h5>


                    <div class="table-responsive">
                        <table class="table table-border mt-3 table-danger">
                          

                            <?php 
                            
                            if(isset($_POST['search'])){
                                $search = $_POST['search'];
                              
                                $sql = $db->query("SELECT * FROM users 
                                WHERE (username LIKE '%$search%' OR number LIKE '%$search%') 
                                AND role = 'user' 
                                AND id != '$user_id'
                                ");
                            }else{
                                if(isset($user_id)){
                                    $sql = $db->query("SELECT * FROM users WHERE (role = 'user' AND id != '$user_id')");
                                }else{
                                    $sql = $db->query("SELECT * FROM users WHERE (role = 'user')");
                                }
                            }
                            while($row = $sql->fetch_assoc()) {

                                $id = $row['id'];
                                $name = $row['username'];
                                $image = $row['image'];

                                ?>

                                <tr class="border-dark border-1  ">
                                    <td width="100" class="align-middle">
                                        <img src="img/<?php echo $image; ?>" class="rounded" width="100" style="height: 150px; object-fit: cover;">
                                    </td>
                                    <td class="p-3 align-middle  fw-bold"><?php echo $name; ?></td>
                                    <td width="100" class="text-end p-3 align-middle">
                                        <?php 
                                        
                                        if(isset($user_id)){
                                            ?>
                                            <a href="find-peoples.php?add=<?php echo $id ?>" class="btn btn-lg btn-dark  border"><i class="fa fa-plus"></i></a>
                                            <?php
                                        }else{
                                            ?>
                                            <a onclick="return alert('please login first');" class="btn btn-sm btn-light border"><i class="fa fa-plus"></i></a>
                                            <?php
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <?php

                            }

                            if(isset($_GET['add'])){

                                $add_id = $_GET['add'];

                                $check_connection = $db->query("SELECT * FROM connections WHERE (user_id = '$user_id' AND connection_id = '$add_id') OR (user_id = '$add_id' AND connection_id = '$user_id')");
                                if($check_connection->num_rows == 0){
                                    $insert = $db->query("INSERT INTO connections (user_id, connection_id, status) VALUES ('$user_id', '$add_id', 'pending')");
                                    if($insert){
                                        echo "<script>alert('Connection request sent successfully.');</script>";
                                    }else{
                                        echo "<script>alert('Failed to send connection request.');</script>";
                                    }
                                }else{
                                    echo "<script>alert('You are already connected or have a pending connection request.');</script>";
                                }
                                echo "<script>window.location.href='find-peoples.php';</script>";
                            }
                            
                            
                            ?>

                        </table>
                    </div>






                </div>
            </div>

        </div>
        

        <?php include_once('quick-links.php'); ?>




    </div>
</div>





<?php include_once('footer.php'); ?>