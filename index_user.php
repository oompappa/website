<?php include 'includes/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notebook Marketplace - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header>
        <h1>Welcome to Notebook Marketplace</h1>
        <nav>
            <form action="user/register.php" method="get" style="display: inline;">
                <button type="submit" class="nav-button">Register</button>
            </form>
            <form action="user/login.php" method="get" style="display: inline;">
                <button type="submit" class="nav-button">Login</button>
            </form>
            <a href="../user/logout.php">Logout</a>

        </nav>
    </header>

    <main class="container">
        <h2>Listings</h2>

        <div class="card">
            <h3>Product Name</h3>
            <p>Price: R 200</p>
            <a href="product_detail.php">View Details</a>
        </div>

    </main>

    <footer>
        &copy; 2025 Notebook Marketplace
    </footer>

</body>

</html>