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
                    <a href="index.php" class="logo">
                        <h1>Villa</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="properties.php">Properties</a></li>
                      <li><a href="lease.php">Lease your villa</a></li>
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
  <!-- ***** Header Area End ***** -->

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Bookings</a> / listings</span>
          <h3>My Bookings</h3>
        </div>
      </div>
    </div>
  </div>

  <section class="py-5 bg-light" style="font-family: 'Poppins', sans-serif;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">Booking Cart</h2>
          <div class="cart-items" id="cart-items">
            <!-- Booking items will be dynamically added here -->
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
// document.addEventListener('DOMContentLoaded', function () {
//   const cartItemsContainer = document.getElementById('cart-items');
//   let subtotal = 0;

//   // Sample items with a booking date
//   const sampleItems = [
//     { id: 1, name: 'Booking Option 1', price: 99, img: 'https://via.placeholder.com/100', bookedOn: '2024-04-07' },
//     { id: 2, name: 'Booking Option 2', price: 149, img: 'https://via.placeholder.com/100', bookedOn: '2024-04-06' },
//     { id: 3, name: 'Booking Option 3', price: 79, img: 'https://via.placeholder.com/100', bookedOn: '2024-04-05' },
//     { id: 4, name: 'Booking Option 4', price: 44, img: 'https://via.placeholder.com/100', bookedOn: '2024-02-05' }
//   ];

//   // Function to add item to the cart
//   function addItemToCart(item) {
//     subtotal += item.price;
//     const itemRow = document.createElement('div');
//     itemRow.className = 'cart-item d-flex justify-content-between align-items-center mb-3';
//     itemRow.innerHTML = `
//       <div class="d-flex align-items-center">
//         <img src="${item.img}" alt="${item.name}" style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
//         <div>
//           <h6 class="my-0">${item.name}</h6>
//           <small class="text-muted">Booked on: ${item.bookedOn}</small><br>
//           <small class="text-muted">Price: $${item.price}</small>
//         </div>
//       </div>
//       <span class="text-muted">$${item.price}</span>
//       <button class="btn btn-sm" style="background-color: #f85424; color: white;" data-itemid="${item.id}">Remove</button>
//     `;
//     cartItemsContainer.appendChild(itemRow);
//     updateSummary();
//   }

//   // Function to remove item from the cart
//   function removeItemFromCart(event) {
//     if (!event.target.matches('[data-itemid]')) return;
//     const itemId = parseInt(event.target.getAttribute('data-itemid'), 10);
//     const item = sampleItems.find(item => item.id === itemId);
//     subtotal -= item.price;
//     event.target.closest('.cart-item').remove();
//     updateSummary();
//   }

//   // Function to update cart summary
//   function updateSummary() {
//     const tax = subtotal * 0.05;
//     const total = subtotal + tax;
//     document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
//     document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
//     document.getElementById('total').textContent = `$${total.toFixed(2)}`;
//   }

//   // Initial items
//   sampleItems.forEach(item => addItemToCart(item));

