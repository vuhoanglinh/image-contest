<?php
/**
* Upload Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Upload extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();	
	}

	/**
	* Function view plans page
	* Date: 10/02/2015
	* URL Page: plans
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show plans page
	*/
	public function index()
	{      

    if(isset($this->session->userdata[SESSION_USER_ID])) 
    {
      $this->load->library("common");
      $p_arr   =  $this->common->readfileconfig();

      $this->load->Model('Images');
      $user_id = $this->session->userdata[SESSION_USER_ID];
      $p_arr_img                      =  $this->Images->get_image_by_user($user_id);
      $p_temp                      =  array();
      
      foreach ($p_arr_img as $row) {        
        $row[THUMB]  =  base_url(UPLOAD_FOLDER_THUMB.THUMB.$row[DB_IMAGES_COL_NAME]);
        $row[DB_IMAGES_COL_NAME]   =  base_url(UPLOAD_FOLDER.$row[DB_IMAGES_COL_NAME]);
        $row[LINK]  =  base_url('gallery/detail/image_' . $row[DB_IMAGES_COL_ID]);
        $p_temp[]                  =  $row;
      }
      $p_data['p_arr_img']         =  $p_temp;
      $max_image                   =  (int)$p_arr[FILE_IMAGE_UPLOAD] - count($p_data['p_arr_img']);
      $p_data['p_setting']         =  array(
                                        'st_max_image'   =>   ($max_image > 0) ? $max_image : 0,
                                        'st_max_width'   =>   $p_arr[FILE_IMAGE_MAX_WIDTH],
                                        'st_max_height'  =>   $p_arr[FILE_IMAGE_MAX_HEIGHT],
                                        'st_min_width'   =>   $p_arr[FILE_IMAGE_MIN_WIDTH],  
                                        'st_min_height'  =>   $p_arr[FILE_IMAGE_MIN_HEIGHT],
                                        'st_max_size'    =>   $p_arr[FILE_IMAGE_SIZE],
                                        'st_extention'   =>   $p_arr[FILE_IMAGE_EXTENTION]
                                  );                                  

      $p_data['p_js_function']     =  $this->load->view('layouts/function', $p_data, TRUE);
      $p_data['maxFileUpload'] = isset($p_arr[FILE_IMAGE_UPLOAD])? $p_arr[FILE_IMAGE_UPLOAD] : 4;      
      
      $this->load->view('layouts/header');
      $this->load->view('layouts/upload', $p_data);
      $this->load->view('layouts/footer', array('isFooter' => true));
    }
    else
    {
      redirect(base_url());
    }
	}

	public function do_upload() 
  {
        $user_id         = $this->session->userdata[SESSION_USER_ID];
        $upload_path_url = base_url() . UPLOAD_FOLDER;

        $config['upload_path'] = FCPATH . UPLOAD_FOLDER;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '20000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload', $error);

            //Load the list of existing files in the upload directory
            $existingFiles = get_dir_file_info($config['upload_path']);
            $foundFiles = array();
            $f=0;
            foreach ($existingFiles as $fileName => $info) 
            {
              if($fileName!='thumbs')
              {
                //Skip over thumbs directory
                //set the data for the json array   
                $foundFiles[$f]['name'] = $fileName;
                $foundFiles[$f]['size'] = $info['size'];
                $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                //$foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
                //$foundFiles[$f]['deleteUrl'] = base_url() . UPLOAD_FOLDER . $fileName;
                //$foundFiles[$f]['deleteType'] = 'DELETE';
                $foundFiles[$f]['error'] = null;
                $f++;
              }
            }
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('files' => $foundFiles)));
        } 
        else 
        {
          if ( session_status() == PHP_SESSION_NONE ) {
            session_start();
          }
          if(isset($this->session->userdata[SESSION_USER_ID])) {

            if(!isset($_SESSION['imgs']))
            {
              $_SESSION['imgs'] = 0;
            }

            $_SESSION['imgs']   = $_SESSION['imgs'] + 1;

            $data[] = $this->upload->data();
            $this->load->library("common");
            $p_arr   =  $this->common->readfileconfig();

            $this->load->library('ImageResize');
            $this->load->Model('Images');

            for ($i=0; $i < count($data); $i++) { 
              # code...
            
            // create thumbnail
            $thumb = new ImageResize(UPLOAD_FOLDER . $data[$i]['file_name']);
            $thumb->resizeToWidth(THUMB_WIDTH);
            $thumb->save(UPLOAD_FOLDER_THUMB . THUMB . $data[$i]['file_name']);

            $arr_img    = array(
                DB_IMAGES_COL_NAME      => $data[$i]['file_name'],
                DB_IMAGES_COL_IS_HIDDEN => ($p_arr[FILE_IMAGE_CHECK_UPLOAD] == TRUE) ? IMAGE_NOT_HIDDEN : IMAGE_HIDDEN,
                DB_IMAGES_COL_ORIGIN    => IMG_FROM_USER_UPLOAD,
                DB_IMAGES_COL_APPID     => 0,
                DB_IMAGES_COL_AUTHOR    => $user_id);
                $this->Images->add_image($arr_img);
            }
            if (IS_AJAX) {


              echo json_encode(array('success' => $_SESSION['imgs']));
              if($this->input->post('imgs') == $_SESSION['imgs'])
              {
                unset($_SESSION['imgs']);
              }
            }
            else
            {
              redirect(base_url());
            }
          }
		}
	}
}