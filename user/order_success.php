<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Order Success</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Order Confirmed</h1>
    </header>

    <main class="container">
        <p>Your order was placed successfully!</p>

        <form action="../index.php" method="get">
            <button type="submit">Return to Listings</button>
        </form>
    </main>

    <footer>&copy; 2025</footer>
</body>

</html>