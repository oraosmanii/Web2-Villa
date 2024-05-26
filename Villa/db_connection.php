<?php
$servername = "localhost";
$username = "root";
$password = "Password"; 
$dbname = "villadb"; 
$port = 3307;


$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tables = [
    "users" => "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        salt VARCHAR(255) NOT NULL
    )",
    "properties" => "CREATE TABLE IF NOT EXISTS properties (
        id INT AUTO_INCREMENT PRIMARY KEY,
        country VARCHAR(255) NOT NULL,
        city VARCHAR(255) NOT NULL,
        date DATE NOT NULL,
        image VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        bedrooms INT NOT NULL,
        bathrooms INT NOT NULL,
        area INT NOT NULL,
        type VARCHAR(50) NOT NULL,
        description TEXT NOT NULL
    )",
    "bookings" => "CREATE TABLE IF NOT EXISTS bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        property_id INT NOT NULL,
        arrival_date DATE NOT NULL,
        departure_date DATE NOT NULL,
        phone_number VARCHAR(20) NOT NULL,
        payment_method VARCHAR(255) NOT NULL,
        comment TEXT,
        total_price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (property_id) REFERENCES properties(id)
    )",
    "ratings" => "CREATE TABLE IF NOT EXISTS ratings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        property_id INT NOT NULL,
        rating INT NOT NULL,
        UNIQUE KEY unique_rating (user_id, property_id),
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (property_id) REFERENCES properties(id)
    )",
    "listings" => "CREATE TABLE IF NOT EXISTS listings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        property_id INT NOT NULL,
        country VARCHAR(255) NOT NULL,
        city VARCHAR(255) NOT NULL,
        date DATE NOT NULL,
        image VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        bedrooms INT NOT NULL,
        bathrooms INT NOT NULL,
        area INT NOT NULL,
        type VARCHAR(50) NOT NULL,
        description TEXT NOT NULL
    )"
];
foreach ($tables as $sql) {
    $conn->query($sql);
}
?>