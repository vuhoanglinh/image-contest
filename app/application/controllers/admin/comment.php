<?php
/**
* Comments Controller
*
* @package   Viet Vang - Image Contest
* @author    Creater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @author    Updater: Vu Hoang Linh - <linh_vh@vietvang.net>
* @copyright 2015 The Viet Vang JSC
*/
class Comment extends CI_Controller
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
		$this->load->Model('Comments');
	}

	/**
	* Function view comments
	* Date: 13/01/2015
	* URL Page: admin/comment/$1
	* Rewrite routing: file config/routes.php
	* @param 
	* @return Show Comment by image id
	*/
	public function index($p_image_id = null)
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
		$this->load->model('Users');
		$data = $this->Comments->get_comment_by_image($p_image_id);
		$comments = array();

			foreach ($data as $key => $comment) {
				$comments[$key][DB_COMMENTS_COL_ID]		 =	$comment[DB_COMMENTS_COL_ID];
				$comments[$key][DB_COMMENTS_COL_CONTENT] =  $comment[DB_COMMENTS_COL_CONTENT];
				$author = 	$this->Users->get_user_by_id($comment[DB_COMMENTS_COL_USER_ID]);
				$authorName = '';
				$authorAvatar = '';
				$idauthor 	=	'';
				$currentUser = $this->session->userdata(SESSION_USER_ID);
				if(!empty($author))
				{
					$authorName = $author[DB_USERS_COL_NAME];
					$authorAvatar = $author[DB_USERS_COL_AVATAR];
					$idauthor  	  = $author[DB_USERS_COL_ID];
				}
				$comments[$key]['author'] = $authorName;
				$comments[$key]['avatar'] = $authorAvatar;
				$comments[$key]['author_id'] = $idauthor;
			}
		/**
		* @param $p_data_head 
		* Description: 	data use on admin/head_view
		*/
		$p_data_head 	=	array(
							"title" 		=> 	"Management comments Page" 
							);

		/**
		* @param $p_data_footer 
		* Description: 	data use on admin/footer_view
		*/
		$p_data_footer 	=	array( 
							"p_js_view"			=>	$this->load->view("admin/js/js_comment_view", NULL, TRUE)
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
							"p_comments"				=>	$comments
						);		

		/*
		|----------------------------------------------------------------
		| Load Admin Head View
		| Load Admin Left Navigation View
		| Load Admin Comments View
		| Load Admin Footer View
		|----------------------------------------------------------------
		*/
		$this->load->view("admin/head_view", $p_data_head);
		$this->load->view("admin/left_view", $p_data_left);
		$this->load->view("admin/comments_view", $p_data_index);
		$this->load->view("admin/footer_view", $p_data_footer);

	}

	public function delete()
	{
		$response = 0;
		$this->load->model('Comments');
		$commentid= $this->input->post('id');
		if($this->Comments->delete_comment($commentid) == true)
		{
			$response = 1;
		}
		echo $response;
	}
}