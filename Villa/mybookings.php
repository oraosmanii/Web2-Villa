<?php
session_start();
include 'db_connection.php'; // include database 

if (!isset($_SESSION['USER_ID'])) {
    header("Location: logincopy.php");
    exit();
}

$user_id = $_SESSION['USER_ID'];

// fetch from login
$stmt = $conn->prepare("SELECT bookings.*, properties.country, properties.city, properties.image, properties.price FROM bookings INNER JOIN properties ON bookings.property_id = properties.id WHERE bookings.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}
$stmt->close();
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
    <link rel="stylesheet" href="assets/css/mybookings.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
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
                      <li><a href="lease.php">Lease your villa</a></li>
                      <li><a href="mybookings.php" class="active">My Bookings</a></li>
                      <?php 
                        if(!empty($_SESSION['LogedIn'])){
                        $username=$_SESSION['USERNAME'];
                        echo "<li><a href='#'>{$username}</a></li><li>
                        <a href='logout.php'>Log Out</a></li>";
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
          <span class="breadcrumb">Bookings / listings</span>
          <h3>My Bookings & Listings</h3>
        </div>
      </div>
    </div>
  </div>

  <section class="py-5 bg-light" style="font-family: 'Poppins', sans-serif;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">My Bookings:</h2>
          <div class="booked-items" id="booked-items">
            <?php if (empty($bookings)): ?>
              <p class="text-center">You don't have any bookings yet.</p>
            <?php else: ?>
              <?php foreach ($bookings as $booking): ?>
                <div class="cart-item d-flex justify-content-between align-items-center mb-3">
                  <div class="d-flex align-items-center" style="flex-grow: 1;">
                    <img src="<?php echo $booking['image']; ?>" alt="Place in <?php echo $booking['country'] . ', ' . $booking['city']; ?>" class="img-fluid rounded" style="width: 100px; height: auto; margin-right: 20px;">
                    <div>
                      <h5 class="fw-bold mb-1"><?php echo $booking['country'] . ', ' . $booking['city']; ?></h5>
                      <p class="text-muted mb-0">Arrival: <?php echo $booking['arrival_date']; ?></p>
                      <p class="text-muted mb-0">Departure: <?php echo $booking['departure_date']; ?></p>
                      <p class="text-muted mb-0">Total Price: $<?php echo $booking['total_price']; ?></p>
                    </div>
                  </div>
                  <button onclick="cancelBooking(<?php echo $booking['id']; ?>)" class="btn btn-danger btn-sm">Cancel Booking</button>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
        <hr>
        <div class="col-md-12">
          <h2 class="mb-4">My Listings:</h2>
          <div class="listed-items" id="listed-items">
            <!-- qetu shtohen items -->
          </div>
        </div>
      </div>
    </div>
  </section>

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
    function cancelBooking(bookingId) {
      if (confirm("Are you sure you want to cancel this booking?")) {
        // ajax request
        $.post('cancel_booking.php', { booking_id: bookingId }, function(response) {
          if (response.success) {
            location.reload(); // reload page
          } else {
            alert("Failed to cancel the booking. Please try again.");
          }
        }, 'json');
      }
    }
  </script>
</body>
</html>
