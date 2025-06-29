<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "your live server";
$username   = "your live db user";
$password   = "your live db password";
$dbname     = "your live db name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
