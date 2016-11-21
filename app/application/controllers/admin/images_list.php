<?php
/**
* Images Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Images_list extends CI_Controller
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
	* Function view image page
	* Date: 27/01/2015
	* URL Page: admin/images
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show Image Page
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
							"title" 		=> 	"Images List Page",
							"p_css_view"	=>	$this->load->view("admin/css/css_index_view", NULL, TRUE)
						);

		/**
		* @param $p_data_footer 
		* Description: 	data use on admin/footer_view
		*/
		$p_data_footer 	=	array( 
							"p_js_view"	=>	$this->load->view("admin/js/js_index_view", NULL, TRUE)
						);
		
		/**
		* @param $p_data_left 
		* Description: 	data use on admin/left_view
		*/
		$p_data_left 	=	array( 
							"p_account_name"	=>	$this->arr_Session[0][DB_MANAGER_COL_NAME],
							"active"			=>	2
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
		$p_sort 		=	($this->input->get('sort') != NULL ? $this->input->get('sort') : DB_IMAGES_COL_ID);// default is sort by id
		$total 			=	count($this->Images->get_all_images());
		$p_current_page =	($this->input->get('page') ? $this->input->get('page') : 1);

		/**
		* Array param pagging, add to view
		* Description: 	data use on admin/image_view
		*/
		$p_arr_pram 	=	array(
								'p_list_page' 		=> 	ceil($total / $p_item_show),
								'p_current_page'	=>	$p_current_page,
								'p_sort'			=>	$p_sort,
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
		$p_data_image 	=	array( 
							"p_account_name"			=>	$p_data_left["p_account_name"],
							"p_menu_right_account"		=>	$this->load->view("admin/menu_account_view", NULL, TRUE),
							"p_images"					=>	$this->Images->get_images($p_item_show, $p_start, $p_sort),
							"p_arr_param"				=>	$p_arr_pram				
						);
				
		/*
		|----------------------------------------------------------------
		| Load Admin Head View
		| Load Admin Left Navigation View
		| Load Admin Image View
		| Load Admin Footer View
		|----------------------------------------------------------------
		*/
		$this->load->view("admin/head_view", $p_data_head);
		$this->load->view("admin/left_view", $p_data_left);
		$this->load->view("admin/image_view", $p_data_image);
		$this->load->view("admin/footer_view", $p_data_footer);
	}

	/**
	* Function update status image
	* Date: 27/01/2015
	* URL Page: admin/images/status
	* Rewrite routing: file config/routes.php
	* @param input post from admin and admin/images page (request by ajax)
	* File source ajax request: view/js/js_image_view.php
	* @return reponse after update status
	*/
	public function update_images_status()
	{
		
		/*
		|----------------------------------------------------------------
		| Variable reponse
		|----------------------------------------------------------------
		*/
		$p_reponse 		= 0;

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{

			/*
			|----------------------------------------------------------------
			| Load model images
			|----------------------------------------------------------------
			*/
			$this->load->model('Images');

			/*
			|----------------------------------------------------------------
			| Get input post status and id of image
			|----------------------------------------------------------------
			*/
			$status =	$this->input->post('p_status');
			$id 	=	$this->input->post('p_id');

			/*
			|----------------------------------------------------------------
			| Array info update of image
			|----------------------------------------------------------------
			*/
			$p_arr_image 	= 	array(
								DB_IMAGES_COL_ID 		=> $id,
								DB_IMAGES_COL_IS_HIDDEN => $status
							);
			/*
			|----------------------------------------------------------------
			| Call function update form image model
			|----------------------------------------------------------------
			*/
			if($this->Images->edit_image($p_arr_image) == TRUE) {
				$p_reponse	=	1;
			}
		}

		/*
		|----------------------------------------------------------------
		| echo variable to request from browser (using ajax)
		|----------------------------------------------------------------
		*/
		echo $p_reponse;
	}
}