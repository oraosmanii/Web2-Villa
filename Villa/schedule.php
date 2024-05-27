<?php
session_start();
include 'db_connection.php';
include "errors.php";
global $errors;

define('TVSH', '0.18');

function formatPhoneNumber()
{
    if (isset($_POST['phone-number'])) {
        $input = $_POST['phone-number'];
        $phoneNumber = trim($input);
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
        if (strlen($phoneNumber) == 10) {
            $phoneNumber = preg_replace('/(\d{2})(\d{3})(\d{3})/', '+383 (0) $1 $2 $3', $phoneNumber);
        }
        $_POST['phone-number'] = $phoneNumber;
        return $phoneNumber;
    }
    return '';
}

function &getBookedDates($property_id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT arrival_date, departure_date FROM bookings WHERE property_id = ?");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $bookings_result = $stmt->get_result();
    $booked_dates = [];
    while ($row = $bookings_result->fetch_assoc()) {
        $booked_dates[] = ['start' => $row['arrival_date'], 'end' => $row['departure_date']];
    }
    $stmt->close();
    return $booked_dates;
}

$property_id = isset($_GET['info']) ? intval($_GET['info']) : 0;

if ($property_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM listings WHERE id = ?");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $property = $result->fetch_assoc();
    $stmt->close();

    // Fetch booked dates for the property
    $booked_dates = &getBookedDates($property_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formattedPhoneNumber = formatPhoneNumber();

    if (!isset($_SESSION['USER_ID'])) {
        echo $errors['E017'];
        exit();
    }

    $user_id = &$_SESSION['USER_ID'];
    $arrival_date = $_POST['arrival_date'];
    $departure_date = $_POST['departure_date'];
    $payment_method = $_POST['payment'];
    $comment = $_POST['comment'];
    $total_price = isset($_POST['total_price']) ? $_POST['total_price'] : 0;

    $today = date('Y-m-d');
    if ($arrival_date < $today || $departure_date <= $arrival_date) {
        echo $errors['E012'];
        exit();
    }

    // Check for date overlap
    $stmt = $conn->prepare("
        SELECT COUNT(*) FROM bookings 
        WHERE property_id = ? AND 
              ((arrival_date <= ? AND departure_date > ?) OR 
               (arrival_date < ? AND departure_date >= ?))
    ");
    $stmt->bind_param("issss", $property_id, $departure_date, $arrival_date, $arrival_date, $departure_date);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo $errors['E013'];
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, property_id, arrival_date, departure_date, phone_number, payment_method, comment, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssssd", $user_id, $property_id, $arrival_date, $departure_date, $formattedPhoneNumber, $payment_method, $comment, $total_price);

    if ($stmt->execute()) {
        header("Location: mybookings.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900");
        * {
            font-family: 'Poppins', sans-serif;
        }
        .property {
            font-size: 30px;
            font-style: light;
        }
        #total_price {
            font-style: italic;
        }
        input[type="date"] {
            color: #ffffff;
            border-color: #ffffff;
        }
    </style>
</head>
<body>
    <!-- Main Screen-->
    <audio id="Subscribe">
        <source src="Sounds/Subscribe.mp3" type="audio/mpeg">
    </audio>
    <main class="first-box">
        <header class="header-area header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <a href="index.php" class="logo">
                                <h1>Villa</h1>
                            </a>
                            <ul class="nav">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="properties.php">Properties</a></li>
                                <li><a href="lease.php">Lease your Villa</a></li>
                                <li><a href="mybookings.php">My Bookings</a></li>
                                <?php
                                if (!empty($_SESSION['LogedIn'])) {
                                    $username = $_SESSION['USERNAME'];
                                    echo "<li><a href='UserPage.php'>{$username}</a></li><li>
                                          <a href='logout.php'>Log Out</a></li>";
                                } else {
                                    echo "<li><a href='logincopy.php'>Log in | Sign up</a></li>";
                                } ?>
                            </ul>
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <br>
        <h1 class="book-title"><b>Book your dream villa<b></b></h1>
        <p class="book-caption">WE ALWAYS AIM TO CONFIRM YOUR RESERVATION WITHIN 1 HOUR</p> <br> <br>
        <form id="booking-form" action="#" method="POST">
            <input type="hidden" id="total_price_input" name="total_price" value=""> <!-- Hidden input for total price -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <div class="row">
                            <?php if ($property): ?>
                                <?php $property_name = "{$property['country']}, {$property['city']}"; ?>
                                <p class='property'>Property: <?php echo $property_name; ?></p>
                                <input type="hidden" id="property_name" name="property_name" value="<?php echo $property_name; ?>">
                                <input type="hidden" id="property_price" name="property_price" value="<?php echo $property['price']; ?>">
                            <?php else: ?>
                                <p class='property'>Property not found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="arrival_date">Arrival Date:</label>
                                <input type="text" id="arrival_date" name="arrival_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="departure_date">Departure Date:</label>
                                <input type="text" id="departure_date" name="departure_date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="radio">Payment: &nbsp &nbsp &nbsp &nbsp</label>
                                <input type="radio" id="cash" name="payment" value="cash" checked> <label class="form-check-label" for="cash" required>
                                    Cash &nbsp &nbsp
                                </label>
                                <input type="radio" class="radio" id="bank" name="payment" value="bank"> <label class="form-check-label" for="bank" required>
                                    Bank
                                </label>
                                <input style="width:50%;float: right;" type="text" id="bank_number" class="classinput" placeholder="Bank Number">
                                <br> <br> <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="phone-number">Phone number:</label>
                            </div>
                            <div class="col-md-9">
                                <input class="classinput" type="text" name="phone_number" id="phone_number" placeholder="Phone number" value="<?php echo $formattedPhoneNumber ?>">
                            </div>
                        </div>
                        <label for="exampleFormControlTextarea1" class="form-label"></label>
                        <textarea class="classinput" id="exampleFormControlTextarea1" placeholder="Add comment..." rows="2" name="comment"></textarea>
                        <br> <br>
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
                        <br> <br>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <div class="container-fluid">
                            <img id="telephone" src="assets/images/Phone.png">
                            <a href="" onclick="alert('You are calling this number...')">
                                <h2 class="call">Call us:<br>+383 44 342 685</h2>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </form>
        <script>
        function checkForm() {
            var arrivalDate = document.getElementById('arrival_date').value;
            var departureDate = document.getElementById('departure_date').value;
            var phoneNumber = document.getElementById('phone_number').value;
            var paymentMethod = document.querySelector('input[name="payment"]:checked');
            var bankNumber = document.getElementById('bank_number').value;
            var bankRadio = document.getElementById('bank').checked;

            if (arrivalDate && departureDate && phoneNumber && paymentMethod && (!bankRadio || (bankRadio && bankNumber))) {
                document.getElementById('buttoni').disabled = false;
            } else {
                document.getElementById('buttoni').disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('booking-form').addEventListener('submit', function(event) {
                var phoneNumber = document.getElementById('phone_number').value;
                var phonePattern = /^\+\d{11}$/;

                if (!phonePattern.test(phoneNumber)) {
                    alert("Please enter a valid phone number.");
                    event.preventDefault();
                }
            });

            document.getElementById('arrival_date').addEventListener('input', checkForm);
            document.getElementById('departure_date').addEventListener('input', checkForm);
            document.getElementById('phone_number').addEventListener('input', checkForm);
            var paymentRadios = document.querySelectorAll('input[name="payment"]');
            paymentRadios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (this.value === 'bank') {
                        document.getElementById('bank_number').required = true;
                    } else {
                        document.getElementById('bank_number').required = false;
                        document.getElementById('bank_number').value = '';
                    }
                    checkForm();
                });
            });
            document.getElementById('bank_number').addEventListener('input', checkForm);
            checkForm();
        });
        </script>
        <script src="assets/js/book.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const arrivalDateInput = $('#arrival_date');
                const departureDateInput = $('#departure_date');
                const propertyPriceInput = document.getElementById('property_price');
                const totalPriceContainer = document.getElementById('total_price');
                const totalPriceInput = document.getElementById('total_price_input');  // Hidden input for total price
                const TVSH = parseFloat("<?php echo TVSH; ?>");

                const today = new Date().toISOString().split('T')[0];
                const bookedDates = <?php echo json_encode($booked_dates); ?>;
                let bookedRanges = [];

                bookedDates.forEach(function(booking) {
                    let start = new Date(booking.start);
                    let end = new Date(booking.end);
                    bookedRanges.push({ start: start, end: end });
                });

                function isDateBooked(date) {
                    for (let i = 0; i < bookedRanges.length; i++) {
                        if (date >= bookedRanges[i].start && date <= bookedRanges[i].end) {
                            return true;
                        }
                    }
                    return false;
                }

                function noPastDates(date) {
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    if (date < today) {
                        return [false, "", "Past dates are disabled"];
                    }
                    if (isDateBooked(date)) {
                        return [false, "", "This date is already booked"];
                    }
                    return [true, "", ""];
                }

                arrivalDateInput.datepicker({
                    dateFormat: 'yy-mm-dd',
                    beforeShowDay: noPastDates,
                    onSelect: updateTotalPrice
                });

                departureDateInput.datepicker({
                    dateFormat: 'yy-mm-dd',
                    beforeShowDay: noPastDates,
                    onSelect: updateTotalPrice
                });

                function updateTotalPrice() {
                    const arrivalDate = new Date(arrivalDateInput.val());
                    const departureDate = new Date(departureDateInput.val());
                    const propertyPrice = parseFloat(propertyPriceInput.value);

                    if (!isNaN(arrivalDate.getTime()) && !isNaN(departureDate.getTime()) && !isNaN(propertyPrice)) {
                        const numNights = Math.ceil((departureDate - arrivalDate) / (1000 * 60 * 60 * 24));
                        const totalPrice = numNights * propertyPrice;
                        const totalPriceTVSH = totalPrice + (totalPrice * TVSH);

                        if (totalPrice < 0) {
                            totalPriceContainer.textContent = 'Please enter valid dates';
                            totalPriceContainer.style.fontWeight = '700';
                            totalPriceContainer.style.fontSize = '20px';
                            totalPriceInput.value = "";  
                        } else {
                            totalPriceContainer.innerHTML = '';
                            var totalPriceNode = document.createTextNode('Total Price: ' + totalPrice.toFixed(2) + "$");
                            var br = document.createElement("br");
                            var totalPriceTVSHNode = document.createTextNode("Total price with VAT: " + totalPriceTVSH.toFixed(2) + "$");
                            totalPriceContainer.appendChild(totalPriceNode);
                            totalPriceContainer.appendChild(br);
                            totalPriceContainer.appendChild(totalPriceTVSHNode);

                            totalPriceContainer.style.fontWeight = '700';
                            totalPriceContainer.style.fontSize = '23px';

                            totalPriceInput.value = totalPriceTVSH.toFixed(2);  
                        }
                    } else {
                        totalPriceContainer.textContent = 'Enter your travel dates for total price';
                        totalPriceContainer.style.fontWeight = '700';
                        totalPriceContainer.style.fontSize = '20px';
                        totalPriceInput.value = "";  
                    }
                }
            });
        </script>
    </main>
</body>
</html>
