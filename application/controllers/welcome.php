<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/My_Controller.php';
class Welcome extends My_Controller {

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
		//$path = //'../js/ckfinder';
		//$this->config->item( 'base_theme_url') . 'js/ckfinder/';
		//$width = '850px';
		//$this->editor($path, $width);
		
		
		$this->load->view('templates/header',
				$this->data
		);
		
		$this->load->view('welcome_message');
		$this->load->view('templates/footer', $this->data);
	}
        
        public function redirect()
	{	
		
		$this->load->view('templates/header',
				$this->data
		);
		
		$this->load->view('pages/welcome/redirect');
		$this->load->view('templates/footer', $this->data);
	}
	
	function editor($path,$width) {
            if($_POST){
                var_dump($_POST);
                $request_url = $this->data['router'] . '/list/format/json';
                                var_dump($request_url);die;
		$resp = my_api_request($request_url , $method = 'get', $param = array());
		$resp = json_decode($resp,true);
		if(isset($resp['error']))
		{
			$this->data['error'] = $resp['error'];
		}
	    else {
	    	foreach($resp as $item){
	    		if(isset($item['img']) && $item['img'] )
	    		{
	    			$imgs = explode($item['img'], ',');
	    			$item['img'] = $imgs[0];
	    		
	    		}
	    	}
	    	$this->data['items'] = $resp;
	    }
            }
            
//		//Loading Library For Ckeditor
//		$this->load->library('ckeditor');
//		$this->load->library('ckFinder');
//		//configure base path of ckeditor folder
//		$this->ckeditor->basePath = $this->config->item( 'base_theme_url') . 'js/ckeditor/';
//		//base_url().'js/ckeditor/';
//		$this->ckeditor-> config['toolbar'] = 'Full';
//		$this->ckeditor->config['language'] = 'en';
//		$this->ckeditor-> config['width'] = $width;
//		//configure ckfinder with ckeditor config
//		$this->ckfinder->SetupCKEditor($this->ckeditor,$path);
//		$this->ckeditor->addEventHandler('instanceReady', 'function (ev) {
//	   // alert("Loaded: " + ev.editor.name);
//				
//	  }');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */