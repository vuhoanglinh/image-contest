<?php
/**
* Vote model, manage user vote
*
* @package   Viet Vang - Image Contest
* @author    Creater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @author    Updater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Vote extends CI_Model
{
	/* Construct function */
	public function __construct()
	{
		$this->load->database();
	}
	
	/**
	* Update vote
	* Each user votes each image only one time each day. At 00:00:00 everyday, vote table will be reset.
	* 
	* @param int $p_userId
	* @param int $p_imageId
	* @return 0 if vote success, 1 if voter voted the image before. Other wise, 2
	*/
	public function update_vote($p_userId, $p_imageId)
	{
		if(!isset($p_userId) OR !isset($p_imageId))
		{
			return 2;
		}
		
		// check if the voter voted the image or not
		$this->db->where(DB_VOTES_COL_IMAGE_ID, $p_imageId);
		$this->db->where(DB_VOTES_COL_USER_ID, $p_userId);
		$this->db->from(DB_TAB_VOTES);
		if($this->db->count_all_results() > 0)
		{
			return 1;
		}
		
		//update vote
		$this->db->set(DB_IMAGES_COL_LIKES, '`' . DB_IMAGES_COL_LIKES . '` + 1', FALSE);
		$this->db->where(DB_IMAGES_COL_ID, $p_imageId);
		$this->db->update(DB_TAB_IMAGES);
		
		if($this->db->affected_rows() > 0) // check if updated vote into image table or not
		{
			$data = array(
						DB_VOTES_COL_IMAGE_ID => $p_imageId,
						DB_VOTES_COL_USER_ID => $p_userId,
						);
			$this->db->insert(DB_TAB_VOTES, $data);
			return 0;
		}
		else
		{
			return 2;
		}
	}

	/**
	* Check if an user voted an image or note
	* 
	* @param int $p_userId
	* @param int $p_imageId
	* @return boolean true if voted. Otherwise, false
	*/

	public function check_vote($p_userId, $p_imageId)
	{
		if(isset($p_userId, $p_imageId))
		{
			$this->db->where(DB_VOTES_COL_USER_ID, $p_userId);
			$this->db->where(DB_VOTES_COL_IMAGE_ID, $p_imageId);
			$this->db->from(DB_TAB_VOTES);

			$result = $this->db->count_all_results();
			if($result > 0) return true;
			else return false;
		}
		return false;
	}
}