<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['USER_ID']; 
    $property_id = $_POST['property_id'];
    $arrival_date = $_POST['arrival_date'];
    $departure_date = $_POST['departure_date'];


    $current_date = date('Y-m-d');
    if ($arrival_date < $current_date || $departure_date <= $arrival_date) {
        echo json_encode(["message" => "Invalid date range.", "redirect" => false]);
        exit;
    }

    
    $stmt = $conn->prepare("
        SELECT COUNT(*) FROM bookings 
        WHERE property_id = ? 
        AND (arrival_date < ? AND departure_date > ?)
    ");
    $stmt->bind_param("iss", $property_id, $departure_date, $arrival_date);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo json_encode(["message" => "Selected dates are already booked.", "redirect" => false]);
        exit;
    }


    $stmt = $conn->prepare("
        INSERT INTO bookings (user_id, property_id, arrival_date, departure_date) 
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("iiss", $user_id, $property_id, $arrival_date, $departure_date);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["message" => "Booking successful.", "redirect" => "mybookings.php"]);
    exit;
}
?>
