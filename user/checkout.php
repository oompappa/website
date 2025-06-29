<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Fetch product info by GET or POST
$list_ID = isset($_GET['list_ID']) ? (int)$_GET['list_ID'] : (isset($_POST['list_ID']) ? (int)$_POST['list_ID'] : 0);

// Validate listing
$sql = "SELECT * FROM listings WHERE list_ID = $list_ID";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (!$product) {
    echo "Product not found.";
    exit();
}

// If form is submitted (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = $conn->real_escape_string($_POST['address']);
    $buyer_id = $_SESSION['user_id'];

    // Insert order into orders table
    $stmt = $conn->prepare("INSERT INTO orders (buyer_ID, list_ID, order_status) VALUES (?, ?, 'Pending')");
    $stmt->bind_param("ii", $buyer_id, $list_ID);

    if ($stmt->execute()) {
        header("Location: order_success.php");
        exit();
    } else {
        echo "Error placing order: " . $conn->error;
    }
    $stmt->close();
    exit();
}
?>

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
        <p>Product: <?php echo htmlspecialchars($product['product_name']); ?></p>
        <p>Price: R <?php echo number_format($product['price'], 2); ?></p>

        <form method="post">
            <input type="text" name="address" placeholder="Delivery Address" required>
            <input type="hidden" name="list_ID" value="<?php echo $product['list_ID']; ?>">
            <button type="submit">Confirm Order</button>
        </form>

        <br>
        <form action="../index.php" method="get">
            <button type="submit">Return to Home Page</button>
        </form>
    </main>

    <footer>&copy; 2025</footer>
</body>

</html>