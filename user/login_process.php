<?php
session_start();
include '../includes/db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

//gotta have some sql injection prevention measures
$username = $conn->real_escape_string($username);

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if (!$result) {
    die("Database query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    //lord help me if I need this to test the password hashing again
    /* echo "Entered password: " . $password . "<br>";
    echo "Hashed password from DB: " . $user['password'] . "<br>";
    var_dump(password_verify($password, $user['password']));
    exit();
    */


    //check password so it doesn't give me that error
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_ID'];    
        $_SESSION['username'] = $user['username'];
        header("Location: ../index.php");
        exit();
    } else {
        echo "Invalid login credentials.";
    }
} else {
    echo "User not found.";
}
/*
$result = $conn->query("SELECT * FROM users WHERE username='$username'");
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['username'] = $user['username'];
header("Location: ../index.php");
exit();
} else {
echo "Invalid login.";
}
} else {
echo "User not found.";
}
?>
*/
?>



