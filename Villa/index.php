<?php
session_start();
if (!isset($_SESSION['index_visits'])) {

  $_SESSION['index_visits'] = 1; 
} else {
  $_SESSION['index_visits']++; 
}


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Villa Agency</title>
    <!-- test -->
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

<style>
  .button-orange {
            padding: 10px 20px; 
            background-color: orange; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s, color 0.3s; 
        }


        .button-orange:hover {
            background-color: darkorange; 
            color: #fff; 
        }
  .main-banner .item-1 {
    background-image: url(assets/images/location/<?php if (isset($_COOKIE["user_location"])) { echo $_COOKIE["user_location"]; } else { echo "Toronto"; } ?>.jpg);
  }

.location-form{
            background-color: #fff;
            padding: 1rem;
            border-top: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .location-form form {
            display: flex;
            align-items: center;
        }

        .location-form label {
            margin-right: 1rem;
        }

        .location-form select {
            border: 1px solid #ddd;
            padding: 0.5rem;
            border-radius: 0.25rem;
            font-size: 1rem;
        }

        .location-form button {
            background-color: orangered;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            font-size: 1rem;
            cursor: pointer;
            margin-left: 15px;
        }

        .location-form button:hover {
            background-color: #0069d9;
            background-color: red;
        }

        #ratingBox {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            z-index: 1000;
        }
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .slide-in {
            animation: slideIn 0.5s forwards;
        }
        @keyframes slideIn {
            from {
                transform: translate(-50%, -100%);
            }
            to {
                transform: translate(-50%, -50%);
            }
        }
