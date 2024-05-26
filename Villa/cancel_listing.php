<?php
session_start();
include 'db_connection.php'; // Include database connection

if (!isset($_SESSION['USER_ID'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $listing_id = intval($_POST['listing_id']);
    $user_id = $_SESSION['USER_ID'];

    // Check if the listing belongs to the user
    $stmt = $conn->prepare("SELECT * FROM listings WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $listing_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Listing belongs to the user, proceed to delete
        $stmt = $conn->prepare("DELETE FROM listings WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $listing_id, $user_id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Listing deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete listing.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Listing not found or does not belong to the user.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
$conn->close();
?>