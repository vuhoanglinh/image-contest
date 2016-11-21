<?php
/**
* Index_post_login Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Index_post_login extends CI_Controller
{
	/* Construct function */
	public function __construct()
	{
		parent:: __construct();
	}

	/**
	* Function get infomation and authenticate account login
	* Date: 21/01/2015
	* Data From Page: admin/login
	* URL Page: admin/logined
	* Rewrite routing: file config/routes.php
	* Using function: authenticate()
	* @param get from method post
	* @return 
	*/
	public function login()
	{
		/*
		|----------------------------------------
		| Library Form Validation
		|----------------------------------------
		*/		
		$this->load->library('form_validation');		

		/**
		* @param $p_request
		* Description:  $p_request = 0: Login fails
		*				$p_request = 1: Login success	
		*/
		$p_request = 0;

		/*
		| Set Rules Validation for input (account and password required)
		*/
		$this->form_validation->set_rules("txt_account", "Account name", "required");
		$this->form_validation->set_rules("txt_password", "Password", "required");

		/*
		| Check Validation
		*/
		if($this->form_validation->run() == TRUE)
		{
			if($this->authenticate() == TRUE){
				$p_request = 1;
			}				
		}

		/*
		| echo request (return request)
		*/

		if($this->input->is_ajax_request()) 
		{
			echo $p_request;
		}
		else
		{
			if($p_request == 1)
			{
				redirect(base_url('admin'));
			}
			else
			{
				$_SESSION['error_login']	=	"1";
				redirect(base_url('admin/login'));	
			}
		}
		
	}

	/**
	* Function authenticate account login
	* Date: 21/01/2015
	* Data From Page: admin/login
	* @param get from method post
	* @return TRUE/FALSE
	*/
	public function authenticate()
	{
		/**
		* @param $p_authenticate
		* Description:  $p_authenticate = false: authenticate fails
		*				$p_authenticate = true: authenticate success	
		*/
		$p_authenticate = FALSE;
		/*
		|----------------------------------------
		| Load Model Manager
		| Library Encrypt
		|----------------------------------------
		*/
		$this->load->model("Manager");
		$this->load->library('encrypt');

			/*
			| Get Response form client
			| Get account and password
			| Encrypt password
			| Compare data form database
			*/
			$account 	= 	$this->input->post("txt_account");
			$password 	=	$this->input->post("txt_password");

			/*
			| Get data after compare model
			| Model return array
			*/
			$result 	=	$this->Manager->get_by_login($account, $password);

			/*
			| Login success, set data to session
			*/
			$p_authenticate = $this->setSession($result);
			
		return $p_authenticate;
	}
	
	/**
	* Function set manager infomation to session
	* Date: 21/01/2015
	* @param array 
	* @return TRUE/FALSE
	*/
	public function setSession($result = array())
	{
		/**
		* @param $p_session
		* Description:  $p_session = false: set session fails
		*				$p_session = true: set session success	
		*/
		$p_session = FALSE;

		if(is_array($result) AND !empty($result))
		{
			/**
			* Autoload Library Session in file config/autoload.php
			* Description: using session library save manager infomation
			* And set return variable TRUE
			*/
			$this->session->set_userdata(ACCOUNT,$result);
			$_SESSION['base_url'] 	=	base_url();			
			$p_session = TRUE;
		}
		return $p_session;
	}

}