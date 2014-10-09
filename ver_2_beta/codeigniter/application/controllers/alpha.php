<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alpha extends CI_Controller {

	public function view( $page = 'monitoring' )
	{
		$this->load->helper('url');
	
		if(!file_exists('../codeigniter/application/views/alpha/' . $page . '.php')) {
			show_404();
		}
	
		$data['title'] = $page;
		$data['version'] = "alpha";
		$data['folder'] = "alphaF";
		
		$data['charts'] = $data['tables'] = $data['forms'] = $data['bselements'] = '';
		$data['bsgrid'] = $data['blank'] = $data['home'] = $data['monitoring'] = '';
		$data['dropdown_chart'] = $data['site'] = $data['node'] = '';
		$data['jsfile'] = $data['gmap'] = $data['commhealth'] = $data['analysisdyna'] = '';
		$data['sentnodetotal'] = $data['rainfall'] = $data['lsbchange'] = '';
		$data['accel'] = $data['showplots'] = $data['showdateplots'] = '';
		
		$data['ismap'] = false;

		switch ($page) {
			case 'home':
				$data['home'] = 'class="active"';
				break;
			
			case 'monitoring':
				$data['monitoring'] = 'class="active"';
				$data['jsfile'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsalert.js"></script>';
				$data['gmap'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsmaps.js"></script>';
				
				$data['ismap'] = true;
				break;
				
			case 'dropdown_chart':
				$data['dropdown_chart'] = 'class="active"';
				break;
				
			case 'site':
				$data['showplots'] = 'showSitePlots(this.form)';
				$data['showdateplots'] = "showDateSitePlots(document.getElementById('formGeneral'))";
				
				$data['dropdown_chart'] = 'class="active"';
				$data['jsfile'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsposition.js"></script>';
				$data['gmap'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsmaps.js"></script>';
				$data['commhealth'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewscommhealth.js"></script>';
				$data['analysisdyna'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsanalysisdyna.js"></script>';
				$data['sentnodetotal'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewssentnodetotal.js"></script>';
				$data['rainfall'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsrainfall.js"></script>';
				
				$data['ismap'] = true;
				break;
				
			case 'node':
				$data['showplots'] = 'showNodePlots(this.form)';
				$data['showdateplots'] = "showDateNodePlots(document.getElementById('formGeneral'))";
			
				$data['dropdown_chart'] = 'class="active"';
				$data['jsfile'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsposition.js"></script>';
				$data['gmap'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsmaps.js"></script>';
				$data['rainfall'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsrainfall.js"></script>';
				$data['lsbchange'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewslsbchange.js"></script>';
				$data['accel'] = '<script src="/' . $data['folder'] . '/js/dewslandslide/dewsaccel.js"></script>';
				
				$data['ismap'] = true;
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
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav', $data);
		$this->load->view('alpha/' . $page, $data);
		$this->load->view('templates/footer');
	}

}

/* End of file alpha.php */
/* Location: ./application/controllers/alpha.php */