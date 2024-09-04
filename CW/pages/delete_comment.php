<?php
try {
    include '../includes/DBConnection.php';
    include '../includes/DBFunctions.php';
    
   
    if(isset($_POST['comment_id'])) {
        $comment_id = $_POST['comment_id'];
        
        
        deleteComment($pdo, $comment_id);
        
      
        header('location: ../pages/posts.php');
        exit(); 
    } else {
        
        $title = 'An error has occurred';
        $output = 'No comment ID provided.';
    }
} catch(PDOException $e) {
    
    $title = 'An error has occurred';
    $output = 'Unable to connect to delete comment: ' . $e->getMessage();
}


include '../templates/layout.html.php';
?>
