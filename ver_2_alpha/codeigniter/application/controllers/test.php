<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
	
		$this->load->view('graphs/accelplot');
	}

}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */