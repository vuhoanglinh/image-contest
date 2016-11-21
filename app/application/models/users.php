<?php
/**
* User model, manage users
*
* @package   Viet Vang - Image Contest
* @author    Creater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @author    Updater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Users extends CI_Model
{
	/* Construct function */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	* Add new user
	*
	* @param array $p_arr_user user information
	* @return user id if added successfully. Otherwise, false
	*/
	public function add_user($p_arr_user)
	{
		// Insert into database
		try
		{
			$p_arr_user[DB_USERS_COL_NAME] = base64_encode($p_arr_user[DB_USERS_COL_NAME]);
			$p_arr_user[DB_USERS_COL_IS_BAN] = USER_NOT_BANNED;
			$this->db->insert(DB_TAB_USERS, $p_arr_user);
			return $this->db->insert_id();
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Edit user
	* 
	* @param array $p_arr_user user information
	* @return true if edited successlly. Otherwise, false
	*/
	public function edit_user($p_arr_user, $p_useAppId = false)
	{
		//return false if user id is not set
		if(isset($p_arr_user[DB_USERS_COL_NAME]))
		{
			$p_arr_user[DB_USERS_COL_NAME] = base64_encode($p_arr_user[DB_USERS_COL_NAME]);
		}
		if($p_useAppId)
		{
			$this->db->update(DB_TAB_USERS, $p_arr_user, array(DB_USERS_COL_APPID => $p_arr_user[DB_USERS_COL_APPID], DB_USERS_COL_KIND => $p_arr_user[DB_USERS_COL_KIND]));
			return true;
		}
		else
		{
			if( !array_key_exists(DB_USERS_COL_ID, $p_arr_user)
				|| $p_arr_user[DB_USERS_COL_ID] == '')
			{
				return false;
			}

			//update
			$this->db->update(DB_TAB_USERS, $p_arr_user, array(DB_USERS_COL_ID => $p_arr_user[DB_USERS_COL_ID]));
			return true;
		}
	}

	/**
	* Delete user
	*
	* @param int or string $p_id user id
	* @return true if deleted successfuly. Otherwise, false
	*/
	public function delete_user($p_id)
	{
		//return false if user id is not set
		if(!isset($p_id) || $p_id == '')
		{
			return false;
		}

		//delete user
		$this->db->delete(DB_TAB_USERS, array(DB_USERS_COL_ID => $p_id));
	}

	/**
	* Get all user
	* 
	* @param $p_limit number of user get, default is null
	* @param $start offset start get, default is 0
	* @param $p_kind user kind, default is null
	* @return array of users. Otherwise, array()
	*/
	public function get_all_users($p_limit = null, $start = 0, $p_kind = null)
	{
		$result = array();
		if($p_kind != null)
		{
			$this->db->where(DB_USERS_COL_KIND, $p_kind);
		}

		if($p_limit == null)
		{
			//get all images
			$result = $this->db->get(DB_TAB_USERS);
		}
		else
		{
			//get $p_limit first images
			$result = $this->db->get(DB_TAB_USERS, (int)$p_limit, (int)$start);
		}
		

		if(!isset($result) || $result->num_rows <= 0)
		{
			return array();
		}

		return self::decode_user_name($result->result_array());
	}

	/**
	* Get count all user
	* 
	* @return number of users
	*/
	public function get_count_all_users($p_is_ban = USER_NOT_BANNED)
	{
		if($p_is_ban == USER_NOT_BANNED)
		{
			$this->db->where(DB_USERS_COL_IS_BAN, $p_is_ban);
			$this->db->from(DB_TAB_USERS);
			return $this->db->count_all_results();
		}
		elseif( $p_is_ban == USER_BANNED) // include hidden image
		{
			return $this->db->count_all(DB_TAB_USERS);
		}
		else // return 0 if $p_is_hidden set not currect
		{
			return 0;
		}
	}

	/**
	* Get all user who is not banned
	*
	* @param int $p_is_banned user is banned or not. default value is USER_NOT_BANNED
	* @return array of users. Otherwise, array()
	*/
	public function get_active_users($p_is_banned = USER_NOT_BANNED)
	{
		if($p_is_banned == USER_NOT_BANNED || $p_is_banned == USER_BANNED)
		{
			$result = $this->db->get_where(DB_TAB_USERS, array(DB_USERS_COL_IS_BAN => $p_is_banned));
			if(!isset($result) || $result->num_rows <= 0)
			{
				return array();
			}
			return self::decode_user_name($result->result_array());
		}
		else
		{
			return array();
		}
	}

	/**
	* Get user by ID
	*
	* @param int $p_id user id
	* @param int $kind user kind. Default is IS_DEFAULT_USER
	* @return array of user information or array empty if user not exist
	*/
	public function get_user_by_id($p_id, $kind = IS_DEFAULT_USER)
	{
		//return empty array if user id is not set
		if(!isset($p_id) || $p_id == '')
		{
			return array();
		}
		$result = array();
		if($kind == IS_FACEBOOK_USER || $kind == IS_TWITTER_USER || $kind == IS_INSTAGRAM_USER)
		{
			$result = $this->db->get_where(DB_TAB_USERS, array(DB_USERS_COL_APPID => $p_id, DB_USERS_COL_KIND => $kind));
		}
		else
		{
			$result = $this->db->get_where(DB_TAB_USERS, array(DB_USERS_COL_ID => $p_id));
		}

		if(!isset($result) || $result->num_rows <= 0)
		{
			return array();
		}

		return reset(self::decode_user_name($result->result_array()));
	}

	/**
	* Get user by image id
	*
	* @param int $p_id image id
	* @return array user information or array empty if not fault
	*/
	public function get_user_by_image($p_id)
	{
		//return empty array if image id is not set
		if(!isset($p_id) || $p_id == '')
		{
			return array();
		}

		$where = "`" . DB_USERS_COL_ID . "` IN (SELECT `" . DB_IMAGES_COL_AUTHOR . 
			                                 "` FROM `" . DB_TAB_IMAGES . 
			                                 "` WHERE `" . DB_IMAGES_COL_ID . "` = " . $p_id . ")";
		$result = $this->db->get_where(DB_TAB_USERS, $where);
		if(!isset($result) || $result->num_rows <= 0)
		{
			return array();
		}

		return self::decode_user_name($result->result_array());
	}

	/**
	* Get users who have most like
	*
	* @param $p_num number of user will be get. Default value is DEFAULT_GET_TOP
	* @return array or user information. Note that number of user return may be less than $p_num. Emty array if $p_num is invalid
	*/
	public function get_user_top_like($p_num = DEFAULT_GET_TOP)
	{
		//return empty array if $p_num not valid
		if(!isset($p_num) || $p_num <= 0)
		{
			return false;
		}
		$query = "SELECT *, (SELECT SUM(`" . DB_IMAGES_COL_LIKES . "`)
			                 FROM `" . DB_TAB_IMAGES .
			                 "` WHERE `". DB_IMAGES_COL_AUTHOR . "` = `" . DB_TAB_USERS."`.`".DB_USERS_COL_ID . "`) AS " . DB_IMAGES_COL_LIKES.
                  " FROM `" . DB_TAB_USERS .
                  "` ORDER BY " . DB_IMAGES_COL_LIKES . " DESC LIMIT 0, " . $p_num;
        $result = $this->db->query($query);

        if(!isset($result) || $result->num_rows <= 0)
		{
			return array();
		}

		return self::decode_user_name($result->result_array());
	}

	/**
	* Get users who have most comment
	*
	* @param $p_num number of user will be get. Default value is DEFAULT_GET_TOP
	* @return array or user information. Note that number of user return may be less than $p_num. Emty array if $p_num is invalid
	*/
	public function get_user_top_comment($p_num = DEFAULT_GET_TOP)
	{
		//return empty array if $p_num not valid
		if(!isset($p_num) || $p_num <= 0)
		{
			return false;
		}
		$query = "SELECT *, (SELECT SUM(`" . DB_IMAGES_COL_COMMENTS . "`)
			                 FROM `" . DB_TAB_IMAGES .
			                 "` WHERE `". DB_IMAGES_COL_AUTHOR . "` = `" . DB_TAB_USERS."`.`".DB_USERS_COL_ID . "`) AS " . DB_IMAGES_COL_COMMENTS.
                  " FROM `" . DB_TAB_USERS .
                  "` ORDER BY " . DB_IMAGES_COL_COMMENTS . " DESC LIMIT 0, " . $p_num;
        $result = $this->db->query($query);

        if(!isset($result) || $result->num_rows <= 0)
		{
			return array();
		}

		return self::decode_user_name($result->result_array());
	}


	/**
	* Decode for user name
	*/
	private function decode_user_name($p_arr_user)
	{
		$newUserList = $p_arr_user;
		foreach ($p_arr_user as $key => $user)
		{
			$newUserList[$key][DB_USERS_COL_NAME] = base64_decode($user[DB_USERS_COL_NAME]);
		}
		return $newUserList;
	}

}