<?php
include '../includes/DBConnection.php';
include '../includes/DBFunctions.php';

$title = "Edit Post";
$output = '';

try {
    if (isset($_GET['post_id'])) {
        $post_id = (int)$_GET['post_id'];
        $post = getPost($pdo, $post_id);

        if ($post) {    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $newTitle = $_POST['title'];
                $newContent = $_POST['content'];
                $newImageURL = $post['image_url']; 
                
               
                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $newImageURL = updateImage($pdo, $post_id, $_FILES['image']);
                }

                
                if ($newTitle != $post['title'] || $newContent != $post['content'] || $newImageURL != $post['image_url']) {
                   
                    updatePost($pdo, $post_id, $newTitle, $newContent, $newImageURL);
                    header('Location: posts.php?post_id=' . $post_id);
                    exit();
                } else {
                    
                    header('Location: edit_post.php?post_id=' . $post_id);
                    exit();
                }
            }
            
            ob_start();
            include '../templates/edit_post.html.php';
            $output = ob_get_clean();
        } else {
            $output = 'No post found with the provided ID.';
        }
    } else {
        $output = 'No post ID provided.';
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/layout.html.php';
?>
