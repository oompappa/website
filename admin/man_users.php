<?php
session_start();
include '../includes/db_connect.php';

// Admin check
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../user/login.php");
    exit();
}

// deletion or change user type
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['user_id'])) {
    $action = $_POST['action'];
    $userID = intval($_POST['user_id']);
    if ($action === 'delete') {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_ID = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
    } elseif ($action === 'change_type' && isset($_POST['new_type'])) {
        $newType = $conn->real_escape_string($_POST['new_type']);
        $stmt = $conn->prepare("UPDATE users SET user_type = ? WHERE user_ID = ?");
        $stmt->bind_param("si", $newType, $userID);
        $stmt->execute();
    }
}

// fetch all users
$result = $conn->query("SELECT user_ID, f_name, l_name, username, email, user_type FROM users");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/admin.js"></script>
</head>

<body>
    <h1>Manage Users</h1>
    <form action="index.php" method="get">
        <button type="submit">Back to Dashboard</button>
    </form>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
        <?php while ($user = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $user['user_ID']; ?></td>
                <td><?php echo htmlspecialchars($user['f_name'] . ' ' . $user['l_name']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <form method="post" class="inline-form">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_ID']; ?>">
                        <input type="hidden" name="action" value="change_type">
                        <select name="new_type" onchange="this.form.submit()">
                            <option value="buyer" <?php if ($user['user_type'] == 'buyer') echo 'selected'; ?>>Buyer</option>
                            <option value="seller" <?php if ($user['user_type'] == 'seller') echo 'selected'; ?>>Seller</option>
                            <option value="admin" <?php if ($user['user_type'] == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </form>
                </td>
                <td>
                    <form method="post" onsubmit="return confirm('Delete this user?');" class="inline-form">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_ID']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>