<?php
session_start();
include '../includes/db_connect.php';

// If not logged in or not an admin, redirect away
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../user/login.php");
    exit();
}
