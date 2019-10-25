<?
session_start();

if($_SESSION['UserName'] == ""){
   header("Location: login.html");
}

echo "<h1>Order List</h1>";
include "model/mysqlpdoconn.php";
$sql = "SELECT * FROM orderlist";
$stmt = $conn -> query($sql);
?>
<table>
<tr><th>Order ID</th><th>Item Name</th><th>Item Code</th><th>Amount</th><th>Unit</th></tr>
<?php
while($data = $stmt->fetch( PDO::FETCH_ASSOC )){ 
    $result .="<tr><td>" . $data['order_id'] ."</td><td>" . $data['itemname'] . "</td><td>" .
             $data['itemcode'] . "</td><td>" . $data['amount'] . "</td><td>" . $data['unit'] . "</td></tr>";
    //itemname, itemcode, amount, unit
}
echo $result;
?>
</table>

