<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|------------------------------------------------------------------------
| Database construct
|------------------------------------------------------------------------
|
| Database fields and columns name
|
*/
//Table users
define('DB_TAB_USERS', 'users');
define('DB_USERS_COL_ID', 'id');
//define('DB_USERS_COL_PASSWORD', 'Password');
define('DB_USERS_COL_KIND', 'UserKind');
define('DB_USERS_COL_APPID', 'UserAppId');
define('DB_USERS_COL_NAME', 'UserName');
define('DB_USERS_COL_PHONE', 'UserPhone');
define('DB_USERS_COL_EMAIL', 'UserEmail');
define('DB_USERS_COL_ACCOUNT_NAME', 'UserAppUserName');
define('DB_USERS_COL_ADDRESS', 'UserAddress');
define('DB_USERS_COL_ID_CARD', 'UserIDCard');
define('DB_USERS_COL_BIRTH_DATE', 'UserBirthDate');
define('DB_USERS_COL_GENDER', 'UserGender');
define('DB_USERS_COL_AVATAR', 'UserAvatar');
define('DB_USERS_COL_IS_BAN', 'UserIsBan');
define('DB_USERS_COL_CREATED_DATE', 'UserCreatedDate');
define('DB_USERS_COL_UPDATED_DATE', 'UserUpdatedDate');
//define some default value
define('USER_BANNED', 0);
define('USER_NOT_BANNED', 1);
define('USER_GENDER_MALE', 1);
define('USER_GENDER_FEMALE', 2);
define('USER_GENDER_OTHER', 0);
define('IS_FACEBOOK_USER', 8);
define('IS_INSTAGRAM_USER', 1);
define('IS_TWITTER_USER', 2);
define('IS_DEFAULT_USER', -1);

//Session key
define('SESSION_USER_ID', 'ses_id');
define('SESSION_USER_NAME', 'ses_username');
define('SESSION_USER_AVATAR', 'ses_avatar');

//Table images
define('DB_TAB_IMAGES', 'images');
define('DB_IMAGES_COL_ID', 'id');
define('DB_IMAGES_COL_NAME', 'ImageName');
define('DB_IMAGES_COL_TITLE', 'ImageTitle');
define('DB_IMAGES_COL_DESCRIPTION', 'ImageDescription');
define('DB_IMAGES_COL_IS_HIDDEN', 'ImageIsHidden');
define('DB_IMAGES_COL_LIKES', 'ImageLikes');
define('DB_IMAGES_COL_SHARES', 'ImageShares');
define('DB_IMAGES_COL_COMMENTS', 'ImageComments');
define('DB_IMAGES_COL_CREATED_DATE', 'ImageCreatedDate');
define('DB_IMAGES_COL_UPDATED_DATE', 'ImageUpdatedDate');
define('DB_IMAGES_COL_AUTHOR', 'ImageAuthor');
define('DB_IMAGES_COL_ORIGIN', 'ImageOrigin');
define('DB_IMAGES_COL_APPID', 'ImageAppId');

//define some default value
define('IMAGE_HIDDEN', 1);
define('IMAGE_NOT_HIDDEN', 0);
define('IMG_FROM_USER_UPLOAD', 0);
define('IMG_FROM_INSTAGRAM', 1);
define('IMG_FROM_TWITTER', 2);

define('DB_TAB_COMMENTS', 'comments');
define('DB_COMMENTS_COL_ID', 'id');
define('DB_COMMENTS_COL_IMAGE_ID', 'CommentImageID');
define('DB_COMMENTS_COL_USER_ID', 'CommentUserID');
define('DB_COMMENTS_COL_PARENT_ID', 'CommentParentID');
define('DB_COMMENTS_COL_CONTENT', 'CommentContent');
define('DB_COMMENTS_COL_LIKES', 'CommentLikes');
define('DB_COMMENTS_COL_SHARES', 'CommentShares');
define('DB_COMMENTS_COL_IS_HIDDEN', 'CommentIsHidden');
define('DB_COMMENTS_COL_CREATED_DATE', 'CommentCreatedDate');
define('DB_COMMENTS_COL_UPDATED_DATE', 'CommentUpdatedDate');
//define some default value
define('COMMENT_HIDDEN', 1);
define('COMMENT_NOT_HIDDEN', 0);

