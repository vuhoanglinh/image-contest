<?php
/**
* Comments model, manage comments which stored in database
*
* @package   Viet Vang - Image Contest
* @author    Creater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @author    Updater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Comments extends CI_Model
{
	/* Construct function */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	* Add new comment
	*
	* @param $p_arr_comment comment information
	* @return true if added successfully. Otherwise, false
	*/
	public function add_comment($p_arr_comment)
	{
		//return false if parameter is in valid
		if(!isset($p_arr_comment) || !is_array($p_arr_comment))
		{
			return false;
		}

		//return false if required field is not exist
		if(   !array_key_exists(DB_COMMENTS_COL_IMAGE_ID, $p_arr_comment)
		   || !array_key_exists(DB_COMMENTS_COL_USER_ID, $p_arr_comment))
		{
			return false;
		}

		try
		{
			$this->db->insert(DB_TAB_COMMENTS, $p_arr_comment);
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Edit comment
	*
	* @param $p_arr_comment comment information
	* @return true if edited successfully. Otherwise, false
	*/
	public function edit_comment($p_arr_comment)
	{
		//return false if parameter is in valid
		if(!isset($p_arr_comment) || !is_array($p_arr_comment))
		{
			return false;
		}

		//return false if required field is not exist
		if(   !array_key_exists(DB_COMMENTS_COL_ID, $p_arr_comment))
		{
			return false;
		}

		try
		{
			$this->db->update( DB_TAB_COMMENTS,
			               $p_arr_comment, 
			               array(DB_COMMENTS_COL_ID => $p_arr_comment[DB_COMMENTS_COL_ID])
			             );
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Delete comment
	*
	* @param int $p_id comment id
	* @return true if deleted successfully. Otherwise, false
	*/
	public function delete_comment($p_id)
	{
		//return false if comment id is not set
		if(!isset($p_id))
		{
			return false;
		}

		try
		{
			$this->db->delete(DB_TAB_COMMENTS, array(DB_COMMENTS_COL_ID => $p_id));
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Delete comments of user
	*
	* @param int $p_id user id
	* @return true if deleted successfully. Otherwise, false
	*/
	public function delete_user_comments($p_id)
	{
		//return false if comment id is not set
		if(!isset($p_id))
		{
			return false;
		}

		try
		{
			$this->db->delete(DB_TAB_COMMENTS, array(DB_COMMENTS_COL_USER_ID => $p_id));
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Get all comment
	*
	* @param $p_limit number of comment get. Default value is null (no limit)
	* @return array comment information or empty array
	*/
	public function get_all_comments($p_limit = null)
	{
		$result = array();
		if($p_limit == null)
		{
			//get all images
			$result = $this->db->get(DB_TAB_COMMENTS);
		}
		else
		{
			//get $p_limit first images
			$result = $this->db->get(DB_TAB_COMMENTS, 0, (int)$p_limit);
		}

		if(!isset($result) || $result->num_rows <= 0)
		{
			return array();
		}

		$comments = $result->result_array();
		$comments[] = _sort($comments);
		return $comments;
	}

	/**
	* Get comments by hiddent status
	* 
	* @param $p_is_hidden comment hidden status. Default is COMMENT_NOT_HIDDEN
	* @return array comments information or empty array
	*/
	public function get_active_comments($p_is_hidden = COMMENT_NOT_HIDDEN)
	{
		$result = array();
		if($p_is_hidden == IMAGE_NOT_HIDDEN || $p_is_hidden == IMAGE_NOT_HIDDEN)
		{
			$result = $this->db->get(DB_TAB_COMMENTS, array(DB_COMMENTS_COL_IS_HIDDEN => $p_is_hidden));

			if(!isset($result) || $result->num_rows <= 0)
			{
				return array();
			}

			$comments = $result->result_array();
			$comments[] = _sort($comments);
			return $comments;
		}
		else //$p_is_hidden is not valid value
		{
			return array();
		}
	}

	/**
	* Get comments by user
	*
	* @param int $p_id user id
	* @return array comments information or empty array
	*/
	public function get_comment_by_user($p_id)
	{
		//return false if user id is not set
		if(!isset($p_id))
		{
			return false;
		}

		try
		{
			$result = $this->db->get(DB_TAB_COMMENTS, array(DB_COMMENTS_COL_USER_ID => $p_id));
			if(!isset($result) || $result->num_rows <= 0)
			{
				return array();
			}

			$comments = $result->result_array();
			$comments[] = _sort($comments);
			return $comments;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Get comments by image, only not hidden comment
	*
	* @param int $p_id image id
	* @param int $p_last_id last comment id. Default is false
	* @param int $limit number of image get. Default is 20
	* @return array comments information or empty array
	*/
	public function get_comment_by_image($p_id, $p_last_id = false, $limit = 20, $minId = false)
	{
		//return false if image id is not set
		if(!isset($p_id))
		{
			return array();
		}

		try
		{
			$result = array();
			$this->db->where(DB_COMMENTS_COL_IMAGE_ID, $p_id);
			$this->db->where(DB_COMMENTS_COL_IS_HIDDEN, COMMENT_NOT_HIDDEN);
			if($p_last_id !== false)
			{
				$this->db->where(DB_COMMENTS_COL_ID . ' > ',  $p_last_id);
				$this->db->order_by(DB_COMMENTS_COL_ID, 'DESC');
				$result = $this->db->get(DB_TAB_COMMENTS);
			}
			else
			{
				if($minId !== false)
				{
					$this->db->where(DB_COMMENTS_COL_ID . ' < ',  $minId);
				}
				$this->db->order_by(DB_COMMENTS_COL_ID, 'DESC');
				$result = $this->db->get(DB_TAB_COMMENTS, $limit, 0);
			}
			if(!isset($result) || $result->num_rows <= 0)
			{
				return array();
			}

			$comments = $result->result_array();
			//$comments[] = _sort($comments);
			return $comments;
		}
		catch(Exception $e)
		{
			return array();
		}
	}

	/**
	* Count comments by image, only not hidden comment
	*
	* @param int $p_id image id
	* @return array comments information or empty array
	*/
	public function count_comment_by_image($p_id)
	{	
		$comments = 0;
		//return false if image id is not set
		if(!isset($p_id))
		{
			return array();
		}

		try
		{
			$result = $this->db->get_where(DB_TAB_COMMENTS, array(DB_COMMENTS_COL_IMAGE_ID => $p_id, DB_COMMENTS_COL_IS_HIDDEN => COMMENT_NOT_HIDDEN));
			$comments = $result->num_rows();
			//$comments[] = _sort($comments);
			return $comments;
		}
		catch(Exception $e)
		{
			return array();
		}
	}

	/**
	* Sort comment by parent - childrent relationship
	* 
	* @param array $p_arr_comments comment list
	* @return array comment sorted or empty array
	*/
	private function _sort($p_arr_comments)
	{
		//get comment id and parent into an array
		$result = array();
		$comments = array();
		$parents = array();
		$indexs = array();

		foreach ($p_arr_comments as $key => $comment)
		{
			if(isset($comment[DB_COMMENTS_COL_ID]))
			{
				if(isset($comment[DB_COMMENTS_COL_PARENT_ID]))
				{
					//get root comment
					if($comment[DB_COMMENTS_COL_PARENT_ID] == 0)
					{
						$parents[$comment[DB_COMMENTS_COL_ID]] = $comment[DB_COMMENTS_COL_PARENT_ID];
					}
					else
					{
						$comments[$comment[DB_COMMENTS_COL_ID]] = $comment[DB_COMMENTS_COL_PARENT_ID];
					}

					$result[$key] = array(DEEP => 1, CHILDREN => array());
				}
				else //if not parent, set it as root comment
				{
					$result[$key] = array(DEEP => 1, CHILDREN => array());

					$parents[$comment[DB_COMMENTS_COL_ID]] = $comment[DB_COMMENTS_COL_PARENT_ID];
				}

				$indexs[$comment[DB_COMMENTS_COL_ID]] = $key;
			}
		}
		$stop = false;
		while (!empty($comments) && !$stop) {
			$stop = true;
			foreach ($comments as $key => $value) {
				if(array_key_exists($value, $parent))
				{
					$parent[$key] = $value;
					unset($comments[$key]);

					$stop = false;
				}
			}
		}

		while(!empty($parent))
		{
			end($parent);
			$key = key($parent); //last index of $parent
			$child = $indexs[$key]; //index of comment
			$parent = $indexs[$parent[$key]];

			if($parent[$key] == 0)
			{
				break;
			}

			if(isset($result[$parent]) && isset($result[$child]))
			{
				$result[$parent][CHILDREN][$child] = $result[$child];
				$result[$parent][DEEP] += 1;
				unset($result[$child]);
			}
			unset($parent[$key]);
		}

		return $result;
	}

}