<?php
	require_once('connectDB.php'); 
	require_once('getHealth.php'); 
	require_once('getSiteHealth.php'); 
	require_once('getAccel.php');
	require_once('getSitesCoord.php');
	require_once('getAlert.php');
	
	if(isset($_GET['db'])) {
		$mysql_database = $_GET['db'];
		//echo "db exists: $mysql_database<Br/>";	
	}
	else {
		//echo "db exists: $mysql_database<Br/>";	
	}	
	
	if(isset($_GET['health'])) {
		//echo "health exists<Br/>";
		$site = $_GET['site'];
		
		getHealth($site, $mysql_host, $mysql_database, $mysql_user, $mysql_password);
	}
	
	if(isset($_GET['sitehealth'])) {
		//echo "site health exists<Br/>";
		$site = $_GET['site'];
		$date = $_GET['q'];
		
		if(isset($_GET['site']) && isset($_GET['q'])) {
			//echo "site info & date data is incomplete<Br/>";
			getSiteHealth($date, $site, $mysql_host, $mysql_database, $mysql_user, $mysql_password);
		}
		else {
			echo "site info & date data is incomplete<Br/>";
		}
		
		//getSiteHealth($site, $mysql_host, $mysql_database, $mysql_user, $mysql_password);
	}
	
	if(isset($_GET['accel'])) {
		//echo "accel exists <Br/>";	
		$q = $_GET['q'];
		$site = $_GET['site'];
		$nid = (int)($_GET['nid']);
		
		getAccel($q, $site, $nid, $mysql_host, $mysql_database, $mysql_user, $mysql_password);
	}
	
	if(isset($_GET['accel2'])) {
		//echo "accel exists <Br/>";	
		$from = "'" . $_GET['from'] . "'";
		$to = $_GET['to'];
		$site = $_GET['site'];
		$nid = (int)($_GET['nid']);
		
		$to = "'" . date('Y-m-d H:i:s', strtotime($to. '+1 days +7 hours +45 minutes')) . "'";
		
		getAccel2($from, $to, $site, $nid, $mysql_host, $mysql_database, $mysql_user, $mysql_password);
	}

	if(isset($_GET['coord'])) {
		//echo "coord exists<Br/>";
		getCoord($mysql_host, $mysql_database, $mysql_user, $mysql_password);
	}
	
	if(isset($_GET['alert'])) {
		//echo "accel exists <Br/>";	
		$q = $_GET['q'];
		$site = $_GET['site'];
		$nid = (int)($_GET['nid']);
		
		//getAlert($q, $site, $mysql_host, $mysql_database, $mysql_user, $mysql_password);
		getAlert($site, $mysql_host, $mysql_database, $mysql_user, $mysql_password);
	}	
?>	




















































