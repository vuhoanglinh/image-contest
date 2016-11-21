<?php
/**
* Plans Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
	* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
		* @copyright 2015 The Viet Vang JSC
		*/
		class Plans extends CI_Controller
		{
			public function __construct()
			{
					parent:: __construct();
			}
			/**
			* Function view plans page
			* Date: 10/02/2015
			* URL Page: plans
			* Rewrite routing: file config/routes.php
			* @param
			* @return Show plans page
			*/
			public function index()
			{
				$this->load->library('common');
				$p_arr 	= $this->common->readfileconfig();
				$header = array(
					 'active'	=>	1,
					 'favicon'	=>	isset($p_arr[FILE_FAVICON]) ? $p_arr[FILE_FAVICON] : "",
					 'logo'		=>	isset($p_arr[FILE_LOGO]) ? $p_arr[FILE_LOGO] : ""
				);
				$this->load->view('layouts/header', $header);
				$this->load->view('layouts/plans');
				$this->load->view('layouts/footer');
			}

	/**
	* Function view how to use page
	* Date: 10/02/2015
	* URL Page: howtouse
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show how to use
	*/
	public function howtouse()
	{
		$this->load->library('common');
		$p_arr 	= $this->common->readfileconfig();
		$header = array(
			'active'	=>	2,
			'favicon'	=>	isset($p_arr[FILE_FAVICON]) ? $p_arr[FILE_FAVICON] : "",
			'logo'		=>	isset($p_arr[FILE_LOGO]) ? $p_arr[FILE_LOGO] : ""
			);
		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/howtouse');
		$this->load->view('layouts/footer');
	}

	
}