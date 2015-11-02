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
		$path = //'../js/ckfinder';
		$this->config->item( 'base_theme_url') . 'js/ckfinder/';
		$width = '850px';
		$this->editor($path, $width);
		
		
		$this->load->view('templates/header',
				$this->data
		);
		
		$this->load->view('welcome_message');
		$this->load->view('templates/footer', $this->data);
	}
	
	function editor($path,$width) {
            if($_POST){
                var_dump($_POST);die;
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