<?php
session_start();

include '../includes/DBConnection.php'; 
include '../includes/DBFunctions.php'; 

try {
    
    if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
        $title = 'Admin Dashboard'; 
        $messages = allMessages($pdo); 
        
        
        ob_start();
        include '../templates/admin_message.html.php'; 
        $output = ob_get_clean();
        include '../templates/admin_layout.html.php'; 
    } else {
        
        header("Location: home.php");
        exit();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
    include '../templates/layout.html.php';
}
?>
