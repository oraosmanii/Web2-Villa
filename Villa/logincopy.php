<?php

session_start();
if(isset($_POST['login'])){
              if (!empty($_POST["email"]) && !empty($_POST["password"])){
                $email=$_POST["email"];
                $password=hash("sha256",$_POST["password"]);
                $file_content=file("users.txt",FILE_IGNORE_NEW_LINES);
                $username;
                $email_exist=false;
                $passwordMatch=false;
                foreach($file_content as $line){
                  $params=explode("~",$line);
                  if($params[0]===$email){
                    $email_exist=true;
                    if ($params[2]===$password){
                      $passwordMatch=true;
                      $username=$params[1];
                    }
                    break;
                  }
                  
                }
                if($email_exist && $passwordMatch){
                    $_SESSION['LogedIn']=true;
                    $_SESSION['USERNAME']=$username;
                    $_SESSION['EMAIL']=$email;
                    header("Location:index.php");
                  }
                }
              }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Villa | Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
html,body{
  display: grid;
  height: 100%;
  width: 100%;
  place-items: center;

}
::selection{
  background: #f35525;
  color: #fff;
}
.wrapper{
  overflow: hidden;
  max-width: 390px;
  background: #fff;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
}
.wrapper .title-text{
  display: flex;
  width: 200%;
}
.wrapper .title{
  width: 50%;
  font-size: 30px;
  font-weight: 600;
  text-align: center;
  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
}
.wrapper .slide-controls{
  position: relative;
  display: flex;
  height: 50px;
  width: 100%;
  overflow: hidden;
  margin: 30px 0 10px 0;
  justify-content: space-between;
  border: 1px solid lightgrey;
  border-radius: 15px;
}
.slide-controls .slide{
  height: 100%;
  width: 100%;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  text-align: center;
  line-height: 48px;
  cursor: pointer;
  z-index: 1;
  transition: all 0.6s ease;
}
.slide-controls label.signup{
  color: #000;
}
.slide-controls .slider-tab{
  position: absolute;
  height: 100%;
  width: 50%;
  left: 0;
  z-index: 0;
  border-radius: 15px;
  background: -webkit-linear-gradient(left, #c44620, #e24d1f, #f4420b, #ff6333);
  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
}
input[type="radio"]{
  display: none;
}
#signup:checked ~ .slider-tab{
  left: 50%;
}
#signup:checked ~ label.signup{
  color: #fff;
  cursor: default;
  user-select: none;
}
#signup:checked ~ label.login{
  color: #000;
}
#login:checked ~ label.signup{
  color: #000;
}
#login:checked ~ label.login{
  cursor: default;
  user-select: none;
}
.wrapper .form-container{
  width: 100%;
  overflow: hidden;
}
.form-container .form-inner{
  display: flex;
  width: 200%;
}
.form-container .form-inner form{
  width: 50%;
  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
}
.form-inner form .field{
  height: 50px;
  width: 100%;
  margin-top: 20px;
}
.form-inner form .field input{
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 15px;
  border-radius: 15px;
  border: 1px solid lightgrey;
  border-bottom-width: 2px;
  font-size: 17px;
  transition: all 0.3s ease;
}
.form-inner form .field input:focus{
  border-color: #f35525;
}
.form-inner form .field input::placeholder{
  color: #999;
  transition: all 0.3s ease;
}
form .field input:focus::placeholder{
  color: #f35525;
}
.form-inner form .pass-link{
  margin-top: 5px;
}
.form-inner form .signup-link{
  text-align: center;
  margin-top: 30px;
}
.form-inner form .pass-link a,
.form-inner form .signup-link a{
  color: #f35525;
  text-decoration: none;
}
.form-inner form .pass-link a:hover,
.form-inner form .signup-link a:hover{
  text-decoration: underline;
}
form .btn{
  height: 50px;
  width: 100%;
  border-radius: 15px;
  position: relative;
  overflow: hidden;
}
form .btn .btn-layer{
  height: 100%;
  width: 300%;
  position: absolute;
  left: -100%;
  background: -webkit-linear-gradient(right, #c44620, #e24d1f, #f4420b, #ff6333);
  border-radius: 15px;
  transition: all 0.4s ease;;
}
form .btn:hover .btn-layer{
  left: 0;
}
form .btn input[type="submit"]{
  height: 100%;
  width: 100%;
  z-index: 1;
  position: relative;
  background: none;
  border: none;
  color: #fff;
  padding-left: 0;
  border-radius: 15px;
  font-size: 20px;
  font-weight: 500;
  cursor: pointer;
}
.field.btn {
  display: flex; 
  justify-content: center; 
  align-items: center; 
  position: relative; 
  overflow: hidden; 
  height: 50px; 
  width: 100%; 
  border-radius: 15px; 
}


.btn-layer {
  width: 100%; 
}

form .btn input[type="submit"] {
  width: auto;
  margin: 0; 
}
.logo1{
  width: 100%;
  text-align: center;

}



</style>
</head>
<body>


<div class="wrapper">
<a href="index.php" class="logo1">
            <h1>Villa</h1>
        </a> <br> <br>
      <div class="title-text">
        <div class="title login">Login</div>
        <div class="title signup">Signup</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">


          <!-- LOGIN -->
          <form action="logincopy.php" method="post" class="login">
            <div class="field">
            <input type="text" name="email" placeholder="Email Address" required>
            </div>
            <div class="field">
            <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="login" value="Login">
            </div>
            <?php
            if(isset($_POST['login'])){
            global $email_exist;
            global $passwordMatch;
              if(!$email_exist){
                echo "<div class='signup-link' >Your credentials are not valid!</div>";
              }
              else{
                if(!$passwordMatch){
                  echo "<div class='signup-link' >Your credentials are not valid!</div>";
                }
              }
            }
            ?>
            <div class="signup-link">Not a member? <a href="">Signup now</a></div>
          </form>


          <!-- SIGNUP -->
          <form id="signupf" action="logincopy.php" method="post" class="signup">
            <div class="field">
            <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="field">
            <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="field">
            <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="field">
            <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="signup" value="Signup">
            </div>
            <?php 
            include_once'signup.php';
            if (!empty($message)){
                echo $message; 
            }?>
          </form>
        </div>
      </div>
    </div>

    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
      <?php 
      if (isset($_POST['signup'])){
        echo "signupBtn.click();";
      }
      ?>
    </script>

</body>
</html>