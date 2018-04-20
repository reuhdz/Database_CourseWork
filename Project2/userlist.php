<?php
include "dbconfig.php";
$conn = new mysqli($server, $dbusername, $dbpassword, $dbname) or die($conn->connect_error);

$query = "SELECT id, login, password, concat(first_name,' ', last_name) as Name, role, address, zipcode, state FROM Users";

$result = $conn->query($query);
$row_ct = $result->num_rows;

if($row_ct >= 1){
	echo "The users in the database:<br><br>";
	echo "<table border = '1'>
		<tr>
		<th>ID</th>
		<th>login ID</th>
		<th>password</th>
		<th>Name</th>
		<th>Role</th>
		<th>address</th>
		<th>Zipcode</th>
		<th>State</th>
		</tr>";
	while($row = $result->fetch_assoc()){
		echo "<tr>";
		echo "<td>". $row['id']."</td>";
                echo "<td>". $row['login']."</td>";
                echo "<td>". $row['password']."</td>";
                echo "<td>". $row['Name']."</td>";
                echo "<td>". $row['role']."</td>";
                echo "<td>". $row['address']."</td>";
                echo "<td>". $row['zipcode']."</td>";
                echo "<td>". $row['state']."</td>";
		echo "</tr>";
	}
	echo "</table>";
}
else {
	echo "Empty Set";
}
 
?>
