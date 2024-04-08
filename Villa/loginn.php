<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $isValid = false;
    $users = file("users.txt");
    foreach ($users as $user) {
        list($savedEmail, $savedPassword) = explode(',', trim($user));
        if ($savedEmail == $email && $savedPassword == $password) {
            $isValid = true;
            break;
        }
    }

    if ($isValid) {
        echo "Login successful. Welcome back!";

    } else {
        echo "Login failed. Invalid credentials.";

    }
} else {
    header("Location: yourLoginForm.html");
}
?>
