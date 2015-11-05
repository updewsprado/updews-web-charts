<?php
	$mysql_host = "mysql.hostinger.ph";
	$mysql_database = "u657292987_sens";
	$mysql_user = "u657292987_def";
	$mysql_password = "sept17";

	$q = $_GET['q'];
    $q2 = $_GET['q2'];
	$site = $_GET['site'];
	
	//echo "Site: " . $site . "<Br/>Date: " . $q . "<Br/><Br/>";

	// Create connection
	$con=mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
	
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

    // Compose the query
	//$sql="SELECT * FROM $site WHERE timestamp >= '".$q."' and timestamp <= '".$q2."' ORDER BY timestamp ASC";
    $sql="SELECT * FROM $site WHERE timestamp between '".$q."' and '".$q2."' ORDER BY timestamp ASC";
	$result = mysqli_query($con, $sql);

	$dbreturn;
	$ctr = 0;
	while($row = mysqli_fetch_array($result)) {
          $dbreturn[$ctr]['timestamp'] = $row['timestamp'];
          $dbreturn[$ctr]['id'] = $row['id'];
          $dbreturn[$ctr]['xvalue'] = $row['xvalue'];
          $dbreturn[$ctr]['yvalue'] = $row['yvalue'];
          $dbreturn[$ctr]['zvalue'] = $row['zvalue'];
          $dbreturn[$ctr]['mvalue'] = $row['mvalue'];

          $ctr = $ctr + 1;
	}

	echo json_encode( $dbreturn );

	mysqli_close($con);
?>			