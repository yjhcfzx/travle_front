<?php defined('BASEPATH') or exit('No direct script access allowed');
include('log4php/Logger.php');


/**
 * CodeIgniter Rest Controller
 *
 * A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link			https://github.com/chriskacerguis/codeigniter-restserver
 * @version         3.0.0-pre
 */
abstract class My_Controller extends CI_Controller
{
    /**
     * This defines the rest format.
     *
     * Must be overridden it in a controller so that it is set.
     *
     * @var string|null
     */
    protected $subnav = array(
        'user'=>array(

		"profile" => array(
			'href'=>'user/detail'	
		),
		"resource" => array(
				'href'=>'resource/index'	
		),)
        );
    protected $rest_format          = null;

    protected $data = array();

    protected function uploadImg($input_name, &$error){
    	if ( ! $this->upload->do_upload($input_name))
    	{
    		$error = $this->upload->display_errors();
    		return  false;
    	}
    	else
    	{
    		$this->data['upload_data'] = $this->upload->data();
    		$filepath = $this->data['upload_data']['file_name'];
    		return $filepath;
    
    		//$this->load->view('upload_success', $this->data);
    	}
    }
    
    protected function getDestinations(){
         $destination_url = 'common/destination/format/json';
         $destination = my_api_request($destination_url , $method = 'get', $param = array());
         $destination = json_decode($destination,true);
         return $destination;
    }
    
    protected function getHosts(){
         $api_url = 'common/host/format/json';
         $data = my_api_request($api_url , $method = 'get', $param = array());
         $data = json_decode($data,true);
         return $data;
    }
    
    protected function getEvents(){
         $event_url = 'common/event/format/json';
         $event = my_api_request($event_url , $method = 'get', $param = array());
         $event = json_decode($event,true);
         return $event;
    }

    /**
     * Constructor function
     * @todo Document more please.
     */
    public function __construct($config = 'rest')
    {
        parent::__construct();
        
//         Logger::configure('D:/e_work/soa_front/application/libraries/log4php/config.xml');
        
//         $logger = Logger::getLogger("main");
//         $logger->info("This is an informational message.");
//         $logger->warn("I'm not feeling so good...");
         $CI = & get_instance();
        $this->load->helper('api');
        $this->load->helper('my_form');
        $this->lang->load('general', 'chinese');
        $this->load->library('session');
        $this->load->helper('url');
        $router = $this->router->class;
        $action = $this->router->method;

        
        $this->data['router'] = $router;
        $this->data['action'] = $action;
        $this->data['subnav'] = $this->subnav;
        $current_url = $router . '/' . $action;
        //$this->session->unset_userdata('user');
        $current_user = $this->session->userdata('user');
        $url_string =  uri_string();
        $exception_arr = array(
        		'user/login',
        		'user/register',
        		'welcome/index',
                        'welcome/redirect',
                        'post/index',
                        'post/detail'
        		
        );
        $forget_arr = array(
        		'user/login',
        		'user/register',
                        'welcome/redirect',
        		
        );
        $url_string = $_SERVER['QUERY_STRING'] ? $url_string.'?'.$_SERVER['QUERY_STRING'] : $url_string;
        if(!in_array($current_url , $forget_arr)){
        	$this->session->set_userdata('current_url', $url_string);
        }
        if(!$current_user  && !in_array($current_url , $exception_arr)){
        	//redirect('../user/login', 'refresh');
            redirect('../welcome/redirect', 'refresh');
        }
        else
        {
        	$this->data['user'] = $current_user;
        }
        
            $request_url = 'post/list/format/json';
            $param = array('action'=>'recent');
            $resp = my_api_request($request_url , 'get', $param);
            $resp = json_decode($resp,true);
            if(isset($resp['error']))
            {
			//$this->data['error'] = $resp['error'];
            }
	    else {
	    	
	    	$this->data['recent_hot_post'] = $resp;
	    }
            
            
            $route = $this->uri->segment(1);
            $method = $this->uri->segment(2);
            if(!$method){
                $method = 'index';
            }
            $action = '';
            $url = parse_url($_SERVER['REQUEST_URI']);
            if($url && isset($url['query'])){
                parse_str($url['query'], $params);
                if(isset($params['action'])){
                    $action = $params['action'];
                }
            }
            $title = $route;
            if($method == 'index'){
                $title .= '_list'; 
            }else{
                 if($action == 'edit'){
                     $title .= '_' . $action; 
                 }else{
                      $title .= '_' .$method;
                 }
            }
             $this->data['page_title'] = $CI->lang->line($title);
             
    }



}
