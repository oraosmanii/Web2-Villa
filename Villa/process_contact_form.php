<?php


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
            echo "<script>alert('Thanks for contacting us!'); window.location.href = '#sub-header';</script>";
        } else {
            echo "<script>alert('Failed to send email. Please try again later.'); window.location.href = '#contact-form';</script>";
        }
    } else {
        $error_message = "Invalid email address!";
        echo "<script>window.location.href = '#contact-form';</script>" . "<p style='color: red'>$error_message</p><br>";
    }
}
?>