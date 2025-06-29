<?php include '../includes/db_connect.php'; ?>
<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }

    $buyer_id = $_SESSION['user_id'];
    $list_ID = $_POST['list_ID'];
    $address = $conn->real_escape_string($_POST['address']);

    $sql = "SELECT seller_ID, product_name, price FROM listings WHERE list_ID = $list_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Product not found.";
        exit();
    }

    $seller_id = $row['seller_ID'];
    $product_name = htmlspecialchars($row['product_name']);

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
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