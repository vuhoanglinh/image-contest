<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "gallery/index";
$route['404_override'] 	= '/';
$route['500_override'] 	= 'pageerrors/error';
/*
| ------------------------------------------------------------------------------------------
| Custom router admin page
| ------------------------------------------------------------------------------------------
*/

/*
| --------------------------------
| Custom router view (get)
| --------------------------------
*/
$route['admin/login'] 								= 		'admin/index/login';
$route['admin'] 									= 		'admin/index/index';
$route['admin/logout'] 								= 		'admin/index/logout';
$route['admin/setting']								=		'admin/setting/index';
$route['admin/images']								=		'admin/images_list/index';
$route['admin/contestants']							=		'admin/contestant/index';
$route['admin/contestants/profile/(:any)']			=		'admin/contestant/profile/$1';
$route['admin/profile']								=		'admin/profile/index';
$route['admin/comments/(:any)']						=		'admin/comment/index/$1';

/*
| --------------------------------
| Custom router action (post)
| --------------------------------
*/
$route['admin/logined'] 			= 		'admin/index_post_login/login';
$route['admin/setting/save']		=		'admin/setting_post/save';
$route['admin/images/status']		=		'admin/images_list/update_images_status';
$route['admin/contestants/status']	=		'admin/contestant/update_contestant_status';
$route['admin/profile/save']		=		'admin/profile/edit_account';
/*
| ------------------------------------------------------------------------------------------
| Custom router admin page
| ------------------------------------------------------------------------------------------
*/

/*
| ------------------------------------------------------------------------------------------
| Custom router front end page
| ------------------------------------------------------------------------------------------
*/
$route['login']						=		'gallery/login';
$route['login/login_popup']			=		'gallery/login';
$route['plans'] 					=		'plans/index';
$route['howtouse']					=		'plans/howtouse';
$route['upload']					=		'upload/index';

/*
| ------------------------------------------------------------------------------------------
| Gallery page
| ------------------------------------------------------------------------------------------
*/
$route['gallery/([a-zA-Z]+_)(\d+)'] = 		'gallery/index/$2';
$route['gallery/detail/([a-zA-Z]+_)(\d+)'] = 'gallery/detail/$2';

/*
| ------------------------------------------------------------------------------------------
| Action: vote and post comment
| Action: delete
| ------------------------------------------------------------------------------------------
*/
$route['actions/vote/([a-zA-Z]+_)(\d+)'] 	= 'actions/vote/$2';
$route['actions/max_vote']					= 'actions/max_vote';
$route['actions/comment'] 					= 'actions/comment';
//delete comment
$route['actions/delete_comment'] 			= 'actions/delete_comment';
//delete image
$route['delete'] 							= 'actions/delete';
//get more comment
$route['actions/more_comment']				= 'actions/get_more_comment';
/*

/*
| ------------------------------------------------------------------------------------------
| Facebook login
| ------------------------------------------------------------------------------------------
*/
$route['user/facebook_login'] = 'user/facebook_login';
$route['user/facebook_login?(:any)'] = 'user/facebook_login';
$route['admin/load_hashtag'] 	=	'admin/setting/load_hashtag';

$route['user/logout'] = 'user/facebook_logout';

$route['user/suspended'] = 'pageerrors/banned';
/*
| ------------------------------------------------------------------------------------------
| Custom router front end page
| ------------------------------------------------------------------------------------------
*/
$route['upload/do_upload']	=	"upload/do_upload";
/*
| ------------------------------------------------------------------------------------------
| Custom router not found page
| ------------------------------------------------------------------------------------------
*/
$route['error'] = 'pageerrors/error';
$route['(:any)'] = "pageerrors/index/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */