<?php

class Users_Controller extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Users');
	}

	public function index()
	{
		
		$facebook = array(
			'app_id' => '1123',
			'app_serect' => '1223'
			);
		$this->config->set_item('facebook', $facebook);
		die(var_dump($this->config->item('facebook')));
		$this->Users->add_user(array());
		//$this->load->view('test_only',$data);
	}
}