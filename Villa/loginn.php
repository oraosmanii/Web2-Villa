<?php
session_start();
include 'db_connection.php'; // include

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // fetch
    $stmt = $conn->prepare("SELECT username, password, salt FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($username, $hashed_password, $salt);
    $stmt->fetch();
    $stmt->close();

    // verify
    $email_exist = false;
    $passwordMatch = false;
    if ($hashed_password) {
        $email_exist = true;
        if (hash("sha256", $password . $salt) === $hashed_password) {
            $passwordMatch = true;
            $_SESSION['LogedIn'] = true;
            $_SESSION['USERNAME'] = $username;
            $_SESSION['EMAIL'] = $email;
            header("Location: index.php");
            exit();
        }
    }

    // login fails
    if (!$email_exist || !$passwordMatch) {
        $message = "<div class='signup-link'>Your credentials are not valid!</div>";
    }
// } else {
//     header("Location: yourLoginForm.html");
//     exit();
// }
?>
