<?php
session_start();
include '../includes/db_connect.php';

// already logged in as admin, redirect to dashboard
if (isset($_SESSION['user_id'], $_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0T9Z5MG6GT"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-0T9Z5MG6GT');
</script>

<body>
    <header>
        <h1>Admin Login</h1>
    </header>

    <main class="container">
        <form method="post" action="login_process.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <form action="index.php" method="get">
            <button type="submit">Back to Dashboard</button>
        </form>
    </main>

    <footer>&copy; 2025 Notebook Marketplace</footer>
</body>

</html>