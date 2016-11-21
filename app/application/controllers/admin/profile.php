<?php
/**
* Manager Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Profile extends CI_Controller
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

	/**
	* Function view edit account manager page
	* Date: 21/01/2015
	* URL Page: admin/profile
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show Edit Account Manager Page
	*/
	public function index() 
	{
		/*
		|----------------------------------------------------------------
		| Load library common
		| Check non exist session account manager
		| Non exist: redirect to login page
		|----------------------------------------------------------------
		*/
		$this->load->library("common");
		$this->common->check_non_exist_Session();


		/*
		|----------------------------------------------------------------
		| Load model manager
		|----------------------------------------------------------------
		*/
		$this->load->model('Manager');

		/**
		* @param $p_data_head 
		* Description: 	data use on admin/head_view
		*/
		$p_data_head 	=	array(
							"title" 		=> 	"Profile Admin Page", 
							"p_css_view"	=>	$this->load->view("admin/css/css_index_view", NULL, TRUE)
						);


		/**
		* @param $p_data_footer 
		* Description: 	data use on admin/footer_view
		*/
		$p_data_footer 	=	array( 
							"p_js_view"	=>	$this->load->view("admin/js/js_manager_view", NULL, TRUE)
						);
		
		/**
		* @param $p_data_left 
		* Description: 	data use on admin/left_view
		*/
		$p_data_left 	=	array( 
							"p_account_name"	=>	$this->arr_Session[0][DB_MANAGER_COL_NAME]
						);

		/**
		* @param $p_data_index 
		* Description: 	data use on admin/left_view
		*/
		$p_data_index 	=	array( 
							"p_account_name"			=>	$p_data_left["p_account_name"],
							"p_menu_right_account"		=>	$this->load->view("admin/menu_account_view", NULL, TRUE),
							"p_profile"					=>	$this->Manager->get_by_id($this->arr_Session[0][DB_MANAGER_COL_ID])
						);
		/*
		|----------------------------------------------------------------
		| Load Helper Form
		|----------------------------------------------------------------
		*/
		$this->load->helper(array('form'));
		/*
		|----------------------------------------------------------------
		| Load Admin Head View
		| Load Admin Left Navigation View
		| Load Admin Manager View
		| Load Admin Footer View
		|----------------------------------------------------------------
		*/
		$this->load->view("admin/head_view", $p_data_head);
		$this->load->view("admin/left_view", $p_data_left);
		$this->load->view("admin/account_manager_view", $p_data_index);
		$this->load->view("admin/footer_view", $p_data_footer);
	}

	/**
	* Function save change infomation for admin account
	* Date: 30/01/2015
	* Data From Page: admin/profile
	* URL Page: admin/profile/save
	* Rewrite routing: file config/routes.php
	* @param get from method post (request by ajax)
	* File source ajax request: view/js/js_manager_view.php
	* @return 
	*/
	public function edit_account()
	{
		/*
		|----------------------------------------
		| Load Model Manager
		| Library Encrypt
		| Input type = 0 : update info
		| Input type = 1 : change password
		|----------------------------------------
		*/
		$this->load->model("Manager");
		$this->load->library('encrypt');

		$p_reponse 		=	"0";
		if($this->input->post('type') == 0) 
		{
			$p_arr_manager 	=	array(
								DB_MANAGER_COL_ID		=>		$this->input->post('rd_id'),
								DB_MANAGER_COL_NAME		=>		$this->input->post('txt_name'),	
								DB_MANAGER_COL_EMAIL	=>		$this->input->post('txt_email'),
								DB_MANAGER_COL_ADDRESS	=>		$this->input->post('txt_address'),
								DB_MANAGER_COL_PHONE	=>		$this->input->post('txt_phone')
							);

			if($this->Manager->edit_manager($p_arr_manager) == TRUE) 
			{
				$p_reponse 		=	"1";
			}
		}
		else if($this->input->post('type') == "1") {
			
			/*
			|----------------------------------------
			| Load library form validate
			|----------------------------------------
			*/			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txt_old_password', 'Old password','trim|required');
			$this->form_validation->set_rules('txt_new_password', 'New password','trim|required');
			$this->form_validation->set_rules('txt_confirm_password', 'Confirm password','trim|required|matches[txt_new_password]');

			if($this->form_validation->run() == TRUE)
			{
				/**
				* Get manager by id
				*/
				$p_arr 				=	$this->Manager->get_by_id($this->input->post('rd_id'));
				$temp_pass_decode 	= 	$this->encrypt->decode($p_arr[0][DB_MANAGER_COL_PASSWORD]);
				$new_pass 			=	$this->encrypt->encode($this->input->post('txt_new_password'));

				if($this->input->post('txt_old_password') == $temp_pass_decode)
				{
					$p_arr_manager 	=	array(
								DB_MANAGER_COL_ID		=>		$this->input->post('rd_id'),
								DB_MANAGER_COL_PASSWORD	=>		$new_pass
							);

					if($this->Manager->edit_manager($p_arr_manager) == TRUE) 
					{
						$p_reponse 		=	"2";
					}
				}
				else
				{
					$p_reponse 		=	"3";
				}
			}			
		}		

		echo $p_reponse;
	}
}