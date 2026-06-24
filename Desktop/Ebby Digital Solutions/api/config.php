<?php

// ======================================
// EBBY DIGITAL SOLUTIONS
// DATABASE CONFIGURATION
// ======================================

$host = "localhost";
$username = "root";
$password = "";
$database = "ebby_digital";

$conn = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Set UTF-8
mysqli_set_charset($conn, "utf8");

?>
