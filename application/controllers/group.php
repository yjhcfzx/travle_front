<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/My_Controller.php';
class group extends My_Controller {

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
            if($_POST){
               $is_search = true;
               if(isset($_POST['keyword'])){
                   $keyword = $_POST['keyword'];
               }
            }
            
            $request_url = $this->data['router'] . '/list/format/json';
            $param = array();
            if(isset($keyword)){
                $param['keyword'] = $keyword;
            }
            $resp = my_api_request($request_url , 'get', $param);
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
        public function create()
        {
            $destination = $this->getDestinations();
            $this->data['destination'] =    $destination;

            $event = $this->getEvents();
            $this->data['event'] =    $event;
            
	   $this->load->view('templates/header',
				$this->data
		);
		
            $this->load->view('pages/' .   $this->data ['router'] . '/create', $this->data);
            $this->load->view('templates/footer', $this->data);
	}
        
        public function detail($id)
        {
            //create comment
            if(isset($_POST['submit']) && $_POST['submit']){
                $comment_content = $_POST['comment'];
                $request_url =  'comment/detail/format/json';
                $resp = my_api_request($request_url ,  'post', $param = array('content'=>$comment_content,'post_id'=>$id));
            }
            $request_url = $this->data['router'] . '/detail/format/json';
            $resp = my_api_request($request_url ,  'get', $param = array('id'=>$id));
            $resp = json_decode($resp,true);
            if(isset($resp['error']))
		{
			$this->data['error'] = $resp['error'];
		}
	    else {
                $imgOfText = null;
                if ($resp['main_image']) {
                $imgOfText =  $resp['main_image'];
                } else if ($resp['content']) {
                    $doc = new DOMDocument();
                    $doc->loadHTML($resp['content']);
                    $img = $doc->getElementsByTagName('img')->item(0);
                    if ($img) {
                        $imgOfText = $img->getAttribute('src');
                        $imgOfText = substr($imgOfText, strrpos($imgOfText, '/') + 1 );
                    }
                }
                $this->data['main_image'] = $imgOfText;
                $author_id = $resp['uid'];
                if(isset($this->data['user']) && $this->data['user']['id'] == $author_id){
                    $is_author = TRUE;
                    
                } else{
                    $is_author = FALSE;
                }
	    	$this->data['items'] = $resp;
                $this->data['is_author'] = $is_author;
                $this->data['page_title'] .= ' - ' . $resp['title'];
                $request_url =  'comment/list/format/json';
                $resp = my_api_request($request_url ,  'get', $param = array('post_id'=>$id));
                $resp = json_decode($resp,true);
            if(isset($resp['error']))
		{
			$resp = null;
		}
                $this->data['comments'] = $resp;
	    }
            
              
		$this->load->view('templates/header',
				$this->data
		);
                if(isset($_GET['action'])){
                    if($_GET['action'] == 'edit' && $is_author){
                          $destination = $this->getDestinations();
                          $this->data['destination'] =    $destination;
                          $event = $this->getEvents();
                          $this->data['event'] =    $event;
                        
                        $this->load->view('pages/' .   $this->data ['router'] . '/edit', $this->data);
                    }
                    else{
                        $this->load->view('pages/' .   $this->data ['router'] . '/detail', $this->data);
                    }
                }
                else{
                    $this->load->view('pages/' .   $this->data ['router'] . '/detail', $this->data);
                }
		
		$this->load->view('templates/footer', $this->data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */