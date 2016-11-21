<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}

// Autoload the required files
require_once( APPPATH . 'libraries/autoload.php' );

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;


class Facebook {
  var $ci;
  var $helper;
  var $session;

  public function __construct() {
    $this->ci =& get_instance();
    $previousData = $this->ci->session->flashdata('previousData');
    if($previousData != false)
    {
      $this->ci->session->set_flashdata('previousData', $previousData);
    }
    // Initialize the SDK
    $this->ci->load->library("common");
    $facebookConfig = $this->ci->common->readfileconfig();
    FacebookSession::setDefaultApplication( $facebookConfig[FILE_FACEBOOK_APP_ID], $facebookConfig[FILE_FACEBOOK_APP_SECRET]);

    $this->ci->load->helper('url');
    $this->helper = new FacebookRedirectLoginHelper(base_url('user/facebook_login'));

    if ( $this->ci->session->userdata('fb_token') ) {
      $this->session = new FacebookSession( $this->ci->session->userdata('fb_token') );

      // Validate the access_token to make sure it's still valid
      try {
        if ( ! $this->session->validate() ) {
          $this->session = null;
        }
      } catch ( Exception $e ) {
        // Catch any exceptions
        $this->session = null;
      }
    } else {
      // No session exists
      try {
        $this->session = $this->helper->getSessionFromRedirect();
      } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
      } catch( Exception $ex ) {
        // When validation fails or other local issues
      }
    }

    if ( $this->session ) {
      $this->ci->session->set_userdata( 'fb_token', $this->session->getToken() );

      $this->session = new FacebookSession( $this->session->getToken() );
    }
  }

  /**
   * Returns the login URL.
   */
  public function login_url() {
    return $this->helper->getLoginUrl(array('req_perms' => 'user_hometown,email,user_birthday,public_profile,publish_actions'));
  }

  /**
   * Returns the current user's info as an array.
   */
  public function get_user() {
    if ( $this->session ) {
      /**
       * Retrieve User’s Profile Information
       */
      // Graph API to request user data
      $request = ( new FacebookRequest( $this->session, 'GET', '/me' ) )->execute();

      // Get response as an array
      $user = $request->getGraphObject();

      return $user;
    }
    return false;
  }

  public function get_logout_url($next)
  {
    $this->session = new FacebookSession( $this->ci->session->userdata('fb_token'));
    return $this->helper->getLogoutUrl($this->session, $next);
  }
  public function post_to_wall($link, $image)
  {
	$this->session = new FacebookSession( $this->ci->session->userdata('fb_token'));
    if($this->session) {

      try {

        $response = (new FacebookRequest(
          $this->session, 'POST', '/me/feed', array(
            'link' => $link,
            'message' => 'I joined i-photos contest. Let\'s join from the campaign site.',
            'picture' => $image
          )
        ))->execute()->getGraphObject();

        return 'success';

      } catch(FacebookRequestException $e) {

        return 'error: ' . $e->getMessage();

      }   

    }
	else
{
return 'no session';
}
  }
}