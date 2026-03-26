<?php
$conn = new mysqli("localhost", "root", "", "cet_exam");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>
