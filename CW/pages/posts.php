<?php
session_start(); // Start session to check for admin user

include '../includes/DBConnection.php';
include '../includes/DBFunctions.php';

$title = "Posts Page";
$output = '';

try 
{
    if (isset($_GET['post_id'])) 
    {
        $post_id = (int)$_GET['post_id'];
        $post = getPost($pdo, $post_id);

        if ($post) 
        {
            // Handle the comment submission
            if (isset($_POST['submit_comment'], $_POST['comment'], $_POST['post_id'])) 
            {
                $comment = trim($_POST['comment']); // Sanitize the comment input
                $post_id = (int)$_POST['post_id']; // Ensure the post_id is an integer
                $user_id = $_SESSION['user_id'] ?? null; // Use the session user_id if available

                // Check if user is logged in
                if ($user_id === null) {
                    $output = 'You must be logged in to post a comment.';
                } elseif (empty($comment)) {
                    $output = 'Comment cannot be empty.';
                } else {
                    // Attempt to insert the comment
                    try {
                        insertComment($pdo, $comment, $post_id, $user_id);
                        header('Location: posts.php?post_id=' . $post_id);
                        exit();
                    } catch (Exception $e) {
                        $output = 'Failed to insert comment: ' . $e->getMessage();
                    }
                }
            }

            // Fetch all comments for the given post
            $comments = getCommentsForPost($pdo, $post_id);

            ob_start();
            include '../templates/posts.html.php';
            $output = ob_get_clean();
        }
        else
        {
            $output = 'No post found with the provided ID.';
        }
    }
    else
    {
        $posts = allPosts($pdo);
        ob_start();
        include '../templates/home.html.php';
        $output = ob_get_clean();
    }
}
catch (PDOException $e)
{
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

// Determine the layout to use based on user session
if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
    include '../templates/admin_layout.html.php'; // Use the admin layout for admins
} else {
    include '../templates/layout.html.php'; // Use the regular layout for non-admins
}
?>
