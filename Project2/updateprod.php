<?php

$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])){
	echo "Please login in first<br>";
	echo "<a href='p2_index.html'>Login page</a>";
}
else {
	echo "<a href = 'logout.php'>Logout</a><br>";
	echo "<h1>Update Products</h1><br><br>";
	echo "You can only update description, cost, sell price and quantity.<br>";
	include "dbconfig.php";
	$conn = new mysqli($server, $dbusername, $dbpassword, $dbname2) or die ($conn -> connect_error);
	$static = "SELECT p.id, p.name as p_name,  v.name as v_name, u.login as u_id, CONCAT(u.first_name, ' ', u.last_name) as name FROM Products_hernareu p, CPS3740.Vendors v, CPS3740.Users u where p.user_id = u.id and p.vendor_id = v.v_id Order by p.id";
	$change = "SELECT description, sell_price, quantity, cost FROM Products_hernareu";

	$static_res = mysqli_query($conn, $static);
	//$static_ct = mysqli_rows_num($static_res);
	$change_res = mysqli_query($conn, $change);
	echo "<form action = 'update.php' method = 'Post'>";
	echo "<table border = '1'>
          <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Sell Price</th>
          <th>Cost</th>
          <th>Quantity</th>
          <th>Login ID</th>
          <th>Vendor name</th>
          </tr>";
	while($static_row = mysqli_fetch_assoc($static_res)){
	$change_row = mysqli_fetch_assoc($change_res);
	echo "<tr>";
    	echo "<td bgcolor = 'yellow' name = 'id'><input type = 'hidden' name = 'id[]' value = " . $static_row['id'].">". $static_row['id'] . "</td>";
        echo "<td bgcolor = 'yellow'><input type = 'hidden' name = 'p_name[]' value = " . $static_row['p_name'].">". $static_row['p_name'] ."</td>";
        echo "<td> <input type = 'text'  name = 'desc[]' value = '" . $change_row['description']. "'' ></td>";
        echo "<td> <input type = 'number' step = '0.01' name = 'sell[]' value = " . $change_row['sell_price']." ></td>";
       	echo "<td> <input type = 'number'  step = '0.01' name = 'cost[]' value = " . $change_row['cost']." ></td>";
       	echo "<td> <input type = 'number' name = 'quantity[]' value = " . $change_row['quantity']."></td>";
       	echo "<td bgcolor = 'yellow'><input type = 'hidden' name = 'u_id[]' value = " . $static_row['u_id'].">". $static_row['u_id'] ."</td>";
       	echo "<td bgcolor = 'yellow'><input type = 'hidden' name = 'v_name[]' value = " . $static_row['v_name'].">". $static_row['v_name'] ."</td>";
       	echo "</tr>";	
	  }
	  
	echo "</table><br>";
	echo "<input type = 'submit' value = 'Update Products'>";
	echo "</form>";
	mysqli_close($conn);
}
?>