//Table manager
define('DB_TAB_MANAGER', 'manager');
define('DB_MANAGER_COL_ID', 'id');
define('DB_MANAGER_COL_ACCOUNT_NAME', 'ManagerAccountName');
define('DB_MANAGER_COL_PASSWORD', 'ManagerPassword');
define('DB_MANAGER_COL_NAME', 'ManagerName');
define('DB_MANAGER_COL_EMAIL', 'ManagerEmail');
define('DB_MANAGER_COL_ADDRESS', 'ManagerAddress');
define('DB_MANAGER_COL_PHONE', 'ManagerPhone');

//Table vote
define('DB_TAB_VOTES', 'votes');
define('DB_VOTES_COL_IMAGE_ID', 'VoteImageId');
define('DB_VOTES_COL_USER_ID', 'VoteUserId');

//default number get top like or share
define('DEFAULT_GET_TOP', 10);

//define some constant for comment-tree
define('DEEP', 0);
define('CHILDREN', 1);

define('LINK', 'link');
define('COMMENT', 'comment');
define('VOTE', 'vote');
define('AVATAR', 'avatar');
define('DELETE', 'delete');
define('AUTHOR', 'author');
define('IS_AUTHOR', 'is_author');
define('LAST_ID', 'lastid');


//define path config file
define("FILE_CONFIG_PATH", "app/config.txt");

//define array config file
define("FILE_HASHTAG_INSTAGRAM", "hashtag_itg");
define("FILE_HASHTAG_TWITTER", "hashtag_tw");
define("FILE_LOGO", "logo");
define("FILE_FAVICON", "favicon");
define("FILE_IMAGE_MAX_WIDTH", "image_max_width");
define("FILE_IMAGE_MAX_HEIGHT", "image_max_height");
define("FILE_IMAGE_MIN_WIDTH", "image_min_width");
define("FILE_IMAGE_MIN_HEIGHT", "image_min_height");
define("FILE_IMAGE_EXTENTION", "image_extention");
define("FILE_IMAGE_SIZE", "image_size");
define("FILE_BEGIN_DATE", "begin_date");
define("FILE_FINISH_DATE", "finish_date");
define("FILE_FACEBOOK_APP_ID", "facebook_app_id");
define("FILE_FACEBOOK_APP_SECRET", "facebook_app_secret");
define("FILE_INSTAGRAM_API_ID", "instagram_api_id");
define("FILE_INSTAGRAM_API_SECRET", "instagram_api_secret");
define("FILE_TWITTER_CONSUMER_KEY", "twitter_consumer_key");
define("FILE_TWITTER_COMSUMER_SECRET", "twitter_consumer_secret");
define("FILE_IMAGE_UPLOAD", "image_upload_max");
define("FILE_IMAGE_SHOW_NUMBER", "image_show_number");
define("FILE_IMAGE_CHECK_UPLOAD", "image_upload_check");

//define extention col
define("NO", "no");
define("PHOTO", "photo");

//define session login
define("ACCOUNT", "account");
//end of thumbnail image
define("THUMB", "thumb_");

//thumb width
define("THUMB_WIDTH", 250);

/*
* ---------------------------------------------------------------------
* Define upload image. All image will be uploaded here
* ---------------------------------------------------------------------
*/
define('UPLOAD_FOLDER', 'styles/upload/');
//Upload foler. All images will be uploaded here
define("UPLOAD_FOLDER_THUMB", "styles/upload/thumbnail/");

//Number of image in each gallery page
define("IMAGE_EACH_PAGE", 12);

//javascript file extexsion
define("JAVASCRIPT", "js");
//CSS file extexsion
define("CSS", "css");

// Define Ajax Request
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

// folder stograge css and js
define('FOLDER_ADMIN', 'styles');
define('FOLDER_ADMIN_IMG', 'styles/images');
define('FOLDER_ADMIN_CSS', 'styles/css');
define('FOLDER_ADMIN_JS', 'styles/js');
define('FOLDER_ADMIN_VENDOR', 'styles/vendor');
/* End of file constants.php */
/* Location: ./application/config/constants.php */