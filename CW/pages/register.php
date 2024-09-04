<?php
session_start();

include '../includes/DBConnection.php'; 
include '../includes/DBFunctions.php'; 

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables with default values
    $username = '';
    $email = '';
    $password = '';
    $confirm_password = '';

    // Check if POST data is set and sanitize inputs
    if (isset($_POST['username'])) {
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['email'])) {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if (isset($_POST['confirm_password'])) {
        $confirm_password = $_POST['confirm_password'];
    }

    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (empty($username) || empty($password) || empty($confirm_password)) {
        $error = 'All fields are required.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        // Check if email is already registered
        $user = getUserByEmail($pdo, $email);
        if ($user) {
            $error = 'Email is already registered.';
        } else {
            // Register the user with plain text password
            if (registerUser($pdo, $username, $email, $password)) {
                $success = 'Registration successful! You can now <a href="login.php">login</a>.';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}

include '../templates/register.html.php';
?>
