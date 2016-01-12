<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/My_Controller.php';
class ajax extends My_Controller {

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
		//$request_url = 'store/detail/id/1/format/json';
		$url = $_POST ['url'];
		$request = isset($_POST ['request']) ? $_POST ['request'] : array();
		$method = $_POST ['method'];
		$data = my_api_request($url , $method, $request);
		//$data = array();
		//$data = my_api_request
		
		header('Content-Type: application/json');
    	echo $data;
		//return $data;
		
	}
        
        public function image()
	{
            header('Content-Type: application/json');
            try{
		$request = isset($_POST ['request']) ? $_POST ['request'] : array();
                if(!isset($request['src'])){
                     $rst = array('status'=>'400', 'msg'=>'invalid image');
                     echo json_encode($rst);die;
                }
                $src = $request['src'];
                $index = strpos($src, 'base64,') + 7;
                
                $imageData = substr($src, $index);
                //base 64 image data
                $imageData = base64_decode($imageData);
                $source = imagecreatefromstring($imageData);
                $f = finfo_open();
                $mime_type = finfo_buffer($f, $imageData, FILEINFO_MIME_TYPE);
                $type_arr = explode('/', $mime_type);
                $type = $type_arr[1];
                $plain_name = uniqid('upload');
                $imgName = $this->config->item( 'base_upload_path') . $plain_name;
                //save image to upload path
                $imageSave = imagejpeg($source, $imgName . '.' . $type,100);
                $target = $this->generateThumbnail($imgName,$type);
                $rst = array('status'=>'200', 'msg'=>$plain_name . '_thumb.' . $type);
                echo json_encode($rst);die;
            }
            catch(Exception $e){
                $rst = array('status'=>'500', 'msg'=>$e->getMessage());
                echo json_encode($rst);die;
            }
		//return $data;
		
	}
        
       protected function generateThumbnail($source, $type)
    {
        $max_size = 600;
        $full_path = $source . '.' . $type;
        $thumb_path = $source . '_thumb.' . $type;;
        if (filesize($full_path) > 5000000) {
            return "";
        }

        $info = getimagesize($full_path);
        if (!$info) {
            return "";
        }

        $type2 = isset($info['type']) ? $info['type'] : $info[2];
        // Check support of file type
        if (!(imagetypes() & $type2)) {
            // Server does not support file type
            return "";
        }
        $target = $thumb_path;
        $width = isset($info['width']) ? $info['width'] : $info[0];
        $height = isset($info['height']) ? $info['height'] : $info[1];

        if ($width > 5000 || $height > 5000) {
            return "";
        }

        // Calculate aspect ratio
        $w_ratio = $max_size / $width;
        $h_ratio = $max_size / $height;

        // Calculate a proportional width and height no larger than the max size.
        if (($width <= $max_size) && ($height <= $max_size)) {
            // Input is smaller than thumbnail, do nothing, copy it
            copy($full_path, $target);
            return $target;
        } elseif (($w_ratio * $height) < $max_size) {
            // Image is horizontal
            $t_height = ceil($w_ratio * $height);
            $t_width = $max_size;
        } else {
            // Image is vertical
            $t_width = ceil($h_ratio * $width);
            $t_height = $max_size;
        }

        // Using imagecreatefromstring will automatically detect the file type
        try {
            $source_image = imagecreatefromstring(file_get_contents($full_path));
        } catch (Exception $e) {
            return '';
        }

        if ($source_image === false) {
            // Could not load image
            return "";
        }

        $thumb = imagecreatetruecolor($t_width, $t_height);
        // Copy resampled makes a smooth thumbnail
        imagecopyresampled($thumb, $source_image, 0, 0, 0, 0, $t_width, $t_height, $width, $height);
        imagedestroy($source_image);

        // save it
        imagejpeg($thumb, $target);

        return $target;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */