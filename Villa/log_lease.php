<?php
function log_lease($user_id, $country, $city, $price, $bedrooms, $bathrooms, $area, $type, $description, $images) {
    $log_file = 'lease_log.txt';
    
    $file_handle = fopen($log_file, 'a');
    if (!$file_handle) {
        trigger_error("Could not open the log file for writing.", E_USER_WARNING);
        return;
    }
    
    $total_image_size = 0;
    foreach ($images as $image) {
        $total_image_size += filesize($image);
    }
    $total_image_size_mb = $total_image_size / (1024 * 1024); 

    $log_entry = "User ID: $user_id, Country: $country, City: $city, Price: $price, Bedrooms: $bedrooms, Bathrooms: $bathrooms, Area: $area m², Type: $type, Description: $description, Total Image Size: " . number_format($total_image_size_mb, 2) . " MB\n";
    
    fwrite($file_handle, $log_entry);
    
    fclose($file_handle);
}


function read_log_file() {
    $log_file = 'lease_log.txt';
    

    $file_handle = fopen($log_file, 'r');
    if (!$file_handle) {
        trigger_error("Could not open the log file for reading.", E_USER_WARNING);
        return;
    }
    

    $file_size = filesize($log_file);
    $log_content = fread($file_handle, $file_size);
    
 
    fclose($file_handle);
    
    return $log_content;
}
?>
