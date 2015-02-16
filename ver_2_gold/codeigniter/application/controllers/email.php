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
		$columnLinks = array();
		$ctr = 0;
		
		$data['nodeAlerts'] = $this->Alert_model->getColumnAlerts();
		
		//echo $data['nodeAlerts'];
		//echo count($data['nodeAlerts']);
		
		$count = count($data['nodeAlerts']);
		
		foreach ($data['nodeAlerts'] as $site) {
			//echo $nodeStatus['site'] . " " . $nodeStatus['node'] . "<Br/>";
			$columnLinks[$ctr++] = "www.dewslandslide.com/gold/site/" . $site;
		}
		 
		echo json_encode($data['nodeAlerts']);
	}

    public function html()
	{       
	    $config = array(
	        'protocol' => 'smtp',
	        'smtp_host' => 'tls://smtp.gmail.com',
	        'smtp_port' => 465,
	        'smtp_user' => 'senslopenotification@gmail.com',
			'smtp_pass' => 'september172013',
	        'mailtype'  => 'html',
	        'charset'   => 'utf-8'
	    );
	
		$this->load->helper('url');
		$this->load->model('Alert_model');
		$this->load->model('Data_presence_Model');
	    $this->load->library('email', $config);
	    $this->email->set_newline("\r\n");
		
	    $this->email->from('senslopenotification@gmail.com', 'Senslope Notification');
		$this->email->to('updews.prado@gmail.com');
	
	    $this->email->subject('Test Email');
	
		$this->load->model('Weather_station_Model');
		$body = $this->Weather_station_Model->getRawAll($site, '2010-01-01', null);
	
	    $this->email->message($body);
	
	    if (!$this->email->send()){
	        echo 'fail to load html email';
	    }
	    else {
	        echo 'success to send html email';
	    }
	}
}

/* End of file email.php */
/* Location: ./application/controllers/email.php */


































