<?php
/*
UserCake (Via CupCake) Version: 2.0.2
http://usercake.com
*/

GLOBAL $db_table_prefix;
//Database Information
$db_host = "localhost"; //Host address (most likely localhost)
$db_name = "cpu"; //Name of Database
$db_user = "cpu"; //Name of database user
$db_pass = "cpu123"; //Password for database user
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

?>