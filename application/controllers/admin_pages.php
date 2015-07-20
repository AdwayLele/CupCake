<?php
class Admin_Pages extends CI_Controller{
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
GLOBAL $baseURL;
require_once("$baseURL/application/third_party/user_cake/models/config.php");
	
if (!securePage($_SERVER['PHP_SELF'])){die();}

$pages = getPageFiles(); //Retrieve list of pages in root usercake folder
$dbpages = fetchAllPages(); //Retrieve list of pages in pages table
$creations = array();
$deletions = array();

//Check if any pages exist which are not in DB
foreach ($pages as $page){
	if(!isset($dbpages[str_replace(".php", "", $page)])){
		$creations[] = str_replace(".php", "", $page);	
	}
}

//Enter new pages in DB if found
if (count($creations) > 0) {
	createPages($creations)	;
}

if (count($dbpages) > 0){
	//Check if DB contains pages that don't exist
	foreach ($dbpages as $page){
		if(!isset($pages[$page['page'].'.php'])){
			$deletions[] = $page['id'];
		}
	}
}

//Delete pages from DB if not found
if (count($deletions) > 0) {
	deletePages($deletions);
}

//Update DB pages
$dbpages = fetchAllPages();

require_once("$baseURL/application/third_party/user_cake/models/header.php");

echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake (Via CupCake)</h1>
<h2>Admin Pages</h2>
<div id='left-nav'>";

include("$baseURL/application/third_party/user_cake/left-nav.php");

echo "
</div>
<div id='main'>
<form name='adminPages' action='".$_SERVER['PHP_SELF']."' method='post'>
<table class='admin'>
<tr><th>Delete</th><th>Id</th><th>Page</th><th>Access</th></tr>";

//Display list of pages
foreach ($dbpages as $page){
	echo "
	<tr>
	<td><input type='checkbox' name='delete[".$page['id']."]' id='delete[".$page['id']."]' value='".$page['id']."'></td>
	<td>
	".$page['id']."
	</td>
	<td>
	<a href ='".str_replace('index.php/', '', site_url('admin_page'))."?id=".$page['id']."'>".$page['page']."</a>
	</td>
	<td>";
	
	//Show public/private setting of page
	if($page['private'] == 0){
		echo "Public";
	}
	else {
		echo "Private";	
	}
	
	echo "
	</td>
	</tr>";
}

echo "
</table>
<input type = 'submit' value = 'Submit'/>
</form>
</div>
<div id='bottom'></div>
</div>
<div id = 'createNewPage'>
<a href ='".str_replace('index.php/', '', site_url('new_page'))."'>Add Page</a>
</div>
</body>
</html>";

	}
}
?>