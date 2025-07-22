<?php
$host = "localhost";
$user = "topwinx1_donation";
$pass = "topwinx1_donation";
$db   = "topwinx1_donation";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>