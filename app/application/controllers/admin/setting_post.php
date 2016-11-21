<?php
/**
* Setting_post Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Setting_post extends CI_Controller
{
	/* Construct function */
	public function __construct()
	{
		parent:: __construct();
	}

	/**
	* Function save info config to file config
	* File path: ./app/config.txt
	* Date: 25/01/2015
	* Data From Page: admin/setting
	* URL Page: admin/setting/save
	* Rewrite routing: file config/routes.php
	* @param get from method post (request by ajax)
	* File source ajax request: view/js/js_setting_view.php
	* @return 
	*/
	public function save()
	{
		/*
		|-------------------------------------------------------------------------------
		|Check exist file
		|-------------------------------------------------------------------------------
		*/
		if(!file_exists(FILE_CONFIG_PATH)) {
			fopen(FILE_CONFIG_PATH, "w");
		}

		/*
		|-------------------------------------------------------------------------------
		|Array config
		|-------------------------------------------------------------------------------
		*/
		$p_arr_info = array(
						FILE_HASHTAG_INSTAGRAM		=>	$this->input->post("txt_hashtag_itg"),
						FILE_HASHTAG_TWITTER		=>	$this->input->post("txt_hashtag_tw"),
						FILE_LOGO					=>	$this->input->post("txt_logo"),
						FILE_FAVICON				=>	$this->input->post("txt_favicon"),
						FILE_IMAGE_MAX_WIDTH		=>	$this->input->post("txt_img_maxwidth"),
						FILE_IMAGE_MAX_HEIGHT		=>	$this->input->post("txt_img_maxheight"),
						FILE_IMAGE_MIN_WIDTH		=>	$this->input->post("txt_img_minwidth"),
						FILE_IMAGE_MIN_HEIGHT		=>	$this->input->post("txt_img_minheight"),
						FILE_IMAGE_EXTENTION		=>	$this->input->post("sl_img_extention"),
						FILE_IMAGE_SIZE				=>	$this->input->post("txt_img_size"),
						FILE_BEGIN_DATE				=>	$this->input->post("txt_begin_date"),
						FILE_FINISH_DATE			=>	$this->input->post("txt_finish_date"),
						FILE_FACEBOOK_APP_ID		=>	$this->input->post("txt_fb_appid"),
						FILE_FACEBOOK_APP_SECRET	=>	$this->input->post("txt_fb_appsecret"),
						FILE_INSTAGRAM_API_ID		=>	$this->input->post("txt_itg_apiid"),
						FILE_INSTAGRAM_API_SECRET	=>	$this->input->post("txt_itg_apisecret"),
						FILE_TWITTER_CONSUMER_KEY	=>	$this->input->post("txt_tw_consumerkey"),
						FILE_TWITTER_COMSUMER_SECRET=>	$this->input->post("txt_tw_consumersecret"),
						FILE_IMAGE_UPLOAD			=>	$this->input->post("txt_max_upload"),
						FILE_IMAGE_SHOW_NUMBER		=>	$this->input->post("txt_item_page"),
						FILE_IMAGE_CHECK_UPLOAD		=>	$this->input->post("chk_check_img"),
						);
		
		/*
		|-------------------------------------------------------------------------------
		|Parse to json
		|-------------------------------------------------------------------------------
		*/
		$json = json_encode($p_arr_info);
		
		/*
		|-------------------------------------------------------------------------------
		|Save to file
		|-------------------------------------------------------------------------------
		*/
		file_put_contents (FILE_CONFIG_PATH, $json);
		
		/*
		|-------------------------------------------------------------------------------
		|echo "1", ajax call save info success
		|-------------------------------------------------------------------------------
		*/

		if(IS_AJAX)
		{
			echo "1";
		}
		else
		{
			redirect(base_url('admin/setting'));
		}
	}

}