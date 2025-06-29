<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Look for an admin user
    $sql = "SELECT * FROM users WHERE username = '$username' AND user_type = 'admin'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin['password'])) {
            // Set admin session variables
            $_SESSION['user_id']   = $admin['user_ID'];
            $_SESSION['username']  = $admin['username'];
            $_SESSION['user_type'] = $admin['user_type'];

            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Admin user not found.";
    }
} else {
    header("Location: login.php");
    exit();
}
