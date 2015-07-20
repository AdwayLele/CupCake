<?php
class Admin_Permissions extends CI_Controller{
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
	if(!empty($_POST['delete']) || !empty($_POST['newPermission'])){
		//Delete permission levels
		if(!empty($_POST['delete'])){
			$deletions = $_POST['delete'];
			if ($deletion_count = deletePermission($deletions)){
			$successes[] = lang("PERMISSION_DELETIONS_SUCCESSFUL", array($deletion_count));
			}
		}
		
		//Create new permission level
		if(!empty($_POST['newPermission'])) {
			$permission = trim($_POST['newPermission']);
			
			//Validate request
			if (permissionNameExists($permission)){
				$errors[] = lang("PERMISSION_NAME_IN_USE", array($permission));
			}
			elseif (minMaxRange(1, 50, $permission)){
				$errors[] = lang("PERMISSION_CHAR_LIMIT", array(1, 50));	
			}
			else{
				if (createPermission($permission)) {
				$successes[] = lang("PERMISSION_CREATION_SUCCESSFUL", array($permission));
			}
				else {
					$errors[] = lang("SQL_ERROR");
				}
			}
		}
	}else{
		$errors[] = lang("NO_PERMISSION_SELECTED");
	}
}

$permissionData = fetchAllPermissions(); //Retrieve list of all permission levels

require_once("$baseURL/application/third_party/user_cake/models/header.php");

echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake (Via CupCake)</h1>
<h2>Admin Permissions</h2>
<div id='left-nav'>";

include("$baseURL/application/third_party/user_cake/left-nav.php");

echo "
</div>
<div id='main'>";

echo resultBlock($errors,$successes);

echo "
<form name='adminPermissions' action='".$_SERVER['PHP_SELF']."' method='post'>
<table class='admin'>
<tr>
<th>Delete</th><th>Permission Name</th>
</tr>";

//List each permission level
foreach ($permissionData as $v1) {
	echo "
	<tr>
	<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
	<td><a href='".str_replace('index.php/', '', site_url('admin_permission'))."?id=".$v1['id']."'>".$v1['name']."</a></td>
	</tr>";
}

echo "
</table>
<p>
<label>Permission Name:</label>
<input type='text' name='newPermission' />
</p>                                
<input type='submit' name='Submit' value='Submit' />
</form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

}
}
?>