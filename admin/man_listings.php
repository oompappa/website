<?php
session_start();
include '../includes/db_connect.php';

// Admin check
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../user/login.php");
    exit();
}

// Handle deletes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['list_ID'])) {
    $action = $_POST['action'];
    $listID = intval($_POST['list_ID']);
    if ($action === 'delete') {
        $stmt = $conn->prepare("DELETE FROM listings WHERE list_ID = ?");
        $stmt->bind_param("i", $listID);
        $stmt->execute();
    }
}

// Fetch all listings
$sql = "
  SELECT
    l.list_ID,
    l.product_name,
    l.price,
    l.date_posted,
    u.username AS seller_name
  FROM listings AS l
  JOIN users AS u ON l.seller_ID = u.user_ID
  ORDER BY l.date_posted DESC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Listings</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/admin.js"></script>
</head>

<body>
    <h1>Manage Listings</h1>
    <form action="index.php" method="get">
        <button type="submit">Back to Dashboard</button>
    </form>
    
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Seller</th>
            <th>Date Posted</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['list_ID']; ?></td>
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td>R <?php echo number_format($row['price'], 2); ?></td>
                <td><?php echo htmlspecialchars($row['seller_name']); ?></td>
                <td><?php echo $row['date_posted']; ?></td>
                <td>
                    <a href="../product_detail.php?listing=<?php echo $row['list_ID']; ?>" target="_blank">View</a> |
                    <form method="post" onsubmit="return confirm('Delete this listing?');" style="display:inline;">
                        <input type="hidden" name="list_ID" value="<?php echo $row['list_ID']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>