<?php
class Logout extends CI_Controller{
public function __construct(){
		parent::__construct();
		$baseURL = getcwd();
		require_once("$baseURL/application/third_party/user_cake/models/class.user.php");
		$this->load->helper();
		$this->load->library('session');
	}
	public function index(){
		/*
UserCake (Via CupCake) Version: 2.0.2
http://usercake.com
*/
global $loggedInUser;
$baseURL = getcwd();
require_once("$baseURL/application/third_party/user_cake/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Log the user out

if(isUserLoggedIn())
{
	$loggedInUser->userLogOut($this);
}
$s_u = site_url();
if(!empty($s_u)) 
{
	$add_http = "";
	
	if(strpos(site_url(),"http://") === false)
	{
		$add_http = "http://";
	}
	
	header("Location: ".$add_http.str_replace('.php', '', site_url()));
	die();
}
else
{
	header("Location: http://".$_SERVER['HTTP_HOST']);
	die();
}	

	}
}
?>