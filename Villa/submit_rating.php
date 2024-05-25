<?php
session_start();
include 'db_connection.php';

if (isset($_POST['rating']) && isset($_POST['property_id']) && isset($_SESSION['USER_ID'])) {
    $user_id = $_SESSION['USER_ID'];
    $property_id = $_POST['property_id'];
    $rating = intval($_POST['rating']);


    $stmt = $conn->prepare("SELECT id FROM ratings WHERE user_id = ? AND property_id = ?");
    if (!$stmt) {
        echo "<script>alert('Prepare failed: (" . $conn->errno . ") " . $conn->error . "'); window.history.back();</script>";
        exit();
    }
    $stmt->bind_param("ii", $user_id, $property_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {

        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO ratings (user_id, property_id, rating) VALUES (?, ?, ?)");
        if (!$stmt) {
            echo "<script>alert('Prepare failed: (" . $conn->errno . ") " . $conn->error . "'); window.history.back();</script>";
            exit();
        }
        $stmt->bind_param("iii", $user_id, $property_id, $rating);
        $stmt->execute();
        $stmt->close();
    } else {

        echo "<script>alert('You have already rated this property.'); window.history.back();</script>";
        exit();
    }


    $stmt = $conn->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE property_id = ?");
    if (!$stmt) {
        echo "<script>alert('Prepare failed: (" . $conn->errno . ") " . $conn->error . "'); window.history.back();</script>";
        exit();
    }
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $stmt->bind_result($avg_rating);
    $stmt->fetch();
    $stmt->close();


    $stmt = $conn->prepare("UPDATE properties SET average_rating = ? WHERE id = ?");
    if (!$stmt) {
        echo "<script>alert('Prepare failed: (" . $conn->errno . ") " . $conn->error . "'); window.history.back();</script>";
        exit();
    }
    $stmt->bind_param("di", $avg_rating, $property_id);
    $stmt->execute();
    $stmt->close();


    echo "<script>alert('Thank you for your feedback!'); window.location.href = 'property-details.php?info=" . urlencode($property_id) . "';</script>";
    exit();
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>
