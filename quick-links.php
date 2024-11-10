


<div class="container  mt-5   bg-transparent">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-1  bg-transparent">
                <div class="card-body">
                    <h5 class="card-title text-uppercase mb-4">Connection Requests</h5>

                    <table class="table table-borderless mt-3  ">
                        <?php
                        if (isset($user_id)) {
                            $sql = $db->query("SELECT * FROM connections WHERE connection_id = '$user_id' AND status = 'pending'");
                            if ($sql->num_rows > 0) {
                                while ($row = $sql->fetch_assoc()) {
                                    $id = $row['id'];
                                    $user_id = $row['user_id'];
                                    $status = $row['status'];

                                    $sql1 = $db->query("SELECT * FROM users WHERE id = '$user_id'");
                                    $row1 = $sql1->fetch_assoc();

                                    $name = $row1['username'];
                                    $image = $row1['image'];
                                    ?>

                                    <tr class="border table-warning">
                                        <td width="50">
                                            <img src="img/<?php echo $image; ?>" class="rounded-circle" width="50" alt="<?php echo $name; ?>">
                                        </td>
                                        <td class="p-3  fw-bold"><?php echo $name; ?></td>
                                        <td width="100" class="text-end">
                                            <a href="?accept=<?php echo $id; ?>" class="btn btn-sm  btn-success text-white  "><i class="fa fa-check"></i></a>
                                            <a href="?reject=<?php echo $id; ?>" class="btn btn-sm btn-danger  text-black"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>

                                <?php
                                }
                            } else {
                                ?>
                                <tr class="border-1  border-dark">
                                    <td colspan="3" class="p-3  bg-transparent">No Connection Requests</td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr class="border-1  border-dark ">
                                <td width="50">
                                    <img src="img/kj.jpg" class="rounded-circle" width="70" alt="Default Image">
                                </td>
                                <td colspan="2" class="p-3  bg-transparent">Please Login First</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>

                    <?php 
                    
                    if(isset($_GET['accept'])){
                        $accept = $_GET['accept'];
                        $sql = $db->query("UPDATE connections SET status = 'approve' WHERE id = '$accept'");
                        header("Location: " . $_SERVER['PHP_SELF']);
                    }

                    if(isset($_GET['reject'])){
                        $reject = $_GET['reject'];
                        $sql = $db->query("DELETE FROM connections WHERE id = '$reject'");
                        header("Location: " . $_SERVER['PHP_SELF']);
                    }
                    
                    ?>


                    <h5 class="card-title text-uppercase mb-4 mt-4">Navigation</h5>

                    <ul class="list-group">
                        <?php
                        if (isset($user_id)) {
                            ?>
                            <a href="stories.php" class="text-decoration-none mb-2 "><li class="list-group-item border-1  border-dark  bg-transparent"><i class="fa fa-film me-2"></i> Stories</li></a>
                            <a href="for-you.php" class="text-decoration-none mb-2"><li class="list-group-item  border-1  border-dark  bg-transparent"><i class="fa fa-camera me-2"></i> For You</li></a>
                            <a href="find-peoples.php" class="text-decoration-none mb-2"><li class="list-group-item  border-1  border-dark  bg-transparent"><i class="fa fa-user me-2"></i> Connect / Find People</li></a>
                        <?php
                        } else {
                            ?>
                            <a href="#" onclick="return confirm('Please login first');" class="text-decoration-none mb-2"><li class="list-group-item  border-1  border-dark  bg-transparent"><i class="fa fa-film me-2"></i> Stories</li></a>
                            <a href="#" onclick="return confirm('Please login first');" class="text-decoration-none mb-2"><li class="list-group-item  border-1  border-dark  bg-transparent"><i class="fa fa-camera me-2"></i> For You</li></a>
                        <?php
                        }
                        ?>
                    </ul>


                    <h5 class="card-title text-uppercase mb-4 mt-4">My Connections</h5>

                    <table class="table table-borderless mt-3">
                    <?php 
                        
                        if(isset($user_id)){
                            $sql = $db->query("SELECT * FROM connections WHERE (user_id = '$user_id' OR connection_id = '$user_id') AND status = 'approve'");
                            if($sql->num_rows){
                                while($row = $sql->fetch_assoc()) {
                                    $id = $row['id'];
                                    $connection_user_id = ($row['user_id'] == $user_id) ? $row['connection_id'] : $row['user_id'];
                                    
                                    $sql1 = $db->query("SELECT * FROM users WHERE id = '$connection_user_id'");
                                    $row1 = $sql1->fetch_assoc();
                        
                                    $name = $row1['username'];
                                    $image = $row1['image'];
                                    ?>

                                    <tr class="border  table-warning">
                                        <td width="50">
                                            <img src="img/<?php echo $image; ?>" class="rounded-circle" width="50" alt="<?php echo $name; ?>">
                                        </td>
                                        <td class="p-3  fw-bold"><?php echo $name; ?></td>
                                        <td width="100" class="text-end">
                                            <a href="?disconnect=<?php echo $id; ?>" class="btn btn-sm  text-white btn-danger"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>

                                <?php
                                }
                            } else {
                                ?>
                                <tr class="border-1  border-dark">
                                    <td colspan="3" class="p-3   bg-transparent">No Connections</td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr class="border-1  border-dark">
                                <td width="50">
                                    <img src="img/kj.jpg" class="rounded-circle" width="70" alt="Default Image">
                                </td>
                                <td colspan="2" class="p-3  bg-transparent">Please Login First</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>

                    <?php
                  

                    if (isset($_GET['disconnect'])) {
                        $disconnect = $_GET['disconnect'];
                        $sql = $db->query("DELETE FROM connections WHERE id = '$disconnect'");
                        header("Location: " . $_SERVER['PHP_SELF']);
                    }
                    ?>
                </div>
            </div>
        </div>















        
        <div class="col-lg-4">
            <div class="card border-1  bg-transparent">
                <div class="card-body">
                    <h5 class="card-title text-uppercase mb-4">Search Posts</h5>

                    <form action="index.php" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control border-1  border-dark  bg-transparent  p-3" placeholder="Search by post or location">
                            <button class="btn btn-outline-dark  border-1  " type="button" id="search-button">Search</button>
                        </div>
                    </form>

                    <h5 class="card-title text-uppercase mb-4">Quick Links</h5>

                    <ul class="list-group">
                    <a href="index.php?popular" class="text-decoration-none mb-2">
    <li class="list-group-item border-1 border-dark bg-transparent">
        <i class="fas fa-star"></i> View Popular Posts
    </li>
</a>
<a href="index.php?trending" class="text-decoration-none mb-2">
    <li class="list-group-item border-1 border-dark bg-transparent">
        <i class="fas fa-chart-line"></i> Trending Posts
    </li>
</a>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
