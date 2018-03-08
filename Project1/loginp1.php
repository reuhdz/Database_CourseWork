<?php
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
	$ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else {
	$ip = $_SERVER['REMOTE_ADDR'];
}
$IPv4 = explode(".",$ip);
	echo "<br>Your IP: $ip<br>";
if($IPv4[0] == 10){
	echo "You are from Kean University<br>";
}
elseif($IPv4[0] == 131 && $IPv4[1] == 125) {
	echo "You are from Kean University<br>";
}
else {
	echo "You are NOT from Kean University<br>";
}
include "dbconfig.php";
$conn = new mysqli($server, $dbusername, $dbpassword, $dbname) or die($conn-> connect_error);
$loginID = strtolower($_POST["loginID"]);
$paswd = $_POST["paswd"];

$query = "SELECT * FROM Users WHERE login='$loginID'";
$result = $conn->query($query);
$row_ct = $result->num_rows;

if($row_ct == 1){
        while($row = $result->fetch_assoc()){
                if($row['password'] == $paswd){
                        echo "Welcome user: " . $row['first_name']. " ". $row['last_name'] ."<br>";
                        echo "Role: " . $row['role']. "<br>";
                        echo "Address: " . $row['address'] . ", ". $row['state']. ", " . $row['zipcode'];
			//Display Customers_hernareu table

echo "<br><br>The customers are:<br> ";
$conn2 = new mysqli($server, $dbusername, $dbpassword, "CPS3740_2018S") or die($conn->connect_error);
$query2 = "SELECT * FROM Customers_hernareu";
$sum = "SELECT sum(balance) as total FROM Customers_hernareu";

$result2 = $conn2->query($query2);
$total = $conn2->query($sum);

$row_ct2 = $result2->num_rows;

if($row_ct2 >= 1){
         echo "<table border = '1'>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Balance</th>
                <th>Zipcode</th>
                </tr>";

        while($arr = $result2->fetch_assoc()){
                echo "<tr>";
                echo "<td>". $arr['id']."</td>";
                echo "<td>". $arr['name']."</td>";
                echo "<td>". $arr['balance']."</td>";
                echo "<td>". $arr['zip']."</td>";
                echo "</tr>";
        }
        echo "</table>";
}
else {
        echo "Empty set";
}

$add = $total->fetch_assoc();
echo "<br>Total balance: ".$add['total'];
                }
                else{
                        echo "User exists, but password does not match";
			$conn->close();
			$result->close();
                }
        }
	$conn->close();
	$result->close();
}
else {
        echo "Login ID " . "'".$_POST["loginID"]."'" . " doesn't exist in the database";
	$conn->close();
	$result->close();
}


?>
