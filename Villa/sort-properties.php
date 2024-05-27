<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'db_connection.php'; 

// Inicializohet array per ruajtjen e informatave
$properties = [];

// Fetch properties from the database
$sql = "SELECT * FROM listings";
$result = $conn->query($sql);

// Loop ne cdo rresht
while ($row = $result->fetch_assoc()) {
    $cards = urlencode($row['id']); 
    
   
    $images = json_decode($row['image'], true);
    $imagePath = !empty($images) ? $images[0] : 'default-image-path.jpg';

    $property = [     // varg asociativ
        'user_id' => $row['user_id'],
        'country' => $row['country'],
        'city' => $row['city'],
        'date' => $row['date'],
        'image' => $imagePath,
        'price' => (int)$row['price'],
        'bathrooms' => (int)$row['bathrooms'],
        'bedrooms' => (int)$row['bedrooms'],
        'area' => (int)$row['area'],
        'type' => ucwords($row['type']),
        'card' => $cards
    ];
    $properties[$row['id']][] = $property; // Vendoset ne array
}

// Nese forma behet submit
if (isset($_POST['sort'])) {
    // Merr opsionin e selektuar
    $sort = $_POST['sort'];
    if ($sort == 'price-asc') {
        // Cmimi ne rritje
        usort($properties, function ($a, $b) {
            return $a[0]['price'] <=> $b[0]['price'];
        });
    } elseif ($sort == 'price-desc') {
        // Cmimi ne zvogelim
        usort($properties, function ($a, $b) {
            return $b[0]['price'] <=> $a[0]['price'];
        });
    } elseif ($sort == 'name-asc') {
        // Emri i vendit alfabetikisht
        ksort($properties);
    } elseif ($sort == 'name-desc') {
        // Emri i vendit anasjelltas
        krsort($properties);
    } elseif ($sort == 'beds-asc') {
        // Nr.krevateve ne rritje
        usort($properties, function ($a, $b) {
            return $a[0]['bedrooms'] <=> $b[0]['bedrooms'];
        });
    } elseif ($sort == 'beds-desc') {
        // E kunderta
        usort($properties, function ($a, $b) {
            return $b[0]['bedrooms'] <=> $a[0]['bedrooms'];
        });
    }
    $_SESSION['properties'] = $properties;
}

?>




