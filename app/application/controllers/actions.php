<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* ---------------------------------------------------------------------------
* Actions controller
* ---------------------------------------------------------------------------
* Processing common actions like voting, commenting
* ---------------------------------------------------------------------------
* 
* @author Creater: Ho Quoc Nghi <nghi_hq@vietvang.net>
* @author Updater: Ho Quoc Nghi <nghi_hq@vietvang.net>
* @copyright 2015 Viet Vang JSC
*/

class Actions extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Images');		
	}
	
	public function vote($p_imageId)
	{
		if(isset($p_imageId))
		{
			$userId = $this->session->userdata(SESSION_USER_ID);
			$imgData = $this->Images->get_image_by_id($p_imageId);

			$imageLink = ''; //set default as logo
			if(!empty($imgData))
			{
				$imageLink = UPLOAD_FOLDER . $imgData[DB_IMAGES_COL_NAME];
			}

			if(!$userId) //user is not login
			{
				/*
				$previousData = array(
								'type' => 'vote',
								'image' => $p_imageId
								);
				$this->session->set_flashdata('previousData', $previousData);
				redirect(base_url('user/facebook_login'));
				*/
				echo 'not login';
				return 'fail';
			}
			else
			{
				//post to user wall
				$this->load->library('facebook');
				$result = $this->facebook->post_to_wall(base_url('gallery/detail/image_' . $p_imageId), base_url($imageLink));
				
				$this->load->model('Vote');
				if($this->Vote->update_vote($userId, $p_imageId) == 0)
				{
					echo 'success';
					return 'success';
				}
				else
				{
					echo 'vote fail';
					return 'fail';
				}				
			}
		}
		else
		{
			echo 'no image id';
		}
	}
	
	public function max_vote()
	{
		$this->load->view('layouts/max_vote');
	}

	public function comment()
	{
		$p_imageId 	 = $this->input->post('currentId');

		if(isset($p_imageId))
		{
			$content = $this->input->post('comment');

			if($content != "")
			{
				$p_userId = $this->session->userdata(SESSION_USER_ID);
				if(isset($p_userId))
				{
					if(isset($p_imageId) && isset($content))
					{
						$arr_comment = array(
									DB_COMMENTS_COL_IMAGE_ID  => $p_imageId,
									DB_COMMENTS_COL_USER_ID   => $p_userId,
									DB_COMMENTS_COL_CONTENT   => $content
									);
						$this->load->model('Comments');
						$this->Comments->add_comment($arr_comment);

						$lastComment = $this->input->post('lastId');
						$data = $this->Comments->get_comment_by_image($p_imageId, $lastComment);
						$newComment = array();
						$this->load->model('Users');
						foreach ($data as $key => $comment)
						{
							$author 		= $this->Users->get_user_by_id($comment[DB_COMMENTS_COL_USER_ID]);
							$authorName 	= '';
							$authorAvatar 	= '';
							if(!empty($author))
							{
								$authorName 	= $author[DB_USERS_COL_NAME];
								$authorAvatar 	= $author[DB_USERS_COL_AVATAR];
							}
							$newComment['comments'][$key] = array(
												DB_COMMENTS_COL_ID  	=> $comment[DB_COMMENTS_COL_ID],
												DB_COMMENTS_COL_CONTENT => $comment[DB_COMMENTS_COL_CONTENT],
												AUTHOR 					=> $authorName,
												AVATAR 					=> $authorAvatar
												);
							if($comment[DB_COMMENTS_COL_USER_ID] == $p_userId)
							{
								$newComment['comments'][$key][IS_AUTHOR] = true;
								//$newComment[$key]['delete'] = base_url('actions/deletecomment_' . $comment[DB_IMAGES_COL_ID]);
							}
						}
						$newComment['last_id'] = (count($data) > 0) ? $data[0][DB_COMMENTS_COL_ID] : 0;
						$endComment = end($data);
		
						$first_id = 0;
						if(isset($endComment) AND is_array($endComment))
						{
							$first_id = $endComment[DB_COMMENTS_COL_ID];
						}
						$newComment['first_id'] = $first_id;
						$moreComment = $this->Comments->get_comment_by_image($p_imageId, false, 20, $first_id);
						$newComment['more'] = (count($moreComment) > 0)? 1 : 0;
						echo json_encode($newComment);
					}
				}
				else
				{
					/*
					$previousData = array(
										'type' => 'comment',
										'image' => $p_imageId,
										'content' => $content,
										'lastId' => $lastComment
										);
					$this->session->set_flashdata('previousData', $previousData);
					redirect(base_url('user/facebook_login'));
					*/
					echo json_encode(array('error' => '1'));
				}
			}
			else // redirect to current page
			{
				echo json_encode(array('error' => '2'));
			}
		}
		else // redirect to homepage if image id not exist
		{
			echo json_encode(array('error' => '3'));
		}
	}

	public function delete_comment()
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

	public function delete()
	{
		$id 		= 	$this->input->post('id');
		$p_image 	=	$this->Images->get_image_by_id($id);
		if(count($p_image) > 0)
		{
			if($this->Images->delete_image($id) === true)
			{
				echo "1";
				if(file_exists(UPLOAD_FOLDER.$p_image[DB_IMAGES_COL_NAME]))
				{
					unlink(UPLOAD_FOLDER.$p_image[DB_IMAGES_COL_NAME]);
				}
				if(file_exists(UPLOAD_FOLDER_THUMB.THUMB.$p_image[DB_IMAGES_COL_NAME]))
				{
					unlink(UPLOAD_FOLDER_THUMB.THUMB.$p_image[DB_IMAGES_COL_NAME]);
				}
				
			}
			else
			{
				echo "0";
			}
		}				
		else
		{
			echo "0";
		}
	}

	public function get_more_comment()
	{
		$p_imageId 	 = $this->input->post('currentId');
		$lastComment = $this->input->post('firstId');
		$this->load->model('Comments');
		$p_userId = $this->session->userdata(SESSION_USER_ID);
		$data = $this->Comments->get_comment_by_image($p_imageId, false, 20, $lastComment);
		$newComment = array();
		$this->load->model('Users');
		$newComment['comments'] = array();
		foreach ($data as $key => $comment)
		{
			$author 		= $this->Users->get_user_by_id($comment[DB_COMMENTS_COL_USER_ID]);
			$authorName 	= '';
			$authorAvatar 	= '';
			if(!empty($author))
			{
				$authorName 	= $author[DB_USERS_COL_NAME];
				$authorAvatar 	= $author[DB_USERS_COL_AVATAR];
			}
			$newComment['comments'][$key] = array(
				DB_COMMENTS_COL_ID  	=> $comment[DB_COMMENTS_COL_ID],
				DB_COMMENTS_COL_CONTENT => $comment[DB_COMMENTS_COL_CONTENT],
				AUTHOR 					=> $authorName,
				AVATAR 					=> $authorAvatar
				);
			if($comment[DB_COMMENTS_COL_USER_ID] == $p_userId)
			{
				$newComment['comments'][$key][IS_AUTHOR] = true;
								//$newComment[$key]['delete'] = base_url('actions/deletecomment_' . $comment[DB_IMAGES_COL_ID]);
			}
		}
		$endComment = end($data);
		
		$first_id = 0;
		if(isset($endComment) AND is_array($endComment))
		{
			$first_id = $endComment[DB_COMMENTS_COL_ID];
		}
		$newComment['first_id'] = $first_id;
		$moreComment = $this->Comments->get_comment_by_image($p_imageId, false, 20, $first_id);
		$newComment['more'] = (count($moreComment) > 0)? true : false;
		echo json_encode($newComment);
	}
}