<?php
include 'db_connection.php'; // databaza

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



define("minlength", 8);
$message = ''; // mesazhi

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];


    // check email
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $email_exist = $stmt->num_rows > 0;
    $stmt->close();

    // checkusername
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $username_exist = $stmt->num_rows > 0;
    $stmt->close();

    // validimi
    if (strlen($password) < minlength) {
        $message = "<p style='color: red; font-size: 16px;'>Password is too short. It must be at least 8 characters.</p>";
    } elseif ($password !== $confirmpassword) {
        $message = "<p style='color: red; font-size: 16px;'>Passwords do not match.</p>";
    } elseif ($email_exist) {
        $message = "<p style='color: red; font-size: 16px;'>An account with this email already exists.</p>";
    } elseif ($username_exist) {
        $message = "<p style='color: red; font-size: 16px;'>This username is already taken.</p>";
    } else {
        // salt
        $salt = bin2hex(random_bytes(16)); // 32 characters salt

        // hash with salt
        $hashed_password = hash("sha256", $password . $salt);

        // if validimi me salt
        $stmt = $conn->prepare("INSERT INTO users (email, username, password, salt) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $username, $hashed_password, $salt);

if ($stmt->execute()) {
            $message = "<p style='color: green; font-size: 16px;'>Account created successfully.</p>";

            // Send confirmation email
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'villaweb2324@gmail.com';             // SMTP username
                $mail->Password = 'nuun jheb tjsy wrdc';              // SMTP password
                $mail->SMTPSecure = 'ssl';   // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    // TCP port to connect to

                // Recipients
                $mail->setFrom('villaweb2324@gmail.com', 'Villa');  // Replace with your email and name
                $mail->addAddress($email, $username);                 // Add a recipient

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Welcome to Our Property Rental Service';
                $mail->Body    = "<html><body>
                                  <h2>Welcome, $username!</h2>
                                  <p>Thank you for signing up. We are excited to have you with us.</p>
                                  </body></html>";

                $mail->send();
                $message .= "<p style='color: green; font-size: 16px;'>A confirmation email has been sent to your email address.</p>";
            } catch (Exception $e) {
                $message .= "<p style='color: red; font-size: 16px;'>Confirmation email could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
            }
        } else {
            $message = "<p style='color: red; font-size: 16px;'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    $conn->close();
}
?>
