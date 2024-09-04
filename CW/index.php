<?php
try {
    header('Location: pages/login.php');
    exit();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
?>

