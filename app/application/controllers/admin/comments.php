<?php
/**
* Comments Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Comments extends CI_Controller
{
	/* 
	|----------------------------------------------------------------
	| Variable
	|----------------------------------------------------------------
	*/
	private $arr_Session = NULL;	
	/* Construct function */
	public function __construct()
	{
		parent:: __construct();
		$this->arr_Session = $this->session->userdata(ACCOUNT);
	}

	public function index($p_image_id = null)
	{
		echo $p_image_id;	
	}

	public function delete_comment()
	{
		
	}
}