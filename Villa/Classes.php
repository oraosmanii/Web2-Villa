<?php
class Bookings {
      protected $id;
      protected $country;
      protected $city;
      protected $date;
      protected $imgpath;
      protected $price;

      function __construct( $country, $city, $date, $imgpath, $price) {
        $this->id = uniqid();
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


      function __construct($country, $city, $date, $imgpath, $price,$bedrooms,$bathrooms,$area){
        $this->id = uniqid();
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

    }

class Apartment extends Bookings{
      private $bedrooms;
      private $bathrooms;
      private $area;
      private $type="Apartment";


      function __construct($country, $city, $date, $imgpath, $price,$bedrooms,$bathrooms,$area){
        $this->id = uniqid();
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

    }

class Penthouse extends Bookings{
      private $bedrooms;
      private $bathrooms;
      private $area;
      private $type ="Penthouse";


      function __construct($country, $city, $date, $imgpath, $price,$bedrooms,$bathrooms,$area){
        $this->id = uniqid();
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

    }

    function recieverProperties($info){
        
          
          // Split the line by commas
          $data = explode(",", $info);
          
          
          // Process the data as needed
          // For example, you can print the split data

          $type=strtoupper(trim($data[8]));
          
          switch($type){
            case 'VILLA':
                return new Villa($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
                break;
            case 'APARTMENT':
              return new Apartment($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
              break;
            case 'PENTHOUSE':
             return new Penthouse($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
              break;
            default:
              echo "Invalid info";
          } 
    }
?>