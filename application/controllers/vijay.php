<?php
/* This pase was created by Vijay at "2014 07 22 13-31-45". */
/*  */

class Vijay extends CI_Controller{
	public function __construct(){
		parent::__construct();
		global $baseURL; 
		$baseURL = getcwd();
		// File requires to check logged in user information.
		require_once("$baseURL/application/third_party/user_cake/models/class.user.php");
		
		// Basic helper and libraries
		$this->load->helper();
		$this->load->library("session");
	}
	public function index(){
		global $baseURL; 
		// Require config file
		require_once("$baseURL/application/third_party/user_cake/models/config.php");
		
		// Write your code after this line
		
		
		
		// Code ends here
		
		// index function
		$this->load->view("vijay");
	} 
	}
?>