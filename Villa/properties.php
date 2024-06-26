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
<style>
  .sort-button{
  display: inline-block;
  text-align: center;
  font-size: 15px;
  text-transform: capitalize;
  font-weight: 500;
  color: white;
  background-color: #e95317;
  padding: 6px 13px;
  border-radius: 5px;
  transition: all .3s;
  border: none;
  }
  .sort-button:hover {
  background-color: #000103;
}
  form{
    margin-bottom: 20px;
    margin-right: 180px;
  }

 
</style>
  </head>

<body>

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
                      <li><a href="index.php" >Home</a></li>
                      <li><a href="properties.php" class="active">Properties</a></li>
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
                        echo "<li><a href='UserPage.php'>{$username}</a></li><li>
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
            <form action="properties.php" method="post">
                                <label for="sort-by">Sort properties by:</label>
                                <select name="sort" id="sort-by">
                                    <option value="">Select an option</option>
                                    <option value="price-asc">Price (Low to High)</option>
                                    <option value="price-desc">Price (High to Low)</option>
                                    <option value="name-asc">Name (A to Z)</option>
                                    <option value="name-desc">Name (Z to A)</option>
                                    <option value="beds-asc">Bedrooms (Low to High)</option>
                                    <option value="beds-desc">Bedrooms (High to Low)</option>
                                </select>
                                <button class="sort-button" type="submit">Sort</button>
                            </form>
          </li>
          <li class="filter-button">
            <a class="is_active" href="#!" data-filter="*">Show All</a>
          </li>
          <li class="filter-button">
            <a href="#!" data-filter=".Apartment">Apartment</a>
          </li >
          <li class="filter-button">
            <a href="#!" data-filter=".Villa">Villa House</a>
          </li>
          <li class="filter-button">
            <a href="#!" data-filter=".Penthouse">Penthouse</a>
          </li>
      </ul>
          
       
  <div class="row properties-box">

  <?php
    include "create-properties.php";
    include "sort-properties.php";
    
    createCard($_SESSION['properties']);
  ?>


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
  <script>
        // Clear the form data from the cache when the page is loaded
        window.onload = function() {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        };
    </script>

  </body>
</html>