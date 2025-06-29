<?php
session_start();
include 'includes/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notebook Marketplace - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
        <h1>Welcome to Notebook Marketplace</h1>
        <nav>
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- logged in: shows listing and logout options -->
                <form action="user/add_listing.php" method="get" style="display:inline;">
                    <button type="submit" class="nav-button">Post a New Listing</button>
                </form>
                <form action="user/logout.php" method="get" style="display:inline;">
                    <button type="submit" class="nav-button">Logout</button>
                </form>
                <form action="admin/index.php" method="get">
                    <button type="submit">Admin Login</button>
                </form>
            <?php else: ?>
                <!-- not logged in: shows register and login buttons -->
                <form action="user/register.php" method="get" style="display:inline;">
                    <button type="submit" class="nav-button">Register</button>
                </form>
                <form action="user/login.php" method="get" style="display:inline;">
                    <button type="submit" class="nav-button">Login</button>
                </form>
                <form action="admin/index.php" method="get">
                    <button type="submit">Admin Login</button>
                </form>
            <?php endif; ?>
        </nav>
    </header>

    <main class="container">
        <h2>Listings</h2>

        <div class="sort-controls">
            <span>Sort by:</span>
            <form method="get" style="display: inline;">
                <button type="submit" name="sort" value="date_desc">Date (Newest)</button>
            </form>
            <form method="get" style="display: inline;">
                <button type="submit" name="sort" value="price_asc">Price (Low → High)</button>
            </form>
            <form method="get" style="display: inline;">
                <button type="submit" name="sort" value="price_desc">Price (High → Low)</button>
            </form>
        </div>

        <?php
        // sorting parameter (default is date descending)
        $allowed_sorts = ['date_desc', 'price_asc', 'price_desc'];
        $sort = 'date_desc';
        if (isset($_GET['sort']) && in_array($_GET['sort'], $allowed_sorts)) {
            $sort = $_GET['sort'];
        }

        // map sort to SQL ORDER BY clause
        switch ($sort) {
            case 'price_asc':
                $order_by = 'l.price ASC';
                break;
            case 'price_desc':
                $order_by = 'l.price DESC';
                break;
            case 'date_desc':
            default:
                $order_by = 'l.date_posted DESC';
                break;
        }

        // query to fetch listings from db, ORDER BY
        $sql = "
      SELECT
        l.list_ID,
        l.product_name,
        l.price,
        l.description,
        l.image,
        l.date_posted,
        l.seller_ID,
        u.username AS seller_name
      FROM listings AS l
      JOIN users AS u
        ON l.seller_ID = u.user_ID
      ORDER BY $order_by
    ";
        $result = $conn->query($sql);

        if (!$result) {
            echo "<p>Error fetching listings: " . htmlspecialchars($conn->error) . "</p>";
        } elseif ($result->num_rows === 0) {
            echo "<p>No listings available at the moment.</p>";
        } else {
            // looping through listing rows and rendering
            while ($row = $result->fetch_assoc()) {
                // escape output for failsafe
                $productName = htmlspecialchars($row['product_name']);
                $price       = number_format($row['price'], 2);
                $description = nl2br(htmlspecialchars($row['description']));
                $seller      = htmlspecialchars($row['seller_name']);
                $date        = $row['date_posted'];
                $imagePath   = htmlspecialchars($row['image']);
        ?>

                <div class="card">
                    <h3><?php echo $productName; ?></h3>
                    <p><strong>Price:</strong> R <?php echo $price; ?></p>

                    <?php if (!empty($imagePath)): ?>
                        <img src="<?php echo $imagePath; ?>" alt="Product Image" style="max-width:200px;">
                    <?php endif; ?>

                    <?php if (!empty($description)): ?>
                        <p><?php echo $description; ?></p>
                    <?php endif; ?>

                    <p>
                        <em>Posted by:</em> <?php echo $seller; ?><br>
                        <em>On:</em> <?php echo $date; ?>
                    </p>

                    <?php if (isset($_SESSION['user_id'])): ?>

                        <div class="button-group">

                            <!-- Buy Now button -->
                            <form method="get" action="user/checkout.php">
                                <input type="hidden" name="list_ID" value="<?php echo $row['list_ID']; ?>">
                                <button type="submit">Buy Now</button>
                            </form>


                            <!-- Message Seller button -->
                            <?php if ($_SESSION['user_id'] != $row['seller_ID']): ?>
                                <form method="get" action="user/message.php">
                                    <input type="hidden" name="seller_id" value="<?php echo $row['seller_ID']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo urlencode($productName); ?>">
                                    <button type="submit">Message Seller</button>
                                </form>
                            <?php endif; ?>

                        </div>

                    <?php else: ?>
                        <p><em>Login to buy this product.</em></p>
                    <?php endif; ?>

                </div>



        <?php
            } // end while
        }
        ?>

    </main>

    <footer>
        &copy; 2025 Notebook Marketplace
    </footer>
</body>

</html>