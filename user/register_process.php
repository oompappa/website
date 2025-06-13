<?php 
session_start(); 
include '../includes/db_connect.php';

$f_name = $conn->real_escape_string($_POST['f_name']);
$l_name = $conn->real_escape_string($_POST['l_name']);
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);    
$user_type = $conn->real_escape_string($_POST['user_type']);


// Check username is unique
$check = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "Username already in use. Username must be unique.";
} else {
    $sql = "INSERT INTO users (f_name, l_name, username, email, password, user_type) 
            VALUES ('$f_name', '$l_name', '$username', '$email', '$password', '$user_type')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?> 