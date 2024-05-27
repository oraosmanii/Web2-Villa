<?php
session_start();
include 'db_connection.php';
include "errors.php";
global $errors;
require 'log_lease.php'; 

set_error_handler("customErrorHandler");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $country = htmlspecialchars($_POST['country']);
    $city = htmlspecialchars($_POST['city']);
    $phone = htmlspecialchars($_POST['phone']);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $area = filter_var($_POST['area'], FILTER_SANITIZE_NUMBER_INT);
    $bedrooms = filter_var($_POST['bedrooms'], FILTER_SANITIZE_NUMBER_INT);
    $bathrooms = filter_var($_POST['bathrooms'], FILTER_SANITIZE_NUMBER_INT);
    $description = htmlspecialchars($_POST['message']);
    $type = htmlspecialchars($_POST['type']);
    $images = [];

    if (empty($email) || empty($country) || empty($city) || empty($phone) || empty($price) || empty($area) || empty($bedrooms) || empty($bathrooms) || empty($description) || empty($type)) {
      $error_message= $errors['E005'];
      trigger_error($error_message);
      exit();
    }

    // Phone number validation
    if (!preg_match('/^\+[0-9]{1,11}$/', $phone)) {
      $error_message = $errors['E004'];
      trigger_error($error_message);  
      exit();
    }

    if (isset($_FILES['add']) && count($_FILES['add']['name']) > 0) {
        $total = count($_FILES['add']['name']);
        for ($i = 0; $i < $total; $i++) {
            if ($_FILES['add']['error'][$i] == 0) {
                $target_dir = "./assets/images/";
                $target_file = $target_dir . basename($_FILES["add"]["name"][$i]);
                if (move_uploaded_file($_FILES["add"]["tmp_name"][$i], $target_file)) {
                    $images[] = $target_file;
                } else {
                    echo $errors['E002'];
                    exit();
                }
            }
        }
    }

    $images_json = json_encode($images);
    $date = date("Y-m-d");

    $user_id = $_SESSION['USER_ID']; 
    $stmt2 = $conn->prepare("INSERT INTO listings (user_id, country, city, date, image, price, bedrooms, bathrooms, area, type, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt2->bind_param("issssdiiiss", $user_id, $country, $city, $date, $images_json, $price, $bedrooms, $bathrooms, $area, $type, $description);

    if ($stmt2->execute()) {
        echo "New record created successfully";
        
        
        log_lease($user_id, $country, $city, $price, $bedrooms, $bathrooms, $area, $type, $description, $images);
        
    } else {
        echo $errors['E003'] . $stmt2->error;
    }
    $stmt2->close();
    exit();
}
?>


<?php

function customErrorHandler($errno, $errstr, $errfile, $errline) {
  // Define an array to map error types to user-friendly names
  $error_types = array(
      E_ERROR => 'Error',
      E_WARNING => 'Warning',
      E_PARSE => 'Parse Error',
      E_NOTICE => 'Notice',
      E_CORE_ERROR => 'Core Error',
      E_CORE_WARNING => 'Core Warning',
      E_COMPILE_ERROR => 'Compile Error',
      E_COMPILE_WARNING => 'Compile Warning',
      E_USER_ERROR => 'User Error',
      E_USER_WARNING => 'User Warning',
      E_USER_NOTICE => 'User Notice',
      E_STRICT => 'Runtime Notice',
      E_RECOVERABLE_ERROR => 'Catchable Fatal Error',
  );

  
  $error_type = isset($error_types[$errno]) ? $error_types[$errno] : 'Unknown Error';

 
  $error_message = "[$error_type] $errstr";

  
  echo "$error_message";

  if ($errno == E_USER_ERROR || $errno == E_ERROR) {
      exit(1);
  }
}

