<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Now</title>

  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/book.css">



  <link rel="stylesheet" href="footer.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap"
    rel="stylesheet">

</head>

<body>
  <!-- Main Screen-->
  <!-- Audio File -->
  <audio id="Subscribe">
    <source src="Sounds/Subscribe.mp3" type="audio/mpeg">
  </audio>
  <!-- Main Screen-->
  <main class="first-box">

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
                <li><a href="lease.php">Lease your Villa</a></li>
                <li><a href="mybookings.php">My Bookings</a></li>
                <?php
                if (!empty($_SESSION['LogedIn'])) {
                  $username = $_SESSION['USERNAME'];
                  echo "<li><a href='#'>{$username}</a></li><li>
                        <a href='logout.php'>Log Out</a></li>";
                } else {
                  echo "<li><a href='logincopy.php'>Log in | Sign up</a></li>";
                } ?>
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
    </div>
    <br>
    <h1 class="book-title"><b>Book your dream villa<b></b></h1>
    <p class="book-caption">WE ALWAYS AIM TO CONFIRM YOUR RESERVATION WITHIN 1 HOUR</p>


    <?php
    $property_name = $_POST['property_name']; //QETU ME MARR DIQYSH PROPERTY NAME
    echo "Property Name: $property_name";
    ?>


    <form action="booking.php" method="post">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">

                <label for="arrival_date">Arrival Date:</label>
                <input type="date" id="arrival_date" name="arrival_date" required>

                <input type="hidden" id="property_name" name="property_name" value="<?php echo $property_name; ?>">


              </div>
              <div class="col-md-6">
                <label for="departure_date">Departure Date:</label>
                <input type="date" id="departure_date" name="departure_date" required>
                <input type="hidden" id="property_price" name="property_price" value="<?php echo $property_price; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <br>
                <label for="radio" style="font-weight: bold;">Payment: &nbsp &nbsp &nbsp &nbsp</label>
                <input type="radio" id="cash" name="payment" checked> <label class="form-check-label" for="cash"
                  required>
                  Cash &nbsp &nbsp
                </label>
                <input type="radio" class="radio" id="bank" name="payment"> <label class="form-check-label" for="bank"
                  required>
                  Bank
                </label>
                <input style="width:50%;float: right;" type="text" id="bank" class="classinput"
                  placeholder="Bank Number" required>

                <br>
                <label for="exampleFormControlTextarea1" class="form-label"></label>
                <textarea class="classinput" id="exampleFormControlTextarea1" placeholder="Add comment..."
                  rows="2"></textarea>
                <br>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <br>
            <div class="container-fluid">
              <img id="telephone" src="assets/images/Phone.png">

              <a href="" onclick="alert('You re calling this number...')">
                <h2 class="call">
                  Call us:<br>
                  +383 44 342 685</h2>
              </a>
            </div>

          </div>
          <div class="col-md-1"></div>
        </div>
      </div>



      <?php
      $property_price = $_POST['property_price']; //QETU ME MARR DIQYSH PROPERTY PRICE
      
      $arrival_date = $_POST['arrival_date'];
      $departure_date = $_POST['departure_date'];

      $date1 = new DateTime($arrival_date);
      $date2 = new DateTime($departure_date);
      $interval = $date1->diff($date2);
      $num_nights = $interval->days;

      $total_price = $num_nights * $property_price;

      echo "Total Price: $total_price";
      ?>





      <div class="submit-buttoni">
        <button type="submit" class="submitButton" id="buttoni">
          <p>MAKE IT YOURS</p>
        </button>
      </div>

    </form>


    <script src="assets/js/book.js">

    </script>

</body>

</html>