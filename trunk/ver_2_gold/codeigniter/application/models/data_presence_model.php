<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Includes the Gmap_Model class as well as the required sub-classes
 * @package codeigniter.application.models
 */

/**
 * Gmap_Model extends codeigniters base CI_Model to inherit all codeigniter magic!
 * @author Leon Revill
 * @package codeigniter.application.models
 */
class Data_presence_Model extends CI_Model
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

	public function getSingleDataPresence($site, $interval = 1)
	{
		$sql_maxnode = $this->db->query("SELECT * FROM site_column_props WHERE s_id IN 
									(SELECT s_id FROM site_column WHERE name = '" . $site . "')");
		
		$dbreturn = array();
		$ctr = 0;
		$accum = $interval * 1800;
		
		$maxnode = $sql_maxnode->row()->num_nodes;
							
		$sql = $this->db->query("SELECT FROM_UNIXTIME( CEILING(UNIX_TIMESTAMP(`timestamp`)/$accum ) * $accum ) 
							AS timeslice , COUNT(*) AS mycount FROM $site WHERE id <= $maxnode 
							GROUP BY timeslice DESC LIMIT 48");							
		
		$dbtstamp;
		$ctr_ts = 0;		
		foreach ($sql->result_array() as $row)
		{
			$dbtstamp[$ctr_ts]['site'] = $site;
			$dbtstamp[$ctr_ts]['timestamp'] = $row['timeslice'];
			$dbtstamp[$ctr_ts]['count'] = $row['mycount'];
			$ctr_ts = $ctr_ts + 1;
		}
		
		echo json_encode( $dbtstamp );
	}
	
	public function getSingleDataPresenceCSV($site, $interval = 1)
	{
		$sql_maxnode = $this->db->query("SELECT * FROM site_column_props WHERE s_id IN 
									(SELECT s_id FROM site_column WHERE name = '" . $site . "')");
		
		$dbreturn = array();
		$ctr = 0;
		$accum = $interval * 1800;
		
		$maxnode = $sql_maxnode->row()->num_nodes;
							
		$sql = $this->db->query("SELECT FROM_UNIXTIME( CEILING(UNIX_TIMESTAMP(`timestamp`)/$accum ) * $accum ) 
							AS timeslice , COUNT(*) AS mycount FROM $site WHERE id <= $maxnode 
							GROUP BY timeslice DESC LIMIT 48");							
		
		$dbtstamp = '';
		$ctr_ts = 0;		
		foreach ($sql->result_array() as $row)
		{
			//$dbtstamp = $dbtstamp . $site . ',' . $row['timeslice'] . ',' . $row['mycount'] . "\n";
			$tstamp = $row['timeslice'];
			$count = $row['mycount'];
			echo "'$site','$tstamp','$count'\n";
		}
		
		//echo $dbtstamp;
	}	
	
	public function getAllDataPresence($interval = 1)
	{	
		$dbreturn = array();
		$ctr = 0;
		$accum = $interval * 1800;
		
		$sitesAll = $this->db->query("SELECT name FROM site_column");	
		
		foreach ($sitesAll->result_array() as $row)
		{
			$site = $row['name'];

			$sql = $this->db->query("SELECT FROM_UNIXTIME( CEILING(UNIX_TIMESTAMP(`timestamp`)/$accum ) * $accum ) 
								AS timeslice , COUNT(*) AS mycount FROM $site 
								GROUP BY timeslice DESC LIMIT 48");							

			foreach ($sql->result_array() as $row)
			{
				$dbreturn[$ctr]['site'] = $site;
				$dbreturn[$ctr]['timestamp'] = $row['timeslice'];
				$dbreturn[$ctr]['count'] = $row['mycount'];
				$ctr = $ctr + 1;
			}
		}
		
		echo json_encode( $dbreturn );
	}
	
	public function getAllDataPresence2($interval = 1)
	{	
		$dbreturn = array();
		$ctr = 0;
		$accum = $interval * 1800;
		
		$sitesAll = $this->db->query("SELECT name FROM site_column");	
		
		foreach ($sitesAll->result_array() as $row)
		{
			$site = $row['name'];
			$this->getSingleDataPresence($site, $interval);
		}
		
		echo json_encode( $dbreturn );
	}

	public function getAllDataPresenceCSV($interval = 1)
	{	
		$dbreturn = array();
		$ctr = 0;
		$accum = $interval * 1800;
		
		$sitesAll = $this->db->query("SELECT name FROM site_column");	
		
		foreach ($sitesAll->result_array() as $row)
		{
			$site = $row['name'];
			$this->getSingleDataPresenceCSV($site, $interval);
		}
		
		//echo json_encode( $dbreturn );
	}

	//Move this to the Site Health Model!!!
	public function getSiteHealth($site, $tStart = '2014-10-01')
	{
		$sql_maxnode = $this->db->query("SELECT * FROM site_column_props WHERE s_id IN 
									(SELECT s_id FROM site_column WHERE name = '" . $site . "')");
		
		$dbreturn = array();
		$ctr = 0;
		
		$maxnode = $sql_maxnode->row()->num_nodes;
		
		$sql = $this->db->query("SELECT FROM_UNIXTIME( CEILING(UNIX_TIMESTAMP(`timestamp`)/1800)*1800 ) 
							AS timeslice , COUNT(*) AS mycount FROM $site WHERE timestamp > '".$tStart."'
							and id <= $maxnode GROUP BY timeslice");
		
		$dbtstamp;
		$ctr_ts = 0;		
		foreach ($sql->result_array() as $row)
		{
			$dbtstamp[$ctr_ts]['timestamp'] = $row['timeslice'];
			$dbtstamp[$ctr_ts]['count'] = $row['mycount'];
			$ctr_ts = $ctr_ts + 1;
		}
		
		echo json_encode( $dbtstamp );
	}
	
	public function getSitesCoord()
	{
		$query = $this->db->query("SELECT * FROM site_column");
		
		$dbreturn = array();
		$ctr = 0;
		
		foreach ($query->result_array() as $row)
		{		    
			$dbreturn[$ctr]['name'] = $row['name'];
			$dbreturn[$ctr]['lat'] = $row['lat'];
			$dbreturn[$ctr]['long'] = $row['long'];
			$dbreturn[$ctr]['place_installed'] = $row['place_installed'];
			
			$ctr = $ctr + 1;
		}
		
		//return json_encode($dbreturn);
		echo json_encode($dbreturn);
	}

}