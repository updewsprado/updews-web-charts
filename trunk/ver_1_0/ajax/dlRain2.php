<?php
	if(isset($_GET['site'])) {
		$site = $_GET['site'];
	}
	else {
		$site = 204;
	}

	date_default_timezone_set("Asia/Manila");
	$date_cur = "'" . date('Y-m-d H:i:s') . "'";
	
	$date_string = "-" . "14" . " days";
	$date_range =  "'" . date('Y-m-d H:i:s',strtotime($date_string)) . "'";
	
	
	//$html = file_get_contents("http://weather.asti.dost.gov.ph/home/index.php/api/data/204/from/2014-07-01/to/2014-07-20");
	$url = "http://weather.asti.dost.gov.ph/home/index.php/api/data/" . $site . "/from/" . $date_range . "/to/" . $date_cur;
	$html = file_get_contents($url);
	$json_obj = json_decode($html);
	
	foreach ($json_obj->data as $rdata) {
		echo $rdata->dateTimeRead . ",";
		echo $rdata->rain_value . "\n";
	}
?>