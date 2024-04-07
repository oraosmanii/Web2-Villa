<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentify | Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div id="loginForm" class="cont">

    <form action="#">
         <!-- ***** Logo Start ***** -->
         <a href="index.php" class="logo1">
            <h1>Villa</h1>
        </a> <br> <br>
        <h2>Welcome</h2>
        <label for="email">Email</label> <br>
        <input type="email" name="email" id="email" placeholder="Email" required autocomplete="email"> <br> <br>
        <label for="password">Password</label> <br>
        <input id="password" type="password" placeholder="Password" required autocomplete="current-password"> <br>
        <p style="font-style: italic;">Forgot password?</p>
        <button type="submit" class="submit" id="loginFormButton">Log In</button>
        <h3>Don't have an account? Please <i><a id="signupLink" href="#">Sign up!</a></i></h3>
    </form>


</div>

<div id="signup-form" class="cont cont1">
    <form id="signup" action="#">
        <a href="index.php" class="logo1">
            <h1>Villa</h1>
        </a> 
        <h2>Sign Up</h2>
        <label for="firstname">Full Name:</label> <br>
        <input type="text" id="firstname" required placeholder="First name" autocomplete="name"> <br>
        <label for="email">Email</label> <br>
        <input type="email" name="email" id="email" placeholder="Email" required autocomplete="email"> <br> 
        <label for="newUsername">New Username:</label> <br>
        <input type="text" id="newUsername" name="newUsername" required placeholder="Username" autocomplete="username"> <br>
        <label for="newPassword">New Password:</label> <br>
        <input type="password" id="newPassword" name="newPassword" required placeholder="Password" autocomplete="off"> <br>
        <label for="confirmPassword">Confirm password:</label> <br>
        <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Password" autocomplete="off"> <br>
        <label for="gender">Gender:</label> <br>
        <input type="radio" name="gender" id="gender1" form="signup">
        <label class="gender" for="gender1" id="gender1">Female</label>
        <input type="radio" name="gender" id="gender2" form="signup">
        <label class="gender" for="gender2">Male</label>
        <input type="radio" name="gender" id="gender3" form="signup">
        <label  for="gender3">Other</label> <br> <br>
       <br>
    

        <button type="submit" class="submit" id="signupButton">Sign Up</button>
        <h3>Already have an account? <i><a href="#" id="loginLink">Login!</a></i> </h3>
    </form>
    <?php
    session_start();
    if(isset($_SESSION['error'])) {
        echo "<script>alert('" . $_SESSION['error'] . "');</script>";
        unset($_SESSION['error']);
    }
    ?>
    <?php
//session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $username = $_POST['newUsername'];
    $password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];
    $gender = $_POST['gender'];

    
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $password)) {
        
        $_SESSION['error'] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.";
        header("Location: login.php#signupLink");
        exit();
    }

    
    if ($password !== $confirm_password) {
        
        $_SESSION['error'] = "Passwords do not match. Please try again.";
        header("Location: login.php#signupLink");
        exit();
    }

    
    echo "Signup Successful!<br>";
    echo "Full Name: $fullname<br>";
    echo "Username: $username<br>";
    echo "Gender: $gender<br>";
}
?>
   
</div>

<script src="assets/js/login.js"></script>

</body>
</html>