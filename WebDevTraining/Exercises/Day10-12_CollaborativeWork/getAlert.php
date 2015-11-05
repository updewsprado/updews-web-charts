<?php
	function getAlert($site, $host, $db, $user, $pass) {
	//function getAlert($q, $site, $host, $db, $user, $pass) {
		// Create connection
		$con=mysqli_connect($host, $user, $pass, $db);
		
		// Check connection
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$sql_alert = "SELECT * FROM alert WHERE s_id IN (SELECT s_id FROM site_column WHERE name = '" . $site . "') ;";
		//$sql = "SELECT * FROM $site WHERE id = $nid and timestamp > '".$q."' ORDER BY timestamp ASC";
		$result = mysqli_query($con, $sql_alert);

		$dbreturn;
		$ctr = 0;
		while($row = mysqli_fetch_array($result)) {
			$dbreturn[$ctr]['tstamp'] = $row['tstamp'];
			$dbreturn[$ctr]['a_id'] = $row['a_id'];
			$dbreturn[$ctr]['s_id'] = $row['s_id'];
			$dbreturn[$ctr]['status'] = $row['status'];

			$ctr = $ctr + 1;
		}

	   echo json_encode( $dbreturn );

	   mysqli_close($con);
	}
?>