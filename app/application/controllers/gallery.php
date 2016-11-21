<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* ---------------------------------------------------------------------------
* Gallery controller
* ---------------------------------------------------------------------------
* Home page of event, image detail page
* ---------------------------------------------------------------------------
* 
* @author Creater: Ho Quoc Nghi <nghi_hq@vietvang.net>
* @author Updater: Ho Quoc Nghi <nghi_hq@vietvang.net>
* @copyright 2015 Viet Vang JSC
*/

class Gallery extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Images');		
	}

	//home page
	public function index($page = null)
	{
		$currentPage 	= ($page == null)? 1 : $page;
		$currentUser 	= $this->session->userdata(SESSION_USER_ID);
		$totalPage 		= $this->session->flashdata('TOTALPAGE');
		$this->load->library('common');
		$imgEachPage 	= $this->common->readfileconfig();
		$p_arr 	= $this->common->readfileconfig();
		if(!empty($imgEachPage) AND isset($imgEachPage[FILE_IMAGE_SHOW_NUMBER]))
		{
			$imgEachPage = $imgEachPage[FILE_IMAGE_SHOW_NUMBER];
		}
		else
		{
			$imgEachPage = IMAGE_EACH_PAGE;
		}
		
		if($totalPage == false)
		{
			$totalImages 	= $this->Images->get_count();
			$totalPage 		= ceil($totalImages / $imgEachPage);
		}		
		//pagination
		$startPage = null;
		$endPage = null;
		$dotdotPre = false;
		$dotdotNext = false;
		if($totalPage > 2)
		{
			$startPage = ($currentPage > 4) ? $currentPage - 3 : 2;
			$endPage = ($currentPage + 3 < $totalPage)? $currentPage + 3 : $totalPage - 1;
			if($startPage > 2) $dotdotPre = true;
			if($endPage + 1 < $totalPage) $dotdotNext = true;
		}

		$start 	 = ($currentPage - 1) * $imgEachPage;
		$gallery = $this->Images->get_active_images($start, $imgEachPage, IMAGE_NOT_HIDDEN, DB_IMAGES_COL_ID);

		$this->load->model('Users');
		$this->load->model('Vote');
		foreach ($gallery as $key => $image) {
			$user = $this->Users->get_user_by_id($image[DB_IMAGES_COL_AUTHOR]);
			//check if avatar is exist
			// $response = get_headers($user[DB_USERS_COL_AVATAR], 1);
			// if(strpos($response[0], '404') !== false)
			// {
			// 	$user[DB_USERS_COL_AVATAR] = base_url('styles/images/anonymousUser.jpg');
			// }
			$gallery[$key][THUMB] 					= base_url(UPLOAD_FOLDER_THUMB . THUMB . $image[DB_IMAGES_COL_NAME]);
			$gallery[$key][DB_IMAGES_COL_NAME] 		= UPLOAD_FOLDER . $image[DB_IMAGES_COL_NAME];
			$gallery[$key][DB_IMAGES_COL_AUTHOR] 	= $user;
			$gallery[$key][LINK] 					= base_url('gallery/detail/image_' . $image[DB_IMAGES_COL_ID]);
			$gallery[$key][VOTE] 					= base_url('actions/vote/image_' . $image[DB_IMAGES_COL_ID]);
			$gallery[$key]['isVoted']				= $this->Vote->check_vote($currentUser, $image[DB_IMAGES_COL_ID]);
			
		}

		$this->session->set_flashdata('TOTALPAGE', $totalPage);

		$data = array(
			         'currentPage' 	=> $currentPage,
			         'totalPage' 	=> $totalPage,
			         'gallery' 		=> $gallery);
		$data['checklogin'] = isset($this->session->userdata[SESSION_USER_ID]) ? 1 : 0;
		$data['isVotedLink'] = base_url('actions/max_vote.html');
		$data['startPage'] = $startPage;
		$data['endPage'] = $endPage;
		$data['dotPre'] = $dotdotPre;
		$data['dotNext'] = $dotdotNext;
		$header = array(
					 'active'	=>	0,
					 'favicon'	=>	isset($p_arr[FILE_FAVICON]) ? $p_arr[FILE_FAVICON] : "",
					 'logo'		=>	isset($p_arr[FILE_LOGO]) ? $p_arr[FILE_LOGO] : ""
					 );
		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/gallery', $data);
		$this->load->view('layouts/footer');
	}

	public function detail($id = null)
	{
		if($id == null)
		{
			redirect(base_url());
		}		

		$image = $this->Images->get_image_by_id($id);
		$comments = array();
		$this->load->library('common');
		$p_arr 	= $this->common->readfileconfig();
		if(!empty($image))
		{
			$this->load->model('Users');
			$this->load->model('Comments');
			$this->load->model('Vote');
			$image[THUMB] 					= UPLOAD_FOLDER_THUMB . THUMB . $image[DB_IMAGES_COL_NAME];
			$image[DB_IMAGES_COL_NAME] 		= UPLOAD_FOLDER . $image[DB_IMAGES_COL_NAME];
			$image[DB_IMAGES_COL_AUTHOR] 	= $this->Users->get_user_by_id($image[DB_IMAGES_COL_AUTHOR]);
			$data 							= $this->Comments->get_comment_by_image($image[DB_IMAGES_COL_ID]);
			$is_more = false;
			$currentUser 		= $this->session->userdata(SESSION_USER_ID);
			$image['isVoted'] 	= $this->Vote->check_vote($currentUser, $id);
			foreach ($data as $key => $comment) {
				$comments[$key][DB_COMMENTS_COL_CONTENT] = $comment[DB_COMMENTS_COL_CONTENT];
				$comments[$key][DB_COMMENTS_COL_ID] 	 = $comment[DB_COMMENTS_COL_ID];
				$author 			= $this->Users->get_user_by_id($comment[DB_COMMENTS_COL_USER_ID]);
				$authorName 		= '';
				$authorAvatar 		= '';
				$is_author 			= false; //check if comment belong to current user
				if(!empty($author))
				{
					$authorName 	= $author[DB_USERS_COL_NAME];
					$authorAvatar 	= $author[DB_USERS_COL_AVATAR];
					if($comment[DB_COMMENTS_COL_USER_ID] == $currentUser)
					{
						$is_author 			= true;
						//$comments[DELETE] 	= base_url('actions/deletecomment_' . $comment[DB_IMAGES_COL_ID]);
					}
				}
				$comments[$key][AUTHOR] 	= $authorName;
				$comments[$key][AVATAR] 	= $authorAvatar;
				$comments[$key][IS_AUTHOR] 	= $is_author;
			}
			if(count($data) > 0)
			{
				$firstComment = end($data);
				$moreComment = $this->Comments->get_comment_by_image($id, false, 20, $firstComment[DB_COMMENTS_COL_ID]);
				$is_more = (count($moreComment) > 0)? true : false;
			}

			$image[LINK] 	= base_url('gallery/detail/image_' . $image[DB_IMAGES_COL_ID]);			
			$image[COMMENT] = $comments;
			$image[VOTE] 	= base_url('actions/vote/image_' . $image[DB_IMAGES_COL_ID]);

			$gallery 			= $this->Images->get_active_images(null, null);
			$currentImageIndex 	= null;
			foreach ($gallery as $key => $img) {
				$gallery[$key][THUMB] 					= UPLOAD_FOLDER_THUMB . THUMB . $img[DB_IMAGES_COL_NAME];
				$gallery[$key][DB_IMAGES_COL_NAME] 		= UPLOAD_FOLDER . $img[DB_IMAGES_COL_NAME];
				$gallery[$key][DB_IMAGES_COL_AUTHOR] 	= $this->Users->get_user_by_id($img[DB_IMAGES_COL_AUTHOR]);
				$gallery[$key][LINK] 					= base_url('gallery/detail/image_' . $img[DB_IMAGES_COL_ID]);
				if($img[DB_IMAGES_COL_ID] == $id)
				{
					$currentImageIndex = $key;
				} 
			}

			//get only 7 image before and after current image
			$startCut = ($currentImageIndex < 7)? 0 : $currentImageIndex - 7;
			$gallery = array_splice($gallery, $startCut, $currentImageIndex + 7);
			$preAndNext = $this->Images->get_next_and_pre($id);
			$around 	= array();
			if(isset($preAndNext['pre'])) $around['pre'] = 'gallery/detail/image_' . $preAndNext['pre'][DB_IMAGES_COL_ID];
			if(isset($preAndNext['next'])) $around['next'] = 'gallery/detail/image_' . $preAndNext['next'][DB_IMAGES_COL_ID];
			$data['image'] 		= $image;
			$data['others'] 	= $gallery;
			$data['around'] 	= $around;
			$data['checklogin'] = isset($this->session->userdata[SESSION_USER_ID]) ? 1 : 0;
			$data['last_id']	= (count($comments) > 0) ? $comments[0][DB_COMMENTS_COL_ID] : 0;
			$data['first_id']	= (count($comments) > 0) ? $comments[count($comments) - 1][DB_COMMENTS_COL_ID] : 0;
			$data['isMore']		= $is_more;
			$data['isVotedLink'] = base_url('actions/max_vote.html');
			$header = array(
					 'active'	=>	0,
					 'favicon'	=>	isset($p_arr[FILE_FAVICON]) == true ? $p_arr[FILE_FAVICON] : "",
					 'logo'		=>	isset($p_arr[FILE_LOGO]) == true ? $p_arr[FILE_LOGO] : ""
					 );
			$this->load->view('layouts/header', $header);
			$this->load->view('layouts/detail', $data);
			$this->load->view('layouts/footer');
		}
		else
			redirect(base_url('notfault'));		
	}

	public function login()
	{
		$this->load->view('layouts/login');
	}
}