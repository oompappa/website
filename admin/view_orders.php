<?php
session_start();
include '../includes/db_connect.php';

// If not logged in or not an admin, redirect away
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../user/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> (Admin)</p>
    <nav>
        <ul>
            <li><a href="man_users.php">Manage Users</a></li>
            <li><a href="man_listings.php">Manage Listings</a></li>
            <li><a href="manage_orders.php">Manage Orders</a></li>
            <li><a href="manage_reviews.php">Manage Reviews</a></li>
            <li><a href="../index.php">Back to Site</a></li>
            <li><a href="../user/logout.php">Logout</a></li>
        </ul>
    </nav>
</body>

</html>