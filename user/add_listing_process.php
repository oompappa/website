<?php
session_start();
include '../includes/db_connect.php';

// login check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// sanitisation that hopefully works
$seller_id    = $_SESSION['user_id'];
$product_name = $conn->real_escape_string(trim($_POST['product_name']));
$price_input  = trim($_POST['price']);
$description  = $conn->real_escape_string(trim($_POST['description']));

// price check
if (!is_numeric($price_input)) {
    die("Invalid price format. Please enter a number.");
}
$price = number_format((float)$price_input, 2, '.', '');

// image upload
$image_path = null; // default if no image

if (!empty($_FILES['image']['name'])) {
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName    = basename($_FILES['image']['name']);
        $fileSize    = $_FILES['image']['size'];
        $fileType    = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed     = ['jpg', 'jpeg', 'png', 'gif'];

        // check file extension and size 
        if (in_array($fileType, $allowed) && $fileSize <= 2 * 1024 * 1024) {
            // create a unique filename 
            $newFileName = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $fileName);
            $uploadDir   = '../assets/images/';
            $destPath    = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $image_path = $conn->real_escape_string($destPath);
            } else {
                die("Error moving the uploaded file.");
            }
        } else {
            die("Invalid image type or file too large (max 2MB).");
        }
    } else {
        die("File upload error code: " . $_FILES['image']['error']);
    }
}

// 4. Insert the new listing into the database
$stmt = $conn->prepare("
    INSERT INTO listings (seller_ID, product_name, price, description, image)
    VALUES (?, ?, ?, ?, ?)
");
$stmt->bind_param("isdss", $seller_id, $product_name, $price, $description, $image_path);

if ($stmt->execute()) {
    // 5. Redirect back to homepage on success
    header("Location: ../index.php");
    exit();
} else {
    echo "Error inserting listing: " . $conn->error;
}
