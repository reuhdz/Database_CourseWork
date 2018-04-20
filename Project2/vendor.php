<html>
<body style="margin: auto;">
  <div style="margin: auto; text-align: center;">
<?php
$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])){
  echo "Please login in first<br>";
  echo "<a href='p2_index.html'>Login page</a>";
}
else {
  include "dbconfig.php";
  $conn = new mysqli($server, $dbusername, $dbpassword, $dbname) or die("Connection error");
  $query = "SELECT * From Vendors where latitude is not NULL";
  $result = mysqli_query($conn, $query);
  $id = array();
  $name = array();
  $lat = array();
  $long = array();
  $ct = 0;
  echo "<a href = 'logout.php'> Logout</a><br><br>";
  echo "The Following vendors are in the database</br>";
  echo "<table border = '1' align = 'center'>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zipcode</th>
        <th>Location(Latitude, Longitude)</th>
        </tr>";
  while($row = mysqli_fetch_assoc($result)){
    $id[$ct] = $row['V_Id'];
    $name[$ct] = $row['Name'];
    $lat[$ct] = $row['latitude'];
    $long[$ct] = $row['longitude'];

    echo "<tr>";
    echo "<td>" . $row['V_Id']."</td>";
    echo "<td>" . $row['Name']."</td>";
    echo "<td>" . $row['address']."</td>";
    echo "<td>" . $row['city']."</td>";
    echo "<td>" . $row['State']."</td>";
    echo "<td>" . $row['Zipcode']."</td>";
    echo "<td>(" . $row['latitude'].", " . $row['longitude']. ")</td>";
    echo "</tr>";
    $ct++;
  }
  echo "</table><br><br>";
}
?>
  
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
    var i = 0;
    function initialize() {
        var mapOptions = {
                zoom: 4,

                center: new google.maps.LatLng(39.521741, -96.848224),
                mapTypeId: google.maps.MapTypeId.ROADMAP
       };

       var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

       var infowindow = new google.maps.InfoWindow();

	var markerIcon = {
  		scaledSize: new google.maps.Size(80, 80),
		  origin: new google.maps.Point(0, 0),
		  anchor: new google.maps.Point(32,65),
		  labelOrigin: new google.maps.Point(40,33)
	};
        var location;
        var mySymbol;
        var marker, m;

        var MarkerLocations= [
        ['<?php echo $id[0]; ?>', '<?php echo $name[0]; ?>', <?php echo $lat[0]; ?> , <?php echo $long[0]; ?>],
        ['<?php echo $id[1]; ?>', '<?php echo $name[1]; ?>', <?php echo $lat[1]; ?> , <?php echo $long[1]; ?>],
        ['<?php echo $id[2]; ?>', '<?php echo $name[2]; ?>', <?php echo $lat[2]; ?> , <?php echo $long[2]; ?>],
        ['<?php echo $id[3]; ?>', '<?php echo $name[3]; ?>', <?php echo $lat[3]; ?> , <?php echo $long[3]; ?>],
        ['<?php echo $id[4]; ?>', '<?php echo $name[4]; ?>', <?php echo $lat[4]; ?> , <?php echo $long[4]; ?>]];

for (m = 0; m < MarkerLocations.length; m++) {

        location = new google.maps.LatLng(MarkerLocations[m][2], MarkerLocations[m][3]),
        marker = new google.maps.Marker({ 
	    map: map, 
	    position: location, 
	    icon: markerIcon,	
	    label: {
	   	text: MarkerLocations[m][0] ,
		color: "black",
    		fontSize: "16px",
    		fontWeight: "bold"
	    }
	});

      google.maps.event.addListener(marker, 'click', (function(marker, m) {
        return function() {
          infowindow.setContent("Vendor Name: " + MarkerLocations[m][1]);
          infowindow.open(map, marker);
        }
      })(marker, m));
 }
}
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="map-canvas" style="height: 400px; width: 720px; margin: auto;"></div>
<!-- <iframe width="562" height="516" src="https://cybermap.kaspersky.com/en/widget/dynamic/dark" frameborder="0"> -->
</div>
</body>
</html>
  
