<?php
/*
UserCake (Via CupCake) Version: 2.0.2
http://usercake.com
*/


//Functions that do not interact with DB
//------------------------------------------------------------------------------

function ignore_base($entry){
	global $baseURL;
	return str_replace("$baseURL/application/third_party/user_cake/models", "", $entry);
}
//Retrieve a list of all .php files in models/languages

function getLanguageFiles()
{
	global $baseURL;
	$directory = "$baseURL/application/third_party/user_cake/models/languages/";
	$languages = array_map("ignore_base", glob($directory . "*.php"));
	//print each file name
	return $languages;
}

//Retrieve a list of all .css files in models/site-templates 
function getTemplateFiles()
{
	global $baseURL;
	$directory = "$baseURL/application/third_party/user_cake/models/site-templates/";
	$languages = array_map("ignore_base", glob($directory . "*.css"));
	//print each file name
	return $languages;
}

//Retrieve a list of all .php files in root files folder
function getPageFiles()
{
	global $baseURL;
	$directory = "$baseURL/application/controllers/";
	$pages = glob($directory . "*.php");
	//print each file name
	foreach ($pages as $page){
		$row[str_replace("$baseURL/application/controllers/", "", $page)] = str_replace("$baseURL/application/controllers/", "", $page);
	}
	return $row;
}

//Destroys a session as part of logout
function destroySession($name)
{
	if(isset($_SESSION[$name]))
	{
		$_SESSION[$name] = NULL;
		unset($_SESSION[$name]);
	}
}

//Generate a unique code
function getUniqueCode($length = "")
{	
	$code = md5(uniqid(rand(), true));
	if ($length != "") return substr($code, 0, $length);
	else return $code;
}

//Generate an activation key
function generateActivationToken($gen = null)
{
	do
	{
		$gen = md5(uniqid(mt_rand(), false));
	}
	while(validateActivationToken($gen));
	return $gen;
}

//@ Thanks to - http://phpsec.org
function generateHash($plainText, $salt = null)
{
	if ($salt === null)
	{
		$salt = substr(md5(uniqid(rand(), true)), 0, 25);
	}
	else
	{
		$salt = substr($salt, 0, 25);
	}
	
	return $salt . sha1($salt . $plainText);
}

//Checks if an email is valid
function isValidEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	else {
		return false;
	}
}

//Inputs language strings from selected language.
function lang($key,$markers = NULL)
{
	global $lang;
	if($markers == NULL)
	{
		$str = $lang[$key];
	}
	else
	{
		//Replace any dyamic markers
		$str = $lang[$key];
		$iteration = 1;
		foreach($markers as $marker)
		{
			$str = str_replace("%m".$iteration."%",$marker,$str);
			$iteration++;
		}
	}
	//Ensure we have something to return
	if($str == "")
	{
		return ("No language key found");
	}
	else
	{
		return $str;
	}
}

//Checks if a string is within a min and max length
function minMaxRange($min, $max, $what)
{
	if(strlen(trim($what)) < $min)
		return true;
	else if(strlen(trim($what)) > $max)
		return true;
	else
	return false;
}

//Replaces hooks with specified text
function replaceDefaultHook($str)
{
	global $default_hooks,$default_replace;	
	return (str_replace($default_hooks,$default_replace,$str));
}

