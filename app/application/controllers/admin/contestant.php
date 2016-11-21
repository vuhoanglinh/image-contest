<?php
/**
* Contestant Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Contestant extends CI_Controller
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
	* Function view contestant page
	* Date: 23/01/2015
	* URL Page: admin/contestants
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show Contestants Page
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
		| Load model users
		|----------------------------------------------------------------
		*/
		$this->load->model("Users");
		

		/**
		* @param $p_data_head 
		* Description: 	data use on admin/head_view
		*/
		$p_data_head 	=	array(
							"title" 		=> 	"Contestant Page",
							"p_css_view"	=>	$this->load->view("admin/css/css_index_view", NULL, TRUE)
						);

		/**
		* @param $p_data_footer 
		* Description: 	data use on admin/footer_view
		*/
		$p_data_footer 	=	array( 
							"p_js_view"	=>	$this->load->view("admin/js/js_contestant_view", NULL, TRUE)
						);
		
		/**
		* @param $p_data_left 
		* Description: 	data use on admin/left_view
		*/
		$p_data_left 	=	array( 
							"p_account_name"	=>	$this->arr_Session[0][DB_MANAGER_COL_NAME],
							"active"			=>	3
						);


		/*
		|----------------------------------------------------------------
		| Pagging config
		| Get param sort by likes or comments
		| Get total row from image model
		| Get current page
		|----------------------------------------------------------------
		*/		
		$p_item_show	=	DEFAULT_GET_TOP; 	
		$total 			=	count($this->Users->get_all_users());
		$p_current_page =	($this->input->get('page') ? $this->input->get('page') : 1);

		/**
		* Array param pagging, add to view
		* Description: 	data use on admin/image_view
		*/
		$p_arr_pram 	=	array(
								'p_list_page' 		=> 	ceil($total / $p_item_show),
								'p_current_page'	=>	$p_current_page,
								'p_prev_page'		=>	($p_current_page > 1) ? ($p_current_page - 1) : 1,
								'p_next_page'		=>	($p_current_page + 1) > ceil($total / $p_item_show) ? $p_current_page : ($p_current_page + 1)
						 	);
		/**
		* @param start row get data from images model  
		*/
		$p_start		=	($p_arr_pram['p_current_page'] - 1) * $p_item_show;	

		/**
		* @param $p_data_index 
		* Description: 	data use on admin/image_view
		*/
		$p_data_contestant 	=	array( 
							"p_account_name"			=>	$p_data_left["p_account_name"],
							"p_menu_right_account"		=>	$this->load->view("admin/menu_account_view", NULL, TRUE),
							"p_users"					=>	$this->Users->get_all_users($p_item_show, $p_start),
							"p_arr_param"				=>	$p_arr_pram	
						);
				
		/*
		|----------------------------------------------------------------
		| Load Admin Head View
		| Load Admin Left Navigation View
		| Load Admin Contestant View
		| Load Admin Footer View
		|----------------------------------------------------------------
		*/
		$this->load->view("admin/head_view", $p_data_head);
		$this->load->view("admin/left_view", $p_data_left);
		$this->load->view("admin/contestant_view", $p_data_contestant);
		$this->load->view("admin/footer_view", $p_data_footer);
	}

	/**
	* Function view profile contestant page
	* Date: 30/01/2015
	* URL Page: admin/contestants/profile/(:any)
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show Profile Contestants Page
	*/
	public function profile($p_id = null)
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
		| Load model users
		| Check id user exist
		|----------------------------------------------------------------
		*/
		$this->load->model("Users");
		
		if($p_id == null OR empty($this->Users->get_user_by_id($p_id))) {
			redirect('notfound');
		}

		/**
		* @param $p_data_head 
		* Description: 	data use on admin/head_view
		*/
		$p_data_head 	=	array(
							"title" 		=> 	"Contestant Page",
							"p_css_view"	=>	$this->load->view("admin/css/css_index_view", NULL, TRUE)
						);

		/**
		* @param $p_data_footer 
		* Description: 	data use on admin/footer_view
		*/
		$p_data_footer 	=	array( 
							"p_js_view"	=>	$this->load->view("admin/js/js_profile_view", NULL, TRUE)
						);
		
		/**
		* @param $p_data_left 
		* Description: 	data use on admin/left_view
		*/
		$p_data_left 	=	array( 
							"p_account_name"	=>	$this->arr_Session[0][DB_MANAGER_COL_NAME],
							"active"			=>	3
						);

		/*
		|----------------------------------------------------------------
		| Load model images
		| Get image by user
		|----------------------------------------------------------------
		*/
		$this->load->model('Images');
		$p_images 		=	$this->Images->get_image_by_user($p_id);
		$p_arr_images 	=	array(
								'p_total_image' 	=> 	0, 
								'p_total_comments' 	=> 	0, 
								'p_total_likes' 	=> 	0,
								'p_images'			=>	array()
							);

		if(empty($p_images )) {
			$p_arr_images = array(
								'p_total_image' 	=> 	0, 
								'p_total_comments' 	=> 	0, 
								'p_total_likes' 	=> 	0,
								'p_images'			=>	array()
							);
		}
		else {
			foreach ($p_images as $row) {
				$p_arr_images['p_total_comments']	+=	$row[DB_IMAGES_COL_COMMENTS];
				$p_arr_images['p_total_likes']		+=	$row[DB_IMAGES_COL_LIKES];
			}
			$p_arr_images['p_total_image'] = count($p_images);
			$p_arr_images['p_images']				=	$p_images;
		}
		/**
		* @param $p_data_index 
		* Description: 	data use on admin/image_view
		*/
		$p_data_contestant 	=	array( 
							"p_account_name"			=>	$p_data_left["p_account_name"],
							"p_menu_right_account"		=>	$this->load->view("admin/menu_account_view", NULL, TRUE),
							"p_users"					=>	$this->Users->get_user_by_id($p_id),
							"p_arr_images"				=>	$p_arr_images
						);
		/*
		|----------------------------------------------------------------
		| Load Admin Head View
		| Load Admin Left Navigation View
		| Load Admin Profile Contestant View
		| Load Admin Footer View
		|----------------------------------------------------------------
		*/
		$this->load->view("admin/head_view", $p_data_head);
		$this->load->view("admin/left_view", $p_data_left);
		$this->load->view("admin/profile_view", $p_data_contestant);
		$this->load->view("admin/footer_view", $p_data_footer);
	}

	/**
	* Function update status (ban or allow) users (contestants)
	* Date: 30/01/2015
	* URL Page: admin/contestants/status
	* Rewrite routing: file config/routes.php
	* @param input post from admin and admin/contestant (request by ajax)
	* File source ajax request: view/js/js_contestant_view.php
	* @return reponse after update status
	*/
	public function update_contestant_status()
	{
		/*
		|----------------------------------------------------------------
		| Load model Users
		|----------------------------------------------------------------
		*/
		$this->load->model('Users');

		/*
		|----------------------------------------------------------------
		| Get input post status and id of user
		|----------------------------------------------------------------
		*/
		$status =	$this->input->post('p_status');
		$id 	=	$this->input->post('p_id');
		/*
		|----------------------------------------------------------------
		| Variable reponse
		|----------------------------------------------------------------
		*/
		$p_reponse 		= 	0;

		/*
		|----------------------------------------------------------------
		| Array info update of user
		|----------------------------------------------------------------
		*/
		$p_arr_user 	= 	array(
							DB_USERS_COL_ID 		=> $id,
							DB_USERS_COL_IS_BAN 	=> $status
						);
		//Delete user's comments and images
		if($status == USER_BANNED)
		{
			$this->load->model('Images');
			$userImages = $this->Images->get_image_by_user($id);
			foreach ($userImages as $key => $image)
			{
				unlink(UPLOAD_FOLDER . $images[DB_IMAGES_COL_NAME]);
				unlink(UPLOAD_FOLDER_THUMB . THUMB . $images[DB_IMAGES_COL_NAME]);
			}
			$this->Images->delete_user_images($id);
			
			$this->load->model('Comments');
			$this->Comments->delete_user_comments($id);
		}

		/*
		|----------------------------------------------------------------
		| Call function update form user model
		|----------------------------------------------------------------
		*/
		if($this->Users->edit_user($p_arr_user) == TRUE) {
			$p_reponse	=	1;
		}

		/*
		|----------------------------------------------------------------
		| echo variable to request from browser (using ajax)
		|----------------------------------------------------------------
		*/
		echo $p_reponse;
	}
}