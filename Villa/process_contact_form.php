<?php
include "errors.php";
global $errors;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $email_pattern = '/^[a-zA-Z][a-zA-Z0-9_]*@[a-zA-Z.]+$/';

    if (preg_match($email_pattern, $email)) {
        $to = 'villaweb2324@gmail.com';
        $headers = 'From: ' . $email . "\r\n" .
                   'Reply-To: ' . $email . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        $full_message = "Name: $name\n\n";
        $full_message .= "Email: $email\n\n";
        $full_message .= "Subject: $subject\n\n";
        $full_message .= "Message: $message\n\n";

        if (mail($to, $subject, $full_message, $headers)) {
            echo "Message was sent. Thanks for contacting us!";
        } else {
            echo $errors['E015'];
        }
    } else {
        $error_message = $errors['E014'];
        echo $error_message;
    }
}
?>