set_error_handler('customErrorHandler');
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Villa Agency TemplateMo - Contact Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <div class="sub-header" id="sub_head">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <ul class="info">
            <li><i class="fa fa-envelope"></i> info@company.com</li>
            <li><i class="fa fa-map"></i> Sunny Isles Beach, FL 33160</li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
          <ul class="social-links">
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>



  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <h1>Villa</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="properties.php">Properties</a></li>
                      <li><a href="lease.php" class="active">Lease your villa</a></li>
                      <li><a href="mybookings.php">My Bookings</a></li>
                      <?php 
                        if(!empty($_SESSION['LogedIn'])){
                        $username=$_SESSION['USERNAME'];
                        echo "<li><a href='#'>{$username}</a></li>
                        <li><a href='logout.php'>Log Out</a></li>";
                      }
                      else{
                        echo "<li><a href='logincopy.php'>Log in | Sign up</a></li>";
                      }?>
                      
                  </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a>  /  Lease your villa</span>
          <h3>Lease your Villa</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>| Lease your villa</h6>
            <h2>Set up your own villa for other people to enjoy</h2>
          </div>
          <p>In order to lease your villa through our platform, you have to fill out the form <i>on the right</i>. We will get back to you as soon as we can...</p> <br> <br>
          <p>If you have any questions, please contact us using the information below:</p>
          <div class="row">
            <div class="col-lg-12">
              <div class="item phone">
                <img src="assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                <h6>010-020-0340<br><span>Phone Number</span></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item email">
                <img src="assets/images/email-icon.png" alt="" style="max-width: 52px;">
                <h6>info@villa.co<br><span>Business Email</span></h6>
              </div>
            </div>
          </div>
        </div>


        
        <div class="col-lg-6">


          <form id="contact-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
          <div class="row">
              <div class="col-lg-12">
                  <fieldset>
                      <label for="email">Email Address</label>
                      <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your E-mail..." 
                      <?php if (!empty($_SESSION['LogedIn'])) {
                          $email = $_SESSION['EMAIL'];
                          echo "value='{$email}'";
                      } ?> required="">
                  </fieldset>
              </div>
              <div class="col-lg-6">
                  <fieldset>
                      <label for="country">Country</label>
                      <input type="text" name="country" id="country" placeholder="Country of property..." required>
                  </fieldset>
              </div>
              <div class="col-lg-6">
                  <fieldset>
                      <label for="city">City</label>
                      <input type="text" name="city" id="city" placeholder="City of property..." required>
                  </fieldset>
              </div>
              <div class="col-lg-6">
                  <fieldset>
                      <label for="phone">Phone Number</label>
                      <input type="phone" name="phone" id="phone" placeholder="Your Phone Number (+....)" required>
                  </fieldset>
              </div>
              <div class="col-lg-6">
                  <fieldset>
                      <label for="type">Type</label> <br>
                      <select name="type" id="type" required>
                          <option value="Villa">Villa</option>
                          <option value="Apartment">Apartment</option>
                          <option value="Penthouse">Penthouse</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-lg-6">
                  <fieldset>
                      <label for="price">Price per night</label>
                      <input type="number" name="price" id="price" placeholder="Price per night in $..." required>
                  </fieldset>
              </div>
              <div class="col-lg-6">
                  <fieldset>
                      <label for="area">Area</label>
                      <input type="number" name="area" id="area" placeholder="Area in m2..." required>
                  </fieldset>
              </div>
              <div class="col-lg-6">
                  <fieldset>
                      <label for="bedrooms">Number of bedrooms</label>
                      <input type="number" name="bedrooms" id="bedrooms" placeholder="Bedrooms of property..." required>
                  </fieldset>
              </div>
              <div class="col-lg-6">
                  <fieldset>
                      <label for="bathrooms">Number of bathrooms</label>
                      <input type="number" name="bathrooms" id="bathrooms" placeholder="Bathrooms of property..." required>
                  </fieldset>
              </div>
              <div class="col-lg-12">
                  <fieldset>
                      <label for="message">Description of the villa</label>
                      <textarea name="message" id="message" placeholder="Describe in detail..."></textarea>
                  </fieldset>
              </div>
              <div class="col-md-12">
                  <br>
                  <div>
                      <label class="add" for="add">Add Photos</label>
                      <button class="chooseThePhoto" type="button" onclick="document.getElementById('getFile').click()" style="background-color:#f6f6f6;color: #757575;">
                          Choose Photos
                      </button>
                      <input type="file" id="getFile" style="display:none" name="add[]" multiple>
                  </div>
              </div>
              <div class="col-lg-12">
                  <fieldset>
                      <button type="submit" id="form-submit" class="orange-button">Lease your property</button>
                  </fieldset>
              </div>
          </div>
      </form>
        </div>
   
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2048 Villa Agency Co., Ltd. All rights reserved. 
        
        Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('contact-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var xhr = new XMLHttpRequest(); //Objekti XMLHttpRequest
                xhr.open("POST", "", true); //Inicon nje kerkese ne server
                xhr.onload = function() { //kur kerkesa perfundon me sukses
                    if (xhr.status >= 200 && xhr.status < 300) {
                        alert(xhr.responseText);
                    } else {
                        alert('An error occurred: ' + xhr.statusText);
                    }
                };

                xhr.onerror = function() { //nese kerkesa perfundon me deshtim
                    alert($errors['E009']);
                };

                var formData = new FormData(this);
                xhr.send(formData); // dergon te dhenat ne server
            });
        });
    </script>
  </body>
</html>