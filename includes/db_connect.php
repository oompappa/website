<?php
// backup of actual hosted info while tasting
$servername = "sql313.infinityfree.com";
$username = "if0_39222676";
$password = "Geescheck1";
$dbname = "if0_39222676_on_notebook_marketplace";

//localhost info
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "notebook_marketplace";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
