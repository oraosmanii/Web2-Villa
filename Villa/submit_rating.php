<?php
session_start();
include 'db_connection.php';

header('Content-Type: application/json');

$response = array('message' => '', 'redirect' => '');

if (isset($_POST['rating']) && isset($_POST['property_id']) && isset($_SESSION['USER_ID'])) {
    $user_id = $_SESSION['USER_ID'];
    $property_id = $_POST['property_id'];
    $rating = intval($_POST['rating']);

    $stmt = $conn->prepare("SELECT id FROM ratings WHERE user_id = ? AND property_id = ?");
    if (!$stmt) {
        $response['message'] = 'Prepare failed: (' . $conn->errno . ') ' . $conn->error;
        echo json_encode($response);
        exit();
    }
    $stmt->bind_param("ii", $user_id, $property_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO ratings (user_id, property_id, rating) VALUES (?, ?, ?)");
        if (!$stmt) {
            $response['message'] = 'Prepare failed: (' . $conn->errno . ') ' . $conn->error;
            echo json_encode($response);
            exit();
        }
        $stmt->bind_param("iii", $user_id, $property_id, $rating);
        $stmt->execute();
        $stmt->close();
    } else {
        $response['message'] = 'You have already rated this property.';
        echo json_encode($response);
        exit();
    }

    $stmt = $conn->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE property_id = ?");
    if (!$stmt) {
        $response['message'] = 'Prepare failed: (' . $conn->errno . ') ' . $conn->error;
        echo json_encode($response);
        exit();
    }
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $stmt->bind_result($avg_rating);
    $stmt->fetch();
    $stmt->close();

    $response['message'] = 'Thank you for your feedback!';
    $response['redirect'] = 'property-details.php?info=' . urlencode($property_id);
    echo json_encode($response);
    exit();
} else {
    $response['message'] = 'Invalid request.';
    echo json_encode($response);
}
?>