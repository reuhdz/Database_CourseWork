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
$conn = new mysqli($server, $dbusername, $dbpassword, $dbname) or die($conn->connect_error);

$cookie_name = "user";


$loginID = mysqli_real_escape_string($conn, $_POST["loginID"]);
$paswd = mysqli_real_escape_string($conn, $_POST["paswd"]);

$query = "SELECT * FROM Users WHERE login = '$loginID'";
$result = mysqli_query($conn, $query);
$row_ct = mysqli_num_rows($result);

if($row_ct == 1){
	while($row = mysqli_fetch_assoc($result)){
		if($row['password'] == $paswd){ //Display User info
			$cookie_val = $row['id'];
			setcookie($cookie_name, $cookie_val, time() + (86400 * 30), "/"); //set cookie

			echo "Welcome user: " . $row['first_name']. " ". $row['last_name'] ."<br>";
            echo "Role: " . $row['role']. "<br>";
            echo "Address: " . $row['address'] . ", ". $row['state']. ", " . $row['zipcode'];
            //Links
            if(strcasecmp($row['role'], 'Staff') == 0){
            	echo "<ul>";
            	echo "<li> <a href='addprod.php'>Add products</a></li>";
            	echo "<li> <a href='displayprod.php'>Display products</a></li>";
            	echo "<li> <a href='updateprod.php'>Update products</a></li>";
            	echo "</ul>";
            }

            echo "<br><br><a href = 'logout.php'>User logout</a>";
            echo "<br><a href = 'vendor.php'>View Vendors</a>";
            //Display Customers_hernareu table
            echo "<br><br>The customers are:<br> ";
            $query2 = "SELECT * FROM CPS3740_2018S.Customers_hernareu";
            $sum = "SELECT sum(balance) as total FROM CPS3740_2018S.Customers_hernareu";
			$result2 = mysqli_query($conn, $query2);
            $total = mysqli_query($conn, $sum);
            $row_ct2 = mysqli_num_rows($result2);

            if($row_ct2 >= 1){
                echo "<table border = '1'>
                      <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Balance</th>
                      <th>Zipcode</th>
                      </tr>";

                while($arr = mysqli_fetch_assoc($result2)){
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

            $add = mysqli_fetch_assoc($total);
            echo "<br>Total balance: " . $add['total'];

            mysqli_close($result2);
            mysqli_close($total);
		}
	}

}
mysqli_close($conn);
mysqli_close($result);

?>