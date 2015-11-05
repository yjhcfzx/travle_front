<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/My_Controller.php';
class post extends My_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
        {
            
            $request_url = $this->data['router'] . '/list/format/json';
            $resp = my_api_request($request_url , $method = 'get', $param = array());
            $resp = json_decode($resp,true);
            if(isset($resp['error']))
		{
			$this->data['error'] = $resp['error'];
		}
	    else {
	    	
	    	$this->data['items'] = $resp;
	    }
		$this->load->view('templates/header',
				$this->data
		);
		
		$this->load->view('pages/' .   $this->data ['router'] . '/list', $this->data);
		$this->load->view('templates/footer', $this->data);
	}
        public function detail()
        {
                if($_POST){
                                var_dump($_POST);die;}
		$this->load->view('templates/header',
				$this->data
		);
		
		$this->load->view('pages/' .   $this->data ['router'] . '/detail', $this->data);
		$this->load->view('templates/footer', $this->data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */