<?php
$cookie_name = "user";
$userID = $_COOKIE[$cookie_name];

//Connect to database
include "dbconfig.php";
$conn = new mysqli($server, $dbusername, $dbpassword, $dbname2) or die($conn -> connect_error);
//Form variables
$prodName = mysqli_real_escape_string($conn, $_POST['prodName']);
$desc = mysqli_real_escape_string($conn, $_POST['desc']);

$cost = $_POST['cost'];
$sell = $_POST['sell'];
$quantity = $_POST['quantity'];
$vendor_id = $_POST['vendor_id'];
if($cost < 0 or $sell < 0){
	echo "Cost or Sell cannot be negative" ;
}
else if ($sell < $cost) {
	echo "Sell price cannot be lower than the cost";
}
else if($quantity <= 0){
	echo "Quantity has to be greater than 0";
}
else {
	//Query product name
	$query = "SELECT name FROM Products_hernareu WHERE name like '%$prodName%' ";
	$result = mysqli_query($conn, $query);
	$row_ct = mysqli_num_rows($result);
	//Checks if product name exist 
	if($row_ct > 0){
		echo "Product name already exist. Try a new one";
	}
	else{
		echo "<a href = 'logout.php'>Logout</a><br>";
		$insert = "INSERT into Products_hernareu (name, description, sell_price, cost, quantity, user_id, vendor_id) Values ('$prodName', '$desc', $sell, $cost, $quantity, $userID, $vendor_id) ";
		
		$enter = mysqli_query($conn, $insert);
		if($enter){ 
			echo "Product added successfully";
		}
		
	}
}
mysqli_close($conn);

?>
