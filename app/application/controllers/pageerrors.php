<?php
/**
* Admin Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @author    Updater: Ho Quoc Nghi - <nghi_hq@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class PageErrors extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index($url = null)
	{
		//die(var_dump($url));
		$this->load->library('common');
		$p_arr 	= $this->common->readfileconfig();
		$header = array(
					 'active'	=>	0,
					 'favicon'	=>	isset($p_arr[FILE_FAVICON]) ? $p_arr[FILE_FAVICON] : "",
					 'logo'		=>	isset($p_arr[FILE_LOGO]) ? $p_arr[FILE_LOGO] : ""
					 );
		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/404_error');
		$this->load->view('layouts/footer');
	}
 
	public function banned()
	{
		$this->load->library('common');
		$p_arr 	= $this->common->readfileconfig();
		$header = array(
					 'active'	=>	0,
					 'favicon'	=>	isset($p_arr[FILE_FAVICON]) ? $p_arr[FILE_FAVICON] : "",
					 'logo'		=>	isset($p_arr[FILE_LOGO]) ? $p_arr[FILE_LOGO] : ""
					 );
		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/banned');
		$this->load->view('layouts/footer');
	}

	public function error()
	{
		$this->load->library('common');
		$p_arr 	= $this->common->readfileconfig();
		$header = array(
					 'active'	=>	0,
					 'favicon'	=>	isset($p_arr[FILE_FAVICON]) ? $p_arr[FILE_FAVICON] : "",
					 'logo'		=>	isset($p_arr[FILE_LOGO]) ? $p_arr[FILE_LOGO] : ""
					 );
		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/other_error');
		$this->load->view('layouts/footer');
	}
}