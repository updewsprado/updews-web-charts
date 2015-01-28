<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gold extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->is_logged_in();
	}

	public function index() {
		echo "Gold Version index page";
	}

	public function view( $page = 'monitoring', $site = null, $node = 1 )
	{
		$this->load->helper('url');
	
		if(!file_exists('../codeigniter/application/views/gold/' . $page . '.php')) {
			show_404();
		}
	
		$data['first_name'] = $this->session->userdata('first_name');
		$data['last_name'] = $this->session->userdata('last_name');
	
		$data['title'] = $page;
		$data['version'] = "gold";
		$data['folder'] = "goldF";
		$data['imgfolder'] = "images";
		
		$data['charts'] = $data['tables'] = $data['forms'] = $data['bselements'] = '';
		$data['bsgrid'] = $data['blank'] = $data['home'] = $data['monitoring'] = '';
		$data['dropdown_chart'] = $data['site'] = $data['node'] = '';
		$data['alert'] = $data['gmap'] = $data['commhealth'] = $data['analysisdyna'] = '';
		$data['position'] = $data['presence'] = '';
		$data['slider'] = '';
		$data['sentnodetotal'] = $data['rainfall'] = $data['lsbchange'] = '';
		$data['accel'] = $data['showplots'] = $data['showdateplots'] = '';
		$data['sitesCoord'] = 0;
		
		$data['ismap'] = false;

		switch ($page) {
			case 'home':
				$data['home'] = 'class="active"';
				break;
			
			case 'monitoring':
				//Load Required Models
				$this->load->model('Alert_model');
				$this->load->model('Gmap_model');
				
				//Data for Alert Map
				$data['nodeAlerts'] = $this->Alert_model->getAlert();
				$data['siteMaxNodes'] = $this->Alert_model->getSiteMaxNodes();
				$data['nodeStatus'] = $this->Alert_model->getNodeStatus();
				
				//Data for Google Map Site Coordinates
				$data['sitesCoord'] = $this->Gmap_model->getSitesCoord();
				
				$data['monitoring'] = 'class="active"';
				$data['alert'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsalert.js"></script>';
				$data['gmap'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsmaps.js"></script>';
				$data['presence'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewspresence.js"></script>';
				
				$data['ismap'] = true;
				break;
				
			case 'dropdown_chart':
				$data['dropdown_chart'] = 'class="active"';
				break;
				
			case 'site':
				//Load Required Models
				$this->load->model('Gmap_model');
				$this->load->model('Alert_model');
				$this->load->model('Comm_health_Model');
				$this->load->model('Sent_node_total_Model');
				
				$data['site'] = $site;
				
				//Data for Alert Map
				if ($site) {
					$data['nodeAlerts'] = $this->Alert_model->getSingleAlert($site);
					$data['siteMaxNodes'] = $this->Alert_model->getSingleMaxNode($site);
					$data['nodeStatus'] = $this->Alert_model->getSingleNodeStatus($site);						
				}
				else {
					$data['nodeAlerts'] = 0;
					$data['siteMaxNodes'] = 0;
					$data['nodeStatus'] = 0;						
				}
				
				//Data for Google Map Site Coordinates
				$data['sitesCoord'] = $this->Gmap_model->getSitesCoord();
				
				//$data['showplots'] = 'showSitePlots(this.form)';
				$data['showplots'] = 'redirectSitePlots(this.form)';
				$data['showdateplots'] = "showDateSitePlots(document.getElementById('formGeneral'))";
				
				$data['dropdown_chart'] = 'class="active"';
				$data['slider'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsbrush-d3.js"></script>';
				$data['alert'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsalertmini.js"></script>';
				$data['position'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsposition.js"></script>';
				$data['gmap'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsmaps.js"></script>';
				$data['commhealth'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewscommhealth-d3.js"></script>';
				$data['analysisdyna'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsanalysisdyna.js"></script>';
				$data['sentnodetotal'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewssentnodetotal-d3.js"></script>';
				$data['rainfall'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsrainfall-d3.js"></script>';
				$data['ismap'] = true;
				break;
				
			case 'node':
				//Load Required Models
				$this->load->model('Alert_model');			
			
				$data['site'] = $site;
				$data['node'] = $node;
				
				//Data for Alert Map
				if ($site) {
					$data['nodeAlerts'] = $this->Alert_model->getSingleAlert($site);
					$data['siteMaxNodes'] = $this->Alert_model->getSingleMaxNode($site);
					$data['nodeStatus'] = $this->Alert_model->getSingleNodeStatus($site);						
				}
				else {
					$data['nodeAlerts'] = 0;
					$data['siteMaxNodes'] = 0;
					$data['nodeStatus'] = 0;						
				}				
				
				//$data['showplots'] = 'showNodePlots(this.form)';
				$data['showplots'] = 'redirectNodePlots(this.form)';
				$data['showdateplots'] = "showDateNodePlots(document.getElementById('formGeneral'))";
			
				$data['dropdown_chart'] = 'class="active"';
				$data['alert'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsalertmini.js"></script>';
				//$data['position'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsposition.js"></script>';
				//$data['gmap'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsmaps.js"></script>';
				$data['rainfall'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsrainfall.js"></script>';
				$data['lsbchange'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewslsbchange.js"></script>';
				$data['accel'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsaccel-d3.js"></script>';
				break;

			case 'nodereport':
				$this->nodereport();		
				break;
			
			case 'charts':
				$data['charts'] = 'class="active"';
				break;
				
			case 'tables':
				$data['tables'] = 'class="active"';
				break;
				
			case 'forms':
				$data['forms'] = 'class="active"';
				break;
				
			case 'bselements':
				$data['bselements'] = 'class="active"';
				break;
			
			case 'bsgrid':
				$data['bsgrid'] = 'class="active"';
				break;
			
			case 'blank':
				$data['blank'] = 'class="active"';
				break;
			
			default:
				break;
		}
	
		if ($page != 'nodereport') {
			$this->load->view('gold/templates/header', $data);
			$this->load->view('gold/templates/nav');
			$this->load->view('gold/' . $page, $data);
			$this->load->view('gold/templates/footer');			
		}
	}

	public function nodereport()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Alert_model');

		$data['nodeAlerts'] = $this->Alert_model->getAlert();
		$data['siteMaxNodes'] = $this->Alert_model->getSiteMaxNodes();
		$data['nodeStatus'] = $this->Alert_model->getNodeStatus();
		
		$this->form_validation->set_rules('site', 'Site Column', 'required');
		$this->form_validation->set_rules('node', 'Node ID', 'required');
		$this->form_validation->set_rules('discoverdate', 'Date Discovered', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('gold/nodereport', $data);
		}
		else
		{
			$this->Alert_model->set_node_status();
			redirect('gold/nodereport');
		}
	}

	public function logout() {
	    $this->session->sess_destroy();
	    //redirect('../login');
	    redirect('../lin');
	}
	
	public function is_logged_in() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || ($is_logged_in !== TRUE)) {
			echo 'You don\'t have permission to access this page. <a href="../lin">Login</a>';
			die();
		}
		else {
		}
	}

}

/* End of file gold.php */
/* Location: ./application/controllers/gold.php */






















