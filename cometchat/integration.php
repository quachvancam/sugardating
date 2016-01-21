<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('SET_SESSION_NAME','');			// Session name
define('DO_NOT_START_SESSION','0');		// Set to 1 if you have already started the session
define('DO_NOT_DESTROY_SESSION','0');	// Set to 1 if you do not want to destroy session on logout
define('SWITCH_ENABLED','0');		
define('INCLUDE_JQUERY','1');	
define('FORCE_MAGIC_QUOTES','0');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */

define('BASEPATH',true);
if (!file_exists(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'database.php')) {
	echo "Please check if cometchat is installed in the correct directory.<br /> The 'cometchat' folder should be placed at <CODEEGNITER_HOME_DIRECTORY>/cometchat";
	exit;
}
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'database.php');

// DO NOT EDIT DATABASE VALUES BELOW

define('DB_SERVER',					$db['default']['hostname']				 );
define('DB_PORT',					$db['port']								 );
define('DB_USERNAME',				$db['default']['username']				 );
define('DB_PASSWORD',				$db['default']['password']				 );
define('DB_NAME',					$db['default']['database'] 				 );
define('TABLE_PREFIX',				""										 );
define('DB_USERTABLE',				"user"								     );
define('DB_USERTABLE_USERID',		"id"								     );
define('DB_USERTABLE_NAME',			"name"								 );
define('DB_AVATARTABLE',		    " "                                      );
define('DB_AVATARFIELD',		    "user.avatar" );
define('DB_USERTABLE_LASTACTIVITY',	"last_login"							 );

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */

function getUserID() {
	$userid = 0;
	if (!empty($_SESSION['basedata']) && $_SESSION['basedata'] != 'null') {
		$_REQUEST['basedata'] = $_SESSION['basedata'];
	}

	if (!empty($_REQUEST['basedata'])) {
	
		if (function_exists('mcrypt_encrypt')) {
			$key = KEY_A.KEY_B.KEY_C;
			$uid = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($_REQUEST['basedata']), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
			if (intval($uid) > 0) {
				$userid = $uid;
			}
		} else {
			$userid = $_REQUEST['basedata'];
		}
	}

	if (!empty($_COOKIE['ci_session'])) {
		$uid = unserialize($_COOKIE['ci_session']);
		if (!empty($uid['userid'])) {
			$userid = $uid['userid'];
		}
	}
	
	$userid = intval($userid);	
	return $userid;
}

function chatLogin($userName,$userPass) {
	$userid = 0;
	if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
		$sql = ("SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE Email ='".$userName."' AND member = '2'"); 
	} else {
		$sql = ("SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE username ='".$userName."' AND member = '2'"); 		
	}
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row['password'] == md5($userPass)) {
		$userid = $row['id'];
	}
	if ($userid && function_exists('mcrypt_encrypt')) {
		$key = KEY_A.KEY_B.KEY_C;
		$userid = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $userid, MCRYPT_MODE_CBC, md5(md5($key))));
	}

    return $userid;
}	 

function getFriendsList($userid,$time) {
	$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, 
    ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity, ".DB_AVATARFIELD." avatar, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link, cometchat_status.message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ('".mysql_real_escape_string($time)."'-".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." < '".((ONLINE_TIMEOUT)*2)."') and ".TABLE_PREFIX.DB_USERTABLE.".member = '2' and (cometchat_status.status IS NULL OR cometchat_status.status <> 'invisible' OR cometchat_status.status <> 'offline') order by username asc");
	return $sql;
}

/*
function getFriendsList($userid,$time) {
    $sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, 
    ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity, ".DB_AVATARFIELD." avatar, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link, cometchat_status.message, cometchat_status.status from ".TABLE_PREFIX."friends join ".TABLE_PREFIX.DB_USERTABLE." on  ".TABLE_PREFIX."friends.to_id = ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX."friends.from_id = '".mysql_real_escape_string($userid)."' order by username asc");
    return $sql;
}
*/
function getFriendsIds($userid) {
	$sql = ("select group_concat(friends.fid) myfrndids from (select ".TABLE_PREFIX."friends.friend_user_id fid from ".TABLE_PREFIX."friends where ".TABLE_PREFIX."friends.initiator_user_id = '".mysql_real_escape_string($userid)."' and is_confirmed = 1 union select ".TABLE_PREFIX."friends.initiator_user_id fid from ".TABLE_PREFIX."friends where ".TABLE_PREFIX."friends.friend_user_id = '".mysql_real_escape_string($userid)."' and is_confirmed = 1) friends");
 
	return $sql;
}

function getUserDetails($userid) {
	$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity,  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link,  ".DB_AVATARFIELD." avatar, cometchat_status.message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'"); 
	return $sql;
}

function updateLastActivity($userid) {
	$sql = ("update `".TABLE_PREFIX.DB_USERTABLE."` set ".DB_USERTABLE_LASTACTIVITY." = '".getTimeStamp()."' where ".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
	return $sql;
}

function getUserStatus($userid) {
	 $sql = ("select cometchat_status.message, cometchat_status.status from cometchat_status where userid = '".mysql_real_escape_string($userid)."'");
	 return $sql;
}

function fetchLink($link) {
    return '';
}

function getAvatar($image) { 
    if (is_file(dirname(dirname(__FILE__)).'/upload/user/'.$image)) {
        return 'http://'.$_SERVER['HTTP_HOST'].'/breedlove/upload/user/'.$image;
    } else {
        return 'http://'.$_SERVER['HTTP_HOST'].'/breedlove/upload/user/hideavatar.jpg';
    }
}

function getTimeStamp() {
	return time();
}

function processTime($time) {
	return $time;
}

if (!function_exists('getLink')) {
  	function getLink($userid) {
		return fetchLink($userid);
	}
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* HOOKS */

function hooks_statusupdate($userid,$statusmessage) {
	
}

function hooks_forcefriends() {

}

function hooks_activityupdate($userid,$status) {

}

function hooks_message($userid,$to,$unsanitizedmessage) {

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */

include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'license.php');
$x="\x62a\x73\x656\x34\x5fd\x65c\157\144\x65";
eval($x('JHI9ZXhwbG9kZSgnLScsJGxpY2Vuc2VrZXkpOyRwXz0wO2lmKCFlbXB0eSgkclsyXSkpJHBfPWludHZhbChwcmVnX3JlcGxhY2UoIi9bXjAtOV0vIiwnJywkclsyXSkpOw'));

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
