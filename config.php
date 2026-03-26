<?php
$conn = new mysqli("sql301.infinityfree.com", "if0_41469072", "", "if0_41469072_cet_exam");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>