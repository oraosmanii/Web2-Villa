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
                    <a href="index.html" class="logo">
                        <h1>Villa</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="index.html">Home</a></li>
                      <li><a href="properties.html" class="active">Properties</a></li>
          
                     
                      <li><a href="lease.html">Lease your villa</a></li>

                      <li><a href="login.html">Log in | Sign up</a></li>
                      
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
          <a href="#!" data-filter=".adv">Apartment</a>
        </li>
        <li>
          <a href="#!" data-filter=".str">Villa House</a>
        </li>
        <li>
          <a href="#!" data-filter=".rac">Penthouse</a>
        </li>
      </ul>
      <div class="row properties-box">
        

        <?php
    
    class Bookings {
      protected $id;
      protected $country;
      protected $city;
      protected $date;
      protected $imgpath;
      protected $price;

      function __construct( $country, $city, $date, $imgpath, $price) {
        $this->id = uniqid();
        $this->country=$country;
        $this->city=$city;
        $this->date=$date;
        $this->imgpath=$imgpath;
        $this->price=$price;
      }

      function get_image(){
        return $this->imgpath;
      }
      function get_country(){
        return $this->country;
      }
      function get_city(){
        return $this->city;
      }
      function get_price(){
        return $this->price;
      }
      function get_date(){
        return $this->date;
      }
      function get_id(){
        return $this->id;
      }

    }

    class Villa extends Bookings{
      private $bedrooms;
      private $bathrooms;
      private $area;
      private $type="Villa";


      function __construct($country, $city, $date, $imgpath, $price,$bedrooms,$bathrooms,$area){
        $this->id = uniqid();
        $this->country=$country;
        $this->city=$city;
        $this->date=$date;
        $this->imgpath=$imgpath;
        $this->price=$price;
        $this->bedrooms=$bedrooms;
        $this->bathrooms=$bathrooms;
        $this->area=$area;
      }
      function get_type()
      {
        return $this->type;
      }
      function get_bedrooms(){
        return $this->bedrooms;
      }
      function get_bathrooms(){
        return $this->bathrooms;
      }
      function get_area(){
        return $this->area;
      }

    }

    class Apartment extends Bookings{
      private $bedrooms;
      private $bathrooms;
      private $area;
      private $type="Apartment";


      function __construct($country, $city, $date, $imgpath, $price,$bedrooms,$bathrooms,$area){
        $this->id = uniqid();
        $this->country=$country;
        $this->city=$city;
        $this->date=$date;
        $this->imgpath=$imgpath;
        $this->price=$price;
        $this->bedrooms=$bedrooms;
        $this->bathrooms=$bathrooms;
        $this->area=$area;
      }
      function get_type()
      {
        return $this->type;
      }

      function get_bedrooms(){
        return $this->bedrooms;
      }
      function get_bathrooms(){
        return $this->bathrooms;
      }
      function get_area(){
        return $this->area;
      }

    }

    class Penthouse extends Bookings{
      private $bedrooms;
      private $bathrooms;
      private $area;
      private $type ="Penthouse";


      function __construct($country, $city, $date, $imgpath, $price,$bedrooms,$bathrooms,$area){
        $this->id = uniqid();
        $this->country=$country;
        $this->city=$city;
        $this->date=$date;
        $this->imgpath=$imgpath;
        $this->price=$price;
        $this->bedrooms=$bedrooms;
        $this->bathrooms=$bathrooms;
        $this->area=$area;
      }
      function get_type()
      {
        return $this->type;
      }
      

      function get_bedrooms(){
        return $this->bedrooms;
      }
      function get_bathrooms(){
        return $this->bathrooms;
      }
      function get_area(){
        return $this->area;
      }

    }

    function createCard(){

      $myfile= fopen("Mybookings.txt","r+");
      while (!feof($myfile)) {
          // Read a line from the file
          $line = fgets($myfile);
          
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
          // $booking = new Villa($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);

              echo "<div class='col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv'>
              <div class='item'> 
              <a href='property-details.html'><img src='{$booking->get_image()}' alt=''></a>
              <span class='category'>{$booking->get_type()}</span> 
              <h6>$ {$booking->get_price()}</h6>
            <h4><a href='property-details.html'>{$booking->get_country()} {$booking->get_city()}</a></h4>
            <ul>
              <li>Bedrooms: <span>{$booking->get_bedrooms()}</span></li>
              <li>Bathrooms: <span>{$booking->get_bathrooms()}</span></li>
              <li>Area: <span>{$booking->get_area()}m2</span></li>
            </ul>
            <div class='main-button'>
              <a href='schedule.html'>Book Now</a>
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




          <!-- <div class="item">
            <a href="property-details.html"><img src="assets/images/property-01.jpg" alt=""></a>
            <span class="category">Luxury Villa</span>
            <h6>$2264</h6>
            <h4><a href="property-details.html">18 Old Street Miami, OR 97219</a></h4>
            <ul>
              <li>Bedrooms: <span>8</span></li>
              <li>Bathrooms: <span>8</span></li>
              <li>Area: <span>545m2</span></li>
            </ul>
            <div class="main-button">
              <a href="schedule.html">Book Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 str">
          <div class="item">
            <a href="property-details.html"><img src="assets/images/property-02.jpg" alt=""></a>
            <span class="category">Luxury Villa</span>
            <h6>$1180</h6>
            <h4><a href="property-details.html">54 New Street Florida, OR 27001</a></h4>
            <ul>
              <li>Bedrooms: <span>6</span></li>
              <li>Bathrooms: <span>5</span></li>
              <li>Area: <span>450m2</span></li>
            </ul>
            <div class="main-button">
              <a href="schedule.html">Book Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv rac">
          <div class="item">
            <a href="property-details.html"><img src="assets/images/property-03.jpg" alt=""></a>
            <span class="category">Luxury Villa</span>
            <h6>$1460</h6>
            <h4><a href="property-details.html">26 Mid Street Portland, OR 38540</a></h4>
            <ul>
              <li>Bedrooms: <span>5</span></li>
              <li>Bathrooms: <span>4</span></li>
              <li>Area: <span>225m2</span></li>
            </ul>
            <div class="main-button">
              <a href="schedule.html">Book Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 str">
          <div class="item">
            <a href="property-details.html"><img src="assets/images/property-04.jpg" alt=""></a>
            <span class="category">Apartment</span>
            <h6>$584</h6>
            <h4><a href="property-details.html">12 Hope Street Portland, OR 12650</a></h4>
            <ul>
              <li>Bedrooms: <span>4</span></li>
              <li>Bathrooms: <span>3</span></li>
              <li>Area: <span>125m2</span></li>
            </ul>
            <div class="main-button">
              <a href="schedule.html">Book Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 rac str">
          <div class="item">
            <a href="property-details.html"><img src="assets/images/property-05.jpg" alt=""></a>
            <span class="category">Penthouse</span>
            <h6>$925</h6>
            <h4><a href="property-details.html">34 Hope Street Portland, OR 42680</a></h4>
            <ul>
              <li>Bedrooms: <span>4</span></li>
              <li>Bathrooms: <span>4</span></li>
              <li>Area: <span>180m2</span></li>
            </ul>
            <div class="main-button">
              <a href="schedule.html">Book Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 rac adv">
          <div class="item">
            <a href="property-details.html"><img src="assets/images/property-06.jpg" alt=""></a>
            <span class="category">Modern Condo</span>
            <h6>$450</h6>
            <h4><a href="property-details.html">22 Hope Street Portland, OR 16540</a></h4>
            <ul>
              <li>Bedrooms: <span>3</span></li>
              <li>Bathrooms: <span>2</span></li>
              <li>Area: <span>165m2</span></li>
            </ul>
            <div class="main-button">
              <a href="schedule.html">Book Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 rac str">
          <div class="item">
            <a href="property-details.html"><img src="assets/images/property-03.jpg" alt=""></a>
            <span class="category">Luxury Villa</span>
            <h6>$980</h6>
            <h4><a href="property-details.html">14 Mid Street Miami, OR 36450</a></h4>
            <ul>
              <li>Bedrooms: <span>8</span></li>
              <li>Bathrooms: <span>8</span></li>
              <li>Area: <span>550m2</span></li>
            </ul>
            <div class="main-button">
              <a href="schedule.html">Book Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 rac adv">
          <div class="item">
            <a href="property-details.html"><img src="assets/images/property-02.jpg" alt=""></a>
            <span class="category">Luxury Villa</span>
            <h6>$1520</h6>
            <h4><a href="property-details.html">26 Old Street Miami, OR 12870</a></h4>
            <ul>
              <li>Bedrooms: <span>12</span></li>
              <li>Bathrooms: <span>15</span></li>
              <li>Area: <span>380m2</span></li>
            </ul>
            <div class="main-button">
              <a href="schedule.html">Book Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 rac adv">
          <div class="item">
            <a href="property-details.html"><img src="assets/images/property-01.jpg" alt=""></a>
            <span class="category">Luxury Villa</span>
            <h6>$3145</h6>
            <h4><a href="property-details.html">34 New Street Miami, OR 24650</a></h4>
            <ul>
              <li>Bedrooms: <span>10</span></li>
              <li>Bathrooms: <span>12</span></li>
              <li>Area: <span>860m2</span></li>
            </ul>
            <div class="main-button">
              <a href="schedule.html">Book Now</a>
            </div>
          </div> -->
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