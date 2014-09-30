<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->model('Node_model');
		$data['testname'] = $this->Node_model->printName();
		$data['testaccel'] = $this->Node_model->getAccel('2014-09-01', 'blcb', '4');
	
		$this->load->view('graphs/accelplot', $data);
	}

}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */