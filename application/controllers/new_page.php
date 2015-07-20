<?php
class New_Page extends CI_Controller{
public function __construct(){
		parent::__construct();
		global $baseURL; 
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
	global $baseURL, $loggedInUser, $errors, $success; 
require_once("$baseURL/application/third_party/user_cake/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}


//Forms posted
if(!empty($_POST)){
	$pageName = $_POST['pageName'];
	$pageNameWithoutExt = str_replace(".php", "", $pageName);
	$defaultPages = fetchAllPages();
	$pageCheck = false;
	foreach($defaultPages as $indPage){
		if($indPage['page'] == $pageNameWithoutExt){
			$pageCheck = true;
		}
	}
	if(preg_match('/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/', $pageNameWithoutExt) && !$pageCheck){	
	$comment = $_POST['pageComment'];
	
	$nameWords = explode("_", $pageNameWithoutExt);
	$className = '';
	if(sizeof($nameWords)){
		for($i = 0; $i < sizeof($nameWords); $i++){
			$sep = $i ? "_" : "";
			$className .= $sep.ucfirst($nameWords[$i]) ;
		}
	}else{
		$className = ucfirst($pageNameWithoutExt);
	}
	$file = fopen("$baseURL/application/controllers/$pageName.php", "w");
	fwrite($file,'<?php
/* This pase was created by '.$loggedInUser->displayname.' at "'.date("Y m d H-i-s").'". */
/* '.$comment.' */

class '.$className.' extends CI_Controller{
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
		$this->load->view("'.$pageName.'");
	} 
	}
?>');
	fclose($file);
	$file = fopen("$baseURL/application/views/$pageName.php", "w");
	fwrite($file,'<?php
global $baseURL;
require_once("$baseURL/application/third_party/user_cake/models/header.php");
?>
<!DOCTYPE html PUBLIC \'-//W3C//DTD XHTML 1.0 Transitional//EN\' \'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\'>
<html xmlns=\'http://www.w3.org/1999/xhtml\'>
<head>
<meta http-equiv=\'Content-Type\' content=\'text/html; charset=utf-8\' />
<title>'.$pageName.'</title>
</head>
<body>
<div id="wrapper">
<div id="top"><div id="logo"></div></div>
<div id="content">
<h1>UserCake (Via CupCake)</h1>
<h2>Account</h2>
<div id="left-nav">
<?php
include("$baseURL/application/third_party/user_cake/left-nav.php");
?>

</div>
<div id="main">

</div>
<div id="bottom"></div>
</div>
</body>
</html>');
	fclose($file);
	$newPage = array(str_replace(".php", "", $pageName));
	createPages($newPage);
	$successes[] = lang("PAGE_CREATED_SUCCESSFULLY", array($baseURL, $pageName ));
}else{
	if($pageCheck){
		$errors[] = lang("USER_CREATED_PAGE_EXIST");
	}else{
		$errors[] = lang("PAGE_VALIDATION_ERROR");
		}
}

}
require_once("$baseURL/application/third_party/user_cake/models/header.php");

echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake (Via CupCake)</h1>
<h2>Admin Page</h2>
<div id='left-nav'>";

include("$baseURL/application/third_party/user_cake/left-nav.php");

echo "
</div>
<div id='main'>";

echo resultBlock($errors,$successes);

echo "
<form name='newPage' action='".$_SERVER['PHP_SELF']."' method='post'>
<input type='hidden' name='process' value='1'>
<table class='admin'>
<tr><td>
<h3>Add New Page</h3>
<div id='regbox'>
<p>
<label>New Page Name:</label>
<input type = 'text' name = 'pageName' id = 'pageName'><br/>
(only underscore '_' is allowed as special character.)<br/>
<label>Write your comment:</label><textarea rows = '5' cols = '30' name = 'pageComment' id = 'pageComment'></textarea><br/>
<div>( This is only for documentation purpose. )</div>";

echo "<input type='submit' value='Create' class='submit'/>
</p>
</form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

	}
}
?>