<?php
include 'db_connection.php'; // Database connection

define("MINLENGTH", 8);
$message = ''; // Message

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Check email
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $email_exist = $stmt->num_rows > 0;
    $stmt->close();

    // Check username
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $username_exist = $stmt->num_rows > 0;
    $stmt->close();

    // Validation
    if (strlen($password) < MINLENGTH) {
        $message = "<p style='color: red; font-size: 16px;'>Password is too short. It must be at least 8 characters.</p>";
    } elseif ($password !== $confirmpassword) {
        $message = "<p style='color: red; font-size: 16px;'>Passwords do not match.</p>";
    } elseif ($email_exist) {
        $message = "<p style='color: red; font-size: 16px;'>An account with this email already exists.</p>";
    } elseif ($username_exist) {
        $message = "<p style='color: red; font-size: 16px;'>This username is already taken.</p>";
    } else {
        // Salt
        $salt = bin2hex(random_bytes(16)); // 32 characters salt

        // Hash with salt
        $hashed_password = hash("sha256", $password . $salt);

        // If validation with salt
        $stmt = $conn->prepare("INSERT INTO users (email, username, password, salt) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $username, $hashed_password, $salt);

        if ($stmt->execute()) {
            $message = "<p style='color: green; font-size: 16px;'>Account created successfully.</p>";

            // Send confirmation email
            $to = $email;
            $subject = 'Welcome to Our Property Rental Service';
            $body = "<html><body>
                        <h2>Welcome, $username!</h2>
                        <p>Thank you for signing up. We are excited to have you with us.</p>
                    </body></html>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Villa <villaweb2324@gmail.com>' . "\r\n";

            if (mail($to, $subject, $body, $headers)) {
                $message .= "<p style='color: green; font-size: 16px;'>A confirmation email has been sent to your email address.</p>";
            } else {
                $message .= "<p style='color: red; font-size: 16px;'>Confirmation email could not be sent.</p>";
            }
        } else {
            $message = "<p style='color: red; font-size: 16px;'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    $conn->close();
}
?>