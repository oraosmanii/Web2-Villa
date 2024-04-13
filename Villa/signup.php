<?php
$message = ''; // Initialize message variable
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

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

    // Check if the username already exists in the file
    $username_exist = false;
    foreach ($file_content as $line) {
        list(,$file_username,) = explode("~", $line);
        if ($file_username === $username) {
            $username_exist = true;
            break;
        }
    }

    // Validate password length
    if (strlen($password) < 8) {
        $message = "<p style='color: red; font-size: 16px;'>Password is too short. It must be at least 8 characters.</p>";
    } elseif ($password !== $confirmpassword) {
        $message = "<p style='color: red; font-size: 16px;'>Passwords do not match.</p>";
    } elseif ($email_exist) {
        $message = "<p style='color: red; font-size: 16px;'>An account with this email already exists.</p>";
    } elseif ($username_exist) {
        $message = "<p style='color: red; font-size: 16px;'>This username is already taken.</p>";
    } else {
        // Hash the password using PASSWORD_DEFAULT algorithm
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // If validations pass, append the new user data to the file
        file_put_contents("users.txt", "$email~$username~$hashed_password\n", FILE_APPEND);
        $message = "<p style='color: green; font-size: 16px;'>Account created successfully.</p>";
    }
}
?>
