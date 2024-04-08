<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; 

 
    $data = $email . ',' . $password . "\n";


    file_put_contents("users.txt", $data, FILE_APPEND);


    echo "Signup successful. <a href='logincopy.php'>Login here</a>";
} else {

    header("Location: logincopy.php");
}
?>
