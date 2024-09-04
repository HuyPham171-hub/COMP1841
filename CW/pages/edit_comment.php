<?php
include '../includes/DBConnection.php';
include '../includes/DBFunctions.php';

$title = "Edit Comment";
$output = '';

try {
    
    if (isset($_GET['comment_id']) && !empty($_GET['comment_id'])) {
        $comment_id = (int)$_GET['comment_id'];
        $comment = getComment($pdo, $comment_id);

        if ($comment) {    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $newContent = $_POST['content'];
                
               
                if ($newContent != $comment['content']) {
                 
                    updateComment($pdo, $comment_id, $newContent);
                }
              
                header('Location: posts.php?post_id=' . $comment['post_id']);
                exit();
            }
            
            ob_start();
            include '../templates/edit_comment.html.php';
            $output = ob_get_clean();
        } else {
            $output = 'No comment found with the provided ID.';
        }
    } else {
        $output = 'No comment ID provided.';
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/layout.html.php';
?>
