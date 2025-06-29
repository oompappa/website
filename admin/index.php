<?php
session_start();
include '../includes/db_connect.php';

// only allow logged-in admin users
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
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

    <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</p>

    <div class="admin-buttons">
        <form action="man_users.php" method="get" style="margin-bottom: 10px;">
            <button type="submit">Manage Users</button>
        </form>

        <form action="man_listings.php" method="get" style="margin-bottom: 10px;">
            <button type="submit">Manage Listings</button>
        </form>

        <form action="man_orders.php" method="get" style="margin-bottom: 10px;">
            <button type="submit">Manage Orders</button>
        </form>

        <form action="../index.php" method="get" style="margin-bottom: 10px;">
            <button type="submit">Back to Site</button>
        </form>

        <form action="logout.php" method="get">
            <button type="submit">Logout</button>
        </form>
    </div>

</body>

</html>