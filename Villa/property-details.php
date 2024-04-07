<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Villa Agency - Property Detail Page</title>

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

  <!-- ***** Preloader Start *****
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div> -->
  <!-- ***** Preloader End ***** -->

  <div class="sub-header">
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
                      <li><a href="lease.php">Lease your villa</a></li>
                      <li><a href="mybookings.php">My Bookings</a></li>
                      <li><a href="login.php">Log in | Sign up</a></li>
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
          <span class="breadcrumb"><a href="#">Home</a>  /  Single Property</span>
          <h3>Single Property</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="single-property section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="main-image">
            <img src="assets/images/single-property.jpg" alt="">
          </div>
          <div class="main-content">
            <span class="category">Luxury Villa</span>
            <h4>18 New Street Miami, OR 24560</h4>
            <p>Step into the comfort of modern living with <strong>our premier real estate offerings</strong>. Our carefully curated selections bring you the finest homes that blend luxury with coziness, designed to exceed your expectations. With an eye for exceptional properties, we ensure that every listing provides a unique glimpse into the lifestyle you desire.<br><br></p>

            <p>Browse our collection to find your sanctuary amidst the city's hustle or a tranquil retreat in the countryside. Our team is here to provide <strong>tailored support</strong>, ensuring a smooth transition into your new home. Trust in our expertise to navigate the market and secure your future residence with confidence.</p>
            
            </div> 
        </div> -->

        <?php
        include "Classes.php";
        if(isset($_GET['info'])) {
          // Decode the encoded information
          $info= urldecode($_GET['info']);

          $page=recieverProperties($info);

          
          // Display the information
          echo "<div class='single-property section'>
          <div class='container'>
            <div class='row'>
              <div class='col-lg-8'>
                <div class='main-image'>
                  <img src='{$page->get_image()}' alt='' height='490'>
                </div>
                <div class='main-content'>
                  <span class='category'>{$page->get_type()}</span>
                  <h4>{$page->get_country()} {$page->get_city()}</h4>
                  <p>Step into the comfort of modern living with <strong>our premier real estate offerings</strong>. Our carefully curated selections bring you the finest homes that blend luxury with coziness, designed to exceed your expectations. With an eye for exceptional properties, we ensure that every listing provides a unique glimpse into the lifestyle you desire.<br><br></p>
      
                  <p>Browse our collection to find your sanctuary amidst the city's hustle or a tranquil retreat in the countryside. Our team is here to provide <strong>tailored support</strong>, ensuring a smooth transition into your new home. Trust in our expertise to navigate the market and secure your future residence with confidence.</p>
                  
                  </div> 
              </div>
              <div class='col-lg-4'>
          <div class='info-table-and-button-wrapper'>
            <div class='info-table'>
              <ul>
                <li>
                  <img src='assets/images/info-icon-01.png' alt='' style='max-width: 52px;'>
                  <h4>{$page->get_area()} m2<br><span>Total Flat Space</span></h4>
                </li>
                <li>
                  <img src='assets/images/info-icon-02.png' alt='' style='max-width: 52px;'>
                  <h4>{$page->get_bedrooms()}<br><span>Bedrooms</span></h4>
                </li>
                <li>
                  <img src='assets/images/info-icon-04.png' alt='' style='max-width: 52px;'>
                  <h4>{$page->get_bathrooms()}<br><span>Bathrooms</span></h4>
                </li>
                <li>
                  <img src='assets/images/info-icon-03.png' alt='' style='max-width: 52px;'>
                  <h4>$ {$page->get_price()}<br><span>Price</span></h4>
                </li>
              </ul>
            </div>";
      } else {
          echo "Information not provided";
      }
        ?>
        
            
            <div class="icon-button" style="text-align: center; margin-top: 50px; height: 100px;">
              <a href="schedule.php" style="font-size: 23px;"><i class="fa fa-calendar"></i> Book Now</a>
            </div>
          </div>

<!-- RATING SECTION -->
          <div class="rating-section">
            <div class="card">
              <div class="card-header">
                <h3>Rate this property</h3>
              </div>
              <div class="card-body">
                <form id="rating-form" action="#">
                  <label for="rating">Rating:</label>
                  <div class="yjet">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5"></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4"></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3"></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2"></label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1"></label>
                  </div>
                  <div class="login-first">
                    <a href="login.php">Log in first to rate</a>
                  </div>
                  <button type="submit" class="btn btn-danger" style="position: relative; bottom: 30px;">Submit</button>
                </form>
              </div>
            </div>
          </div>



        </div>
      </div>
    </div>
  </div>


  <footer class="footer-no-gap">
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

  </body>
</html>