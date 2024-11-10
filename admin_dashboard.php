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
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

</head>
<body>

        

                 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>


                    <!-- Content Row -->
                    <div class="row">

                      
                    <?php




// Query to count the number of total  users and we can retrive data with the help of total_user variable
$query = "SELECT COUNT(*) AS total_users FROM users";

// Execute the query
$result = mysqli_query($db, $query);

// Check if the query was successful
if ($result) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);
    // Extract the total number of users
    $totalUsers = $row['total_users'];
    
    // Display the total number of users in your HTML
    $goal = 1000;
    // Calculate the percentage of registered users
    $percentage = ($totalUsers / $goal) * 100;

    // Display the total number of users and the progress bar in your HTML
    echo '<div class="col-xl-3 col-md-6 mb-4 ml-5">';


    echo '<div class="card border-left-success shadow h-100 py-2">';
    echo '<div class="card-body">';
    echo '<div class="row no-gutters align-items-center">';
    echo '<div class="col mr-2">';
    echo '<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total User</div>';
    echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $totalUsers . '</div>';
    echo '</div>';
    echo '<div class="col-auto">';

    echo '</div>';
    echo '</div>';
    echo '<div class="progress mt-3">';
    echo '<div class="progress-bar bg-success" role="progressbar" style="width: ' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    // If query fails, display an error message
    echo "Error: " . mysqli_error($db);
}

  

// Query to count the number of active users
$query = "SELECT COUNT(*) AS active_users FROM users WHERE status = 'active'";

// Execute the query
$result = mysqli_query($db, $query);

// Check if the query was successful
if ($result) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);
    // Extract the total number of active users
    $activeUsers = $row['active_users'];

    // Assuming a goal of 500 active users, you can adjust this as needed
    $goal = 500;
    // Calculate the percentage of active users
    $percentage = ($activeUsers / $goal) * 100;

    // Display the total number of active users and the progress bar in your HTML
    echo '<div class="col-xl-3 col-md-6 mb-4">';
    echo '<div class="card border-left-primary shadow h-100 py-2">';
    echo '<div class="card-body">';
    echo '<div class="row no-gutters align-items-center">';
    echo '<div class="col mr-2">';
    echo '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Active Users</div>';
    echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $activeUsers . '</div>';
    echo '</div>';
    echo '<div class="col-auto">';
    echo '<i class="fas fa-user-check fa-2x text-gray-300"></i>';
    echo '</div>';
    echo '</div>';
    echo '<div class="progress mt-3">';
    echo '<div class="progress-bar bg-primary" role="progressbar" style="width: ' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    // If query fails, display an error message
    echo "Error: " . mysqli_error($db);
}




?>








 <?php


// Query to count the number of pending requests
$query = "SELECT COUNT(*) AS pending_requests FROM users WHERE status = 'pending'";

// Execute the query
$result = mysqli_query($db, $query);

// Check if the query was successful
if ($result) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);
    // Extract the total number of pending requests
    $pendingRequests = $row['pending_requests'];

    // Display the total number of pending requests in your HTML
   
    // Assuming a goal of 100 pending requests, you can adjust this as needed
    $goal = 100;
    // Calculate the percentage of pending requests
    $percentage = ($pendingRequests / $goal) * 100;

    // Display the total number of pending requests and the progress bar in your HTML
    echo '<div class="col-xl-3 col-md-6 mb-4">';
    echo '<div class="card border-left-warning shadow h-100 py-2">';
    echo '<div class="card-body">';
    echo '<div class="row no-gutters align-items-center">';
    echo '<div class="col mr-2">';
    echo '<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>';
    echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $pendingRequests . '</div>';
    echo '</div>';
    echo '<div class="col-auto">';
    echo '<i class="fas fa-comments fa-2x text-gray-300"></i>';
    echo '</div>';
    echo '</div>';
    echo '<div class="progress mt-3">';
    echo '<div class="progress-bar bg-warning" role="progressbar" style="width: ' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
   
  // If query fails, display an error message
    echo "Error: " . mysqli_error($db);

}
?>



<canvas id="myChart" width="400" height="150px"></canvas>


<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Chart type (e.g., bar, line, pie, etc.)
        data: {
            labels: ['Total Users', 'Active Users', 'Pending Requests'],
            datasets: [{
                label: 'Statistics',
                data: [<?php echo $totalUsers; ?>, <?php echo $activeUsers; ?>, <?php echo $pendingRequests; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // Bar color for Total Users
                    'rgba(54, 162, 235, 0.2)', // Bar color for Active Users
                    'rgba(255, 206, 86, 0.2)' // Bar color for Pending Requests
                ],
                borderColor: [
                    'rgba(155, 49, 102, 1)', // Darker border color for Total Users
                    'rgba(24, 122, 205, 1)', // Darker border color for Active Users
                    'rgba(205, 149, 51, 1)' // Darker border color for Pending Requests
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<div class="col-lg-6 mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4 mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Illustrations</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/ser.jpg" alt="...">
            </div>
            <p>"Catch a glimpse of your platform's performance and user engagement through our meticulously crafted admin dashboard. With informative visuals and intuitive data representation, you'll effortlessly navigate through key metrics and insights. Dive into the heart of your data with our dynamic charts and illustrations, making sense of complex analytics at a glance. Whether tracking user activity, monitoring trends, or analyzing performance, our dashboard transforms raw data into actionable insights, empowering you to make informed decisions and drive your platform's success."!</p>
        </div>
    </div>
</div>

<div class="col-lg-6 mt-5">
    <!-- Approach -->
    <div class="card shadow mb-4 mt-4" style="margin-top: calc(50% - 12rem);">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Development Approach</h6>
        </div>
        <div class="card-body">
            <p>"Our approach to development emphasizes simplicity and efficiency. We prioritize modular design and clean coding practices to build a robust and maintainable solution. By adopting agile methodologies, we iterate quickly and adapt to feedback, ensuring continuous improvement and alignment with project goals. Through careful planning and execution, we deliver results that meet both functional requirements and user expectations."</p>
        </div>
    </div>
</div>











</body></html>