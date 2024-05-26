<?php
include "db_connection.php"; 
include "Classes.php";

function getLink($id)
{
    if (!empty($_SESSION['LogedIn'])) {
        return "schedule.php?info=$id";
    } else {
        return "logincopy.php";
    }
}

function createCard(&$array = [])
{
    global $conn;

    if (empty($_POST['sort'])) {
        // fetch info from the database
        $result = $conn->query("SELECT * FROM properties");

        while ($data = $result->fetch_assoc()) {
            $cards = urlencode($data['id']); // from id

            $type = strtoupper(trim($data['type']));

            // Decode the JSON-encoded image paths
            $images = json_decode($data['image'], true);
            // Use the first image for the card (or handle as needed)
            $imagePath = !empty($images) ? $images[0] : 'default-image-path.jpg';

            switch ($type) {
                case 'VILLA':
                    $booking = new Villa($data['country'], $data['city'], $data['date'], $imagePath, $data['price'], $data['bedrooms'], $data['bathrooms'], $data['area']);
                    break;
                case 'APARTMENT':
                    $booking = new Apartment($data['country'], $data['city'], $data['date'], $imagePath, $data['price'], $data['bedrooms'], $data['bathrooms'], $data['area']);
                    break;
                case 'PENTHOUSE':
                    $booking = new Penthouse($data['country'], $data['city'], $data['date'], $imagePath, $data['price'], $data['bedrooms'], $data['bathrooms'], $data['area']);
                    break;
                default:
                    echo "Invalid creation";
            }

            $Link = getLink($cards);
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
        }

        $result->free();
    } else {
        foreach ($array as $objects) {
            $info = $objects[0];
            $Link = getLink($info['card']);
            echo "<div class='col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 {$info['type']}'>
                <div class='item'> 
                    <a href='property-details.php?info={$info['card']}'><img src='{$info['image']}' height='300' alt=''></a>
                    <span class='category'>{$info['type']}</span> 
                    <h6>$ {$info['price']}</h6>
                    <h4><a href='property-details.php'>{$info['country']} {$info['city']}</a></h4>
                    <ul>
                    <li>Bedrooms: <span>{$info['bedrooms']}</span></li>
                    <li>Bathrooms: <span>{$info['bathrooms']}</span></li>
                    <li>Area: <span>{$info['area']}m2</span></li>
                    </ul>
                    <div class='main-button'>
                        <a href='{$Link}'>Book Now</a>
                    </div>
                </div>
            </div>";
            echo "<script>console.log('I have been created')</script>";
        }
    }
}
?>
