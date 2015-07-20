<?php
/*
UserCake (Via CupCake) Version: 2.0.2
http://usercake.com
*/
require_once("db-settings.php"); //Require DB connection

//Retrieve settings
$query = UcConfigurationQuery::create()->find();
foreach($query as $configSetting){
	$settings[$configSetting->getName()] = array('id' => $configSetting->getId(), 'name' => $configSetting->getName(), 'value' => $configSetting->getValue());
}	

global $websiteUrl, $emailActivation, $websiteName, $template;
//Set Settings
$emailActivation = $settings['activation']['value'];
$mail_templates_dir = "models/mail-templates/";
$websiteName = $settings['website_name']['value'];
$websiteUrl = $settings['website_url']['value'];
$emailAddress = $settings['email']['value'];
$resend_activation_threshold = $settings['resend_activation_threshold']['value'];
$emailDate = date('dmy');
$language = $settings['language']['value'];
$template = $settings['template']['value'];

global $master_account;
$master_account = -1;

$default_hooks = array("#WEBSITENAME#","#WEBSITEURL#","#DATE#");
$default_replace = array($websiteName,$websiteUrl,$emailDate);

if (!file_exists($language)) {
	$language = "languages/en.php";
}

if(!isset($language)) $language =  "languages/en.php";

//Pages to require
require_once($language);
require_once("class.mail.php");
require_once("class.user.php");
require_once("class.newuser.php");
require_once("funcs.php");

// session_start();

//Global User Object Var
//loggedInUser can be used globally if constructed

Global $loggedInUser;
if($this->session->userdata('userCakeUser'))
{
	$loggedInUser = $this->session->userdata('userCakeUser');
}
?>
