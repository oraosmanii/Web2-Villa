<?php
session_start();

function formatPhoneNumber()
{
  if (isset($_POST['phone-number'])) {
    $input = $_POST['phone-number']; 
    $phoneNumber = trim($input); 
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber); 
    if (strlen($phoneNumber) == 10) {
      $phoneNumber = preg_replace('/(\d{2})(\d{3})(\d{3})/', '+383 (00) $1 $2 $3', $phoneNumber);
    }
    $_POST['phone-number'] = $phoneNumber;
    return $phoneNumber; 
  }
  return '';
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Format phone number if it's set
if (isset($_POST['phone-number'])) {
$_POST['phone-number'] = formatPhoneNumber($_POST['phone-number']);
}
}

$formattedPhoneNumber = isset($_POST['phone-number']) ? $_POST['phone-number'] : '';
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


    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900");
      *{
        font-family: 'Poppins', sans-serif;
      }
      .property{
        font-size: 30px;
        font-style: light;
      }
      #total_price{
        font-style: italic;
      }
      input[type="date"]{
        color: #ffffff;
        border-color: #ffffff;
      }
    </style>
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
    <p class="book-caption">WE ALWAYS AIM TO CONFIRM YOUR RESERVATION WITHIN 1 HOUR</p> <br> <br>

    <form id="booking-form" action="mybookings.php" method="post">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-6">
            <div class="row">
            <?php
              include "Classes.php";

              if (isset($_GET['info'])) {
                $info = urldecode($_GET['info']);
                $page = recieverProperties($info);
              }
              $property_name = "{$page->get_country()},{$page->get_city()}";
              echo "<p class='property'> Property: $property_name</p>";
              ?>
            
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="arrival_date">Arrival Date:</label>
                <input type="date" id="arrival_date" name="arrival_date" required>
                <input type="hidden" id="property_name" name="property_name" value="<?php echo $property_name; ?>">
              </div>
              <div class="col-md-6">
                <label for="departure_date">Departure Date:</label>
                <input type="date" id="departure_date" name="departure_date" required>
                <input type="hidden" id="property_price" name="property_price" value="<?php echo $page->get_price(); ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br>
                <label for="radio" >Payment: &nbsp &nbsp &nbsp &nbsp</label>
                <input type="radio" id="cash" name="payment" checked> <label class="form-check-label" for="cash"
                  required>
                  Cash &nbsp &nbsp
                </label>
                <input type="radio" class="radio" id="bank" name="payment"> <label class="form-check-label" for="bank"
                  required>
                  Bank
                </label>
                <input style="width:50%;float: right;" type="text" id="bank" class="classinput"
                  placeholder="Bank Number">
        
                <br> <br> <br>
              </div>
            </div>
          
            <div class="row">
              
                  <div class="col-md-3">
                  <label for="phone-number">Phone number:</label></div>
                  <div class="col-md-9">
                  <input class="classinput"type="text" name="phone-number" placeholder="Phone number" value="<?php echo $formattedPhoneNumber?>"></div>
                
            </div>

            <label for="exampleFormControlTextarea1" class="form-label"></label>
                <textarea class="classinput" id="exampleFormControlTextarea1" placeholder="Add comment..."
                  rows="2"></textarea> <br> <br>
            <div class="row">
              <div class="col-md-8">
               <div id="total_price"></div> 
              </div>
              <div class="col-md-2">
              <div class="submit-buttoni">
                <button type="submit" class="submitButton" id="buttoni">
                 <p>MAKE IT YOURS</p>
                </button>
              </div>
              </div>
            </div>
          </div>
          
     
          <div class="col-md-4">
            <br>
            <div class="container-fluid">
              <img id="telephone" src="assets/images/Phone.png">
              <a href="" onclick="alert('You are calling this number...')">
                <h2 class="call">
                  Call us:<br>
                  +383 44 342 685</h2>
              </a>
            </div>
          </div>
          <div class="col-md-1"></div>
        </div>
            </div>
    </form>

    <script src="assets/js/book.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const arrivalDateInput = document.getElementById('arrival_date');
        const departureDateInput = document.getElementById('departure_date');
        const propertyPriceInput = document.getElementById('property_price');
        const totalPriceContainer = document.getElementById('total_price');

        arrivalDateInput.addEventListener('change', updateTotalPrice);
        departureDateInput.addEventListener('change', updateTotalPrice);

        function updateTotalPrice() {
          const arrivalDate = new Date(arrivalDateInput.value);
          const departureDate = new Date(departureDateInput.value);
          const propertyPrice = parseFloat(propertyPriceInput.value);

          if (!isNaN(arrivalDate.getTime()) && !isNaN(departureDate.getTime()) && !isNaN(propertyPrice)) {
            const numNights = Math.ceil((departureDate - arrivalDate) / (1000 * 60 * 60 * 24));
            const totalPrice = numNights * propertyPrice;
            totalPriceContainer.textContent = 'Total Price: ' + totalPrice.toFixed(2)+ "$";
            totalPriceContainer.style.fontWeight= '700'; 
            totalPriceContainer.style.fontSize = '23px';
          } else {
            totalPriceContainer.textContent = 'Total Price: 0$';
            totalPriceContainer.textContent = 'Enter your travel dates for total price';
            totalPriceContainer.style.fontWeight= '700'; 
            totalPriceContainer.style.fontSize = '20px';
          }
        }
      });
    </script>

</body>

</html>
