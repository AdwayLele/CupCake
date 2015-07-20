<?php
/*
UserCake (Via CupCake) Version: 2.0.2
http://usercake.com
*/

class loggedInUser {
	public $email = NULL;
	public $hash_pw = NULL;
	public $user_id = NULL;
	
	//Simple function to update the last sign in of a user
	public function updateLastSignIn()
	{
		$time = time();
		$query = UcUsersQuery::create()->findById($this->user_id);	
		$user = $query[0];
		$user->setLastSignInStamp($time);
		$user->save();
	}
	
	//Return the timestamp when the user registered
	public function signupTimeStamp()
	{
		$query = UcUsersQuery::create()->findById($this->user_id);	
		$user = $query[0];
		$timestamp = $user->getSignUpStamp();
		return ($timestamp);
	}
	
	//Update a users password
	public function updatePassword($pass)
	{
		$secure_pass = generateHash($pass);
		$query = UcUsersQuery::create()->findById($this->user_id);	
		$user = $query[0];
		$user->setPassword($secure_pass);
		$user->save();
	}
	
	//Update a users email
	public function updateEmail($email)
	{
		$query = UcUsersQuery::create()->findById($this->user_id);	
		$user = $query[0];
		$user->setEmail($email);
		$user->save();
	}
	
	//Is a user has a permission
	public function checkPermission($permission)
	{
		global $master_account;
		
		//Grant access if master user	
		$access = 0;
		foreach($permission as $check){
			if ($access == 0){
				$query = UcUserPermissionMatchesQuery::create()->filterByUserId($this->user_id)->filterByPermissionId($check)->find();
				if (count($query) > 0){
					$access = 1;
				}
			}
		}
		if ($access == 1)
		{
			return true;
		}
		if ($this->user_id == $master_account){
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	//Logout
	public function userLogOut($parent)
	{
		$parent->session->unset_userdata('userCakeUser');
		
	}	
}

?>