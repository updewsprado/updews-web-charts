<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pubrelease extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Pubrelease_model');
	}

	public function index()
	{
		echo "Index of Pubrelease";
	}

	public function alertquery($internalAlertLevel = 'A0')
	{
		$alertJoins = $this->Pubrelease_model->getAlertResponses($internalAlertLevel);

		if ($alertJoins == "[]") {
			echo "Variable is empty<Br><Br>";
		}
		else {
			echo "$alertJoins";
		}
	}	

	// Insert Data to Public Alerts Table
	public function insertdata()
	{
		// Database login information
		$servername = "localhost";
		$username = "updews";
		$password = "october50sites";
		$dbname = "senslopedb";

		$timestamp = $_POST["entryTimestamp"];
		$site = $_POST["entrySite"];
		$alert = $_POST["entryAlert"];
		$timeRelease = $_POST["entryRelease"];
		$recipient = $_POST["entryRecipient"];
		$acknowledged = $_POST["entryAck"];
		$flagger = $_POST["entryFlagger"];

		$comments = $_POST["comments"];

		//echo "Received Data: $timestamp, $site, $alert, $timeRelease, $comments, $recipient, $acknowledged, $flagger";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT MAX(public_alert_id) AS id FROM public_alert";
		$result = mysqli_query($conn, $sql);

		$alertId = 1;
		while($row = mysqli_fetch_assoc($result)) {
		    if ($row["id"] != null) {
		      $alertId = $row["id"] + 1;
		    }
		}

		echo json_encode($alertId);

		$sql = "INSERT INTO public_alert VALUES (
		          '$alertId',
		          '$timestamp',
		          '$site',
		          '$alert',
		          '$timeRelease',
		          '$recipient',
		          '$acknowledged',
		          '$flagger')";

		$result = mysqli_query($conn, $sql);

		if ($comments != "") {
		  $sql = "INSERT INTO public_alert_extra VALUES (
		            '$alertId',
		            '$comments')";
		  
		  $result = mysqli_query($conn, $sql);
		}

		mysqli_close($conn);
	}	

	// Read data from public alerts table
	public function readdata()
	{
		// Database login information
		$servername = "localhost";
		$username = "updews";
		$password = "october50sites";
		$dbname = "senslopedb";

		//get site data
		if(isset($_GET['site'])) {
		    $site = $_GET["site"];
		}
		else {
		    echo "Error: No Site selected<Br>";
		    return;
		}

		//echo "Received Data: $timestamp, $site, $alert, $timeRelease, $comments, $recipient, $acknowledged, $flagger";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM public_alert WHERE site = '$site' ORDER BY entry_timestamp DESC";
		$result = mysqli_query($conn, $sql);

		$ctr = 0;
		$siteAlertPublic = [];
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        $siteAlertPublic[$ctr]["alert_id"] = $row["public_alert_id"];
		        $siteAlertPublic[$ctr]["ts_data"] = $row["entry_timestamp"];
		        $siteAlertPublic[$ctr]["name"] = $row["site"];
		        $siteAlertPublic[$ctr]["internal_alert"] = $row["internal_alert_level"];
		        $siteAlertPublic[$ctr]["ts_post_creation"] = $row["time_released"];
		        $siteAlertPublic[$ctr]["recipient"] = $row["recipient"];
		        $siteAlertPublic[$ctr]["acknowledged"] = $row["acknowledged"];
		        $siteAlertPublic[$ctr]["flagger"] = $row["flagger"];
		        $ctr++;
		    }

		    echo json_encode($siteAlertPublic); 
		}
		else {
		    echo 0;
		}

		mysqli_close($conn);
	}

	// Update data in public alerts table
	public function updatedata()
	{
		// Database login information
		$servername = "localhost";
		$username = "updews";
		$password = "october50sites";
		$dbname = "senslopedb";

		//get alert id
		if(isset($_GET['alertid'])) {
		    $alertid = $_GET["alertid"];
		}
		else {
		    echo "Error: No Entry for Alert ID input<Br>";
		    return;
		}

		//get entry timestamp data
		if(isset($_GET['entryts'])) {
		    $entryts = $_GET["entryts"];
		}
		else {
		    echo "Error: No Entry for Timestamp input<Br>";
		    return;
		}

		//TODO: Get time of post
		if(isset($_GET['time_post'])) {
		    $time_post = $_GET["time_post"];
		}
		else {
		    echo "Error: No Entry for Time of Post input<Br>";
		    return;
		}

		//TODO: Get internal alert level
		if(isset($_GET['ial'])) {
		    $ial = $_GET["ial"];
		}
		else {
		    echo "Error: No Entry for Internal Alert Level input<Br>";
		    return;
		}

		//TODO: Get recipients
		if(isset($_GET['recipient'])) {
		    $recipient = $_GET["recipient"];
		}
		else {
		    echo "Error: No Entry for recipient input<Br>";
		    return;
		}

		//TODO: Get time of acknowledgment from recipients
		if(isset($_GET['acknowledged'])) {
		    $acknowledged = $_GET["acknowledged"];
		}
		else {
		    echo "Error: No Entry for time of acknowledgment input<Br>";
		    return;
		}

		//TODO: Get name of flagger
		if(isset($_GET['flagger'])) {
		    $flagger = $_GET["flagger"];
		}
		else {
		    echo "Error: No Entry for flagger input<Br>";
		    return;
		}

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "UPDATE 
		            public_alert 
		        SET 
		            entry_timestamp = '$entryts',
		            time_released = '$time_post',
		            internal_alert_level = '$ial',
		            recipient = '$recipient',
		            acknowledged = '$acknowledged',
		            flagger = '$flagger'
		        WHERE 
		            public_alert_id = $alertid";
		$result = mysqli_query($conn, $sql);

		if ($result > 0) {
		    echo "Successfully updated entry! (alert id: $alertid)";
		}
		else {
		    echo "Update Failed....";
		}

		mysqli_close($conn);
	}

	// Delete data in public alerts table
	public function deletedata()
	{
		// Database login information
		$servername = "localhost";
		$username = "updews";
		$password = "october50sites";
		$dbname = "senslopedb";

		//$site = $_GET["entrySite"];

		//get alert id
		if(isset($_GET['alertid'])) {
		    $alertid = $_GET["alertid"];
		}
		else {
		    echo "Error: No Entry for Alert ID input<Br>";
		    return;
		}

		//echo "Received Data: $timestamp, $site, $alert, $timeRelease, $comments, $recipient, $acknowledged, $flagger";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "DELETE FROM
		            public_alert
		        WHERE 
		            public_alert_id = $alertid";

		$result = mysqli_query($conn, $sql);

		if ($result > 0) {
		    echo "Successfully deleted entry! (alert id: $alertid)";
		}
		else {
		    echo "Delete Failed....";
		}
		mysqli_close($conn);
	}

}

/* End of file pubrelease.php */
/* Location: ./application/controllers/pubrelease.php */