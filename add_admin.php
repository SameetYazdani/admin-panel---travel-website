<?php
include '../db.php'; // or 'db.php' if inside same folder

$name = "Admin";
$email = "admin@gmail.com";
$password = "admin123";

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO admins (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $hashedPassword);

if ($stmt->execute()) {
    echo "Admin added successfully!";
} else {
    echo "Error: " . $stmt->error;
}
