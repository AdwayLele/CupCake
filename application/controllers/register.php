<?php
class Register extends CI_Controller{
public function __construct(){
		parent::__construct();
		global $baseURL;
		$baseURL = getcwd();
		require_once("$baseURL/application/third_party/user_cake/models/class.user.php");
		$this->load->helper();
		$this->load->library('session');
		$this->load->helper('captcha');
	}
	public function index(){
	/*
UserCake (Via CupCake) Version: 2.0.2
http://usercake.com
*/
global $baseURL;

require_once("$baseURL/application/third_party/user_cake/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: ".str_replace('index.php/', '', site_url('account'))); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$displayname = trim($_POST["displayname"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
	$captcha = md5($_POST["captcha"]);
	
	
	if (strtolower($captcha) != strtolower($this->session->userdata('security_code')))
	{
		$errors[] = lang("CAPTCHA_FAIL");
	}else{
		$this->session->unset_userdata('security_code');
	}
	if(minMaxRange(5,25,$username))
	{
		$errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($username)){
		$errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
	}
	if(minMaxRange(5,25,$displayname))
	{
		$errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($displayname)){
		$errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
	}
	if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass))
	{
		$errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
	}
	else if($password != $confirm_pass)
	{
		$errors[] = lang("ACCOUNT_PASS_MISMATCH");
	}
	if(!isValidEmail($email))
	{
		$errors[] = lang("ACCOUNT_INVALID_EMAIL");
	}
	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a user object
		$user = new User($username,$displayname,$password,$email);
		
		//Checking this flag tells us whether there were any errors such as possible data duplication occured
		if(!$user->status)
		{
			if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
			if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
		}
		else
		{
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$user->userCakeAddUser())
			{
				if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
			}
		}
	}
	if(count($errors) == 0) {
		$successes[] = $user->success;
	}
}
$vals = array(
    'img_path'	 => './captcha/',
    'img_url'	 => str_replace("index.php", "", site_url()).'/captcha/',
    // 'font_path'	 => './path/to/fonts/texb.ttf',
    'img_width'	 => '150',
    'img_height' => 30,
    'expiration' => 7200
    );

$cap = create_captcha($vals);
$this->session->set_userdata("security_code", md5($cap['word']));
$this->load->view('register', array("cap" => $cap));

	}
}	
?>