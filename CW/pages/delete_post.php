<?php
try {
    include '../includes/DBConnection.php';
    include '../includes/DBFunctions.php';
    
    
    if(isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        
        
        deletePost($pdo, $post_id);
        
        
        header('location: ../pages/posts.php');
        exit(); 
    } else {
        
        $title = 'An error has occurred';
        $output = 'No post ID provided.';
    }
} catch(PDOException $e) {
    
    $title = 'An error has occurred';
    $output = 'Unable to connect to delete post: ' . $e->getMessage();
}


include '../templates/layout.html.php';
?>
