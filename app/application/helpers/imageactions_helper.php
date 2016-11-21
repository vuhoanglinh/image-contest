<?php
/**
* Convert, save image to database, to local, save user (from instagram and twitter)
*
* @package   Viet Vang - Image Contest
* @author    Creater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @author    Updater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/

class ImageActions
{
	private $ci;

	public function __construct()
	{
		$this->ci = get_instance();
		$this->ci->load->model('Images');
		$this->ci->load->model('Users');
		$this->ci->load->library('ImageResize');
	}
	/**
	* Save image from url to local folder
	*
	* @param array $p_arr_images image list
	* @return number of image saved successfully. Return -1 if UPLOAD_FOLDER is not defined
	*/
	public function save_image_from_url($p_arr_images, $p_user_kind)
	{
		if ( ! defined('UPLOAD_FOLDER'))
		{
			return -1;
		}

		$countSuccess = 0;
		foreach ($p_arr_images as $image) {
			$user = $image['user'];
			$userInfo = $this->ci->Users->get_user_by_id($user[DB_USERS_COL_APPID], $p_user_kind);
			$user_id = null;
			if(!empty($userInfo))
			{
				$user_id = $userInfo[DB_USERS_COL_ID];
			}
			else
			{
				$user_id = $this->ci->Users->add_user($user);
			}

			if(isset($user_id))
			{
				if(self::save_image($image))
				{
					$imgInfo = $image['toDB'];
					$imgInfo[DB_IMAGES_COL_AUTHOR] = $user_id;
					if($this->ci->Images->add_image($imgInfo))
					{
						$countSuccess ++;
					}
				}
			}
		}
		return $countSuccess;
	}

	/**
	* Save get and save image from url
	*
	* @param $p_image image information, include name, extension, url
	* @return true if saved successfully. Otherwise, false
	*/
	public function save_image($p_image)
	{
		//return false if $p_image is not valid
		if(!isset($p_image) || !is_array($p_image))
		{
			return false;
		}

		//return false if require value is not set
		if(!isset($p_image['name']) || !isset($p_image['extension']) || !isset($p_image['link']))
		{
			return false;
		}

		try
		{
			$image = file_get_contents($p_image['link']);
			if($image === false) // return false if cannot get image from url
			{
				return false;
			}
			$save = file_put_contents(UPLOAD_FOLDER . $p_image['name'] . '.' . $p_image['extension'], $image);
			if($save === false)// return false if saved fail
			{
				return false;
			}

			// create thumbnail
			$thumb = new ImageResize(UPLOAD_FOLDER . $p_image['name'] . '.' . $p_image['extension']);
			$thumb->resizeToWidth(THUMB_WIDTH);
			$thumb->save(UPLOAD_FOLDER_THUMB . THUMB . $p_image['name'] . '.' . $p_image['extension']);

			return true;
		}
		catch(Exception $e)
		{
			return false;
		}

	}
}