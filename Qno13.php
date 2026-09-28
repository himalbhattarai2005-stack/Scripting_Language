<?php
$conn = new mysqli("localhost", "root", "", "college");

$username = $_GET['username'];

$result = $conn->query("SELECT * FROM users WHERE username='$username'");

echo $result->num_rows ? "Username available" : "Username not available";
?>