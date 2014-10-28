<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gold extends CI_Controller {

	public function view( $page = 'monitoring', $site = null, $node = 1 )
	{
		$this->load->helper('url');
	
		if(!file_exists('../codeigniter/application/views/gold/' . $page . '.php')) {
			show_404();
		}
	
		$data['title'] = $page;
		$data['version'] = "gold";
		$data['folder'] = "goldF";
		
		$data['charts'] = $data['tables'] = $data['forms'] = $data['bselements'] = '';
		$data['bsgrid'] = $data['blank'] = $data['home'] = $data['monitoring'] = '';
		$data['dropdown_chart'] = $data['site'] = $data['node'] = '';
		$data['alert'] = $data['gmap'] = $data['commhealth'] = $data['analysisdyna'] = '';
		$data['position'] = '';
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
				
				//Data for Communication Health 
				if ($site){
					$data['healthNodes'] = $this->Comm_health_Model->getHealthOptimized($site);
				}
				else {
					$data['healthNodes'] = 0;
				}
				
				//$data['showplots'] = 'showSitePlots(this.form)';
				$data['showplots'] = 'redirectSitePlots(this.form)';
				$data['showdateplots'] = "showDateSitePlots(document.getElementById('formGeneral'))";
				
				$data['dropdown_chart'] = 'class="active"';
				$data['alert'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsalertmini.js"></script>';
				$data['position'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsposition.js"></script>';
				$data['gmap'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsmaps.js"></script>';
				$data['commhealth'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewscommhealth-d3.js"></script>';
				$data['analysisdyna'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsanalysisdyna.js"></script>';
				$data['sentnodetotal'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewssentnodetotal-d3.js"></script>';
				$data['rainfall'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsrainfall.js"></script>';
				
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
				$data['accel'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsaccel.js"></script>';
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
	
		$this->load->view('gold/templates/header', $data);
		$this->load->view('gold/templates/nav');
		$this->load->view('gold/' . $page, $data);
		$this->load->view('gold/templates/footer');
	}

}

/* End of file gold.php */
/* Location: ./application/controllers/gold.php */