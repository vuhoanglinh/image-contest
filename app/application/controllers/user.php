<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* ---------------------------------------------------------------------------
* Login controler
* ---------------------------------------------------------------------------
* User login by facebook account
* ---------------------------------------------------------------------------
* 
* @author Creater: Ho Quoc Nghi <nghi_hq@vietvang.net>
* @author Updater: Ho Quoc Nghi <nghi_hq@vietvang.net>
* @copyright 2015 Viet Vang JSC
*/

class User extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Users');
		$this->load->library('facebook');	
	}

	/**
	* Create facebook login url
	*/
	public function index()
	{
		$loginUrl = '/user/facebook_login';
		$data = array(
			          'loginUrl' => $loginUrl
			          );
		$this->load->view('layouts/login', $data);
	}

	/**
	* Login by facebook
	*/
	public function facebook_login()
	{
		$previousData = $this->session->flashdata('previousData');
		if($previousData != false)
		{
		  $this->session->set_flashdata('previousData', $previousData);
		}

		$graphObject = $this->facebook->get_user();
			
		if($graphObject)
		{
		    $fbid = $graphObject->getProperty('id');              // To Get Facebook ID		 	    
			    //check if user exist
		    $user = $this->Users->get_user_by_id($fbid, IS_FACEBOOK_USER);
			if(empty($user)) // user not register
			{
				$gender = $graphObject->getProperty('gender');
				$isGender = USER_GENDER_OTHER;
				if($gender == 'male')
				{
					$isGender = USER_GENDER_MALE;			    		
				}
				elseif($gender == 'femail')
				{
					$isGender = USER_GENDER_FEMALE;
				}
				$hometown = '';
				if($graphObject->getProperty('hometown') !== null)
				{
					$hometown = $graphObject->getProperty('hometown')->getProperty('name');
				}

				$arr_user = array(
					DB_USERS_COL_KIND => IS_FACEBOOK_USER,
					DB_USERS_COL_APPID => $fbid,
					DB_USERS_COL_NAME => $graphObject->getProperty('name'),
					DB_USERS_COL_EMAIL => $graphObject->getProperty('email'),
					DB_USERS_COL_ADDRESS => $hometown,
					DB_USERS_COL_BIRTH_DATE =>$graphObject->getProperty('birthday'),
					DB_USERS_COL_GENDER => $isGender,
					DB_USERS_COL_AVATAR => 'https://graph.facebook.com/'.$fbid.'/picture'
					);
				
				$newId = $this->Users->add_user($arr_user);
				if($newId)
				{
			    		//Set session
					$this->session->set_userdata(array(
						SESSION_USER_ID => $newId,
						SESSION_USER_NAME => $arr_user[DB_USERS_COL_NAME],
						SESSION_USER_AVATAR => $arr_user[DB_USERS_COL_AVATAR],
						DB_USERS_COL_KIND => IS_FACEBOOK_USER));
					redirect(base_url());
				}
				else
				{
			    	redirect(base_url());
			    }
			}
			else //user is exist
			{
				if($user[DB_USERS_COL_IS_BAN] == USER_BANNED)
				{
					$this->session->unset_userdata(array('fb_token' => ''));
					return redirect(base_url('user/suspended'));
				}
				$this->session->set_userdata(array(
					SESSION_USER_ID => $user[DB_USERS_COL_ID],
					SESSION_USER_NAME => $user[DB_USERS_COL_NAME],
					SESSION_USER_AVATAR => $user[DB_USERS_COL_AVATAR],
					DB_USERS_COL_KIND => IS_FACEBOOK_USER));
				return redirect(base_url());
			}
		}
		else {
			$loginUrl = $this->facebook->login_url();
			header("Location: ".$loginUrl);
		}
	}

	public function facebook_logout()
	{
		self::clear_cookie();

		redirect(base_url());
	}

	private function clear_cookie()
	{
		if($this->session->userdata(SESSION_USER_ID))
		{
			$this->session->unset_userdata(array(SESSION_USER_ID => '',
			                                     DB_USERS_COL_KIND => '',
			                                     SESSION_USER_NAME => '',
			                                     SESSION_USER_AVATAR => '',
			                                     'fb_token' => ''));
		}
	}
}