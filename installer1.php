<?php 
/*
UserCake (Via CupCake) Version: 2.0.2
http://usercake.com
*/
ini_set("display_errors", 1);
error_reporting(E_ALL);
$baseURL = getcwd();
$dbSettings = false;
$propelFiles = false;
global $host, $dbName, $userName, $password;

echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>UserCake (Via CupCake)</title>
<link href='site-templates/default.css' rel='stylesheet' type='text/css' />
<script src='js/funcs.js' type='text/javascript'>
</script>
</head>
<body>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake (Via CupCake)</h1>
<h2>Installer</h2>";	

if(!empty($_POST)){
$host = $_POST['hostName'];
$dbName = $_POST['dbName'];
$userName = $_POST['userName'];
$password = $_POST['password'];
$file = fopen("$baseURL/database_settings.php", "w");
$writtenFile = fwrite($file,'<?php
/*
UserCake (Via CupCake) Version: 2.0.2
http://usercake.com
*/

GLOBAL $db_table_prefix;
//Database Information
$db_host = "'.$host.'"; //Host address (most likely localhost)
$db_name = "'.$dbName.'"; //Name of Database
$db_user = "'.$userName.'"; //Name of database user
$db_pass = "'.$password.'"; //Password for database user
$db_table_prefix = "uc_";

GLOBAL $errors;
GLOBAL $successes;
GLOBAL $mysqli;


$errors = array();
$successes = array();

/* Create a new mysqli object with database connection parameters */
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

//Direct to install directory, if it exists
if(is_dir("install/"))
{
	header("Location: install/");
	die();

}

?>');
fclose($file);

if($writtenFile){
$dbSettings = true;
echo "Database settings created successfully.<br/>";
echo "Creating propel related xml file.";
$xmlFile = fopen("$baseURL/application/build/data/build.properties", "w");
$writtenXmlFile = fwrite($xmlFile,'
# -------------------------------------------------------------------
#
# P R O P E L  C O N F I G U R A T I O N  F I L E
#
# -------------------------------------------------------------------
# This file contains some example properties.  Ideally properties
# should be specified in the project-specific build.properties file;
# however, this file can be used to specify non-default properties
# that you would like to use across all of your Propel projects.
# -------------------------------------------------------------------
#

propel.home = .

# -------------------------------------------------------------------
#
#  P R O J E C T
#
# -------------------------------------------------------------------
# This is the name of your Propel project. The name of your Propel
# project is used (by default) to determine where the generator will
# find needed configuration files and will place resulting build
# files. E.g. if your project is named \'killerapp\', Propel will
# look here for schema.xml and runtime-conf.xml files:
#
#   projects/killerapp/
#
# -------------------------------------------------------------------

# You can set this here, but it\'s preferable to set this in a
# project-specific build.properties file.
#
 propel.project = CPU

# -------------------------------------------------------------------
#
#  T A R G E T  D A T A B A S E
#
# -------------------------------------------------------------------
# This is the target database, only considered when generating
# the SQL for your Propel project. Your possible choices are:
#
#   mssql, mysql, oracle, pgsql, sqlite
# -------------------------------------------------------------------

# You can set this here, but it\'s preferable to set this in a
# project-specific build.properties file.
#
 propel.database = mysql

# -------------------------------------------------------------------
#
#  O B J E C T  M O D E L  I N F O R M A T I O N
#
# -------------------------------------------------------------------
# These settings will allow you to customize the way your
# Peer-based object model is created.
# -------------------------------------------------------------------
# addGenericAccessors
#   If true, Propel adds methods to get database fields by name/position.
#
# addGenericMutators
#   If true, Propel adds methods to set database fields by name/position.
#
# addSaveMethod
#   If true, Propel adds tracking code to determine how to save objects.
#
# addTimeStamp
#   If true, Propel true puts time stamps in phpdoc of generated om files.
#
# basePrefix
#   A string to pre-pend to the file names of base data and peer objects.
#
# complexObjectModel
#   If true, Propel generates data objects with collection support and
#   methods to easily retrieve foreign key relationships.
#
# targetPackage
#   Sets the PHP "package" the om files will generated to, e.g.
#   "com.company.project.om".
#
# targetPlatform
#   Sets whether Propel is building classes for php5 (default)
#   or php4 (experimental).
#
# packageObjectModel
#   Sets whether Propel is packaging ObjectModel for several
#   [package].schema.xml files. The <database package="packageName">
#   attribute has to be set then. (warning: this is experimental!)
#
# -------------------------------------------------------------------

# classes will be put in (and  included from) this directory
# e.g. if package is "bookstore" then om will expect include(\'bookstore/Book.php\'); to work.
# use dot-path notation -- e.g. my.bookstore -> my/bookstore.
#
propel.targetPackage = .

propel.addGenericAccessors = true
propel.addGenericMutators = true
propel.addSaveMethod = true
propel.addTimeStamp = true
propel.basePrefix = Base
propel.complexObjectModel = true
propel.targetPlatform = php5
propel.packageObjectModel = false

# -------------------------------------------------------------------
#
#  D B   C O N N E C T I O N   S E T T I N G S
#
# -------------------------------------------------------------------
# PDO connection settings. These connection settings are used by
# build targets that perform database operations (e.g. \'insert-sql\',
# \'reverse\').
#
# You can set them here, but it\'s preferable to set these properties
# in a project-specific build.properties file.
#

# If you want to use a custom driver, specify it below, otherwise
# leave it blank or comment it out to use Creole stock driver.
#
# propel.database.driver = creole.drivers.sqlite.SQLiteConnection

# Note that if you do not wish to specify the database (e.g. if you
# are using multiple databases) you can use the @DB@ token which
# will be replaced with a database at runtime.
#
 propel.database.url = mysql:host='.$host.';dbname='.$dbName.'

# For MySQL or Oracle, you also need to specify username & password
 propel.database.user = '.$userName.'
 propel.database.password = '.$password.'

# Use the URL below to specify a DSN to used to create the database.
# Note that this URL should not contain the database name, as you will
# get an error if the database does not exist.
# (This does not apply to SQLite since the database is automatically created
# when the connection is made -- if it does not already exist.)
#
# propel.database.createUrl = mysql:host=$host;dbname=$database


# -------------------------------------------------------------------
#
# D A T A B A S E  TO  X M L
#
# -------------------------------------------------------------------
#
# samePhpName
#   If true, the reverse task will set the phpName attribute for the
#   tables and columns to be the same as SQL name.
#
# addVendorInfo
#   If true, the reverse task will add all vendor specific information
#   to the database schema. Under `mysql` the `Engine` vendor information
#   is always added.
#
# addValidators
#   List of Validators that the reverse task may add to the schema
#   based on database constraints.
#   Allowed tokens are:
#      none       add no validators
#      all        add all validators
#      maxlength  add maxlengths for string type columns
#      maxvalue   add maxvalue for numeric columns
#      type       add notmatch validators for numeric columns
#      required   add required validators for required columns
#      unique     add unique validators for unique indexes
#   You can cherry-pick allowed validators by using a comma-separated value, e.g
#      maxvalue,type,required
#
# -------------------------------------------------------------------

# propel.samePhpName = false
# propel.addVendorInfo=true
# propel.addValidators=none


# -------------------------------------------------------------------
#
#  D A T A B A S E   B U I L D   C O N F I G
#
# -------------------------------------------------------------------
# Some databases provide some configuration options that can be set
# in this script.
#
# === MySQL
# propel.mysql.tableType
#   Use this property to set the table type of generated tables (e.g. InnoDB, MyISAM).


# -------------------------------------------------------------------
#  D I R E C T O R I E S
# -------------------------------------------------------------------

propel.project.dir = ${propel.home}
propel.output.dir = ${propel.project.dir}/output
propel.conf.dir = ${propel.project.dir}
propel.sql.dir = ${propel.output.dir}/sql
propel.graph.dir = ${propel.output.dir}/graphs
propel.omtar.dir = ${propel.output.dir}
propel.php.dir = ../../../models
propel.phpconf.dir = ../../../config');
fclose($xmlFile);

$xmlFile2 = fopen("$baseURL/application/build/data/buildtime-conf.xml", "w");
$writtenXmlFile2 = fwrite($xmlFile2,'<?xml version="1.0" encoding="UTF-8"?>
<config>
  <!-- Uncomment this if you have PEAR Log installed
  <log>
    <type>file</type>
    <name>/path/to/propel.log</name>
    <ident>propel-ci</ident>
    <level>7</level>
  </log>
  -->
  <propel>
    <datasources default="'.$dbName.'">
      <datasource id="'.$dbName.'">
        <adapter>mysql</adapter> <!-- sqlite, mysql, mssql, oracle, or pgsql -->
        <connection>
          <dsn>mysql:host='.$host.';dbname='.$dbName.'</dsn>
          <user>'.$userName.'</user>
          <password>'.$password.'</password>
        </connection>
      </datasource>
    </datasources>
  </propel>
</config>');
fclose($xmlFile2);
$xmlFile3 = fopen("$baseURL/application/build/data/runtime-conf.xml", "w");
$writtenXmlFile3 = fwrite($xmlFile3,'<?xml version="1.0" encoding="UTF-8"?>
<config>
  <!-- Uncomment this if you have PEAR Log installed
  <log>
    <type>file</type>
    <name>/path/to/propel.log</name>
    <ident>propel-ci</ident>
    <level>7</level>
  </log>
  -->
  <propel>
    <datasources default="'.$dbName.'">
      <datasource id="'.$dbName.'">
        <adapter>mysql</adapter> <!-- sqlite, mysql, mssql, oracle, or pgsql -->
        <connection>
          <dsn>mysql:host='.$host.';dbname='.$dbName.'</dsn>
          <user>'.$userName.'</user>
          <password>'.$password.'</password>
        </connection>
      </datasource>
    </datasources>
  </propel>
</config>');
fclose($xmlFile3);

$conf = fopen("$baseURL/application/config/cpu-conf.php", "w");
$confFile = fwrite($conf, '<?php
// This file generated by Propel 1.7.0 convert-conf target
// from XML runtime conf file C:\xampp\htdocs\cpu\application\build\data\runtime-conf.xml
$conf = array (
  \'datasources\' => 
  array (
    \''.$dbName.'\' => 
    array (
      \'adapter\' => \'mysql\',
      \'connection\' => 
      array (
        \'dsn\' => \'mysql:host='.$host.';dbname='.$dbName.'\',
        \'user\' => \''.$userName.'\',
        \'password\' => \''.$password.'\',
      ),
    ),
    \'default\' => \'cpu\',
  ),
  \'generator_version\' => \'1.7.0\',
);
$conf["classmap"] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . \'classmap-cpu-conf.php\');
return $conf;
?>');

function write_model_file($fentry){
global $dbName;
$content = file_get_contents($fentry);
$content = str_replace("cpu", $dbName, $content);
$fhandle = fopen($fentry,"w");
fwrite($fhandle,$content);
fclose($fhandle);

}

$directory = "$baseURL/application/models/om/";
$languages = array_map("write_model_file", glob($directory . "*.php"));


if($writtenXmlFile == true && $writtenXmlFile2 == true && $writtenXmlFile3 == true && $confFile == true){
	$propelFiles = true;
	echo "All xml files have been written successfully.";
}else{
	echo "There is some error writing xml files, please try again.";
	exit;
}

}else{
echo "Some error occored during database settings, please try again.";
}
}
if(!$dbSettings && !isset($_GET["install"])){
echo "<div id = 'main'>
<h2>Enter details for database settings</h2>
<form id = 'dbDetails' method = 'post' action = '".$_SERVER['PHP_SELF']."'>
<label>Host:</label><input type = 'text' name = 'hostName'><br/>
<label>Database Name:</label><input type = 'text' name = 'dbName'><br/>
<label>User:</label><input type = 'text' name = 'userName'><br/>
<label>Password:</label><input type = 'text' name = 'password'><br/>
<input type = 'submit' value = 'submit'>
</form>
</div>";
}
require_once("database_settings.php");
if(isset($_GET["install"]))
{
	$db_issue = false;
	
	$permissions_sql = "
	CREATE TABLE IF NOT EXISTS `".$db_table_prefix."permissions` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(150) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
	";
	
	$permissions_entry = "
	INSERT INTO `".$db_table_prefix."permissions` (`id`, `name`) VALUES
	(1, 'New Member'),
	(2, 'Administrator');
	";
	
	$users_sql = "
	CREATE TABLE IF NOT EXISTS `".$db_table_prefix."users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_name` varchar(50) NOT NULL,
	`display_name` varchar(50) NOT NULL,
	`password` varchar(225) NOT NULL,
	`email` varchar(150) NOT NULL,
	`activation_token` varchar(225) NOT NULL,
	`last_activation_request` int(11) NOT NULL,
	`lost_password_request` tinyint(1) NOT NULL,
	`active` tinyint(1) NOT NULL,
	`title` varchar(150) NOT NULL,
	`sign_up_stamp` int(11) NOT NULL,
	`last_sign_in_stamp` int(11) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	";
	
	$user_permission_matches_sql = "
	CREATE TABLE IF NOT EXISTS `".$db_table_prefix."user_permission_matches` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`permission_id` int(11) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
	";
	
	$user_permission_matches_entry = "
	INSERT INTO `".$db_table_prefix."user_permission_matches` (`id`, `user_id`, `permission_id`) VALUES
	(1, 1, 2);
	";
	
	$configuration_sql = "
	CREATE TABLE IF NOT EXISTS `".$db_table_prefix."configuration` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(150) NOT NULL,
	`value` varchar(150) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
	";
	
	$configuration_entry = "
	INSERT INTO `".$db_table_prefix."configuration` (`id`, `name`, `value`) VALUES
	(1, 'website_name', 'UserCake (Via CupCake)'),
	(2, 'website_url', 'localhost/'),
	(3, 'email', 'noreply@ILoveUserCake (Via CupCake).com'),
	(4, 'activation', 'false'),
	(5, 'resend_activation_threshold', '0'),
	(6, 'language', '/languages/en.php'),
	(7, 'template', '/site-templates/default.css');
	";
	
	$pages_sql = "CREATE TABLE IF NOT EXISTS `".$db_table_prefix."pages` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`page` varchar(150) NOT NULL,
	`is_private` tinyint(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;
	";
	
	$pages_entry = "INSERT INTO `".$db_table_prefix."pages` (`id`, `page`, `is_private`) VALUES
	(1, 'account', 1),
	(2, 'activate_account', 0),
	(3, 'admin_configuration', 1),
	(4, 'admin_page', 1),
	(5, 'admin_pages', 1),
	(6, 'admin_permission', 1),
	(7, 'admin_permissions', 1),
	(8, 'admin_user', 1),
	(9, 'admin_users', 1),
	(10, 'forgot_password', 0),
	(11, 'index', 0),
	(12, 'left-nav.php', 0),
	(13, 'login', 0),
	(14, 'logout', 1),
	(15, 'register', 0),
	(16, 'resend_activation', 0),
	(17, 'user_settings', 1);
	";
	
	$permission_page_matches_sql = "CREATE TABLE IF NOT EXISTS `".$db_table_prefix."permission_page_matches` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`permission_id` int(11) NOT NULL,
	`page_id` int(11) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;
	";
	
	$permission_page_matches_entry = "INSERT INTO `".$db_table_prefix."permission_page_matches` (`id`, `permission_id`, `page_id`) VALUES
	(1, 1, 1),
	(2, 1, 14),
	(3, 1, 17),
	(4, 2, 1),
	(5, 2, 3),
	(6, 2, 4),
	(7, 2, 5),
	(8, 2, 6),
	(9, 2, 7),
	(10, 2, 8),
	(11, 2, 9),
	(12, 2, 14),
	(13, 2, 17);
	";
	
	$stmt = $mysqli->prepare($configuration_sql);
	if($stmt->execute())
	{
		$cfg_result = "<p>".$db_table_prefix."configuration table created.....</p>";
	}
	else
	{
		$cfg_result = "<p>Error constructing ".$db_table_prefix."configuration table.</p>";
		$db_issue = true;
	}
	
	echo $cfg_result;
	$stmt = $mysqli->prepare($configuration_entry);
	if($stmt->execute())
	{
		echo "<p>Inserted basic config settings into ".$db_table_prefix."configuration table.....</p>";
	}
	else
	{
		echo "<p>Error inserting config settings access.</p>";
		$db_issue = true;
	}
	
	$stmt = $mysqli->prepare($permissions_sql);
	if($stmt->execute())
	{
		echo "<p>".$db_table_prefix."permissions table created.....</p>";
	}
	else
	{
		echo "<p>Error constructing ".$db_table_prefix."permissions table.</p>";
		$db_issue = true;
	}
	
	$stmt = $mysqli->prepare($permissions_entry);
	if($stmt->execute())
	{
		echo "<p>Inserted 'New Member' and 'Admin' groups into ".$db_table_prefix."permissions table.....</p>";
	}
	else
	{
		echo "<p>Error inserting permissions.</p>";
		$db_issue = true;
	}
	
	$stmt = $mysqli->prepare($user_permission_matches_sql);
	if($stmt->execute())
	{
		echo "<p>".$db_table_prefix."user_permission_matches table created.....</p>";
	}
	else
	{
		echo "<p>Error constructing ".$db_table_prefix."user_permission_matches table.</p>";
		$db_issue = true;
	}
	
	$stmt = $mysqli->prepare($user_permission_matches_entry);
	if($stmt->execute())
	{
		echo "<p>Added 'Admin' entry for first user in ".$db_table_prefix."user_permission_matches table.....</p>";
	}
	else
	{
		echo "<p>Error inserting admin into ".$db_table_prefix."user_permission_matches.</p>";
		$db_issue = true;
	}
	
	$stmt = $mysqli->prepare($pages_sql);
	if($stmt->execute())
	{
		echo "<p>".$db_table_prefix."pages table created.....</p>";
	}
	else
	{
		echo "<p>Error constructing ".$db_table_prefix."pages table.</p>";
		$db_issue = true;
	}
	
	$stmt = $mysqli->prepare($pages_entry);
	
	if($stmt->execute())
	{
		echo "<p>Added default pages to ".$db_table_prefix."pages table.....</p>";
	}
	else
	{
		echo "<p>Error inserting pages into ".$db_table_prefix."pages.</p>";
		$db_issue = true;
	}
	
	$stmt = $mysqli->prepare($permission_page_matches_sql);
	if($stmt->execute())
	{
		echo "<p>".$db_table_prefix."permission_page_matches table created.....</p>";
	}
	else
	{
		echo "<p>Error constructing ".$db_table_prefix."permission_page_matches table.</p>";
		$db_issue = true;
	}
	
	$stmt = $mysqli->prepare($permission_page_matches_entry);
	if($stmt->execute())
	{
		echo "<p>Added default access to ".$db_table_prefix."permission_page_matches table.....</p>";
	}
	else
	{
		echo "<p>Error adding default access to ".$db_table_prefix."user_permission_matches.</p>";
		$db_issue = true;
	}
	
	$stmt = $mysqli->prepare($users_sql);
	if($stmt->execute())
	{
		echo "<p>".$db_table_prefix."users table created.....</p>";
	}
	else
	{
		echo "<p>Error constructing users table.</p>";
		$db_issue = true;
	}
	
	
	if(!$db_issue){
		echo "<p><strong>Database setup complete, please delete the install folder.</strong></p>";
		copy("$baseURL/database_settings.php", "$baseURL/application/third_party/user_cake/models/database-settings.php");
		rename("$baseURL/application/third_party/user_cake/models/database-settings.php", "$baseURL/application/third_party/user_cake/models/db-settings.php");
	}
	else
	echo "<p><a href=\"?install=true\">Try again</a></p>";
}
else
if($dbSettings == true && $propelFiles == true )
{
	echo "
	<a href='?install=true'>Install UserCake (Via CupCake)</a>
	";
}

echo "
</body>
</html>";

?>