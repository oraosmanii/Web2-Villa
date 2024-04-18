<?php
// Set cookie name and expiration time
$cookie_name = "user_location";
$cookie_expiration = time() + (60*60*24*30);  //30 days
// Get the selected location from the form
$selected_location = $_POST["location"];

// Set the cookie with the selected location
setcookie($cookie_name, $selected_location, $cookie_expiration);

// Redirect back to the main page
header("Location: index.php");


?>