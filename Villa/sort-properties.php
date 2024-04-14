
<?php
// Start the session
//session_start();

// Initialize an empty array to store the data
$properties = [];

// Open the file for reading
$file = fopen('Places.txt', 'r');

// Loop through each line in the file
while (!feof($file)) {
    // Read a line
    $line = fgets($file);

    // Explode the line into parts
    $parts = explode(',', $line);

    // Create an associative array for this line
    $property = [
        'country' => $parts[0],
        'city' => $parts[1],
        'date' => $parts[2],
        'photo' => $parts[3],
        'price' => (int)$parts[4],
        'bathrooms' => (int)$parts[5],
        'bedrooms' => (int)$parts[6],
        'space' => (int)$parts[7],
        'type' => $parts[8]
    ];

    // Add this entry to the data array, using the country as the key
    $properties[$parts[0]][] = $property;
}

// Close the file
fclose($file);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the selected sort option
    $sort = $_POST['sort'];

    // Sort the data based on the selected option
    if ($sort == 'price-asc') {
        // Sort by price in ascending order
        usort($properties, function ($a, $b) {
            return $a[0]['price'] <=> $b[0]['price'];
        });
    } elseif ($sort == 'price-desc') {
        // Sort by price in descending order
        usort($properties, function ($a, $b) {
            return $b[0]['price'] <=> $a[0]['price'];
        });
    } elseif ($sort == 'name-asc') {
        // Sort by country name in ascending order
        ksort($properties);
    } elseif ($sort == 'name-desc') {
        // Sort by country name in descending order
        krsort($properties);
    }

    echo '<pre>'; print_r($properties); echo '</pre>';


    // Store the sorted data in the session
    //$_SESSION['properties'] = $properties;

    

    // Redirect the user back to the properties.php page
    //header('Location: properties.php');
    //exit;
}




?>