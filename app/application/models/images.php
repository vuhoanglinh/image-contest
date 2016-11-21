<?php
/**
* Images model, manage images
*
* @package   Viet Vang - Image Contest
* @author    Creater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @author    Updater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/

class Images extends CI_Model
{
	/* Construct function */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	* Add new image into database
	* @param array $p_arr_image image information
	* @return true if added successfully. Otherwise, false
	*/
	public function add_image($p_arr_image)
	{
		//return false if $p_arr_image is not set or not an array
		if(!isset($p_arr_image) || !is_array($p_arr_image))
		{
			return false;
		}

		//return false if $p_arr_image not contain image name (required field)
		if(!array_key_exists(DB_IMAGES_COL_NAME, $p_arr_image))
		{
			return false;
		}
		try
		{
			$this->db->insert(DB_TAB_IMAGES, $p_arr_image);
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Edit image
	*
	* @param array $p_arr_image image information
	* @return true if edited successfully. Otherwise, false
	*/
	public function edit_image($p_arr_image)
	{
		//return false if $p_arr_image is not set or not an array
		if(!isset($p_arr_image) || !is_array($p_arr_image))
		{
			return false;
		}

		//return false if $p_arr_image not contain image id
		if(!array_key_exists(DB_IMAGES_COL_ID, $p_arr_image))
		{
			return false;
		}

		try
		{
			$this->db->update(DB_TAB_IMAGES, $p_arr_image, array(DB_IMAGES_COL_ID => $p_arr_image[DB_IMAGES_COL_ID]));
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Delete image
	*
	* @param int $p_id image id
	* @return true if deleted successfully. Otherwise, false
	*/
	public function delete_image($p_id)
	{
		//return false if image id is not set
		if(!isset($p_id))
		{
			return false;
		}

		try
		{
			$this->db->delete(DB_TAB_IMAGES, array(DB_IMAGES_COL_ID => $p_id));
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Delete all images of a user
	* @param $p_id user id
	* @return true if delete successfully. Otherwise, false
	*/
	public function delete_user_images($p_id)
	{
		if(!isset($p_id))
		{
			return false;
		}
		try
		{
			$this->db->delete(DB_TAB_IMAGES, array(DB_IMAGES_COL_AUTHOR => $p_id));
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	/**
	* Get all image
	*
	* @param $p_limit number of image get. Default is null (no limit);
	* @param $start position to start getting image. Default is 0
	* @return array image information or empty array
	*/
	public function get_all_images($p_limit = null, $start = 0, $p_order_by = NULL)
	{
		$result = array();
		if($p_order_by != NULL) {
			$this->db->order_by($p_order_by, "DESC");
		}
		if($p_limit == null)
		{
			//get all images
			$result = $this->db->get(DB_TAB_IMAGES);
		}
		else
		{
			//get $p_limit first images
			$result = $this->db->get(DB_TAB_IMAGES, (int)$p_limit, (int)$start);
		}

		if(!isset($result) || $result->num_rows <= 0)
		{
			return array();
		}
		return $result->result_array();

	}

	/**
	* Get total likes image
	*
	* @param $p_limit number of image get. Default is null (no limit);
	* @param $start position to start getting image. Default is 0
	* @return array image information or empty array
	*/
	public function get_total_likes_or_comments_images($p_get_by = DB_IMAGES_COL_LIKES ,$p_is_hidden = IMAGE_NOT_HIDDEN)
	{
		$result = array();
		$total_likes_or_comments = 0;
		if($p_is_hidden == IMAGE_NOT_HIDDEN)
		{
			//get all images
			$result = $this->get_all_images();
		}
		else
		{
			//get $p_limit first images
			$result = $this->get_active_images(NULL, NULL, $p_is_hidden);
		}

		if(isset($result) AND count($result) > 0) {

			foreach ($result as $row) {

				if($p_get_by == DB_IMAGES_COL_LIKES) {
					$total_likes_or_comments += (int)$row[DB_IMAGES_COL_LIKES];
				}

				if($p_get_by == DB_IMAGES_COL_COMMENTS) {
					$total_likes_or_comments += (int)$row[DB_IMAGES_COL_COMMENTS];
				}
			}
		}		

		return $total_likes_or_comments;

	}

	/**
	* Count number of image
	* 
	* @param $p_is_hidden count image include hidden or not. Default is IMAGE_NOT_HIDDEN
	* @return number of image
	*/
	public function get_count($p_is_hidden = IMAGE_NOT_HIDDEN)
	{
		if($p_is_hidden == IMAGE_NOT_HIDDEN)
		{
			$this->db->where(DB_IMAGES_COL_IS_HIDDEN, $p_is_hidden);
			$this->db->from(DB_TAB_IMAGES);
			return $this->db->count_all_results();
		}
		elseif( $p_is_hidden == IMAGE_HIDDEN) // include hidden image
		{
			return $this->db->count_all(DB_TAB_IMAGES);
		}
		else // return 0 if $p_is_hidden set not currect
		{
			return 0;
		}
	}

	/**
	* Get all image by hidden status
	* 
	* @param $start position to start getting image
	* @param $limit number of image get. Default is IMAGE_EACH_PAGE. $limit = 0 or $limit = null mean no limit
	* @param $p_is_hidden image hidden status. Default is IMAGE_NOT_HIDDEN
	* @return array image information or empty array
	*/
	public function get_active_images($start = 0, $limit = IMAGE_EACH_PAGE, $p_is_hidden = IMAGE_NOT_HIDDEN, $p_order_by = NULL)
	{
		$result = array();
		if($p_is_hidden == IMAGE_NOT_HIDDEN || $p_is_hidden == IMAGE_HIDDEN)
		{

			if($p_order_by != NULL) {
				$this->db->order_by($p_order_by, "DESC");
			}

			if(!isset($limit) || $limit <= 0)
			{
				$result = $this->db->get_where(DB_TAB_IMAGES, array(DB_IMAGES_COL_IS_HIDDEN => $p_is_hidden));
			}
			else
			{
				$result = $this->db->get_where(DB_TAB_IMAGES, array(DB_IMAGES_COL_IS_HIDDEN => $p_is_hidden), $limit, $start);
			}

			if(!isset($result) || $result->num_rows <= 0)
			{
				return array();
			}

			return $result->result_array();
		}
		else //$p_is_hidden is not valid value
		{
			return array();
		}
	}

	/**
	* Get image around a id
	*
	* @param $p_id image id, which images get around
	* @param $aroundLen number of image before and after current image. Default value is null (not set)
	* @return array images (include $p_id) or empty array
	*/

	public function get_image_around($p_id, $aroundLen = null)
	{
		//return empty array if $p_id is not set
		if(!isset($p_id))
		{
			return array();
		}
		if($aroundLen == null)
		{
			$aroundLen = floor(IMAGE_EACH_PAGE / 2);
		}

		$getBefore = $aroundLen + 1; //before include current image
		$getAfter = $aroundLen;
		// Variable before: image before $p_id
		$this->db->where(DB_IMAGES_COL_IS_HIDDEN, IMAGE_NOT_HIDDEN);
		$this->db->where(DB_IMAGES_COL_ID . ' <=', $p_id);
		$this->db->order_by(DB_IMAGES_COL_ID, 'DESC');
		$before = $this->db->get(DB_TAB_IMAGES, $getBefore, 0);

		$after = array();
		if($before->num_rows() < $getBefore)
		{
			$getAfter += $getBefore - $before->num_rows();
			$this->db->where(DB_IMAGES_COL_IS_HIDDEN, IMAGE_NOT_HIDDEN);
			$this->db->where(DB_IMAGES_COL_ID . ' >', $p_id);
			$this->db->order_by(DB_IMAGES_COL_ID, 'ASC');
			$after = $this->db->get(DB_TAB_IMAGES, 0, $getAfter);
		}
		else
		{
			$this->db->where(DB_IMAGES_COL_IS_HIDDEN, IMAGE_NOT_HIDDEN);
			$this->db->where(DB_IMAGES_COL_ID . ' >', $p_id);
			$this->db->order_by(DB_IMAGES_COL_ID, 'ASC');
			$after = $this->db->get(DB_TAB_IMAGES, 0, $getAfter);

			if($after->num_rows() < $getAfter)
			{
				$getBefore += $getAfter - $after->num_rows();
				$this->db->where(DB_IMAGES_COL_IS_HIDDEN, IMAGE_NOT_HIDDEN);
				$this->db->where(DB_IMAGES_COL_ID . ' <=', $p_id);
				$this->db->order_by(DB_IMAGES_COL_ID, 'DESC');
				$before = $this->db->get(DB_TAB_IMAGES, 0, $getBefore);
			}
		}

		$arrBefore = $before->result_array();
		$arrAfter = $after->result_array();

		return array_merge(array_reverse($arrBefore), $arrAfter);

	}

	/**
	* Get images which have the most like
	*
	* @param int $p_num number of image get. Default value is DEFAULT_GET_TOP
	* @return array image information or empty array
	*/
	public function get_image_top_like($p_num = DEFAULT_GET_TOP)
	{
		//return false if $p_num is not valid
		if(!isset($p_num) || (int)$p_num <= 0)
		{
			return false;
		}

		try
		{
			$this->db->order_by(DB_IMAGES_COL_LIKES, 'DESC');
			$result = $this->db->get(DB_TAB_IMAGES, $p_num, 0);
			if(!isset($result) || $result->num_rows <= 0)
			{
				return array();
			}

			return $result->result_array();
		}
		catch(Exception $e)
		{
			return array();
		}
	}

	/**
	* Get image by image id
	* 
	* @param int $p_id image id
	* @return array image information if get successfully. Otherwise, empty array
	*/
	public function get_image_by_id($p_id)
	{
		if(isset($p_id))
		{
			$result = $this->db->get_where(DB_TAB_IMAGES,  array(DB_IMAGES_COL_ID => $p_id));
			if(!isset($result) || $result->num_rows <= 0)
			{
				return array();
			}
			return current($result->result_array());
		}
		else //return array empty if image id is not set
		{
			return array();
		}
	}

	/**
	* Get image by user id
	* 
	* @param int $p_id user id
	* @return array image information if get successfully. Otherwise, empty array
	*/
	public function get_image_by_user($p_id)
	{
		if(isset($p_id))
		{
			$result = $this->db->get_where(DB_TAB_IMAGES,  array(DB_IMAGES_COL_AUTHOR => $p_id));
			if(!isset($result) || $result->num_rows <= 0)
			{
				return array();
			}
			return $result->result_array();
		}
		else //return array empty if user id is not set
		{
			return array();
		}
	}

	/**
	* Search image. User can search by image name, image title, image description, user name, user account name, user email
	*
	* @param string $p_keyword search keyword
	* @return array images information if search successfully. Otherwise, empty array
	*/
	public function search($p_keyword)
	{
		//return false if $p_keyword is not set
		if(!isset($p_keyword))
		{
			return false;
		}

		$authorSubQuery = 'SELECT `' . DB_USERS_COL_ID . '`'
		                  .' FROM `' . DB_TAB_USERS . '`'
		                  . 'WHERE `' . DB_USERS_COL_NAME . '` LIKE "%' . $p_keyword .'%"'
		                  . ' OR `' . DB_USERS_COL_EMAIL . '` LIKE "%'  . $p_keyword .'%"'
		                  . ' OR `' . DB_USERS_COL_ACCOUNT_NAME . '` LIKE "%'  . $p_keyword .'%"';

		$query = 'SELECT * FROM `' . DB_TAB_IMAGES 
		                           . '` WHERE `' . DB_IMAGES_COL_NAME . '` LIKE "%' . $p_keyword .'%"'
		                           . ' OR `' . DB_IMAGES_COL_TITLE . '` LIKE "%'  . $p_keyword .'%"'
		                           . ' OR `' . DB_IMAGES_COL_DESCRIPTION . '` LIKE "%'  . $p_keyword .'%"'
		                           . ' OR `' . DB_IMAGES_COL_AUTHOR . '` IN ('  . $authorSubQuery .')';

		$result = $this->query($query);

        if(!isset($result) || $result->num_rows <= 0)
		{
			return array();
		}
		return $result->result();
	}

	/**
	* Get images from instagram hashtag
	*
	* @param string $p_hashtag hashtag
	* @return array list or image url or empty array
	*/
	public function get_images_from_instagram($p_hashtag)
	{
		$this->load->library("common");
		$config = $this->common->readfileconfig();
		if(isset($config))
		{
			if(isset($config[FILE_INSTAGRAM_API_ID], $p_hashtag))
			{
				$next = NULL;
				$stop = 10; //get $stop * 33 images
				$images = array();
				do
				{
					$result = self::get_instagram_images($p_hashtag, $config[FILE_INSTAGRAM_API_ID], $next);
					if(isset($result))
					{
						foreach ($result->data as $media) 
						{
							if($media->type === 'image') // get image only
							{
								$link = $media->images->standard_resolution->url;
								$id = $media->id;
								$user = array(
											DB_USERS_COL_ACCOUNT_NAME => $media->user->username,
											DB_USERS_COL_NAME => $media->user->full_name,
											DB_USERS_COL_APPID => $media->user->id,
											DB_USERS_COL_AVATAR => $media->user->profile_picture,
											DB_USERS_COL_KIND => IS_INSTAGRAM_USER);
								if($user[DB_USERS_COL_NAME] == null OR empty($user[DB_USERS_COL_NAME]))	$user[DB_USERS_COL_NAME] = $user[DB_USERS_COL_ACCOUNT_NAME];
								$images[$id] = array('id' => $id, 'link' => $link, 'user' => $user);
							}
						}
					}
					if(!isset($result->pagination->next_max_tag_id))
					{
						break;
					}
            		$next = $result->pagination->next_max_tag_id;
					$stop--;
				}
				while($stop > 0);
				return $images;
			}
		}
		return array();
	}

	/**
	* Get images from twitter by hashtag
	*
	* @param string $p_hashtag hashtag
	* @return array list or image url or empty array
	*/
	public function get_images_from_twitter($p_hashtag)
	{
		$this->load->library("common");
		$config = $this->common->readfileconfig();
		$images = array();
		if(isset($config) AND !empty($config))
		{
			if(isset($config[FILE_TWITTER_CONSUMER_KEY], $config[FILE_TWITTER_COMSUMER_SECRET]))
			{
				$next = 0;
				$stop = 3; //get $top * 100 images
				$this->load->helper('twitteroauth');
				$connection = new TwitterOAuth($config[FILE_TWITTER_CONSUMER_KEY], $config[FILE_TWITTER_COMSUMER_SECRET]);
				do
				{
					$result = self::get_twitter_images($connection, $p_hashtag, $next);
					if(isset($result->statuses))
					{
						foreach ($result->statuses as $tweet)
						{
							$imgWidth = $tweet->entities->media[0]->sizes->large->w;
							$imgHeight = $tweet->entities->media[0]->sizes->large->h;
							//if(self::check_resolution($imgWidth, $imgHeight))
							//{
								$link = $tweet->entities->media[0]->media_url;
								$id = $tweet->id_str;
								$user = array(
											DB_USERS_COL_APPID => $tweet->user->id_str,
											DB_USERS_COL_ACCOUNT_NAME => $tweet->user->screen_name,
											DB_USERS_COL_NAME => $tweet->user->name,
											DB_USERS_COL_AVATAR => $tweet->user->profile_image_url,
											DB_USERS_COL_ADDRESS => $tweet->user->location,
											DB_USERS_COL_KIND => IS_TWITTER_USER);
								if($user[DB_USERS_COL_NAME] == null OR empty($user[DB_USERS_COL_NAME]))	$user[DB_USERS_COL_NAME] = $user[DB_USERS_COL_ACCOUNT_NAME];
								$images[$id] = array('id' => $id, 'link' => $link, 'user' => $user);
							//}
						}
					}
					if(!isset($result->search_metadata->max_id_str))
					{
						break;
					}
        			$next = $result->search_metadata->max_id_str;
					$stop--;
				}
				while($stop > 0);
			}
		}
		return $images;
	}

	/**
	* Request twitter to get images
	*
	* @param $hashtag hashtag
	* @param $next max_id
	* @param $customerKey twitter comsumer key
	* @param $serectKey twitter comsumer serect
	* @return object result or null
	*/
	private function get_twitter_images($connection, $hashtag, $next)
	{
		$content = $connection->get(
			"search/tweets", array(
				'q' => '#'.$hashtag.' filter:images',
				'include_entities' => true,
				'max_id' => $next,
				'count' => 100
				)
			);
		return $content;
	}

	/**
	* Request instagram images
	*
	* @param $hashtag hashtag
	* @param $key Instagram APP ID
	* @param $next next media id request
	* @return result
	*/
	private function get_instagram_images($hashtag, $key, $next)
	{
		$this->load->helper('Instagram');
		$instagram = new Instagram($key);

		return $instagram->getTagMedia($hashtag, 100, $next);
	}

	/**
	* Check if image resolution is accept
	* 
	* @param int $p_width
	* @param int $p_height
	* @return true if the resolution is accept. Otherwise, false
	*/
	private function check_resolution($p_width, $p_height)
	{
		if(!isset($p_width, $p_height))
		{
			return false;
		}

		$this->load->library("common");
		$config = $this->common->readfileconfig();
		if(isset($config[FILE_IMAGE_MAX_WIDTH]) AND $p_width > $config[FILE_IMAGE_MAX_WIDTH])
		{
			return false;
		}

		if(isset($config[FILE_IMAGE_MIN_WIDTH]) AND $p_width < $config[FILE_IMAGE_MIN_WIDTH])
		{
			return false;
		}

		if(isset($config[FILE_IMAGE_MAX_HEIGHT]) AND $p_height > $config[FILE_IMAGE_MAX_HEIGHT])
		{
			return false;
		}

		if(isset($config[FILE_IMAGE_MIN_HEIGHT]) AND $p_height < $config[FILE_IMAGE_MIN_HEIGHT])
		{
			return false;
		}

		return true;

	}

	/**
	* Get all image appid to check if image is exist in db
	* @param $kind kind of image (instagram, twitter)
	* @return array list of appid or empty array
	*/
	private function get_list_appId($kind)
	{
		if(empty($kind))
		{
			return array();
		}

		$this->db->select(DB_IMAGES_COL_APPID);
		$result = $this->db->get(DB_TAB_IMAGES);
		if(!empty($result))
		{
			$result = $result->result_array();
			$idList = array();
			foreach ($result as $key => $value) {
				$idList[] = $value[DB_IMAGES_COL_APPID];
			}
			return $idList;
		}
		else return array();
	}

	public function get_top_contestant()
	{
		/*
		|----------------------------------------------------------------		
		| Get top images like
		| Load model users (contestants)
		| Get users (contestants) by top images like
		| Load model comments
		|----------------------------------------------------------------
		*/
		$p_top_like = $this->get_image_top_like();
		$this->load->model("Users");
		/**
		* Variable $p_top_contestant is array top contestant info
		* No, Name, Email, Original, Like, Comment, Photo, Status
		*/
		$p_count 			=	1;
		$p_top_contestant 	=	array();

		/**
		* Foreach array top images like
		*/
		foreach ($p_top_like as $row) {

			//Set number
			$p_temp[NO] 						=			$p_count;

			//Get id
			$p_temp[DB_IMAGES_COL_ID]			=			$row[DB_IMAGES_COL_ID];
			$p_temp[DB_IMAGES_COL_AUTHOR]		=			$row[DB_IMAGES_COL_AUTHOR];

			//Get info from users : Name and Email
			foreach( $this->Users->get_user_by_image($row[DB_IMAGES_COL_ID]) as $row_user){
				//$p_temp[DB_USERS_COL_ID]		=			$row_user[DB_USERS_COL_ID];
				$p_temp[DB_USERS_COL_NAME] 		=			$row_user[DB_USERS_COL_NAME];
				$p_temp[DB_USERS_COL_EMAIL] 	=			$row_user[DB_USERS_COL_EMAIL];
			}

			//Get origin
			switch( $row[DB_IMAGES_COL_ORIGIN] ) {

				case IMG_FROM_USER_UPLOAD 	: $p_temp[DB_IMAGES_COL_ORIGIN] = "Upload" ;break;
				case IMG_FROM_INSTAGRAM 	: $p_temp[DB_IMAGES_COL_ORIGIN] = "Instagram" ;break;
				case IMG_FROM_TWITTER 		: $p_temp[DB_IMAGES_COL_ORIGIN] = "Twitter" ;break;
				default 					: $p_temp[DB_IMAGES_COL_ORIGIN] = "Upload" ;break;
			}

			//Get likes
			$p_temp[DB_IMAGES_COL_LIKES] 				=			$row[DB_IMAGES_COL_LIKES];

			//Get comments
			$p_temp[DB_IMAGES_COL_COMMENTS] 			=			$row[DB_IMAGES_COL_COMMENTS];

			//Get photo
			$p_temp[DB_IMAGES_COL_NAME] 				=			$row[DB_IMAGES_COL_NAME];

			//Get status
			$p_temp[DB_IMAGES_COL_IS_HIDDEN] 			=			$row[DB_IMAGES_COL_IS_HIDDEN];

			$p_top_contestant[]							=			$p_temp;
			$p_count++;
		}

		return $p_top_contestant;
	}
	/**
	* Get number images of each user
	*
	* @param $p_kind user kind. Default is IS_DEFAULT_USER
	* @return array if success. Otherwise, empty array
	*/
	private function image_of_each_user($p_kind = IS_DEFAULT_USER)
	{
		$result = null;
		$this->db->select(DB_TAB_USERS . '.' . DB_USERS_COL_APPID . ', count(`'.DB_TAB_IMAGES.'`.`'.DB_IMAGES_COL_ID.'`) AS total');
		$this->db->from(DB_TAB_USERS);
		$this->db->join(DB_TAB_IMAGES, DB_TAB_USERS.'.'.DB_USERS_COL_ID . '=' . DB_TAB_IMAGES .'.'. DB_IMAGES_COL_AUTHOR, 'left');
		$this->db->group_by(DB_TAB_USERS . '.' . DB_USERS_COL_APPID);

		switch ($p_kind) {
			case IS_DEFAULT_USER: // get all
				$result = $this->db->get();
				break;
			case IS_TWITTER_USER:				
			case IS_INSTAGRAM_USER:
			case IS_FACEBOOK_USER:
				$this->db->where(DB_TAB_USERS . '.' . DB_USERS_COL_KIND, $p_kind);
				$result = $this->db->get();
				break;
			default:				
				break;
		}
		if(isset($result))
		{
			$temp = $result->result_array();
			$result->free_result();
			$result = array();
			foreach ($temp as $value) {
				$result[$value[DB_USERS_COL_APPID]] = $value['total'];
			}
			return $result;
		}
		return array();
	}

	public function get_images($p_limit = null, $start = 0, $p_order_by = DB_IMAGES_COL_LIKES)
	{
		/*
		|----------------------------------------------------------------		
		| Get top images like
		| Load model users (contestants)
		| Get users (contestants) by top images like
		| Load model comments
		|----------------------------------------------------------------
		*/
		$p_images = $this->get_all_images($p_limit, $start, $p_order_by);
		
		$this->load->model("Users");
		/**
		* Variable $p_top_contestant is array top contestant info
		* No, Name, Email, Original, Like, Comment, Photo, Status
		*/
		$p_count 			=	1;
		$p_contestant 	=	array();

		/**
		* Foreach array top images like
		*/
		foreach ($p_images as $row) {

			//Set number
			$p_temp[NO] 						=			$p_count;

			//Get id
			$p_temp[DB_IMAGES_COL_ID]			=			$row[DB_IMAGES_COL_ID];
			$p_temp[DB_IMAGES_COL_AUTHOR]		=			$row[DB_IMAGES_COL_AUTHOR];

			//Get info from users : Name and Email
			foreach( $this->Users->get_user_by_image($row[DB_IMAGES_COL_ID]) as $row_user){
				//$p_temp[DB_USERS_COL_ID]		=			$row_user[DB_USERS_COL_ID];
				$p_temp[DB_USERS_COL_NAME] 		=			$row_user[DB_USERS_COL_NAME];
				$p_temp[DB_USERS_COL_EMAIL] 	=			$row_user[DB_USERS_COL_EMAIL];
			}

			//Get origin
			switch( $row[DB_IMAGES_COL_ORIGIN] ) {

				case IMG_FROM_USER_UPLOAD 	: $p_temp[DB_IMAGES_COL_ORIGIN] = "Upload" ;break;
				case IMG_FROM_INSTAGRAM 	: $p_temp[DB_IMAGES_COL_ORIGIN] = "Instagram" ;break;
				case IMG_FROM_TWITTER 		: $p_temp[DB_IMAGES_COL_ORIGIN] = "Twitter" ;break;
				default 					: $p_temp[DB_IMAGES_COL_ORIGIN] = "Upload" ;break;
			}

			//Get likes
			$p_temp[DB_IMAGES_COL_LIKES] 				=			$row[DB_IMAGES_COL_LIKES];

			//Get comments
			$p_temp[DB_IMAGES_COL_COMMENTS] 			=			$row[DB_IMAGES_COL_COMMENTS];

			//Get photo
			$p_temp[DB_IMAGES_COL_NAME] 				=			$row[DB_IMAGES_COL_NAME];

			//Get status
			$p_temp[DB_IMAGES_COL_IS_HIDDEN] 			=			$row[DB_IMAGES_COL_IS_HIDDEN];

			$p_contestant[]							=			$p_temp;
			$p_count++;
		}

		return $p_contestant;
	}

	/**
	* Get image pre and next of an image
	*
	* @param $p_id image id
	* @return array include image next and pre
	*/
	public function get_next_and_pre($p_id)
	{
		$this->db->where(DB_IMAGES_COL_IS_HIDDEN, IMAGE_NOT_HIDDEN);
		$this->db->where(DB_IMAGES_COL_ID . ' <', $p_id);
		$this->db->order_by(DB_IMAGES_COL_ID, 'DESC');
		$before = $this->db->get(DB_TAB_IMAGES, 1, 0)->result_array();

		$this->db->where(DB_IMAGES_COL_IS_HIDDEN, IMAGE_NOT_HIDDEN);
		$this->db->where(DB_IMAGES_COL_ID . ' >', $p_id);
		$this->db->order_by(DB_IMAGES_COL_ID, 'ASC');
		$after = $this->db->get(DB_TAB_IMAGES, 1, 0)->result_array();

		$result = array();
		if(!empty($before)) $result['pre'] = reset($before);
		if(!empty($after)) $result['next'] = reset($after);

		return $result;
	}
}