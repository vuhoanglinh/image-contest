<?php
/**
* Manager model, manage manager (admin) account
*
* @package   Viet Vang - Image Contest
* @author    Creater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @author    Updater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Manager extends CI_Model
{
	/* Construct function */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	* Add new manager
	* 
	* @param array $p_arr_manager manager information
	* @return true if added successfully. Otherwise, false
	*/
	public function add_manager($p_arr_manager)
	{
		//return false if parameter is not set or not an array
		if(!isset($p_arr_manager) || !is_array($p_arr_manager))
		{
			return false;
		}

		//return false if account name and/or password is not set
		if(!isset($p_arr_manager[DB_MANAGER_COL_ACCOUNT_NAME]) || !isset($p_arr_manager[DB_MANAGER_COL_PASSWORD]))
		{
			return false;
		}

		try
		{
			$this->db->insert(DB_TAB_MANAGER, $p_arr_manager);
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Edit manager
	* 
	* @param array $p_arr_manager manager information
	* @return true if eddited successfully. Otherwise, false
	*/
	public function edit_manager($p_arr_manager)
	{
		//return false if parameter is not set or not an array
		if(!isset($p_arr_manager) || !is_array($p_arr_manager))
		{
			return false;
		}

		//return false if account name and/or password is not set
		if(!isset($p_arr_manager[DB_MANAGER_COL_ID]))
		{
			return false;
		}

		try
		{
			$this->db->update(DB_TAB_MANAGER, $p_arr_manager, array(DB_MANAGER_COL_ID => $p_arr_manager[DB_MANAGER_COL_ID]));
			return true;			
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Delete manager
	* 
	* @param int $p_id manager id
	* @return true if deleted successfully. Otherwise, false
	*/
	public function delete_manager($p_id)
	{
		//return false if $p_id is not set
		if(!isset($p_id))
		{
			return false;
		}

		try
		{
			$this->db->delete(DB_TAB_MANAGER, array(DB_MANAGER_COL_ID => $p_id));
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/**
	* Get all manager
	*
	* @return array managers imformation or empty array
	*/
	public function get_all()
	{
		$result = $this->db->get(DB_TAB_MANAGER);
		if(!isset($result) || $result->num_rows <= 0)
		{
			return array();
		}

		return $result->result_array();
	}

	/**
	* Get manager by manager id
	*
	* @param int $p_id manager id
	* @return array manager information or empty array
	*/
	public function get_by_id($p_id)
	{
		//return empty array if $p_id is not set
		if(!isset($p_id))
		{
			return array();
		}
		$result = $this->db->get(DB_TAB_MANAGER, array(DB_MANAGER_COL_ID => $p_id));
		if(!isset($result) || $result->num_rows <=0)
		{
			return array();
		}

		return $result->result_array();
	}

	/**
	* Get manager by account name and password
	*
	* @param string $p_account, string $p_password
	* @return array manager information or empty array
	*/
	public function get_by_login($p_account = "", $p_password = "")
	{
		/*
		|----------------------------------------
		| Library Encrypt
		|----------------------------------------
		*/
		$this->load->library('encrypt');


		$result = null;
		if(!empty($p_account) AND (!empty($p_password)))
		{

			/*
			|----------------------------------------
			| Get manager info by account name
			|----------------------------------------
			*/
			$this->db->where(DB_MANAGER_COL_ACCOUNT_NAME, $p_account);
			$this->db->or_where(DB_MANAGER_COL_EMAIL, $p_account);
			$this->db->limit(1);
			//$this->db->where(DB_MANAGER_COL_PASSWORD, $p_password);
			$query 	= $this->db->get(DB_TAB_MANAGER);			
			foreach ($query->result_array() as $row) {

				/*
				|----------------------------------------
				| Decode password to compare 
				|----------------------------------------
				*/
				$temp_pass_decode = $this->encrypt->decode($row[DB_MANAGER_COL_PASSWORD]);
				if($p_password == $temp_pass_decode)
				{
					$result = $query->result_array();
				}
			}
		}
		return $result; 
	}

}
