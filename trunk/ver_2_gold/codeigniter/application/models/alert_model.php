<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Includes the User_Model class as well as the required sub-classes
 * @package codeigniter.application.models
 */

/**
 * User_Model extends codeigniters base CI_Model to inherit all codeigniter magic!
 * @author Leon Revill
 * @package codeigniter.application.models
 */
class Alert_Model extends CI_Model
{
	/*
	* A private variable to represent each column in the database
	*/
	private $_id;
	private $_username;
	private $_password;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function printName()
	{
		$this->_name = "Test Title Name";
		return $this->_name;
	}
	
	// Function to convert CSV into associative array
	public function csvToArray($file, $delimiter)
	{
		$arr = array();
		 
		if (($handle = fopen($file, 'r')) !== FALSE) {
			$i = 0; 
			while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) {
				for ($j = 0; $j < count($lineArray); $j++) {
					$arr[$i][$j] = $lineArray[$j]; 
				} 
				$i++; 
			} 
			fclose($handle); 
		}
		
		return $arr; 
	}
	
	public function getAlert()
	{
		// Arrays we'll use later
		$keys = array();
		$arrayAlert = array();
		$arrayPlot = array();
		
		$file = 'lsbalerts2.csv';
		
		if(strcmp(base_url(),"http://localhost/") == 0) {
			$path = base_url() . 'temp/csvmonitoring/';
		}
		else {
			$path = base_url() . 'ajax/csvmonitoring/';
		}
		
		// Set your CSV feed
		$feed = $path . $file;
		
		// Do it
		$dataAlert = $this->csvToArray($feed, ',');
		 
		// Set number of elements (minus 1 because we shift off the first row)
		$count = count($dataAlert);
		
		//Use first row for names
		$labels = ["site","node","xalert","yalert","zalert"];
		 
		foreach ($labels as $label) {
			$keys[] = $label;
		}
		
		// Bring it all together
		for ($j = 0; $j < $count; $j++) {
			$dX = array_combine($keys, $dataAlert[$j]);
			$arrayAlert[$j] = $dX;
		}
		
		// Print as JSON data
		return json_encode($arrayAlert);
	}
	
	public function getSingleAlert($site)
	{
		$allAlerts = json_decode($this->getAlert());
		
		$siteAlerts = array();
		$ctr = 0;
		
		foreach ($allAlerts as $alert) {
			//if ($alert->site == '$site') {
			if (strcmp($alert->site, $site) == 0) {
				$siteAlerts[$ctr] = $alert;
				$ctr = $ctr + 1;
				//echo json_encode($alert);
			}
		}
		
		return json_encode($siteAlerts);
	}
	
	public function getSiteMaxNodes()
	{
		$query = $this->db->query("SELECT name FROM site_column");
		
		$sitesAll = array();
		$ctr = 0;
		
		foreach ($query->result_array() as $row)
		{		    
			$sitesAll[$ctr]['site'] = $row['name'];
			
			$sql_maxnode = $this->db->query("SELECT num_nodes FROM site_column_props WHERE s_id IN (SELECT s_id FROM site_column WHERE name = '" . $row['name'] . "')");
			
			$node = $sql_maxnode->row();
			$sitesAll[$ctr]['nodes'] = $node->num_nodes;
			
			$ctr = $ctr + 1;
		}
		
		return json_encode($sitesAll);
	}
	
	public function getSingleMaxNode($site)
	{
		
		$siteArray = array();
		
		$ctr = 0;    
		$siteArray[$ctr]['site'] = $site;
		
		
		$sql_maxnode = $this->db->query("SELECT num_nodes FROM site_column_props WHERE s_id IN (SELECT s_id FROM site_column WHERE name = '" . $site . "')");
		$node = $sql_maxnode->row();
		$siteArray[$ctr]['nodes'] = $node->num_nodes;
		
		$sql_maxall = $this->db->query("SELECT MAX(num_nodes) AS maxnode FROM site_column_props");
		$nodemax = $sql_maxall->row();
		$siteArray[$ctr]['maxall'] = $nodemax->maxnode;		
		
		return json_encode($siteArray);
	}	
	
	public function getNodeStatus()
	{
		$query = $this->db->query("
					SELECT 
						post_timestamp,
						date_of_identification,
						flagger,site,node,status,comment 
					FROM 
						node_status 
					WHERE 
						status <> 'OK'");
		
		$statusAll = array();
		$ctr = 0;
		
		foreach ($query->result_array() as $row)
		{		    
			$statusAll[$ctr]['post_timestamp'] = $row['post_timestamp'];
			$statusAll[$ctr]['date_of_identification'] = $row['date_of_identification'];
			$statusAll[$ctr]['flagger'] = $row['flagger'];
			$statusAll[$ctr]['site'] = $row['site'];
			$statusAll[$ctr]['node'] = $row['node'];
			$statusAll[$ctr]['status'] = $row['status'];
			$statusAll[$ctr]['comment'] = $row['comment'];
			
			$ctr = $ctr + 1;
		}
		
		return json_encode($statusAll);
	}

	public function getSingleNodeStatus($site)
	{
		$query = $this->db->query("
					SELECT 
						post_timestamp,
						date_of_identification,
						flagger,site,node,status,comment 
					FROM 
						node_status 
					WHERE 
						site = '$site' AND
						status <> 'OK'");
		
		$statusAll = array();
		$ctr = 0;
		
		foreach ($query->result_array() as $row)
		{		    
			$statusAll[$ctr]['post_timestamp'] = $row['post_timestamp'];
			$statusAll[$ctr]['date_of_identification'] = $row['date_of_identification'];
			$statusAll[$ctr]['flagger'] = $row['flagger'];
			$statusAll[$ctr]['site'] = $row['site'];
			$statusAll[$ctr]['node'] = $row['node'];
			$statusAll[$ctr]['status'] = $row['status'];
			$statusAll[$ctr]['comment'] = $row['comment'];
			
			$ctr = $ctr + 1;
		}
			
		return json_encode($statusAll);
	}
		
	public function getAccel($q, $site, $nid)
	{
		$query = $this->db->query("SELECT * FROM $site WHERE id = $nid and timestamp > '".$q."' ORDER BY timestamp ASC");
		
		$dbreturn;
		$ctr = 0;
		foreach ($query->result_array() as $row)
		{
		    //echo $row->title;
		    //echo $row->name;
		    //echo $row->email;
		    
		    $dbreturn[$ctr]['timestamp'] = $row['timestamp'];
			$dbreturn[$ctr]['xvalue'] = $row['xvalue'];
			$dbreturn[$ctr]['yvalue'] = $row['yvalue'];
			$dbreturn[$ctr]['zvalue'] = $row['zvalue'];
			$dbreturn[$ctr]['mvalue'] = $row['mvalue'];

			$ctr = $ctr + 1;
		}
		
		return json_encode( $dbreturn );
	}
	
	public function getAccel2($from, $to, $site, $nid)
	{
		$query = $this->db->query("SELECT * FROM $site WHERE id = $nid and timestamp between $from and $to ORDER BY timestamp ASC");
		
		$dbreturn;
		$ctr = 0;
		foreach ($query->result_array() as $row)
		{		    
		    $dbreturn[$ctr]['timestamp'] = $row['timestamp'];
			$dbreturn[$ctr]['xvalue'] = $row['xvalue'];
			$dbreturn[$ctr]['yvalue'] = $row['yvalue'];
			$dbreturn[$ctr]['zvalue'] = $row['zvalue'];
			$dbreturn[$ctr]['mvalue'] = $row['mvalue'];

			$ctr = $ctr + 1;
		}
		
		return json_encode( $dbreturn );
	}

}