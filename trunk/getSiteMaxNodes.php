<?php
require_once('connectDB.php'); 

header('Content-type: application/json');

if(isset($_GET['site'])) {
	$site = $_GET['site'];
}
else {
	$site = "blcb";
} 

// Create connection
$con=mysqli_connect($host, $user, $pass, $db);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql_maxnode = "SELECT * FROM site_column_props WHERE s_id IN (SELECT s_id FROM site_column WHERE name = '" . $site . "') ;";
$result = mysqli_query($con, $sql_maxnode);
$maxnode;

$row = mysqli_fetch_array($result);
$maxnode = $row['num_nodes'];
 
// Print it out as JSON
echo json_encode($maxnode);
?>


































