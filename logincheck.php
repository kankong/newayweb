<?php
session_start();
include "model/mysqlpdoconn.php";

$user = $_POST['txtuser'];
$passwd = $_POST['pass'];

//echo $user . $passwd;

$sql = "SELECT * FROM userpass WHERE username='$user' AND password = '$passwd'";
$stmt = $conn -> query($sql);
$row = $stmt->rowCount();
//echo $row;
//$result = $stmt->fetch(PDO::FETCH_ASSOC);
//echo $result['username'] . "<br />";
//echo $result['password'] . "<br />";

if($row == 1){
   header("Location: showorderlist.php");
   $_SESSION['UserName']=$user;
}else{
   header("Location: login.html");
}

?>
