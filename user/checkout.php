<?php include '../includes/db_connect.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Checkout</h1>
    </header>

    <main class="container">
        <p>Product: Product Name</p>
        <p>Price: R 200</p>
        <form>
            <input type="text" name="address" placeholder="Delivery Address">
            <button type="submit">Confirm Order</button>
        </form>
    </main>

    <footer>&copy; 2025</footer>
</body>

</html>