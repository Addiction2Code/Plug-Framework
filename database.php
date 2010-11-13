<?php

//Fill out this information.
$server = 'localhost';
$username = 'root';
$password = '';
$db = '';

//Use the following format to use database tables. This way you can easily edit them.
$DatabaseTables['Users'] = 'users';
//The Content Plugin Requires both Users and Content in the database
$DatabaseTables['Content'] = 'media_pages';

//This is the connection script
$con = mysql_connect($server,$username,$password);
if (!$con) /* If $con is false, Report error. */
	die('Connection Error: ' . mysql_error());

mysql_select_db($db, $con);

?>
