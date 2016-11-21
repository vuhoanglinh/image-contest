<?php
/**
* Admin Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Index extends CI_Controller
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
	* Function view index page
	* Date: 21/01/2015
	* URL Page: admin
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show Index Page
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
		| Load model images
		| Get users (contestants) by top images like
		| Load model users
		|----------------------------------------------------------------
		*/
		$this->load->model("Images");
		$this->load->model("Users");
		

		/**
		* @param $p_data_head 
		* Description: 	data use on admin/head_view
		*/
		$p_data_head 	=	array(
							"title" 		=> 	"Administrator Page", 
							"p_css_view"	=>	$this->load->view("admin/css/css_index_view", NULL, TRUE)
						);


		/**
		* @param $p_data_footer 
		* Description: 	data use on admin/footer_view
		*/
		$p_data_footer 	=	array( 
							"p_js_view"			=>	$this->load->view("admin/js/js_index_view", NULL, TRUE)
						);
		
		/**
		* @param $p_data_left 
		* Description: 	data use on admin/left_view
		*/
		$p_data_left 	=	array( 
							"p_account_name"	=>	$this->arr_Session[0][DB_MANAGER_COL_NAME],
							"active"			=>	0
						);
		/**
		* @param $p_data_index 
		* Description: 	data use on admin/left_view
		*/
		$p_data_index 	=	array( 
							"p_account_name"			=>	$p_data_left["p_account_name"],
							"p_menu_right_account"		=>	$this->load->view("admin/menu_account_view", NULL, TRUE),
							"p_arr_file"				=>	$this->common->readfileconfig(),
							"p_count_images"			=>	$this->Images->get_count(IMAGE_HIDDEN),
							"p_count_users"				=>	$this->Users->get_count_all_users(USER_BANNED),
							"p_count_likes"				=>	$this->Images->get_total_likes_or_comments_images(),
							"p_count_comments"			=>	$this->Images->get_total_likes_or_comments_images(DB_IMAGES_COL_COMMENTS),
							"p_arr_users_total_likes"	=>	$this->Users->get_user_top_like(),
							"p_arr_users_total_comments"=>	$this->Users->get_user_top_comment(),
							"p_top_contestant"			=>	$this->Images->get_top_contestant(),
							"p_count"					=>	0
						);


		
		/*
		|----------------------------------------------------------------
		| Load Admin Head View
		| Load Admin Left Navigation View
		| Load Admin Dashboard View
		| Load Admin Footer View
		|----------------------------------------------------------------
		*/
		$this->load->view("admin/head_view", $p_data_head);
		$this->load->view("admin/left_view", $p_data_left);
		$this->load->view("admin/index_view", $p_data_index);
		$this->load->view("admin/footer_view", $p_data_footer);
	}




	/**
	* Function view login page
	* Date: 21/01/2015
	* URL Page: admin/login
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show Login Page
	*/
	public function login()
	{		
		$p_error = 0;
		if(isset($_SESSION['error_login']))
		{
			unset($_SESSION['error_login']);
			$p_error = 1;
		}
		/*
		|----------------------------------------------------------------
		| Load library common
		| Check exist session account manager
		| Existed: redirect to admin page
		|----------------------------------------------------------------
		*/
		$this->load->library("common");
		$this->common->check_exist_Session();

		/*
		|----------------------------------------------------------------
		| Load Helper Form
		|----------------------------------------------------------------
		*/
		$this->load->helper(array('form'));


		/**
		* @param $p_js_login 
		* Description: 	url is url redirect when login successs
		*				id_form is id form login, id_form use ajax 
		*/
		$p_js_login = array(
						"url" 			=> 		base_url("admin"),
						"id_form"		=>		"frm-login",
						"msg_error"		=>		"Please check your Email address and Password."
					);


		/**
		* @param $p_data 
		* Description: 	data use on login page
		*/
		$p_data = array(
					"title" 	=> 	"Administrator Login Page",
					"p_js_view"	=>	$this->load->view("admin/js/js_login_view", $p_js_login, TRUE),
					"id_form"	=>	"frm-login",
					"p_error"	=>	$p_error
					);


		/*
		|----------------------------------------------------------------
		| Load Login View
		|----------------------------------------------------------------
		*/
		$this->load->view("admin/login_view", $p_data);
	}

	/**
	* Function logout
	* Date: 21/01/2015
	* Description: remove session
	* @param 
	* @return
	*/
	public function logout()
	{
		/*
		|----------------------------------------------------------------
		| Set Session Null
		| Redirect to login page
		|----------------------------------------------------------------
		*/
		$this->session->set_userdata(ACCOUNT, NULL);
		redirect(base_url("admin/login"));
	}

	/**
	* Function page not found
	* Date: 21/01/2015
	* URL Page: admin/admin/error_404 (404_override)
	* Rewrite routing: file config/routes.php
	* @param 
	* @return
	*/
	public function error_404()
	{
		$this->output->set_status_header('404');

		/**
		* @param $p_data_head 
		* Description: 	data use on admin/head_view
		*/
		$p_data_head 	=	array(
							"title" 		=> 	"404 Page not found"
						);

		/**
		* @param $p_data_footer 
		* Description: 	data use on admin/footer_view
		*/
		$p_data_footer 	=	array( 
							"p_js_view"	=>	'<script type="text/javascript">
										    	$(document).ready(function(){

										    		$("body").addClass("error-page");
										    		$("body").removeClass("sticky-header");
										    	});
										    </script>'
						);

		/*
		|----------------------------------------------------------------
		| Load Admin Head View
		| Load Admin 404 View
		| Load Admin Footer View
		|----------------------------------------------------------------
		*/
		$this->load->view("admin/head_view", $p_data_head);
		$this->load->view("admin/404_view");
		$this->load->view("admin/footer_view", $p_data_footer);
	}
}