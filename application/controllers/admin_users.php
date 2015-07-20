<?php
class Admin_Users extends CI_Controller{
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
$baseURL = getcwd();
require_once("$baseURL/application/third_party/user_cake/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	if(!empty($_POST['delete'])){
		$deletions = $_POST['delete'];
		if ($deletion_count = deleteUsers($deletions)){
			$successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
		}
		else {
			$errors[] = lang("SQL_ERROR");
		}
	}else{
		$errors[] = lang("NO_SELECTION_TO_DELETE_USER");
	}
}

$userData = fetchAllUsers(); //Fetch information for all users

require_once("$baseURL/application/third_party/user_cake/models/header.php");
echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake (Via CupCake)</h1>
<h2>Admin Users</h2>
<div id='left-nav'>";

include("$baseURL/application/third_party/user_cake/left-nav.php");

echo "
</div>
<div id='main'>";

echo resultBlock($errors,$successes);

echo "
<form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
<table class='admin'>
<tr>
<th>Delete</th><th>Username</th><th>Display Name</th><th>Title</th><th>Last Sign In</th>
</tr>";

//Cycle through users
foreach ($userData as $v1) {
	echo "
	<tr>
	<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
	<td><a href='".str_replace('index.php/', '', site_url('admin_user'))."?id=".$v1['id']."'>".$v1['user_name']."</a></td>
	<td>".$v1['display_name']."</td>
	<td>".$v1['title']."</td>
	<td>
	";
	
	//Interprety last login
	if ($v1['last_sign_in_stamp'] == '0'){
		echo "Never";	
	}
	else {
		echo date("j M, Y", $v1['last_sign_in_stamp']);
	}
	echo "
	</td>
	</tr>";
}

echo "
</table>
<input type='submit' name='Submit' value='Delete' />
</form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

	}
}
?>