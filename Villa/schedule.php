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
                      <li><a href="index.php" >Home</a></li>
                      <li><a href="properties.php">Properties</a></li>
                      <li><a href="lease.php">Lease your Villa</a></li>
                      <li><a href="mybookings.php">My Bookings</a></li>
                      <li><a href="login.php">Log in | Sign up</a></li>
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

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <label for="Emri" class="form-label"></label>
              <input type="text" class="classinput" id="Emri" aria-describedby="emailHelp" placeholder="First Name"
                required>

              <label for="Mbiemri" class="form-label"></label>
              <input type="text" class="classinput" id="Mbiemri" placeholder="Surname" aria-describedby="emailHelp"
                required>


              <label for="exampleInputEmail1" class="form-label"></label>
              <input type="email" class="classinput" id="exampleInputEmail1" placeholder="E-mail"
                aria-describedby="emailHelp" required>


            </div>
            <div class="col-md-6">


              <label for="inputAddress" class="form-label"></label>
              <input type="text" class="classinput" id="inputAddress" placeholder="Address" required>

              <label for="inputCity" class="form-label"></label>
              <input type="text" class="classinput" id="inputCity" placeholder="City" required>

              <label for="inputState" class="form-label"></label>
              <input type="text" class="classinput" id="inputState" placeholder="State" required>



            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <br>
              <form oninput="x.value=parseInt(a.value)">
                <label for="netet">Select the number of nights you want to stay:</label>
                <input name="netet" type="range" id="a" value="1" min="1" max="20" step="1" style="margin-left: 20px; color: #fff;">
                <output style="font-family: 'Montserrat'; font-size: 18px;" name="x" for="a">1</output>
              </form>

            </div>

          </div>
          <div class="row">
            <div class="col-md-12">


              <br>
              <label for="radio" style="font-weight: bold;">Payment: &nbsp &nbsp &nbsp &nbsp</label>
              <input type="radio" id="cash" name="payment" checked> <label class="form-check-label" for="cash" required>
                Cash &nbsp &nbsp
              </label>
              <input type="radio" class="radio" id="bank" name="payment"> <label class="form-check-label" for="bank"
                required>
                Bank
              </label>
              <input style="width:50%;float: right;" type="text" id="bank" class="classinput" placeholder="Bank Number"
                required>

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

    <div class="submit-buttoni">
      <button  type="submit" class="submitButton" id="buttoni">
        <p>MAKE IT YOURS</p>
      </button>
    </div>




    <script src="assets/js/book.js">

    </script>

</body>

</html>