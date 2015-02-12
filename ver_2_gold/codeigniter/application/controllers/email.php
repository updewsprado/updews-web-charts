<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'senslopenotification@gmail.com',
			'smtp_pass' => 'september172013'
		);
		
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		$this->email->from('senslopenotification@gmail.com', 'Senslope Notification');
		$this->email->to('updews.prado@gmail.com');
		$this->email->subject('This is an email test');
		$this->email->message('It is working. Great!');
		
		//$path = $this->config->item('server_root');
		//$file = $path . '/attachments/yourInfo.txt';
		
		//$this->email->attach($file);
		
		if ($this->email->send()) {
			echo "Your email was sent, handsome";
		}
		else {
			show_error($this->email->print_debugger());
		}
	}
	
	public function alertcol()
	{
		//Load Required Models
		$this->load->model('Alert_model');
		
		$data['nodeAlerts'] = $this->Alert_model->getAlertArr();
		
		echo $data['nodeAlerts'];
		//echo count($data['nodeAlerts']);
		
		$count = count($data['nodeAlerts']);
		
		/*
		foreach ($data['nodeAlerts'] as $nodeStatus) {
			echo $nodeStatus['site'] + " " + $nodeStatus['node'] + "<Br/>";
		}
		 */
		 
	}
}

/* End of file email.php */
/* Location: ./application/controllers/email.php */


































