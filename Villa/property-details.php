<?php
session_start();
include 'db_connection.php';

$property = null;
$info = null;

if (isset($_GET['info'])) {
    $info = urldecode($_GET['info']);
    $stmt = $conn->prepare("SELECT id, user_id, country, city, image, price, bathrooms, bedrooms, area, type, description FROM listings WHERE id = ?");
    $stmt->bind_param("i", $info);
    $stmt->execute(); 
    $result = $stmt->get_result();
    $property = $result->fetch_assoc();
    $stmt->close();

    $stmt = $conn->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE property_id = ?");
    $stmt->bind_param("i", $info);
    $stmt->execute();
    $stmt->bind_result($avg_rating);
    $stmt->fetch();
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

    <style>
    #weather{
    margin-top: 10px;
    padding: 10px;
    border: 1px solid black;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    height: 150px;
    width: 350px;
    position: relative;
    bottom: 450px;
    left: 60px;
    background-color: #63617d;
}

#weather .weather-card-title {
    margin-bottom: 10px;
    margin-left: 20px;
    color: white;
}

#weather img {
    width: 120px;
    height: 120px;
    float: right;
   position: relative;
   bottom: 20px;
   right: 10px;
}

#weather p {
    margin-bottom: 10px;
    margin-left: 20px;
    font-size: 17px;
    font-weight: 600;
    color: white;
}

.rating-section {
  width: 350px;
  height: 260px;
  margin: 0;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  position: relative;
  bottom: 430px;

}

.rating-card {
  border: none;
}

.rating-card-header {
  padding: 20px;
  border-bottom: 1px solid #ddd;
}

.rating-card-body {
    padding: 20px;
}

.yjet {
  display: inline-block;
  vertical-align: middle;
}

.yjet input[type="radio"] {
  display: none;
}

.yjet label {
  float: right;
  margin: 0 5px;
  padding: 5px;
  cursor: pointer;
}

.yjet label:before {
  content: "\2605";
  font-size: 30px;
  color: #ccc;
}

.yjet input[type="radio"]:checked ~ label:before {
  color: #f00;
}
    </style>


    <!-- WEATHER API SCRIPT -->
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const city = "<?php echo $property['city']; ?>";
    const country = "<?php echo $property['country']; ?>";
    const apiKey = "c8264818d37ac96a61cb2a99e282729a"; // Your API key

    const getWeather = async (city, country) => {
        const url = `https://api.openweathermap.org/data/2.5/weather?q=${city},${country}&appid=${apiKey}`;
        try {
            const response = await fetch(url);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching weather data:', error);
            return null; // Return null on error
        }
    };

    getWeather(city, country).then(weather => {
        if (weather) {
            const description = weather.weather[0].description;
            const temp = (weather.main.temp - 273.15).toFixed(1); // Convert Kelvin to Celsius
            const iconCode = weather.weather[0].icon;
            const iconUrl = `http://openweathermap.org/img/wn/${iconCode}@2x.png`;

            document.getElementById('weather-description').innerText = description;
            document.getElementById('weather-temp').innerText = `${temp}°C`;
            const weatherIcon = document.getElementById('weather-icon');
            weatherIcon.src = iconUrl;
            weatherIcon.style.display = 'block';
        } else {
            document.getElementById('weather-description').innerText = 'Weather data not available';
        }
    });
});
</script>
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
                    <span class="breadcrumb"><a href="#">Home</a> / Single Property</span>
                    <h3>Single Property</h3>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "errors.php";
    global $errors;

if ($property) {
            $images = json_decode($property['image'], true);
            $imagePath = !empty($images) ? $images[0] : 'default-image-path.jpg';
    // fetch
    $stmt = $conn->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE property_id = ?");
    $stmt->bind_param("i", $info);
    $stmt->execute();
    $stmt->bind_result($avg_rating);
    $stmt->fetch();
    $stmt->close();

    $avg_rating = round($avg_rating, 1);
      
      $images = json_decode($property['image'], true);

      $imagePath = !empty($images) ? $images[0] : 'default-image-path.jpg';

    echo "<div class='single-property section'>
    <div class='container'>
      <div class='row'>
        <div class='col-lg-8'>
          <div class='main-image'>
            <img src='{$imagePath}' alt='' height='490'>
          </div>
          <div class='main-content'>
            <span class='category'>{$property['type']}</span>
            <h4>{$property['country']} {$property['city']}</h4>
            <p>Average Rating: {$avg_rating}</p>
            <p> {$property['description']}</p>
            
            </div> 
        </div>
        <div class='col-lg-4'>
    <div class='info-table-and-button-wrapper'>
      <div class='info-table'>
        <ul>
          <li>
            <img src='assets/images/info-icon-01.png' alt='' style='max-width: 52px;'>
            <h4>{$property['area']} m2<br><span>Total Flat Space</span></h4>
          </li>
          <li>
            <img src='assets/images/info-icon-02.png' alt='' style='max-width: 52px;'>
            <h4>{$property['bedrooms']}<br><span>Bedrooms</span></h4>
          </li>
          <li>
            <img src='assets/images/info-icon-04.png' alt='' style='max-width: 52px;'>
            <h4>{$property['bathrooms']}<br><span>Bathrooms</span></h4>
          </li>
          <li>
            <img src='assets/images/info-icon-03.png' alt='' style='max-width: 52px;'>
            <h4>$ {$property['price']}<br><span>Price</span></h4>
          </li>
        </ul>
      </div>";
} else {
    echo $errors['E016'];
}
?>
    
        <div class="icon-button" style="text-align: center; margin-top: 50px; height: 100px;">
        <?php
        if (isset($_SESSION['USER_ID']) && isset($property['user_id']) && $_SESSION['USER_ID'] != $property['user_id']) {
            echo '<a href="schedule.php?info=' . urlencode($info) . '" style="font-size: 23px;"><i class="fa fa-calendar"></i> Book Now</a>';
        }
        else if (isset($_SESSION['USER_ID']) && isset($property['user_id']) && $_SESSION['USER_ID'] == $property['user_id']) {
            echo '<span style="color: #EE626B;">This is your own listing </span>';
        } else {
            echo '<a href="logincopy.php" style="font-size: 23px;"><i class="fa fa-calendar"></i> Log In</a>';
        }
        ?>
    </div>

    </div>


    <!-- RATING SECTION -->
  
        <div id="weather">
                <h3 class="weather-card-title">Current Weather</h3>
            <div class="weather-card-body">
                <img id="weather-icon" alt="Weather Icon" style="display: none;">
                <p id="weather-description"></p>
                <p id="weather-temp"></p>
            </div>      
        </div>

    
    <div class="rating-section">
    <div class="rating-card">
        <div class="rating-card-header">
            <h3>Rate this property</h3>
        </div>
        <div class="rating-card-body">

    <form id="rating-form" action="submit_rating.php" method="post">
        <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($info); ?>">
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
        <div class='login-first'>
            <?php
            if (empty($_SESSION['LogedIn'])) {
                echo "<a href='logincopy.php'>Log in first to rate</a></div>";
            } else {
                echo "<button type='submit' class='btn-submit btn btn-danger' style='position: relative; bottom: 15px; right: 25px'>Submit</button>";
            }
            ?>
    </form>
</div>
        </div>
    </div>
</div>
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
    <script>
$(document).ready(function() {
    $('#rating-form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        $.ajax({
            url: $(this).attr('action'), // Form action URL
            type: $(this).attr('method'), // Form method (POST)
            data: $(this).serialize(), // Serialize form data
            dataType: 'json', // Expect JSON response
            success: function(response) {
                alert(response.message); // Show alert with the response message
                if (response.redirect) {
                    window.location.href = response.redirect; // Redirect if needed
                }
            }
        });
    });
});
</script>

</body>

</html>