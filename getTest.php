<?php
	function getTest($q, $site, $nid, $host, $db, $user, $pass) {
		// Create connection
		$con=mysqli_connect($host, $user, $pass, $db);
		
		// Check connection
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$sql = "SELECT * FROM $site WHERE id = $nid and timestamp > '".$q."' ORDER BY timestamp ASC";
		$result = mysqli_query($con, $sql);

		$dbreturn;
		$ctr = 0;
		while($row = mysqli_fetch_array($result)) {
			  $dbreturn[$ctr]['letter'] = $row['timestamp'];
			  $dbreturn[$ctr]['frequency'] = $row['mvalue'];

			  $ctr = $ctr + 1;
		}

	   echo json_encode( $dbreturn );

	   mysqli_close($con);
	}
?>




















































