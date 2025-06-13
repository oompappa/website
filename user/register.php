<?php include '../includes/db_connect.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Create an Account</h1>
    </header>

    <main class="container">
        <form action="register_process.php" method="POST">
            <input type="text" name="f_name" placeholder="First Name" required>
            <input type="text" name="l_name" placeholder="Last Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" autocomplete="off" required>
            <label for="user_type">Account Type:</label>
            <select name="user_type" required>
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
            </select>
            <button type="submit">Register</button>
        </form>
    </main>

    <footer>&copy; 2025</footer>
</body>

</html>