<?php
/**
* Setting Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Setting extends CI_Controller
{
	/* 
	|----------------------------------------------------------------
	| Variable
	|----------------------------------------------------------------
	*/
	private $arr_Session 	= 	NULL;

	
	/* Construct function */
	public function __construct()
	{
		parent:: __construct();
		$this->arr_Session		=	$this->session->userdata(ACCOUNT);
		$this->load->library("common");
	}

	/**
	* Function view setting page
	* Date: 23/01/2015
	* URL Page: admin/setting
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show Setting Page
	*/
	public function index()
	{
		/*
		|----------------------------------------------------------------
		| Load library common
		| Check non exist session account manager
		| Non exist: redirect to login page
		|----------------------------------------------------------------
		*/		
		$this->common->check_non_exist_Session();

		/*
		|----------------------------------------------------------------
		| Load Helper Form
		|----------------------------------------------------------------
		*/
		$this->load->helper(array('form'));

		/**
		* @param $p_data_head 
		* Description: 	data use on admin/head_view
		*/
		$p_data_head 	=	array(
							"title" 		=> 	"Setting Page", 
							"p_css_view"	=>	$this->load->view("admin/css/css_setting_view", NULL, TRUE)
						);


		/**
		* @param $p_data_footer 
		* Description: 	data use on admin/footer_view
		*/
		$p_data_footer 	=	array( 
							"p_js_view"	=>	$this->load->view("admin/js/js_setting_view", NULL, TRUE)
						);
		
		/**
		* @param $p_data_left 
		* Description: 	data use on admin/left_view
		*/
		$p_data_left 	=	array( 
							"p_account_name"	=>	$this->arr_Session[0][DB_MANAGER_COL_NAME],
							"active"			=>	1
						);

		/**
		* @param $p_data_index 
		* Description: 	data use on admin/left_view
		*/
		$p_data_setting 	=	array( 
							"p_account_name"		=>	$p_data_left["p_account_name"],
							"p_menu_right_account"	=>	$this->load->view("admin/menu_account_view", NULL, TRUE),
							"p_arr_file"			=>	$this->common->readfileconfig()
						);
		

		/*
		|----------------------------------------------------------------
		| Load Admin Head View
		| Load Admin Left Navigation View
		| Load Admin Setting View
		| Load Admin Footer View
		|----------------------------------------------------------------
		*/
		$this->load->view("admin/head_view", $p_data_head);
		$this->load->view("admin/left_view", $p_data_left);

		$this->load->view("admin/setting_view", $p_data_setting);
		$this->load->view("admin/footer_view", $p_data_footer);
	}

	/**
	* Get image from instagram and twitter by hashtag
	*
	* @param
	* @return redirect to admin dashboar
	*/
	public function load_hashtag()
	{
		$config = $this->common->readfileconfig();
		if(isset($config))
		{
			$this->load->model('Images');
			if(isset($config[FILE_HASHTAG_INSTAGRAM]))
			{
				$hashtag = str_replace('#', '', $config[FILE_HASHTAG_INSTAGRAM]);
				self::save_images_hashtag($this->Images->get_images_from_instagram($hashtag), IMG_FROM_INSTAGRAM);
			}
			if(isset($config[FILE_HASHTAG_TWITTER]))
			{
				$hashtag = str_replace('#', '', $config[FILE_HASHTAG_TWITTER]);
				self::save_images_hashtag($this->Images->get_images_from_twitter($hashtag), IMG_FROM_TWITTER);
			}
		}
		redirect('admin');
	}

	/**
	* Save image from image information list
	*
	* @param $p_arr_img array image information
	* @param $p_kind image kind (from instagram or twitter)
	*/
	private function save_images_hashtag($p_arr_img, $p_kind)
	{
		if(count($p_arr_img) > 0)
		{
			$strchar = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$arr_image = self::filter_images($p_arr_img, $p_kind);
			foreach ($arr_image as $key => $image) {
				$extension = end(explode('.', $image['link']));
				date_default_timezone_set('Asia/Ho_Chi_Minh');
				$name = date('Ymd_His_') . $key . substr(str_shuffle($strchar), 0, 5);
				$arr_image[$key]['name'] = $name;
				$arr_image[$key]['extension'] = $extension;

				$arr_image[$key]['toDB'] = array(
							DB_IMAGES_COL_NAME 		=> $name . '.' . $extension,
							DB_IMAGES_COL_IS_HIDDEN => IMAGE_NOT_HIDDEN,
							DB_IMAGES_COL_ORIGIN 	=> $p_kind,
							DB_IMAGES_COL_APPID 	=> $image['id']);
			}
			$this->load->helper('ImageActions');
			$action = new ImageActions();
			if($p_kind === IMG_FROM_TWITTER)
				$action->save_image_from_url($arr_image, IS_TWITTER_USER);
			elseif($p_kind === IMG_FROM_INSTAGRAM)
				$action->save_image_from_url($arr_image, IS_INSTAGRAM_USER);
		}
	}

	/**
	* Save image from image information list
	*
	* @param $p_arr_imageList array image information
	* @param $p_kind image kind (instagram or twitter)
	* @return array image after filter
	*/
	private function filter_images($p_arr_imageList, $p_kind)
	{
		$finalImgList = array();
		if(isset($p_arr_imageList, $p_kind) AND is_array($p_arr_imageList))
		{
			//get user list by $kind
			$userList = self::get_user_list_image($p_kind);
			$userBanned = self::get_banned_users();
			//Browsing image list
			$checkImgList = $p_arr_imageList;
			$this->load->model->Users;
			foreach ($checkImgList as $imgId => $imgTemp)
			{
				$userAppId = $imgTemp['user'][DB_USERS_COL_APPID];
				//check if user is banned
				if(isset($userBanned[$userAppId]))
				{
					unset($p_arr_imageList[$imgId]);
				}
				else
				{
					//check if user is exist
					if(isset($userList[$userAppId]))
					{
						$userTemp = $userList[$userAppId];
						//check if image is exise or not
						$imgKey = self::is_contained_image($userTemp['images'], $imgId);
						if($imgKey >= 0)
						{
							//update user information
							$user = $p_arr_imageList[$imgId]['user'];
							$this->Users->edit_user($user, true);
							unset($userList[$userAppId]['images'][$imgKey]);
							unset($p_arr_imageList[$imgId]);
							continue;
						}
						else //image not exist
						{
							$userList[$userAppId]['count'] += 1;
							$userList[$userAppId]['new'][]  = $imgId;
						}
					}
					else
					{
						$userList[$userAppId] = array(
													'images' => array(),
													'count' => 1,
													'new' => array($imgId));
					}
				}
			}
			//End browsing user list
			//Create final image list to insert
			$finalImgList = self::delete_old_or_excess_image($p_arr_imageList, $userList);
		}
		return $finalImgList;
	}

	/**
	* Get user list contain images of each user
	* 
	* @param $p_kind image kind (from instagram or twitter)
	* @return array
	*/
	private function get_user_list_image($p_kind)
	{
		$userKind = null;
		switch ($p_kind) {
			case IMG_FROM_INSTAGRAM:
			$userKind = IS_INSTAGRAM_USER;
			break;
			case IMG_FROM_TWITTER:
			$userKind = IS_TWITTER_USER;
			break;

			default:
			break;
		}

		$this->load->model('Users');
		$userListData = $this->Users->get_all_users(null, 0, $userKind);
		$userList = array();
		$this->load->model('Images');
		foreach ($userListData as $user) {
			if($user[DB_USERS_COL_IS_BAN] == USER_NOT_BANNED)
			{
				$imgData = $this->Images->get_image_by_user($user[DB_USERS_COL_ID]);
				$userList[$user[DB_USERS_COL_APPID]] = array(
					'images' => $imgData,
					'count' => count($imgData),
					DB_USERS_COL_ID => $user[DB_USERS_COL_ID],
					'new' => array());
			}
		}

		return $userList;
	}

	/**
	* Get banned users
	* @return array banned user list
	*/
	private function get_banned_users()
	{
		$this->load->model('Users');
		$arrTemp = $this->Users->get_active_users(USER_BANNED);
		$result = array();
		foreach ($arrTemp as $key => $user) 
		{
			$result[$user[DB_USERS_COL_APPID]] = $user[DB_USERS_COL_ID];
		}
		return $result;
	}

	/**
	* Check if image is contained in an image list or not
	* @param $p_arr_imgList image list
	* @param $p_id image id
	* @return key of image, -1 if not exist
	*/
	private function is_contained_image($p_arr_imgList, $p_id)
	{
		$result = -1;
		if(isset($p_arr_imgList, $p_id) AND is_array($p_arr_imgList))
		{
			foreach ($p_arr_imgList as $key => $image) {
				if($image[DB_IMAGES_COL_APPID] == $p_id)
				{
					$result = $key;
					break;
				}
			}
		}
		return $result;
	}

	/**
	* Delete image which user deleted (in instagram or twitter) and new image 
	* if number image of user more than limit (4 or from config file)
	*
	* @param $p_imgList image list
	* @param $p_userList user list
	* @return image list after checked and deleted
	*/
	private function delete_old_or_excess_image($p_imgList, $p_userList)
	{
		$result = array();
		$deletedList = array();
		if(isset($p_imgList, $p_userList) AND is_array($p_imgList) AND is_array($p_userList))
		{
			$this->load->model('Images');
			$config = $this->common->readfileconfig();
			$limit = (isset($config[FILE_IMAGE_UPLOAD]))? $config[FILE_IMAGE_UPLOAD] : 4;
			$this->load->model('Users');		
			foreach ($p_userList as $ukey => $user)
			{
				$oldImages = $user['images'];
				//delete old image
				foreach ($oldImages as $okey => $img)
				{
					$deletedList[] = $img[DB_IMAGES_COL_APPID];
					if($this->Images->delete_image($img[DB_IMAGES_COL_ID]))
					{
						try
						{
							unlink(UPLOAD_FOLDER.$img[DB_IMAGES_COL_NAME]);
							unlink(UPLOAD_FOLDER_THUMB.THUMB.$img[DB_IMAGES_COL_NAME]);
							$user['count'] -= 1;
						}
						catch(Exception $e)
						{
							continue;
						}
					}
				}

				if($user['count'] > $limit)
				{
					//delete new image until number of user images equal or less than limit
					foreach ($user['new'] as $key => $img) {
						unset($p_imgList[$img]);
						$user['count'] -= 1;
						if($user['count'] <= $limit)
							break;
					}
				}
				elseif($user['count'] == 0)
				{
					//delete user who have no image
					$this->Users->delete_user($user[DB_USERS_COL_ID]);
				}
			}

			$result = $p_imgList;
		}
		return $result;
	}
}
