<?php
      include "Classes.php";
    function getLink(){
              if(!empty($_SESSION['LogedIn'])){
                return "schedule.php";
              }
              else{
                return "logincopy.php";
              }
            }
          $Link=getLink();
          
    $objectArray=array();
    function createCard(){
      global $Link;

      $myfile= fopen("Places.txt","r+");
      while (!feof($myfile)) {
          // Read a line from the file
          $line = fgets($myfile);
          $cards= urlencode($line);
          
          // Split the line by commas
          $data = explode(",", $line);
          
         
          // Process the data as needed
          // For example, you can print the split data

          $type=strtoupper(trim($data[8]));
          
          switch($type){
            case 'VILLA':
                $booking = new Villa($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
                break;
            case 'APARTMENT':
              $booking = new Apartment($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
              break;
            case 'PENTHOUSE':
              $booking = new Penthouse($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
              break;
            default:
              echo "Invalid creation";
          } 
          
          
          
          global $objectArray;
          transferArray($objectArray,$booking->get_id(),$booking->get_price());
          // $booking = new Villa($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);

              echo "<div class='col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 {$booking->get_type()}'>
              <div class='item'> 
              <a href='property-details.php?info={$cards}'><img src='{$booking->get_image()}' height='300' alt=''></a>
              <span class='category'>{$booking->get_type()}</span> 
              <h6>$ {$booking->get_price()}</h6>
            <h4><a href='property-details.php'>{$booking->get_country()} {$booking->get_city()}</a></h4>
            <ul>
              <li>Bedrooms: <span>{$booking->get_bedrooms()}</span></li>
              <li>Bathrooms: <span>{$booking->get_bathrooms()}</span></li>
              <li>Area: <span>{$booking->get_area()}m2</span></li>
            </ul>
            <div class='main-button'>
              <a href='{$Link}'>Book Now</a>
            </div>
            </div>
            </div>";
          
          // print_r($data);
          // echo "<br> <br>";
      }
      
      // Close the file
      fclose($myfile);
  }

  ?>