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
	
	public function position( $site = 'blcb', $interval = 1, $xz = 0 )
	{
		$this->load->model('Position_model');
		
		$this->Position_model->getPosition($site, $interval, $xz);
		
		//$this->load->view('graphs/positionPlot');
	}	
	
	public function healthbars()
	{
		$this->load->view('graphs/healthbars');
	}
	
	public function sitehealth()
	{
		$this->load->view('graphs/sitehealth');
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
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */

































