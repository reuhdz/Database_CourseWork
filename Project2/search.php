<?php

include "dbconfig.php";
$conn = new mysqli($server, $dbusername, $dbpassword, $dbname2) or die($conn -> connect_error); 

$key = mysqli_real_escape_string($conn, trim($_GET['key']));

if(empty($key)){
	echo "no keyword entered";
}
else if($key == '*'){
	$query = "SELECT p.id, p.name as p_name, p.description, p.sell_price, p.cost, p.quantity, v.name, u.login as u_id
FROM Products_hernareu p, CPS3740.Vendors v, CPS3740.Users u
where p.user_id = u.id and p.vendor_id = v.v_id Order By p.id";
	$result = $conn->query($query);
	echo "The search result for keyword: $key <br><br>";
	echo "<table border = '1'>
	      <tr>
	      <th>Product ID</th>
	      <th>Name</th>
	      <th>Description</th>
	      <th>Sell Price</th>
	      <th>Cost</th>
	      <th>Quantity</th>
	      <th>User name</th>
	      <th>Vendor name</th>
	      </tr>";
	while($row = $result->fetch_assoc()){
		echo "<tr>";
		echo "<td>" . $row['id']."</td>";
        echo "<td>" . $row['p_name']."</td>";
        echo "<td>" . $row['description']."</td>";
        echo "<td>" . $row['sell_price']."</td>";
        echo "<td>" . $row['cost']."</td>";
        echo "<td>" . $row['quantity']."</td>";
        echo "<td>" . $row['u_id']."</td>";
        echo "<td>" . $row['name']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	mysqli_close($conn);
	mysqli_close($result);
}
else { 
	$query = "SELECT p.id, p.name as p_name, p.description, p.sell_price, p.cost, p.quantity, v.name, u.login AS u_id
FROM Products_hernareu p, CPS3740.Vendors v, CPS3740.Users u
where (p.name like '%$key%' or description like '%$key%') and (p.user_id = u.id and p.vendor_id = v.v_id) Order By p.id";
        $result = $conn->query($query);
	$row_ct = $result->num_rows;
	if($row_ct > 0){
        	echo "The search result for keyword: $key <br><br>";
        	echo "<table border = '1'>
              	      <tr>
             	      <th>ID</th>
              	      <th>Name</th>
              	      <th>Description</th>
              	      <th>Sell Price</th>
              	      <th>Cost</th>
              	      <th>Quantity</th>
              	      <th>User name</th>
              	      <th>Vendor name</th>
              	      </tr>";
        	while($row = $result->fetch_assoc()){
                	echo "<tr>";
                	echo "<td>" . $row['id']."</td>";
                	echo "<td>" . $row['p_name']."</td>";
                	echo "<td>" . $row['description']."</td>";
                	echo "<td>" . $row['sell_price']."</td>";
                	echo "<td>" . $row['cost']."</td>";
                	echo "<td>" . $row['quantity']."</td>";
                	echo "<td>" . $row['u_id']."</td>";
                	echo "<td>" . $row['name']."</td>";
                	echo "</tr>";
        	}
        	echo "</table>";
		mysqli_close($conn);
		mysqli_close($result);
	}
	else {
		echo "No record(s) found with the search keyword: '$key'";
		mysqli_close($conn);
		mysqli_close($result);
	}
}
?>
