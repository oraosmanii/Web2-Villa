<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $username=$_POST['username'];

    $file_content=file("users.txt",FILE_IGNORE_NEW_LINES);
    $email_exist=false;
    foreach($file_content as $line){
        $params=explode("~",$line);
        if($params[0]===$email){
            $email_exist=true;
            break;
        }
    }

if (!$email_exist) {
     $data = implode("~",array($email,$username,hash("sha256",$password)));
    file_put_contents("users.txt", $data."\n", FILE_APPEND);
    echo "Signup successful. <a href='logincopy.php'>Login here</a>";}
    else{
        echo "You already have an account. <a href='logincopy.php'>Login here</a>";
    }
} else {

    header("Location: logincopy.php");
}
?>
