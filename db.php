<?php 

session_start();
ob_start();


$host_name = "localhost";
$user_name = "root";
$pass_word = "";
$data_base = "api";

$db = new mysqli($host_name, $user_name, $pass_word, $data_base);

if($db->connect_error){
    die("Connection Failed: " . $db->connect_error);
}

if(isset($_SESSION['id'])){

    $user_id   = $_SESSION['id'];
    $user_role = $_SESSION['role'];

    
    $data = $db->query("SELECT * FROM users WHERE id = '$user_id' ");
    $user = $data->fetch_assoc();

    $login_image    = $user['image'];
    $login_username = $user['username'];
    $login_email    = $user['email'];
    $login_address   = $user['address'];
    $login_number   = $user['number'];
    $login_password = $user['password'];



    
}

?>