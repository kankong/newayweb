<?php
$username = "neway532_kong";
$password = "neway2480db";

try{
    $conn = new PDO("mysql:host=localhost;dbname=neway532_showroom",$username,$password);
    /*
    if($conn){
        echo "Connected to the <strong>neway532_showroom</strong> database successfully!";
    }
    */
}catch(PDOException $e){
    echo $e->getMessage();
}

?>