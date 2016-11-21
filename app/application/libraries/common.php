<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Class Common
* 
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Common {

	
	/* 
	|----------------------------------------------------------------
	| Variable
	|----------------------------------------------------------------
	*/
	private $arr_Session = NULL;
	private $ci;

	/* Construct function */
  	public function __construct() {
    	$this->ci =& get_instance();
    	$this->arr_Session	=	$this->ci->session->userdata(ACCOUNT);
	}

	/**
	* Function read file config
	* Date: 25/01/2015
	* @param 
	* @return 
	*/
	public function readfileconfig()
	{
		if(!file_exists(FILE_CONFIG_PATH)) {
			fopen(FILE_CONFIG_PATH, "w");
		}

		$json = file_get_contents(FILE_CONFIG_PATH);
		$data = json_decode($json);

		if(count((array)$data) == 0) {
			$data = array(
						FILE_HASHTAG_INSTAGRAM		=>	"",
						FILE_HASHTAG_TWITTER		=>	"",
						FILE_LOGO					=>	"",
						FILE_FAVICON				=>	"",
						FILE_IMAGE_MAX_WIDTH		=>	"",
						FILE_IMAGE_MAX_HEIGHT		=>	"",
						FILE_IMAGE_MIN_WIDTH		=>	"",
						FILE_IMAGE_MIN_HEIGHT		=>	"",
						FILE_IMAGE_EXTENTION		=>	"",
						FILE_IMAGE_SIZE				=>	"",
						FILE_BEGIN_DATE				=>	"",
						FILE_FINISH_DATE			=>	"",
						FILE_FACEBOOK_APP_ID		=>	"",
						FILE_FACEBOOK_APP_SECRET	=>	"",
						FILE_INSTAGRAM_API_ID		=>	"",
						FILE_INSTAGRAM_API_SECRET	=>	"",
						FILE_TWITTER_CONSUMER_KEY	=>	"",
						FILE_TWITTER_COMSUMER_SECRET=>	"",
						FILE_IMAGE_UPLOAD			=>	"",
						FILE_IMAGE_SHOW_NUMBER		=>	"",
						FILE_IMAGE_CHECK_UPLOAD		=>	"",
						);
		}
		return (array)$data;
	}

	/**
	* Function check non exist session account manager
	* Date: 21/01/2015
	* @param 
	* @return 
	*/
	public function check_non_exist_Session()
	{
		/*
		|----------------------------------------------------------------
		| Check exist session account manager
		|----------------------------------------------------------------
		*/
		if(!is_array($this->arr_Session) AND empty($this->arr_Session))
		{
			redirect(base_url("admin/login"), "location");
		}
	}

	/**
	* Function check existed session account manager
	* Date: 21/01/2015
	* @param 
	* @return 
	*/
	public function check_exist_Session()
	{
		/*
		|----------------------------------------------------------------
		| Check exist session account manager
		|----------------------------------------------------------------
		*/
		if(is_array($this->arr_Session) AND !empty($this->arr_Session))
		{
			redirect(base_url("admin"), "location");
		}
	}
}