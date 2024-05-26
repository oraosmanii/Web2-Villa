
<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listing_id = intval($_POST['listing_id']);
    $user_id = $_SESSION['USER_ID'];

    $stmt = $conn->prepare("DELETE FROM listings WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $listing_id, $user_id);

    $response = [];
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }
    $stmt->close();

    echo json_encode($response);
}
?>