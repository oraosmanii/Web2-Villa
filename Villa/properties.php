<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Villa Agency - Properties</title>

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
  <!-- <div id="js-preloader" class="js-preloader">
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
  < <header class="header-area header-sticky">
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

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a> / Properties</span>
          <h3>Properties</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">
    <div class="container">
      <ul class="properties-filter">
        <li>
          <a class="is_active" href="#!" data-filter="*">Show All</a>
        </li>
        <li>
          <a href="#!" data-filter=".Apartment">Apartment</a>
        </li>
        <li>
          <a href="#!" data-filter=".Villa">Villa House</a>
        </li>
        <li>
          <a href="#!" data-filter=".Penthouse">Penthouse</a>
        </li>
      </ul>
      <div class="row properties-box">
        

        <?php
      include "Classes.php";
    function getLink($cards){
              if(!empty($_SESSION['LogedIn'])){
                return "schedule.php?info=$cards";
              }
              else{
                return "logincopy.php";
              }
            }
          
          
    $objectArray=array();
    function createCard(){
      

      $myfile= fopen("Places.txt","r+");
      while (!feof($myfile)) {
          // Read a line from the file
          $line = fgets($myfile);
          $cards= urlencode($line);
          $Link=getLink($cards);
          
          // Split the line by commas
          $data = explode(",", $line);
          
         
          // Process the data as needed
          // For example, you can print the split data

          $type=strtoupper(trim($data[8]));
          
          switch($type){
            case 'VILLA':
                $booking = new Villa($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
                break;
            case 'APARTMENT':
              $booking = new Apartment($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
              break;
            case 'PENTHOUSE':
              $booking = new Penthouse($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
              break;
            default:
              echo "Invalid creation";
          } 
          
          
          
          global $objectArray;
          transferArray($objectArray,$booking->get_id(),$booking->get_price());
          // $booking = new Villa($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);

              echo "<div class='col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 {$booking->get_type()}'>
              <div class='item'> 
              <a href='property-details.php?info={$cards}'><img src='{$booking->get_image()}' height='300' alt=''></a>
              <span class='category'>{$booking->get_type()}</span> 
              <h6>$ {$booking->get_price()}</h6>
            <h4><a href='property-details.php'>{$booking->get_country()} {$booking->get_city()}</a></h4>
            <ul>
              <li>Bedrooms: <span>{$booking->get_bedrooms()}</span></li>
              <li>Bathrooms: <span>{$booking->get_bathrooms()}</span></li>
              <li>Area: <span>{$booking->get_area()}m2</span></li>
            </ul>
            <div class='main-button'>
              <a href='{$Link}'>Book Now</a>
            </div>
            </div>
            </div>";
          
          // print_r($data);
          // echo "<br> <br>";
      }
      
      // Close the file
      fclose($myfile);
  }

  createCard();

    ?>
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

  </body>
</html>