<?php
	require_once('connectDB.php'); 
	
	if(isset($_GET['db'])) {
		$mysql_database = $_GET['db'];
		//echo "db exists: $mysql_database<Br/>";	
	}
	else {
		//echo "db exists: $mysql_database<Br/>";	
	}	
	
	/*
	//echo "test exists <Br/>";	
	$q = $_GET['q'];
	$site = $_GET['site'];
	$nid = 5;//(int)($_GET['nid']);
	
	// Create connection
	$con=mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
	
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$sql = "SELECT * FROM $site WHERE id = $nid and timestamp > '".$q."' ORDER BY timestamp ASC LIMIT 50";
	$result = mysqli_query($con, $sql);	
	*/
	date_default_timezone_set("Asia/Manila");
	$date_cur = "'" . date('Y-m-d H:i:s') . "'";
	
	$dbreturn;
	$ctr = 0;
	while($ctr < 40) {
		$date_string = "-" . $ctr . " days";
		$date_range =  date('Y-m-d H:i:s',strtotime($date_string));
	
		$dbreturn[$ctr]['letter'] = $date_range;
		$dbreturn[$ctr]['frequency'] = $ctr/100 + 0.20;

		$ctr = $ctr + 1;
	}

	echo json_encode( $dbreturn );

	mysqli_close($con);
?>	




















































