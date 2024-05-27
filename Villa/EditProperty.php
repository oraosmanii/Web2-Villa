<?php
session_start();
?>



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
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
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
                        <a href="index.php" class="logo">
                            <h1>Villa</h1>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="properties.php">Properties</a></li>
                            <li><a href="<?php
                                          if (!empty($_SESSION['LogedIn'])) {
                                              echo "lease.php";
                                          } else {
                                              echo "logincopy.php";
                                          }
                                          ?>">Lease your villa</a></li>
                            <li><a href="<?php
                                          if (!empty($_SESSION['LogedIn'])) {
                                              echo "mybookings.php";
                                          } else {
                                              echo "logincopy.php";
                                          }
                                          ?>">My Bookings</a></li>
                            <?php
                            if (!empty($_SESSION['LogedIn'])) {
                                $username = $_SESSION['USERNAME'];
                                echo "<li><a href='#'>{$username}</a></li><li>
                        <a href='logout.php'>Log Out</a></li>";
                            } else {
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
          <span class="breadcrumb"><a href="#">Home</a> / Edit</span>
          <h3>Edit</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>| Edit your villa</h6>
            <h2>Small changes to a bigger experience</h2>
          </div>
          <p>If you have any questions regarding how the edit page works, please contact us using the information below:</p>
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
                      <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                          $pattern = '/^\+[0-9]{1,11}$/';
                          $phone = $_POST["phone"];
                          if (!preg_match($pattern, $phone)) {
                              echo "<p style='color: red; font-size: 16px;'>Invalid phone number.</p>
                              <script>window.location.href = '#phone';</script>";
                              trigger_error("Invalid phone number", E_USER_ERROR);
                          } else {
                              echo "<script>window.location.href = '#contact-form';</script>";
                          }
                      } ?>
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






    <footer class="footer-no-gap">
        <div  class="container">
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