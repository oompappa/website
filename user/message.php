<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['seller_id'])) {
    header("Location: ../index.php");
    exit();
}

$sender_id = $_SESSION['user_id'];
$receiver_id = (int)$_GET['seller_id'];
$product_name = isset($_GET['product_name']) ? htmlspecialchars($_GET['product_name']) : '';

// send message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = $conn->real_escape_string($_POST['message']);
    $conn->query("INSERT INTO messages (sender_id, receiver_id, message) VALUES ($sender_id, $receiver_id, '$msg')");
}

// fetch messages between these two users
$sql = "
    SELECT m.*, u.username AS sender_name
    FROM messages m
    JOIN users u ON m.sender_id = u.user_ID
    WHERE (sender_id = $sender_id AND receiver_id = $receiver_id)
       OR (sender_id = $receiver_id AND receiver_id = $sender_id)
    ORDER BY sent_at ASC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Messaging</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Messaging</h1>
    </header>

    <main class="container">
        <h2>Chat with Seller <?php echo $receiver_id; ?><?php echo $product_name ? " about '$product_name'" : ""; ?></h2>

        <div class="chat-box" style="border:1px solid #ccc; padding:10px; height:300px; overflow-y:scroll;">
            <?php while ($row = $result->fetch_assoc()): ?>
                <p><strong><?php echo htmlspecialchars($row['sender_name']); ?>:</strong>
                    <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                    <em>(<?php echo $row['sent_at']; ?>)</em>
                </p>
            <?php endwhile; ?>
        </div>

        <form method="post" style="margin-top:10px;">
            <textarea name="message" placeholder="Type your message..." required></textarea><br>
            <button type="submit">Send</button>
        </form>

        <br>
        <form action="../index.php" method="get">
            <button type="submit">Return to Home Page</button>
        </form>

    </main>

    <footer>&copy; 2025 Notebook Marketplace</footer>
</body>

</html>