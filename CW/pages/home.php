<?php
session_start();

include '../includes/DBConnection.php'; 
include '../includes/DBFunctions.php'; 

try {
    $title = 'Home Page';
    $posts = allPosts($pdo);
    
    if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
        ob_start();
        include '../templates/home.html.php';
        $output = ob_get_clean();
        include '../templates/admin_layout.html.php';
    } else {
        ob_start();
        include '../templates/home.html.php';
        $output = ob_get_clean();
        include '../templates/layout.html.php';
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
    include '../templates/layout.html.php';
}
?>
