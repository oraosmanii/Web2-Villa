<?php

//Inicializohet array per ruajtjen e informatave
$properties = [];
//Lexohet file
$file = fopen('Places.txt', 'r+');

//Loop ne cdo rresht
while (!feof($file)) {
    $line = fgets($file);
    $cards = urlencode($line);
    $parts = explode(',', $line); //Ndahet ne presje

    $property = [     //varg asociativ
        'country' => $parts[0],
        'city' => $parts[1],
        'date' => $parts[2],
        'image' => $parts[3],
        'price' => (int)$parts[4],
        'bathrooms' => (int)$parts[5],
        'bedrooms' => (int)$parts[6],
        'area' => (int)$parts[7],
        'type' => ucwords($parts[8]),
        'card'=> $cards
    ];
    $properties[$parts[0]][] = $property;// Vendoset ne array
}
fclose($file);

// Nese forma behet submit
if (isset($_POST['sort'])) {
    //Merr opsionin e selektuar
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
    }elseif ($sort == 'beds-asc') {
       // Nr.krevateve ne rritje
        usort($properties, function ($a, $b) {
                return $a[0]['bedrooms'] <=> $b[0]['bedrooms'];
        });
    }
    elseif ($sort == 'beds-desc') {
        // E kunderta
        usort($properties, function ($a, $b) {
            return $b[0]['bedrooms'] <=> $a[0]['bedrooms'];
    });
    }
    $_SESSION['properties'] = $properties;
    
}

?>