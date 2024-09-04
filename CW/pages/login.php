<?php
session_start();

include '../includes/DBConnection.php'; 
include '../includes/DBFunctions.php'; 


$error = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $user = getUserByEmail($pdo, $email);

   
    if ($user && $password === $user['password']) {
       
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];

       
        if ($user['username'] === 'admin') {
         
            header("Location: home.php");
        } else {
           
            header("Location: home.php");
        }
        exit();
    } else {
        
        $error = "Invalid email or password. Please try again.";
    }
}


include '../templates/login.html.php';
?>
