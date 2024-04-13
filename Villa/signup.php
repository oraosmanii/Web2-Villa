<?php
$message = ''; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the posted form data
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password']; // This should be securely hashed before storing

    // Read the file contents
    $file_content = file("users.txt", FILE_IGNORE_NEW_LINES);
    $email_exist = false;

    // Check if the email already exists in the file
    foreach ($file_content as $line) {
        list($file_email,) = explode("~", $line);
        if ($file_email === $email) {
            $email_exist = true;
            break;
        }
    }

    // Prepare the message according to the email check
    if ($email_exist) {
        $message = "<p style='color: red;'>An account with this email already exists.</p>";
    } else {
        // If the email doesn't exist, append the new user data to the file
        // and possibly redirect to a 'thank you' page or similar
        // [Handle user creation logic here]
        $message = "<p style='color: green;'>Your account has been successfully created.</p>";
    }
}
?>