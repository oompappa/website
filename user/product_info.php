<?php include '../includes/db_connect.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Product Details</title>
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
        <h1>Product Details</h1>
    </header>

    <main class="container">
        <div class="card">
            <h3>Product Name</h3>
            <img src="../assets/images/sample.png" alt="Product Image" width="100%">
            <p>Price: R 200</p>
            <p>Description: This is a product description.</p>
            <button>Buy Now</button>
        </div>
    </main>

    <footer>&copy; 2025</footer>
</body>

</html>