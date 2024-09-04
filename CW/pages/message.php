<?php
session_start();

include '../includes/DBConnection.php';
include '../includes/DBFunctions.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $message = $_POST['message'];
    

    $user_id = $_SESSION['user_id']; 
    
    try {
      
        insertMessage($pdo, $message, $user_id);

       
        header('Location: home.php');
        exit();
    } catch (PDOException $e) {
        $error = 'An error occurred while sending the message: ' . $e->getMessage();
    }
}

include '../templates/message.html.php';
?>
