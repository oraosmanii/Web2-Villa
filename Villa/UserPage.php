<?php
session_start();
include 'db_connection.php';
include "errors.php";
global $errors;

$response = [
    'success' => false,
    'message' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = trim($_POST['username_change']);
    $user_id = $_SESSION['USER_ID'];

    if (empty($new_username)) {
        $response['message'] = $errors['E020'];
        echo json_encode($response);
        exit();
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $new_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $response['message'] = $errors['E021'];
        $stmt->close();
        echo json_encode($response);
        exit();
    }

    $stmt->close();


    $stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
    $stmt->bind_param("si", $new_username, $user_id);

    if ($stmt->execute()) {
        $_SESSION['USERNAME'] = $new_username;
        $response['success'] = true;
        $response['message'] = 'Username changed successfully.';
    } else {
        $response['message'] = $errors['E022'];
    }

    $stmt->close();
}
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
                                echo "<li><a href='UserPage.php'>{$username}</a></li><li>
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
          <span class="breadcrumb"><a href="#">Home</a> / User</span>
          <h3>User Info</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>| Express yourself</h6>
            <h2>How you present yourself reflects on what you list</h2>
          </div>
          <p>If you have any questions regarding how this page, please contact us using the information below:</p>
          <div class="row">
            <div class="col-lg-12">
              <div class="item phone">
                <img src="assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                <h6>010-020-0340<br><span>Phone Number</span></h6>
              </div>
            </div>
            <div class="col-lg-12" style="margin-bottom: 10vh;">
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
                      <h3>Username: <span style="color: #EE626B;"><?php echo "{$_SESSION['USERNAME']}"?></span></h3>
                  </fieldset>
              </div><hr>
            
              <div class="col-lg-12">
                  <fieldset>
                      <label for="username_change">Change Username</label>
                      <input type="text" name="username_change" id="username_change" placeholder="New Username" required>
                  </fieldset>
              </div>
              
              <div class="col-lg-12">
                  <fieldset>
                      <button type="submit" id="change-submit" class="orange-button">Change</button>
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

</body>
</html>