<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->model('Alert_model');
		$data['testname'] = $this->Alert_model->printName();
		$data['testaccel'] = $this->Alert_model->getAccel('2014-09-01', 'blcb', '4');

		$data['nodeAlerts'] = $this->Alert_model->getAlert();
		$data['siteMaxNodes'] = $this->Alert_model->getSiteMaxNodes();
		$data['nodeStatus'] = $this->Alert_model->getNodeStatus();
		//echo $data['siteMaxNodes'];
		
		$this->load->view('graphs/testAlert', $data);
		//$this->load->view('graphs/alertPlot', $data);
	}

	public function wsall( $site = 'blcw', $from = '2010-01-01', $to = null )
	{
		$this->load->model('Weather_station_Model');
		$data['weatherJSON'] = $this->Weather_station_Model->getRawAll($site, $from, $to);
		
		echo $data['weatherJSON'];
	}
	
	public function wsindiv( $option = 'temp', $site = 'blcw', $from = '2010-01-01', $to = null )
	{
		$this->load->model('Weather_station_Model');
		//$data['weatherJSON'] = $this->Weather_station_Model->getRawAll($site, $from, $to);
		
		if($option == 'temp') {
			$data['weatherJSON'] = $this->Weather_station_Model->getTemp($site, $from, $to);
		}
		elseif ($option == 'wspd') {
			$data['weatherJSON'] = $this->Weather_station_Model->getWspd($site, $from, $to);
		}
		elseif ($option == 'wdir') {
			$data['weatherJSON'] = $this->Weather_station_Model->getWdir($site, $from, $to);
		}
		elseif ($option == 'rain') {
			$data['weatherJSON'] = $this->Weather_station_Model->getRain($site, $from, $to);
		}
		elseif ($option == 'batt') {
			$data['weatherJSON'] = $this->Weather_station_Model->getBatt($site, $from, $to);
		}
		elseif ($option == 'csq') {
			$data['weatherJSON'] = $this->Weather_station_Model->getCsq($site, $from, $to);
		}
		
		echo $data['weatherJSON'];
	}	
	
	public function accel( $site = 'blcb', $nid = 1, $from = '2010-01-01', $to = null )
	{
		$this->load->model('Accel_model');
		
		if($to == null) {
			$data['accelJSON'] = $this->Accel_model->getAccel($site, $nid, $from);
		}
		else {
			$data['accelJSON'] = $this->Accel_model->getAccel2($site, $nid, $from, $to);
		}
		
		echo $data['accelJSON'];
	}

	public function accel2( $site = 'blcb', $nid = 1, $from = '2010-01-01', $to = null )
	{
		$this->load->model('Accel_model');
		
		if($to == null) {
			$data['accelJSON'] = $this->Accel_model->getAccelPurged($site, $nid, $from);
		}
		else {
			$data['accelJSON'] = $this->Accel_model->getAccelPurged2($site, $nid, $from, $to);
		}
		
		echo $data['accelJSON'];
	}
	
	public function rain( $site = 'blcb', $from = '2014-01-01', $to = null )
	{
		$this->load->model('Rain_model');
		
		if($to == null) {
			$data['rainJSON'] = $this->Rain_model->getRain($site, $from);
		}
		else {
			$data['rainJSON'] = $this->Rain_model->getRain2($site, $from, $to);
		}
		
		echo $data['rainJSON'];
	}	
	
    public function rain2( $site = 'blcb', $from = '2014-01-01', $to = null )
    {
        $this->load->view('graphs/rainfall');
    }
	public function position( $site = 'blcb', $interval = 1, $xz = 0 )
	{
		$this->load->model('Position_model');
		
		$this->Position_model->getPosition($site, $interval, $xz);
		
		//$this->load->view('graphs/positionPlot');
	}	
	
	public function commhealth( $site = 'blcb')
	{
		$this->load->model('Comm_health_model');
		$this->Comm_health_model->getHealthOptimized($site);
		
		//$this->load->view('graphs/healthbars');
	}		
	
	public function healthbars()
	{
		$this->load->view('graphs/healthbars');
	}
	
	public function senttotal( $site = 'blcb', $tStart = '2014-01-01', $tEnd = null )
	{
		$this->load->model('Sent_node_total_Model');
		$this->Sent_node_total_Model->getSiteHealth($site, $tStart, $tEnd);
		
		//$this->load->view('graphs/positionPlot');
	}			
	
	public function sitehealth()
	{
		$this->load->view('graphs/sitehealth');
	}
	
    public function weather()
    {
        $this->load->view('graphs/weather');
    }
    
	public function rainfall()
	{
		$this->load->view('graphs/rainfall');
	}
	
	public function mini( $site = 'blcb' )
	{
		$this->load->helper('url');
		$this->load->model('Alert_model');
		
		$data['nodeAlerts'] = $this->Alert_model->getSingleAlert($site);
		$data['siteMaxNodes'] = $this->Alert_model->getSingleMaxNode($site);
		$data['nodeStatus'] = $this->Alert_model->getSingleNodeStatus($site);
		
		//$data['siteMaxNodes'] = $this->Alert_model->getSiteMaxNodes();
		//$data['nodeStatus'] = $this->Alert_model->getNodeStatus();
		//echo $data['siteMaxNodes'];
		
		$this->load->view('graphs/testAlertMini', $data);
	}

	public function map()
	{
		$this->load->helper('url');
		$this->load->model('Gmap_model');
		
		$data['sitesCoord'] = $this->Gmap_model->getSitesCoord();
		
		$this->load->view('graphs/testMap', $data);
	}

	public function datapres( $site = 'blcb', $interval = 1 )
	{
		$this->load->helper('url');
		$this->load->model('Data_presence_Model');
		
		$data['dataPresence'] = $this->Data_presence_Model->getSingleDataPresence($site, $interval);
	}
	
	public function dataprescsv( $site = 'blcb', $interval = 1 )
	{
		$this->load->helper('url');
		$this->load->model('Data_presence_Model');
		
		$data['dataPresence'] = $this->Data_presence_Model->getSingleDataPresenceCSV($site, $interval);
	}
	
	public function allpres( $interval = 1 )
	{
		$this->load->helper('url');
		$this->load->model('Data_presence_Model');
		
		$data['dataPresence'] = $this->Data_presence_Model->getAllDataPresence($interval);
		echo $data['dataPresence'];
	}
	
	public function allpres2( $interval = 1 )
	{
		$this->load->helper('url');
		$this->load->model('Data_presence_Model');
		
		$data['dataPresence'] = $this->Data_presence_Model->getAllDataPresence2($interval);
	}
	
	public function allprescsv( $interval = 1 )
	{
		$this->load->helper('url');
		$this->load->model('Data_presence_Model');
		
		$data['dataPresence'] = $this->Data_presence_Model->getAllDataPresenceCSV($interval);
	}	
	
	public function prescsv2json( $interval = 1 )
	{
		$this->load->helper('url');
		$this->load->model('Data_presence_Model');
		
		$data['dataPresence'] = $this->Data_presence_Model->getDataPresCSVtoJSON();
		
		$this->load->view('graphs/testDataPres', $data);
	}	

	public function presmap( $interval = 1 )
	{
		$this->load->helper('url');
		$this->load->model('Data_presence_Model');
		
		$data['allSites'] = $this->Data_presence_Model->getAllSiteNames();
		$data['dataPresence'] = $this->Data_presence_Model->getAllDataPresence($interval);
		
		$this->load->view('graphs/testDataPres', $data);
	}
	
	public function presmap2( $interval = 1 )
	{
		$this->load->helper('url');
		$this->load->model('Data_presence_Model');
		
		$data['allSites'] = $this->Data_presence_Model->getAllSiteNames();
		$data['dataPresence'] = $this->Data_presence_Model->getAllDataPresence($interval);
		
		$this->load->view('graphs/dataPres', $data);
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */

































