<?php
session_start();

include '../includes/DBConnection.php';
include '../includes/DBFunctions.php';


if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {

    header("Location: login.php");
    exit();
}


$title = "Manage Users";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_user_id'])) {
        $user_id = $_POST['delete_user_id'];
        deleteUser($pdo, $user_id);
    }

    header("Location: manage_users.php");
    exit();
}


$users = allUsers($pdo);


include '../templates/manage_users.html.php';
?>
