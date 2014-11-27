<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Includes the Weather_station_Model class as well as the required sub-classes
 * @package codeigniter.application.models
 */

/**
 * User_Model extends codeigniters base CI_Model to inherit all codeigniter magic!
 * @author Leon Revill
 * @package codeigniter.application.models
 */
class Weather_station_Model extends CI_Model
{
	/*
	* A private variable to represent each column in the database
	*/
	private $_id;
	private $_username;
	private $_password;
	
	private $purgedDB;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}
	
	public function getRawAll($site = 'blcw', $from = null, $to = null)
	{
		if($to == null) {
			$query = $this->db->query("SELECT * FROM $site WHERE timestamp > '".$from."' ORDER BY timestamp ASC");
		}
		else {
			$query = $this->db->query("SELECT * FROM $site WHERE timestamp between '".$from."' AND '".$to."' ORDER BY timestamp ASC");
		}
		
		$dbreturn;
		$ctr = 0;
		foreach ($query->result_array() as $row)
		{		    
		    $dbreturn[$ctr]['timestamp'] = $row['timestamp'];
			$dbreturn[$ctr]['name'] = $row['name'];
			$dbreturn[$ctr]['temp'] = $row['temp'];
			$dbreturn[$ctr]['wspd'] = $row['wspd'];
			$dbreturn[$ctr]['wdir'] = $row['wdir'];
			$dbreturn[$ctr]['rain'] = $row['rain'];
			$dbreturn[$ctr]['batt'] = $row['batt'];
			$dbreturn[$ctr]['csq'] = $row['csq'];			

			$ctr = $ctr + 1;
		}
		
		return json_encode( $dbreturn );
	}	
	
	public function getAccel($site = 'blcb', $nid = 1, $q = null)
	{
		$query = $this->db->query("SELECT * FROM $site WHERE id = $nid and timestamp > '".$q."' ORDER BY timestamp ASC");
		
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
	
	public function getAccel2($site = 'blcb', $nid = 1, $from = null, $to = null)
	{
		$query = $this->db->query("SELECT * FROM $site WHERE id = $nid and timestamp between '".$from."' AND '".$to."' ORDER BY timestamp ASC");
		
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
	
	public function getAccelPurged($site = 'blcb', $nid = 1, $q = null)
	{
		$this->purgedDB = $this->load->database('purged', TRUE);
		
		$query = $this->purgedDB->query("SELECT * FROM $site WHERE id = $nid and timestamp > '".$q."' ORDER BY timestamp ASC");
		
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

	public function getAccelPurged2($site = 'blcb', $nid = 1, $from = null, $to = null)
	{
		$this->purgedDB = $this->load->database('purged', TRUE);
		
		$query = $this->purgedDB->query("SELECT * FROM $site WHERE id = $nid and timestamp between '".$from."' AND '".$to."' ORDER BY timestamp ASC");
		
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