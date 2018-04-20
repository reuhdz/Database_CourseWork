<?php
$cookie_name = "user";
$user = $_COOKIE[$cookie_name];
include "dbconfig.php";
$conn = new mysqli($server, $dbusername, $dbpassword, $dbname2) or die ("Connection error" . $conn -> connect_error);
$query = "SELECT description, sell_price, cost, quantity From Products_hernareu";
$result = mysqli_query($conn, $query);
$row_ct = mysqli_num_rows($result);
$ct = 0;
for($i = 0; $i < $row_ct; $i++){
	$row = mysqli_fetch_assoc($result);
	$id = $_POST['id'][$i];
	$desc = mysqli_escape_string($conn, $_POST['desc'][$i]);
	$sell = $_POST['sell'][$i];
	$cost = $_POST['cost'][$i]; 
	$quantity = $_POST['quantity'][$i];
	if($desc != $row['description'] or $sell != $row['sell_price'] or $cost != $row['cost'] or $quantity !=$row['quantity'] ){
		$update = "UPDATE Products_hernareu SET description = '$desc', sell_price = $sell, cost = $cost, quantity = $quantity, user_id = $user Where id = $id";
		$check = mysqli_query($conn, $update);
		if($check){
		$ct++;}
	}
}
if ($ct > 0){
	echo "Update successful. Items updated: " . $ct;
}
else {
	echo "Update not successful";
}
mysqli_close($conn);

?>