<?php

$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])){
	echo "Please login in first<br>";
	echo "<a href='p2_index.html'>Login page</a>";
}
else {
	echo "<a href='logout.php'>User logout</a><br><br>";
	echo "Product list<br>";
	require "dbconfig.php";
	$conn = new mysqli($server, $dbusername, $dbpassword, $dbname2) or die($conn -> connect_error);

	$query = "SELECT p.id, p.name as p_name, p.description, v.name as v_name, p.sell_price, p.cost, p.quantity,  u.login as u_id, CONCAT(u.first_name, ' ', u.last_name) as name FROM Products_hernareu p, CPS3740.Vendors v, CPS3740.Users u where p.user_id = u.id and p.vendor_id = v.v_id Order By p.id";

	$result = mysqli_query($conn, $query);
	$row_ct = mysqli_num_rows($result);	
	echo "<table border = '1'>
	      <tr>
	      <th>P ID</th>
	      <th>Product Name</th>
	      <th>Description</th>
	      <th>Vendor Name</th>
	      <th>Cost</th>
	      <th>Sellprice</th>
	      <th>Quantity</th>
	      <th>User login</th>
	      <th>User Name</th>
	      </tr>";
	if($row_ct >= 1){
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>" . $row['id']."</td>";
       		echo "<td>" . $row['p_name']."</td>";
        	echo "<td>" . $row['description']."</td>";
        	echo "<td>" . $row['v_name']."</td>";
        	echo "<td>" . $row['cost']."</td>";
        	echo "<td>" . $row['sell_price']."</td>";
        	echo "<td>" . $row['quantity']."</td>";
        	echo "<td>" . $row['u_id']."</td>";
        	echo "<td>" . $row['name']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	mysqli_close($conn);
}
?>