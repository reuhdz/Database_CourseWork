<?php

$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])){
	echo "Please login in first<br>";
	echo "<a href='p2_index.html'>Login page</a>";
}
else {
	echo "<a href = 'logout.php'>Logout</a>";
	include 'dbconfig.php';
	$conn = new mysqli($server, $dbusername, $dbpassword, $dbname) or die ($conn -> connect_error);
	$query = "SELECT name, v_id FROM Vendors"; //returns name and id from Vendors Table
	$result = mysqli_query($conn, $query);
	//Add products form
	echo "<form method='Post' action='insertprod.php'>";
		echo "<h2>Add products:</h2><br><br>";
		echo "Product Name: <input type='text' name='prodName' required><br>";
		echo "Description: <input type='text' name='desc' required><br>";
		echo "Cost: <input type='number' name = 'cost' step = '0.01' required><br>";
		echo "Sell Price: <input type = 'number' name='sell' step = '0.01' required><br>";
		echo "Quantity: <input type = 'number' name = 'quantity' required><br>";
		echo "Select a Vendor: <select name='vendor_id'>";
		while($row = mysqli_fetch_array($result)){ //adds v_id to value and name to drop down option
			echo "<option value =". $row['v_id']. ">" . $row['name'] ;
		}
		echo "</select>";
		echo "<br><br><input type='submit' value = 'Submit'>";
	echo "</form>";
	mysqli_close($conn);
}

?>
