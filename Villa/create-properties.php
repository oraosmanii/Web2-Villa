<?php
include "db_connection.php"; 
include "Classes.php";
include "errors.php";

function getLink($id,$user)
{
    if (isset($_SESSION['USER_ID']) && isset($user) && $_SESSION['USER_ID'] != $user) {
        return "schedule.php?info=$id";
    } else if (isset($_SESSION['USER_ID']) && isset($user) && $_SESSION['USER_ID'] == $user){
        return "property-details.php?info=$id";
    }else{
        return "logincopy.php";
    }
}

function createCard(&$array = [])
{
    global $conn, $errors;

    if (empty($_POST['sort'])) {
        // fetch info from the database
        $result = $conn->query("SELECT * FROM listings");

        if ($result === false) {
            echo $errors['E001']; // Example: error when creating card
            return;
        }

        while ($data = $result->fetch_assoc()) {
            $cards = urlencode($data['id']); // from id
            $user= urlencode($data['user_id']);
            $type = strtoupper(trim($data['type']));
            $images = json_decode($data['image'], true);
            $imagePath = !empty($images) ? $images[0] : 'default-image-path.jpg';

            switch ($type) {
                case 'VILLA':
                    $booking = new Villa($data['user_id'],$data['country'], $data['city'], $data['date'], $imagePath, $data['price'], $data['bedrooms'], $data['bathrooms'], $data['area']);
                    break;
                case 'APARTMENT':
                    $booking = new Apartment($data['user_id'],$data['country'], $data['city'], $data['date'], $imagePath, $data['price'], $data['bedrooms'], $data['bathrooms'], $data['area']);
                    break;
                case 'PENTHOUSE':
                    $booking = new Penthouse($data['user_id'],$data['country'], $data['city'], $data['date'], $imagePath, $data['price'], $data['bedrooms'], $data['bathrooms'], $data['area']);
                    break;
                default:
                    echo $errors['E007'];
            }

            $Link = getLink($cards,$user);
            echo "<div class='col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 {$booking->get_type()}'>
                    <div class='item'> 
                        <a href='property-details.php?info={$cards}'><img src='{$booking->get_image()}' height='300' alt=''></a>
                        <span class='category'>{$booking->get_type()}</span> 
                        <h6>$ {$booking->get_price()}</h6>
                        <h4><a href='property-details.php?info={$cards}'>{$booking->get_country()} {$booking->get_city()}</a></h4>
                        <ul>
                        <li>Bedrooms: <span>{$booking->get_bedrooms()}</span></li>
                        <li>Bathrooms: <span>{$booking->get_bathrooms()}</span></li>
                        <li>Area: <span>{$booking->get_area()}m2</span></li>
                        </ul>
                        <div class='main-button'>
                            <a href='{$Link}'>";
                            if (isset($_SESSION['USER_ID']) && isset($data['user_id']) && $_SESSION['USER_ID'] != $data['user_id']) {
                                echo "Book Now";
                            } else if (isset($_SESSION['USER_ID']) && isset($data['user_id']) && $_SESSION['USER_ID'] == $data['user_id']){
                                echo "Inspect";
                            }else{
                                echo "Log In";
                            }
                        
                        echo "</div>
                    </div>
                </div>";    
        }

        $result->free();
    } else {
        foreach ($array as $objects) {
            $info = $objects[0];
            $Link = getLink($info['card'],$info['user_id']);
            echo "<div class='col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 {$info['type']}'>
                <div class='item'> 
                    <a href='property-details.php?info={$info['card']}'><img src='{$info['image']}' height='300' alt=''></a>
                    <span class='category'>{$info['type']}</span> 
                    <h6>$ {$info['price']}</h6>
                    <h4><a href='property-details.php?info={$info['card']}'>{$info['country']} {$info['city']}</a></h4>
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
