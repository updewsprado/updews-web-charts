<?php
	require_once('connectDB.php'); 

	$q = $_GET['q'];
	$site = $_GET['site'];
	$nid = (int)($_GET['nid']);

	// Create connection
	$con=mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
	
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql = "SELECT * FROM $site WHERE id = $nid and timestamp > '".$q."' ORDER BY timestamp ASC";
	$result = mysqli_query($con, $sql);

	$dbreturn;
	$ctr = 0;
	while($row = mysqli_fetch_array($result)) {
          $dbreturn[$ctr]['timestamp'] = $row['timestamp'];
          //$dbreturn[$ctr]['id'] = $row['id'];
          $dbreturn[$ctr]['xvalue'] = $row['xvalue'];
          $dbreturn[$ctr]['yvalue'] = $row['yvalue'];
          $dbreturn[$ctr]['zvalue'] = $row['zvalue'];
          $dbreturn[$ctr]['mvalue'] = $row['mvalue'];

          $ctr = $ctr + 1;
	}

   echo json_encode( $dbreturn );

   mysqli_close($con);
?>