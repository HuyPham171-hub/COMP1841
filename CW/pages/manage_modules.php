<?php
session_start();

include '../includes/DBConnection.php';
include '../includes/DBFunctions.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit(); // Stop further script execution after redirection
}

$title = "Modules"; // Missing semicolon fixed

// Check the request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_module_id'])) {
        $module_id = $_POST['delete_module_id']; // Fixed typo in array key
        deleteModule($pdo, $module_id);
    } elseif (isset($_POST['add_module_name'])) { // Corrected 'elseif' syntax
        $module_name = $_POST['add_module_name'];
        addModule($pdo, $module_name);
    }
    header("Location: manage_modules.php");
    exit(); // Stop further script execution after redirection
}

// Retrieve all modules
$modules = allModules($pdo);

// Include the HTML template
include '../templates/manage_modules.html.php';
?>