//Displays error and success messages
function resultBlock($errors,$successes){
	//Error block
	if(count($errors) > 0)
	{
		echo "<div id='error'>
		<a href='#' onclick=\"showHide('error');\">[X]</a>
		<ul>";
		foreach($errors as $error)
		{
			echo "<li>".$error."</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
	//Success block
	if(count($successes) > 0)
	{
		echo "<div id='success'>
		<a href='#' onclick=\"showHide('success');\">[X]</a>
		<ul>";
		foreach($successes as $success)
		{
			echo "<li>".$success."</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}

//Completely sanitizes text
function sanitize($str)
{
	return strtolower(strip_tags(trim(($str))));
}

//Functions that interact mainly with .users table
//------------------------------------------------------------------------------

//Delete a defined array of users
function deleteUsers($users) {
	$i = 0;
	foreach($users as $id){
		$query = UcUsersQuery::create()->findById($id)->delete();
		$query1 = UcUserPermissionMatchesQuery::create()->findById($id)->delete();	
		$i++;
	}
	return $i;
}

//Check if a display name exists in the DB
function displayNameExists($displayname)
{
		$query = UcUsersQuery::create()->filterByDisplayName($displayname)->find();
		return (count($query) > 0);
}

//Check if an email exists in the DB
function emailExists($email)
{
	$query = UcUsersQuery::create()->limit(1)->findByEmail($email);
	return(count($query) > 0);
}

//Check if a user name and email belong to the same user
function emailUsernameLinked($email,$username)
{
	$query = UcUsersQuery::create()->limit(1)->filterByEmail($email)->filterByUserName($username)->find();
	return(count($query) > 0);
}

//Retrieve information for all users
function fetchAllUsers()
{
	$query = UcUsersQuery::create()->find();
	foreach($query as $user){
		$row[] = array('id' => $user->getId(), 
					   'user_name' => $user->getUserName(), 
					   'display_name' => $user->getDisplayName(), 
					   'password' => $user->getPassword(), 
					   'email' => $user->getEmail(), 
					   'activation_token' => $user->getActivationToken(), 
					   'last_activation_request' => $user->getLastActivationRequest(), 
					   'lost_password_request' => $user->getLostPasswordRequest(), 
					   'active' => $user->getActive(), 
					   'title' => $user->getTitle(), 
					   'sign_up_stamp' => $user->getSignUpStamp(), 
					   'last_sign_in_stamp' => $user->getLastSignInStamp());
	}
	
	return ($row);
}

//Retrieve complete user information by username, token or ID
function fetchUserDetails($username=NULL,$token=NULL, $id=NULL)
{
	if($username!=NULL) {
		$query = UcUsersQuery::create()->filterByUserName($username)->find();
	}
	elseif($token!=NULL) {
		$query = UcUsersQuery::create()->filterByActivationToken($token)->find();
	}
	elseif($id!=NULL) {
		$query = UcUsersQuery::create()->findById($id);	
	}

	$user = $query[0];
	$row = array('id' => $user->getId(), 
				 'user_name' => $user->getUserName(),
				 'display_name' => $user->getDisplayName(),
				 'password' => $user->getPassword(),
				 'email' => $user->getEmail(),
				 'activation_token' => $user->getActivationToken(),
				 'last_activation_request' => $user->getLastActivationRequest(),
				 'lost_password_request' => $user->getLostPasswordRequest(),
				 'active' => $user->getActive(),
				 'title' => $user->getTitle(),
				 'sign_up_stamp' => $user->getSignUpStamp(),
				 'last_sign_in_stamp' => $user->getLastSignInStamp());
	return ($row);
}

//Toggle if lost password request flag on or off
function flagLostPasswordRequest($username,$value)
{
	try{
		$query = UcUsersQuery::create()->limit(1)->findByUserName($username);
		$user = $query[0];
		$user->setLostPasswordRequest($value);
		$user->save();
		return (true);
		}catch(Exception $e){
			return (false);
		}
}

//Check if a user is logged in
function isUserLoggedIn()
{
	global $loggedInUser;
	if($loggedInUser == NULL)
	{
		return false;
	}

	$query = UcUsersQuery::create()->filterById($loggedInUser->user_id)
								   ->filterByPassword($loggedInUser->hash_pw)
								   ->filterByActive(true)
								   ->find();
	
	$num_returns = count($query);	
	
		if ($num_returns > 0)
		{
			return true;
		}
		else
		{
			destroySession("userCakeUser");
			return false;	
		}
}

//Change a user from inactive to active
function setUserActive($token)
{
	try{
		$query = UcUsersQuery::create()->limit(1)->findByActivationToken($token);
		$user = $query[0];
		$user->setActive(1);
		$user->save();
		return (true);
		}catch(Exception $e){
			return (false);
		}
}

//Change a user's display name
function updateDisplayName($id, $display)
{
	try{
		$query = UcUsersQuery::create()->limit(1)->findById($id);
		$user = $query[0];
		$user->setDisplayName($display);
		$user->save();
		return (true);
		}catch(Exception $e){
			return (false);
		}
}

//Update a user's email
function updateEmail($id, $email)
{
	try{
		$query = UcUsersQuery::create()->findById($id);
		$user = $query[0];
		$user->setEmail($email);
		$user->save();	
		return(true);
		}catch(Exception $e){
			return(false);
		}
}

//Input new activation token, and update the time of the most recent activation request
function updateLastActivationRequest($new_activation_token,$username,$email)
{
	try{
		$query = UcUsersQuery::create()->filterByEmail($email)->filterByUserName($username)->find();
		$user = $query[0];
		$user->setActivationToken($new_activation_token);
		$user->setLastActivationRequest(time());
		$user->save();
		return true;
	}catch(Exception $e){
		return false;
	}
	
}

//Generate a random password, and new token
function updatePasswordFromToken($pass,$token)
{
	$new_activation_token = generateActivationToken();
	try{
		$query = UcUsersQuery::create()->findByActivationToken($token);
		$user = $query[0];
		$user->setActivationToken($new_activation_token);
		$user->setPassword($pass);
		$user->save();
		return true;
	}catch(Exception $e){
		return false;
	}
}

//Update a user's title
function updateTitle($id, $title)
{
	try{
		$query = UcUsersQuery::create()->findById($id);
		$user = $query[0];
		$user->setTitle($title);
		$user->save();
		return true;
	}catch(Exception $e){
		return false;
	}
}

//Check if a user ID exists in the DB
function userIdExists($id)
{
	$query = UcUsersQuery::create()->limit(1)->findById($id);
	return (count($query) > 0);
}

//Checks if a username exists in the DB
function usernameExists($username)
{
	$query = UcUsersQuery::create()->filterByUserName($username)->find();
		return (count($query) > 0);
}

//Check if activation token exists in DB
function validateActivationToken($token,$lostpass=NULL)
{
	if($lostpass == NULL) 
	{	
		$query = UcUsersQuery::create()->filterByActivationToken($token)->filterByActive(0)->limit(1)->find();
		
	}
	else 
	{
		$query = UcUsersQuery::create()->filterByActivationToken($token)->filterByActive(1)->filterByLostPasswordRequest(1)->limit(1)->find();
	}
	return(count($query) > 0);
}

//Functions that interact mainly with .permissions table
//------------------------------------------------------------------------------

//Create a permission level in DB
function createPermission($permission) {
	try{
		$newPermission = new UcPermissions();
		$newPermission->setName($permission);
		$newPermission->save();
		return (true);
		}catch(Exception $e){
			return (false);
		}
}

//Delete a permission level from the DB
function deletePermission($permission) {
	$i = 0;
	foreach($permission as $id){
		if ($id == 1){
			$errors[] = lang("CANNOT_DELETE_NEWUSERS");
		}
		elseif ($id == 2){
			$errors[] = lang("CANNOT_DELETE_ADMIN");
		}
		else{
			$query = UcPermissionsQuery::create()->findById($id)->delete();
			$query2 = UcUserPermissionMatchesQuery::create()->findByPermissionId($id)->delete();
			$query3 = UcPermissionPageMatchesQuery::create()->findByPermissionId($id)->delete();
			$i++;
		}
	}
	return $i;
}

//Retrieve information for all permission levels
function fetchAllPermissions()
{
	$query = UcPermissionsQuery::create()->find();
	foreach($query as $permission){
		$row[] = array('id' => $permission->getId(), 'name' => $permission->getName());
	}
		return ($row);
}

//Retrieve information for a single permission level
function fetchPermissionDetails($id)
{
	$query = UcPermissionsQuery::create()->filterById($id)->limit(1)->find();
	foreach($query as $permissionDetails){
		$row[] = array('id' => $permissionDetails->getId(), 'name' => $permissionDetails->getName());
	}
	return ($row);
}

//Check if a permission level ID exists in the DB
function permissionIdExists($id)
{
	$query = UcPermissionsQuery::create()->filterById($id)->limit(1)->find();
	return(count($query) > 0);
	
}

//Check if a permission level name exists in the DB
function permissionNameExists($permission)
{
	$query = UcPermissionsQuery::create()->filterByName($permission)->limit(1)->find();
	return(count($query) > 0);
}

//Change a permission level's name
function updatePermissionName($id, $name)
{
	try{
		$query = UcPermissionsQuery::create()->filterById($id)->limit(1)->find();
		$permission = $query[0];
		$permission->setName($name);
		$permission->save();
		return (true);
		}catch(Exception $e){
			return (false);
		}
}

//Functions that interact mainly with .user_permission_matches table
//------------------------------------------------------------------------------

//Match permission level(s) with user(s)
function addPermission($permission, $user) {
	$i = 0;
	$permissionObj = new UcUserPermissionMatches();
	if (is_array($permission)){
		foreach($permission as $id){
			$permissionObj->setPermissionId($id);
			$permissionObj->setUserId($user);
			$permissionObj->save();
			$i++;
		}
	}
	elseif (is_array($user)){
		foreach($user as $id){
			$permissionObj->setPermissionId($permission);
			$permissionObj->setUserId($id);
			$permissionObj->save();
			$i++;
		}
	}
	else {
		$permissionObj->setPermissionId($permission);
		$permissionObj->setUserId($user);
		$permissionObj->save();
		$i++;
	}
	return $i;
}

//Retrieve information for all user/permission level matches
function fetchAllMatches()
{
	$query = UcUserPermissionMatchesQuery::create()->find();
	foreach($query as $permissionObject){
		$row[] = array('id' => $permissionObject->getId(), 'user_id' => $permissionObject->getUserId(), 'permission_id' => $permissionObject->getPermissionId());
	}
	return ($row);	
}

//Retrieve list of permission levels a user has
function fetchUserPermissions($user_id)
{
	$query = UcUserPermissionMatchesQuery::create()->findByUserId($user_id);
	foreach($query as $userPermission){
		$row[$userPermission->getPermissionId()] = array('id' => $userPermission->getId(), 'permission_id' => $userPermission->getPermissionId());
	}	
	if (isset($row)){
		return ($row);
	}
}

//Retrieve list of users who have a permission level
function fetchPermissionUsers($permission_id)
{
	$query = UcUserPermissionMatchesQuery::create()->findByPermissionId($permission_id);
	foreach($query as $permissionUsers){
		$row[$permissionUsers->getUserId()] = array('id' => $permissionUsers->getId(), 'user_id' => $permissionUsers->getUserId());
	}
		if (isset($row)){
		return ($row);
	}
}

//Unmatch permission level(s) from user(s)
function removePermission($permission, $user) {
	$i = 0;
	if (is_array($permission)){
		foreach($permission as $id){
			$query = UcUserPermissionMatchesQuery::create()->filterByPermissionId($id)->filterByUserId($user)->delete();
			$i++;
		}
	}
	elseif (is_array($user)){
		foreach($user as $id){
			$query = UcUserPermissionMatchesQuery::create()->filterByPermissionId($permission)->filterByUserId($id)->delete();
			$i++;
		}
	}
	else {
		$query = UcUserPermissionMatchesQuery::create()->filterByPermissionId($permission)->filterByUserId($user)->delete();
		$i++;
	}
	return $i;
}

//Functions that interact mainly with .configuration table
//------------------------------------------------------------------------------

//Update configuration table
function updateConfig($id, $value)
{
	foreach ($id as $cfg){
		$query = UcConfigurationQuery::create()->findById($cfg);
		$config = $query[0];
		$config->setValue($value[$cfg]);
		$config->save();
	}
}

//Functions that interact mainly with .pages table
//------------------------------------------------------------------------------

//Add a page to the DB
function createPages($pages) {
	$newPage = new UcPages();
	foreach($pages as $page){
		$newPage->setPage($page);
		$newPage->save();
	}
}

//Delete a page from the DB
function deletePages($pages) {
	foreach($pages as $id){
		$query = UcPagesQuery::create()->findById($id)->delete();
		$query1 = UcPermissionPageMatchesQuery::create()->findById($id)->delete();
	}
}

//Fetch information on all pages
function fetchAllPages()
{
	$query = UcPagesQuery::create()->find();
	foreach($query as $page){
		$row[$page->getPage()] = array('id' => $page->getId(), 'page' => $page->getPage(), 'private' => $page->getIsPrivate());
	}
	if (isset($row)){
		return ($row);
	}
}

//Fetch information for a specific page
function fetchPageDetails($id)
{
	$query = UcPagesQuery::create()->limit(1)->findById($id);
	foreach($query as $pageDetails){
		$row = array('id' => $pageDetails->getId(), 'page' => $pageDetails->getPage(), 'private' => $pageDetails->getIsPrivate());
	}
	return ($row);
}

//Check if a page ID exists
function pageIdExists($id)
{
	$query = UcPagesQuery::create()->limit(1)->findById($id);
	return(count($query) > 0);
}

//Toggle private/public setting of a page
function updatePrivate($id, $private)
{
	try{
		$query = UcPagesQuery::create()->findById($id);
		$page = $query[0];
		$page->setIsPrivate($private);
		$page->save();
		return(true);
	}catch(Exception $e){
		return(false);
	}
	
}

//Functions that interact mainly with .permission_page_matches table
//------------------------------------------------------------------------------

//Match permission level(s) with page(s)
function addPage($page, $permission) {
	$newPage = new UcPermissionPageMatches();
	$i = 0;
	if (is_array($permission)){
		foreach($permission as $id){
			$newPage->setPermissionId($id);
			$newPage->setPageId($page);
			$newPage->save();
			$i++;
		}
	}
	elseif (is_array($page)){
		foreach($page as $id){
			$newPage->setPermissionId($permission);
			$newPage->setPageId($id);
			$newPage->save();
			$i++;
		}
	}
	else {
			$newPage->setPermissionId($permission);
			$newPage->setPageId($page);
			$newPage->save();
			$i++;
	}
	return $i;
}

//Retrieve list of permission levels that can access a page
function fetchPagePermissions($page_id)
{
	$query = UcPermissionPageMatchesQuery::create()->findByPageId($page_id);
	foreach($query as $pagePermissions){
		$row[$pagePermissions->getPermissionId()] = array('id' => $pagePermissions->getId(), 'permission_id' => $pagePermissions->getPermissionId());	
	}
	if (isset($row)){
		return ($row);
	}
}

//Retrieve list of pages that a permission level can access
function fetchPermissionPages($permission_id)
{
	$query = UcPermissionPageMatchesQuery::create()->findByPermissionId($permission_id);
	foreach($query as $permissionPage){
		$row[$permissionPage->getPageId()] = array('id' => $permissionPage->getId(), 'permission_id' => $permissionPage->getPageId());
	}
	if (isset($row)){
		return ($row);
	}
}

//Unmatched permission and page
function removePage($page, $permission) {
	$i = 0;
	if (is_array($page)){
		foreach($page as $id){
			$query = UcPermissionPageMatchesQuery::create()->filterByPermissionId($permission)->filterByPageId($id)->delete();
			$i++;
		}
	}
	elseif (is_array($permission)){
		foreach($permission as $id){
			$query = UcPermissionPageMatchesQuery::create()->filterByPermissionId($id)->filterByPageId($page)->delete();
			$i++;
		}
	}
	else {
		$query = UcPermissionPageMatchesQuery::create()->filterByPermissionId($permission)->filterByPageId($page)->delete();	
		$i++;
	}
	return $i;
}

//Check if a user has access to a page
function securePage($uri){

	//Separate document name from uri
	$tokens = explode('/', $uri);
	$page = $tokens[sizeof($tokens)-1];

	global $loggedInUser, $master_account;

	//retrieve page details
	$query = UcPagesQuery::create()->limit(1)->findByPage($page);
		
	foreach($query as $securePage){
		$pageDetails = array('id' => $securePage->getId(), 'page' => $securePage->getPage(), 'private' => $securePage->getIsPrivate());
	}
	
	//If page does not exist in DB, allow access
	if (empty($pageDetails)){
		return false;
	}
	//If page is public, allow access
	elseif ($pageDetails['private'] == 0) {
		return true;	
	}
	//If user is not logged in, deny access
	elseif(!isUserLoggedIn()) 
	{
		header("Location: ".str_replace('index.php/', '', site_url('login')));
		return false;
	}
	else {
		//Retrieve list of permission levels with access to page
		$query = UcPermissionPageMatchesQuery::create()->findByPageId($pageDetails['id']);
		foreach($query as $permission){
			$pagePermissions[] = $permission->getPermissionId();
		}
		
		//Check if user's permission levels allow access to page
		if ($loggedInUser->checkPermission($pagePermissions)){ 
			
			return true;
		}
		//Grant access if master user
		elseif ($loggedInUser->user_id == $master_account){
			return true;
		}
		else {
			header("Location: ".str_replace('index.php/', '', site_url('no_page_found')));
			return false;	
		}
	}
}

?>