</style>
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

  <div class="sub-header" id="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <ul class="info">
            <li><i class="fa fa-envelope"></i> infos@company.com</li>
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
                      <li><a href="index.php" class="active">Home</a></li>
                      <li><a href="properties.php">Properties</a></li>
                      <li><a href="<?php
                      if(!empty($_SESSION['LogedIn'])){
                        echo "lease.php";
                      }
                      else{
                        echo "logincopy.php";
                      }
                      ?>">Lease your villa</a></li>
                      <li><a href="<?php
                      if(!empty($_SESSION['LogedIn'])){
                        echo "mybookings.php";
                      }
                      else{
                        echo "logincopy.php";
                      }
                      ?>">My Bookings</a></li>
                      <?php
                      if(!empty($_SESSION['LogedIn'])){
                        $username=$_SESSION['USERNAME'];
                        echo "<li><a href='#'>{$username}</a></li><li>
                        <a href='logout.php'>Log Out</a></li>";
                      }
                      else{
                        echo "<li><a href='logincopy.php'>Log in | Sign up</a></li>";
                      }
                      ?>
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

  <!-- MAIN CAROUSEL -->

  <div class="main-banner">
  <div class="location-form">
        <form action="set-location.php" method="post">
          <label for="location">Choose your preferred location:</label>
          <select name="location" id="location">
            <option value="Toronto" <?php if (isset($_COOKIE["user_location"]) && $_COOKIE["user_location"] == "Toronto") { echo "selected"; } ?>>Toronto</option>
            <option value="Melbourne" <?php if (isset($_COOKIE["user_location"]) && $_COOKIE["user_location"] == "Melbourne") { echo "selected"; } ?>>Melbourne</option>
            <option value="Paris" <?php if (isset($_COOKIE["user_location"]) && $_COOKIE["user_location"] == "Paris") { echo "selected"; } ?>>Paris</option>
            <option value="Berlin" <?php if (isset($_COOKIE["user_location"]) && $_COOKIE["user_location"] == "Berlin") { echo "selected"; } ?>>Berlin</option>
          </select>
          <button type="submit">Save Location</button>
        </form>
      </div>
      <div class="item item-1">
        <div class="header-text">
          <span class="category"><?php if (isset($_COOKIE["user_location"])) { echo $_COOKIE["user_location"]; } else { echo "Toronto"; } ?></span>
          <h2>Hurry!<br>Get the Best Villa for you</h2>
        </div>
      </div>
  </div>
  <div id="overlay"></div>
    <div id="ratingBox" class="slide-in">
        <p>You visited our home page more than 3 times! Maybe give us a rating?</p>
        <button class="button-orange" onclick="handleClick('later')">Maybe Later</button>
        <button class="button-orange" onclick="handleClick('rate')">Rate</button>
    </div>
              
  <!-- FEATURED / TOP RANKED -->
  <div class="featured section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="left-image">
            <img src="assets/images/featured.jpg" alt="">
            <a href="property-details.php"><img src="assets/images/featured-icon.png" alt="" style="max-width: 60px; padding: 0px;"></a>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="section-heading">
            <h6>| Top Rated</h6>
            <h2>Best Rated Apartment &amp; View </h2>
          </div>
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Most loved from our clients!
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body top-rated-accordion">
                  Excellent
                  <span class="top-rated">9.8</span>/10
                  <img class="stars" src="assets/images/rating.png" alt="">
    
                </div>
              </div>
            </div>
          
          </div>
        </div>
        <div class="col-lg-3">
          <div class="info-table">
            <ul>
              <li>
                <img src="assets/images/info-icon-01.png" alt="" style="max-width: 52px;">
                <h4>250 m2<br><span>Total Flat Space</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-02.png" alt="" style="max-width: 52px;">
                <h4>Contract<br><span>Contract Ready</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-03.png" alt="" style="max-width: 52px;">
                <h4>Payment<br><span>Payment Process</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-04.png" alt="" style="max-width: 52px;">
                <h4>Safety<br><span>24/7 Under Control</span></h4>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="video section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| Video View</h6>
            <h2>Get Closer View & Different Feeling</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="video-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="video-frame">
            <img src="assets/images/video-frame.jpg" alt="">
            <a href="https://youtube.com" target="_blank"><i class="fa fa-play"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="contact section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| Contact Us</h6>
            <h2>Get In Touch With Our Agents</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12469.776493332698!2d-80.14036379941481!3d25.907788681148624!2m3!1f357.26927939317244!2f20.870722720054623!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x88d9add4b4ac788f%3A0xe77469d09480fcdb!2sSunny%20Isles%20Beach!5e1!3m2!1sen!2sth!4v1642869952544!5m2!1sen!2sth" width="100%" height="500px" frameborder="0" style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);" allowfullscreen=""></iframe>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="item phone">
                <img src="assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                <h6>010-020-0340<br><span>Phone Number</span></h6>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="item email">
                <img src="assets/images/email-icon.png" alt="" style="max-width: 52px;">
                <h6>info@villa.co<br><span>Business Email</span></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <form id="contact-form" action="" method="POST">
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                  <label for="name">Full Name</label>
                  <input type="name" name="name" id="name" placeholder="Your Name..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="email">Email Address</label>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your E-mail..." required="">
                  <?php 
          if (isset($_POST["message"])) {
            $email = $_POST["email"];
            $email_pattern = '/^[a-zA-Z][a-zA-Z0-9_]*@[a-zA-Z.]+$/';
          if (preg_match($email_pattern, $email)) {
              echo "<script>alert('Thanks for contacting us!');
              window.location.href = '#sub-header';
              </script>";
            //header("Location: index.php");
        } else {
            $error_message= "Invalid email address!";
            echo "
           <script> window.location.href = '#contact-form';
            </script>";
            
        }
      }
          ?>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Subject</label>
                  <input type="subject" name="subject" id="subject" placeholder="Subject..." autocomplete="on" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="message">Message</label>
                  <textarea name="message" id="message" placeholder="Your Message"></textarea>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" name="message" class="orange-button">Send Message</button>
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
      <div class="col-lg-8">
        <p>Copyright © 2048 Villa Agency Co., Ltd. All rights reserved. 
        
        Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script>
        function handleClick(choice) {
            var box = document.getElementById('ratingBox');
            var overlay = document.getElementById('overlay');
            switch(choice) {
                case 'ok':
                case 'later':
                    box.style.display = 'none';
                    overlay.style.display = 'none';
                    break;
                case 'rate':
                    window.location.href = '#'; // redirect to rating page po na hala se kem
                    break;
            }
        }

     
        window.onload = function() {
            var visits = <?php echo $_SESSION['index_visits']; ?>;
            if (visits == 3 || visits == 6) {
                document.getElementById('ratingBox').style.display = 'block';
                document.getElementById('overlay').style.display = 'block';
            }
        }
    </script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>


  </body>
</html>