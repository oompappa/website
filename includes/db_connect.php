<?php
$servername = "sql313.infinityfree.com";
$username = "if0_39222676";
$password = "Geescheck1";
$dbname = "if0_39222676_XXX";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
