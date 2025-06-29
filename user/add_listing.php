<?php
session_start();

// login check and redirection
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Post a New Listing</title>
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
        <h1>Post a New Product</h1>
    </header>

    <main class="container">
        <form action="add_listing_process.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="product_name">Product Name:</label><br>
                <input type="text" id="product_name" name="product_name" required>
            </div>

            <div>
                <label for="price">Price (ZAR):</label><br>
                <input type="text" id="price" name="price" required>
            </div>

            <div>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>

            <div>
                <label for="image">Product Image (optional):</label><br>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit">Post Listing</button>
        </form>
    </main>


    <footer>&copy; 2025</footer>
</body>

</html>