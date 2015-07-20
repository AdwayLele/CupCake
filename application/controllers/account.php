<?php
class Account extends CI_Controller{
public function __construct(){
		global $baseURL;
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
global $baseURL;

require_once("$baseURL/application/third_party/user_cake/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$this->load->view('account');
	}
}
?>