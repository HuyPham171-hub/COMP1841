<?php
session_start();
include '../includes/DBConnection.php'; 
include '../includes/DBFunctions.php'; 

try {
    if (isset($_POST['title'], $_POST['content'], $_FILES['image'], $_POST['module'])) {   
        $author_id = $_SESSION['user_id'];

        $image_path = ''; 
        if ($_FILES['image']['error'] === 0) {
            $target_dir = '../images/'; 
            $target_file = $target_dir . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $target_file; 
            } else {
                throw new Exception('Failed to upload image.');
            }
        }

        insertPost($pdo, $_POST['title'], $_POST['content'], $image_path, $author_id, $_POST['module']);

        header('Location: posts.php');
        exit();
    } else {
        $title = 'Add a new post';
        $modules = allModules($pdo); 
        ob_start();
        include '../templates/create_post.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = $e->getMessage();
}

// Determine which layout to include based on user role
if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
    include '../templates/admin_layout.html.php'; // Admin layout for admins
} else {
    include '../templates/layout.html.php'; // Regular layout for non-admins
}
?>