//   // Event listener for removing items
//   cartItemsContainer.addEventListener('click', removeItemFromCart);
// });
    document.addEventListener('DOMContentLoaded', function() {
      const cartItemsContainer = document.getElementById('cart-items');
const sampleItems = [
        { id: 1, name: 'Huge Sunny Villa – East Side', img: 'https://via.placeholder.com/150', dateReserved: '10-18-21 to 10-24-21', status: 'Pending', requestBy: 'User' },
        { id: 2, name: 'West Town 3rd Floor Dorm', img: 'https://via.placeholder.com/150', dateReserved: '10-04-21 to 10-05-21', status: 'Invoice Issued', requestBy: 'User' },
        { id: 3, name: 'Nest Villa East Side', img: 'https://via.placeholder.com/150', dateReserved: '10-04-21 to 10-05-21', status: 'Booked', requestBy: 'User' }
      ];
    
      const statusColors = {
        'Pending': 'orange', 
        'Invoice Issued': 'blue',
        'Booked': 'green'
      };
    
      function addItemToCart(item) {
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item d-flex justify-content-between align-items-center mb-3';
        itemElement.innerHTML = `
          <div class="d-flex align-items-center" style="flex-grow: 1;">
            <img src="${item.img}" alt="..." class="img-fluid rounded" style="width: 100px; height: auto; margin-right: 20px;">
            <div>
              <h5 class="fw-bold mb-1">${item.name}</h5>
              <p class="text-muted mb-0">Requested by: ${item.requestBy}</p>
              <p class="text-muted">Period: ${item.dateReserved}</p>
            </div>
          </div>
          <div style="margin-right: 20px;">
            <span class="badge rounded-pill" style="background-color: ${statusColors[item.status]};">${item.status}</span>
          </div>
          <button onclick="removeItem(${item.id})" class="btn btn-danger btn-sm">Remove</button>
        `;
        cartItemsContainer.appendChild(itemElement);
      }
    
      sampleItems.forEach(addItemToCart);
    
      window.removeItem = function(itemId) {
        const itemIndex = sampleItems.findIndex(item => item.id === itemId);
        if (itemIndex > -1) {
          sampleItems.splice(itemIndex, 1);
          cartItemsContainer.children[itemIndex].remove();
        }
      };
    });
    </script>
<?php
    
    //   class Bookings {
    //     private $id;
    //     private $country;
    //     private $city;
    //     private $date;
    //     private $imgpath;
    //     private $price;
  
    //     function __construct( $country, $city, $date, $imgpath, $price) {
    //       $this->id = uniqid();
    //       $this->country=$country;
    //       $this->city=$city;
    //       $this->date=$date;
    //       $this->imgpath=$imgpath;
    //       $this->price=$price;
    //     }
  
    //     function get_image(){
    //       return $this->imgpath;
    //     }
    //     function get_country(){
    //       return $this->country;
    //     }
    //     function get_city(){
    //       return $this->city;
    //     }
    //     function get_price(){
    //       return $this->price;
    //     }
    //     function get_date(){
    //       return $this->date;
    //     }
    //     function get_id(){
    //       return $this->id;
    //     }
  
    //   }
  
    //   function createCard(){
  
    //     $myfile= fopen("Mybookings.txt","r+");
    //     while (!feof($myfile)) {
    //         // Read a line from the file
    //         $line = fgets($myfile);
            
    //         // Split the line by commas
    //         $data = explode(",", $line);
            
            
    //         // Process the data as needed
    //         // For example, you can print the split data
            
    //         $villa= new Bookings($data[0],$data[1],$data[2],$data[3],$data[4]);
  
            
    //             echo " <div class='cart-item d-flex justify-content-between align-items-center mb-3'> 
    //               <div class='d-flex align-items-center'>
    //                 <img src='{$villa->get_image()}' alt='Place in {$villa->get_country()},{$villa->get_city()}' style='width: 100px; height: 100px; object-fit: cover; margin-right: 15px;'>
    //                 <div>
    //                 <h6 class='my-0'>{$villa->get_country()},{$villa->get_city()}</h6>
    //                 <small class='text-muted'>Booked on: {$villa->get_date()}</small><br>
    //                 <small class='text-muted'>Price: $ {$villa->get_price()}</small>
    //               </div>
    //             </div>
    //             <span class='text-muted'>$ {$villa->get_price()}</span>
    //             <button class='btn btn-sm' style='background-color: #f85424; color: white;' data-itemid='{$villa->get_id()}'>Remove</button>
              
    //           </div>";
            
    //         // print_r($data);
    //         // echo "<br> <br>";
    //     }
        
    //     // Close the file
    //     fclose($myfile);
    // }
  
    // createCard();
  
      ?>
   

  </body>
</html>