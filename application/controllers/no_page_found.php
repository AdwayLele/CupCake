<?php
class No_Page_Found extends CI_Controller{
public function __construct(){
		parent::__construct();
		$this->load->helper();
		$this->load->library('session');
	}
	public function index(){
	echo ("<h2>You don't have access to this web page.</h2><br/><h3>Redirecting...</h3>");
	header("refresh:3; url = ".str_replace('index.php/', '', site_url('account')));
	}
}
?>