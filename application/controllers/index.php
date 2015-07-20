<?php
class Index extends CI_Controller{
public function __construct(){
		parent::__construct();
		global $baseURL;
		$baseURL = getcwd();
		if(!file_exists("$baseURL/application/build/data/build.properties") || !file_exists("$baseURL/application/build/data/buildtime-conf.xml") || !file_exists("$baseURL/application/build/data/runtime-conf.xml")){
	header("Location : ".str_replace("index.php", "", site_url())."installer.php");
}

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
$this->load->view('index');

}
}

?>