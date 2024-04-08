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
    <style>
    .error {
        color: red;
        font-style: italic;
        font-size: small;
    }
    .success {
        color: green;
        font-style: italic, bold;
        font-size: small;
    }
</style>
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
<?php
// Define variables and initialize with empty values
$fullName = $email = $username = $password = $confirmPassword = $gender = "";
$passwordErr = $confirmPasswordErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['fullname'];
    $email = $_POST['newEmail'];
    $username = $_POST['newUsername'];
    $password = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $gender = $_POST['gender'];

    if ($password !== $confirmPassword) {
        $confirmPasswordErr = "*Passwords do not match";
    } elseif (strlen($password) < 8) {
        $passwordErr = "*Password must be at least 8 characters long";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $passwordErr = "*Password must contain at least one capital letter";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $passwordErr = "*Password must contain at least one number";
    } else {
        // No errors, signup successful
        $signupSuccess = true;
    }
}
?>

<div id="signup-form" class="cont cont1">
    <form id="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <a href="index.php" class="logo1">
            <h1>Villa</h1>
        </a> 
       
        <h2>Sign Up</h2>
        <label for="fullname">Full Name:</label> <br>
        <input type="text" id="fullname" name ="fullname"required placeholder="First name" autocomplete="name"> <br>
        <label for="email">Email</label> <br>
        <input type="email" name="newEmail" id="newEmail" placeholder="Email" required autocomplete="email"> <br> 
        <label for="newUsername">New Username:</label> <br>
        <input type="text" id="newUsername" name="newUsername" required placeholder="Username" autocomplete="username"> <br>
        <div>
        <label for="newPassword">Password:</label> <br>
        <input type="password" id="newPassword" name="newPassword" value="<?php echo $password; ?>"> <br>
        <div class="error"><?php echo $passwordErr; ?></div>
    </div>
    <div>
        <label for="confirmPassword">Confirm Password:</label> <br>
        <input type="password" id="confirmPassword" name="confirmPassword" value="<?php echo $confirmPassword; ?>"> <br>
        <div class="error"><?php echo $confirmPasswordErr; ?></div>
    </div>

        <label for="gender">Gender:</label> <br>
        <input type="radio" name="gender" id="gender1" form="signup">
        <label class="gender" for="gender1" id="gender1">Female</label>
        <input type="radio" name="gender" id="gender2" form="signup">
        <label class="gender" for="gender2">Male</label>
        <input type="radio" name="gender" id="gender3" form="signup">
        <label  for="gender3">Other</label> <br> 
       <br>
       <?php if(isset($signupSuccess) && $signupSuccess): ?>
    <div class="success">Signup successful</div>
<?php endif; ?> <br>
        <button type="submit" class="submit" id="signupButton">Sign Up</button>
        <h3>Already have an account? <i><a href="#" id="loginLink">Login!</a></i> </h3>
    </form>













    <?php
// // Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve form data
//     $fullName = $_POST['fullname'];
//     $email = $_POST['newEmail'];
//     $username = $_POST['newUsername'];
//     $password = $_POST['newPassword'];
//     $confirmPassword = $_POST['confirmPassword'];
//     $gender = $_POST['gender'];

//     if ($password !== $confirmPassword) {
//         echo "<script>alert('Passwords do not match'); 
//         window.location.href = '#signup-form';
//         document.getElementById('loginForm').style.display = 'none';
//         document.getElementById('signup-form').style.display = 'block';</script>";
//         exit; // Stop further execution
//     } elseif (strlen($password) < 8) {
//         echo "<script>alert('Password must be at least 8 characters long'); 
//         window.location.href = '#signup-form';
//         document.getElementById('loginForm').style.display = 'none';
//         document.getElementById('signup-form').style.display = 'block';</script>";
//         exit; // Stop further execution
//     } elseif (!preg_match("/[A-Z]/", $password)) {

//         echo "<script>alert('Password must contain at least one capital letter'); 
//         window.location.href = '#signup-form';
//         document.getElementById('loginForm').style.display = 'none';
//         document.getElementById('signup-form').style.display = 'block';</script>";
//         exit; // Stop further execution
//     } elseif (!preg_match("/[0-9]/", $password)) {
//         echo "<script>alert('Password must contain at least one number'); 
//         window.location.href = '#signup-form';
//         document.getElementById('loginForm').style.display = 'none';
//         document.getElementById('signup-form').style.display = 'block';</script>";
//         exit; 
//     } else {
        
//         echo "<script>alert('Signup successful');</script>";
       
//     }
// }
// ?>




   
</div>

<script src="assets/js/login.js"></script>

</body>
</html>