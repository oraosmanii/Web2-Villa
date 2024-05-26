<?php
class Bookings {
      protected $id;
      protected $userId;
      protected $country;
      protected $city;
      protected $date;
      protected $imgpath;
      protected $price;

      function __construct($userId, $country, $city, $date, $imgpath, $price) {
        $this->id = uniqid();
        $this->userId=$userId;
        $this->country=$country;
        $this->city=$city;
        $this->date=$date;
        $this->imgpath=$imgpath;
        $this->price=$price;
      }

      function get_image(){
        return $this->imgpath;
      }
      function get_country(){
        return $this->country;
      }
      function get_city(){
        return $this->city;
      }
      function get_price(){
        return $this->price;
      }
      function get_date(){
        return $this->date;
      }
      function get_id(){
        return $this->id;
      }

    }

class Villa extends Bookings{
      private $bedrooms;
      private $bathrooms;
      private $area;
      private $type="Villa";


      function __construct($userId,$country, $city, $date, $imgpath, $price,$bedrooms,$bathrooms,$area){
        $this->id = uniqid();
        $this->userId= $userId;
        $this->country=$country;
        $this->city=$city;
        $this->date=$date;
        $this->imgpath=$imgpath;
        $this->price=$price;
        $this->bedrooms=$bedrooms;
        $this->bathrooms=$bathrooms;
        $this->area=$area;
      }
      function get_type()
      {
        return $this->type;
      }
      function get_bedrooms(){
        return $this->bedrooms;
      }
      function get_bathrooms(){
        return $this->bathrooms;
      }
      function get_area(){
        return $this->area;
      }
      function set_Villa_bedrooms($bedrooms){
        $this->bedrooms=$bedrooms;
      }
      function set_Villa_bathrooms($bathrooms){
        $this->bathrooms=$bathrooms;
      }
      function set_Villa_area($area){
        $this -> area=$area;
      }
    }

class Apartment extends Bookings{
      private $bedrooms;
      private $bathrooms;
      private $area;
      private $type="Apartment";


      function __construct($userId,$country, $city, $date, $imgpath, $price,$bedrooms,$bathrooms,$area){
        $this->id = uniqid();
        $this->userId= $userId;
        $this->country=$country;
        $this->city=$city;
        $this->date=$date;
        $this->imgpath=$imgpath;
        $this->price=$price;
        $this->bedrooms=$bedrooms;
        $this->bathrooms=$bathrooms;
        $this->area=$area;
      }
      function get_type()
      {
        return $this->type;
      }

      function get_bedrooms(){
        return $this->bedrooms;
      }
      function get_bathrooms(){
        return $this->bathrooms;
      }
      function get_area(){
        return $this->area;
      }
      function set_Apartment_bedrooms($bedrooms){
        $this->bedrooms=$bedrooms;
      }
      function set_Aparment_bathrooms($bathrooms){
        $this->bathrooms=$bathrooms;
      }
      function set_Apartment_area($area){
        $this -> area=$area;
      }
    }

class Penthouse extends Bookings{
      private $bedrooms;
      private $bathrooms;
      private $area;
      private $type ="Penthouse";


      function __construct($userId,$country, $city, $date, $imgpath, $price,$bedrooms,$bathrooms,$area){
        $this->id = uniqid();
        $this->userId= $userId;
        $this->country=$country;
        $this->city=$city;
        $this->date=$date;
        $this->imgpath=$imgpath;
        $this->price=$price;
        $this->bedrooms=$bedrooms;
        $this->bathrooms=$bathrooms;
        $this->area=$area;
      }
      function get_type()
      {
        return $this->type;
      }
      

      function get_bedrooms(){
        return $this->bedrooms;
      }
      function get_bathrooms(){
        return $this->bathrooms;
      }
      function get_area(){
        return $this->area;
      }
      function set_Penthouse_bedrooms($bedrooms){
        $this->bedrooms=$bedrooms;
      }
      function set_Penthouse_bathrooms($bathrooms){
        $this->bathrooms=$bathrooms;
      }
      function set_Penthouse_area($area){
        $this -> area=$area;
      }
    }

    function recieverProperties($info){
        
          
          // Split the line by commas
          $data = explode(",", $info);
          
          
          // Process the data as needed
          // For example, you can print the split data

          $type=strtoupper(trim($data[8]));
          
          switch($type){
            case 'VILLA':
                return new Villa($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8]);
                break;
            case 'APARTMENT':
              return new Apartment($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8]);
              break;
            case 'PENTHOUSE':
              return new Penthouse($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8]);
              break;
            default:
              echo "Invalid info";
          } 
    }
    function transferArray(&$Array,$booking,$card){
      $property = [
        'country' => $booking->get_country(),
        'city' => $booking->get_city(),
        'date' => $booking->get_date(),
        'image' => $booking->get_image(),
        'price' => (int)$booking->get_price(),
        'bathrooms' => (int)$booking->get_bathrooms(),
        'bedrooms' => (int)$booking->get_bedrooms(),
        'area' => (int)$booking->get_area(),
        'type' => $booking->get_type(),
        'card' => $card
    ];
    $Array[$booking->get_country()][]=$property;

    }
?>