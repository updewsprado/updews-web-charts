<?php
	require_once('connectDB.php'); 

	$site = $_POST['site'];
	$node = $_POST['node'];
	$status = $_POST['status'];
	$flagger = $_POST['rname'];
	$comment = $_POST['comment'];
	$dateID = $_POST['dateinput'];

	// Create connection
	$con = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	//echo "site: ". $site . ", node: " . $node . ", status: " . $status . ", reporter: " . $flagger;
	//echo ", comment/s: " . $comment;

	$query = "INSERT INTO node_status(post_id, post_timestamp, date_of_identification, flagger, site, node, status, comment) VALUES ('NULL', NULL, '$dateID', '$flagger', '$site', '$node', '$status', '$comment')";

	if (!mysqli_query($con,$query)) {
		die('Error: ' . mysqli_error($con));
	}

	echo "1 Node Status record added by " . $flagger;

	mysqli_close($con);
?>