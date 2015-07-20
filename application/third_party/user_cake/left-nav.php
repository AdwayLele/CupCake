<?php
/*
UserCake (Via CupCake) Version: 2.0.2
http://usercake.com
*/
if (!securePage($_SERVER['PHP_SELF'])){die();}
global $emailActivation, $loggedInUser;
//Links for logged in user
if(isUserLoggedIn()) {
	echo "
	<ul>
	<li><a href='".str_replace('index.php/', '', site_url('account'))."'>Account Home</a></li>
	<li><a href='".str_replace('index.php/', '', site_url('user_settings'))."'>User Settings</a></li>
	<li><a href='".str_replace('index.php/', '', site_url('logout'))."'>Logout</a></li>
	</ul>";
	
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
	echo "
	<ul>
	<li><a href='".str_replace('index.php/', '', site_url('admin_configuration'))."'>Admin Configuration</a></li>
	<li><a href='".str_replace('index.php/', '', site_url('admin_users'))."'>Admin Users</a></li>
	<li><a href='".str_replace('index.php/', '', site_url('admin_permissions'))."'>Admin Permissions</a></li>
	<li><a href='".str_replace('index.php/', '', site_url('admin_pages'))."'>Admin Pages</a></li>
	</ul>";
	}
} 
//Links for users not logged in
else {
	echo "
	<ul>
	<li><a href='".str_replace('index.php/', '', site_url('index'))."'>Home</a></li>
	<li><a href='".str_replace('index.php/', '', site_url('login'))."'>Login</a></li>
	<li><a href='".str_replace('index.php/', '', site_url('register'))."'>Register</a></li>
	<li><a href='".str_replace('index.php/', '', site_url('forgot_password'))."'>Forgot Password</a></li>";
	if ($emailActivation)
	{
	echo "<li><a href='".str_replace('index.php/', '', site_url('resend_activation'))."'>Resend Activation Email</a></li>";
	}
	echo "</ul>";
}

?>
