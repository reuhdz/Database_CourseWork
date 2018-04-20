<?php
	setcookie("user", "", time() - 3600, '/');
	echo 'You are logged out<br><br>';

	echo "<a href='p2_index.html'>Log back in</a>";
	
?>
